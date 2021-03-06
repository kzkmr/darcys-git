<?php

namespace Plugin\ECCUBE4LineLoginIntegration\Controller;

use Plugin\ECCUBE4LineLoginIntegration\Consts\ApiUrl;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Eccube\Controller\AbstractController;
use Eccube\Entity\Master\CustomerStatus;
use Eccube\Repository\CustomerRepository;
use Plugin\ECCUBE4LineLoginIntegration\Entity\LineLoginIntegration;
use Plugin\ECCUBE4LineLoginIntegration\Controller\Admin\LineLoginIntegrationAdminController;
use Plugin\ECCUBE4LineLoginIntegration\Repository\LineLoginIntegrationSettingRepository;
use Plugin\ECCUBE4LineLoginIntegration\Repository\LineLoginIntegrationRepository;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Routing\Annotation\Route;

class LineLoginIntegrationController extends AbstractController
{

    private $lineChannelId;
    private $lineChannelSecret;
    private $lineIntegrationSettingRepository;
    private $lineIntegrationRepository;
    private $customerRepository;
    private $tokenStorage;
    protected $apiUrl;

    const PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID = 'plugin.line_login_integration.sso.userid';
    const PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE = 'plugin.line_login_integration.sso.state';

    public function __construct(
        LineLoginIntegrationSettingRepository $lineIntegrationSettingRepository,
        LineLoginIntegrationRepository $lineIntegrationRepository,
        CustomerRepository $customerRepository,
        TokenStorageInterface $tokenStorage,
        ApiUrl $apiUrl
    )
    {
        $this->lineIntegrationSettingRepository = $lineIntegrationSettingRepository;
        $this->lineIntegrationRepository = $lineIntegrationRepository;
        $lineIntegrationSetting = $this->getLineLoginIntegrationSetting();
        $this->lineChannelId = $lineIntegrationSetting->getLineChannelId();
        $this->lineChannelSecret = $lineIntegrationSetting->getLineChannelSecret();
        $this->customerRepository = $customerRepository;
        $this->tokenStorage = $tokenStorage;
        $this->apiUrl = $apiUrl;
    }

    /**
     * ???????????????????????????
     *
     * @Route("/plugin_line_login", name="plugin_line_login")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function login(Request $request)
    {
        $url = $this->generateUrl('plugin_line_login_callback',array(),0);
        $state = uniqid();
        $session = $request->getSession();
        $session->set(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE, $state);

        $previousUrl = parse_url(
            $request->headers->get('referer'),PHP_URL_PATH);
        $session->set('$previousUrl' ,$previousUrl);

        // TODO bot_prompt
        // bot_prompt=normal or aggressive
        // https://developers.line.me/ja/docs/line-login/web/link-a-bot/
        $lineAuthUrl = $this->apiUrl->getAccessUrl() . '/oauth2/v2.1/authorize?response_type=code&client_id=' . $this->lineChannelId . '&redirect_uri=' . rawurlencode($url) . '&state=' . $state . '&scope=profile&bot_prompt=aggressive';

        return $this->redirect($lineAuthUrl);
    }

    /**
     * ???????????????????????????????????????
     *
     * @Route("/plugin_line_login_callback", name="plugin_line_login_callback")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function loginCallback(Request $request)
    {
        $code = $request->get('code');
        $state = $request->get('state');

        $session = $request->getSession();

        $originalState = $session->get(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE);
        $session->remove(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE);

        // API??????????????????????????????????????????
        $results = $this->validateParameter($code, $state, $originalState);
        if($results !== null) {
            return $results;
        }

        // ??????????????????????????????
        $tokenJson = $this->publishAccessToken($code);
        if (isset($tokenJson['error'])) {
            //error????????????????????????????????????????????????????????????????????????????????????????????????
            log_error('LINE API ?????????(4)' . $tokenJson['error'] . ' ' . $tokenJson['error_description']);
            return $this->render('error.twig', [
                'error_title'   => '???????????????????????????????????????????????????:4???',
                'error_message' => '???????????????????????????????????????????????????',
            ]);
        }
        if (!array_key_exists("access_token", $tokenJson)) {
            log_error('LINE API ?????????(5)');
            return $this->render('error.twig', [
                'error_title'   => '???????????????????????????????????????????????????:5???',
                'error_message' => '???????????????????????????????????????????????????',
            ]);
        }

        // LineId??????
        $profile = $this->getProfile($tokenJson['access_token']);
        if (!array_key_exists("userId", $profile)) {
            log_error('LINE API ?????????(6): LINE ID???????????????');
            return $this->render('error.twig', [
                'error_title'   => '???????????????????????????????????????????????????:6???',
                'error_message' => '???????????????????????????????????????????????????',
            ]);
        }
        if (empty($profile['userId'])) {
            //LINE API ?????????(6)?????????????????????????????????????????????
            log_error('LINE API ?????????(7): LINE ID?????????');
            return $this->render('error.twig', [
                'error_title'   => '???????????????????????????????????????????????????:7???',
                'error_message' => '???????????????????????????????????????????????????',
            ]);
        }
        $lineUserId = $profile['userId'];

        $session->set(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID, $lineUserId);
        $this->setSession($session);

        // LINE???????????????????????????
        $lineIntegration = $this->lineIntegrationRepository->
            findOneBy(['line_user_id' => $lineUserId]);

        // LINE???????????????????????????ID?????????
        $lineIntegration['customer_id'] ?
            $customerId = $lineIntegration['customer_id'] :
            $customerId = null;

        // ????????????????????????????????????
        $this->customerRepository->findOneBy(['id' => $customerId]) ?
            $customer =
                $this->customerRepository->findOneBy(['id' => $customerId]) :
            $customer = null;

        // LINE??????????????????????????????LINE??????????????????????????????????????????????????????????????????????????????LINE????????????????????????
        if (!is_null($lineIntegration)) {
            // DB??????LINE ID????????????????????????Customer??????????????????????????????????????????LINE ID?????????
            if (is_null($customer)) {
                log_info('????????????????????????(customer_id:' . $customerId . ')??????LINE ID?????????????????????????????????');
                $this->lineIntegrationRepository->deleteLineAssociation($lineIntegration);

                // DB??????LINE ID????????????????????????Customer????????????????????????????????????LINE ID???????????????
            } else if ($customer->getStatus()['id'] == CustomerStatus::WITHDRAWING) {
                log_info('???????????????????????????(customer_id:' . $customerId . ')??????LINE ID?????????????????????????????????');
                $this->lineIntegrationRepository->deleteLineAssociation($lineIntegration);
                $customer = null; // ???????????????????????????????????????????????????????????????????????????????????????
            }
            // ????????????????????????????????????????????????????????????
        }

        // EC-CUBE???????????????????????????????????????????????????????????????????????????LINE??????????????????????????????
        if ($this->isGranted('ROLE_USER')) {
            log_info('LINE??????????????????:?????????????????????');

            //  LINE???????????????????????????????????????????????????????????????
            if (is_null($customer)) {
                $this->associationCustomerAndLineid($lineUserId);

            } else {
                // ??????DB???LINE ID?????????????????????????????????ID
                $registeredCustomerId = $customer->getId();
                // ?????????LINE ID???????????????????????????????????????ID
                $nowLoggedInCustomerId = $this->getUser()->getId();

                if($nowLoggedInCustomerId != $registeredCustomerId) {
                    log_info('????????????????????????LINE ID??????????????????????????????????????????????????????????????? $lineUserId:'.$lineUserId);
                    return $this->render('error.twig', [
                        'error_title'   => '????????????LINE ID??????',
                        'error_message' => "???????????????????????????????????????LINE ID??????????????????????????????",
                    ]);
                }
            }
            return $this->redirectToRoute('mypage_change');
        }
        // EC-CUBE?????????????????????????????????
        else {
            log_info('LINE??????????????????: ???????????????');

            // LINE??????????????????????????????????????????????????????
            if (is_null($lineIntegration)) {
                log_info('LINE????????????????????????');

                return $this->redirectToRoute('entry');
            }

            // LINE???????????????????????????????????????????????????????????????????????????????????????
            if (is_null($customer)) {
                log_info('??????????????????????????????????????????????????????????????????');

                return $this->redirectToRoute('entry');
            }

            // ?????????????????????????????????
            if ($customer->getStatus()->getId() == 1) {
                log_info('???????????????????????????????????? customer_id:'.$customerId);

                if ($session->get('$previousUrl') == '/shopping/login') {
                    return $this->redirectToRoute('shopping_login');
                }

                return $this->redirectToRoute('mypage_login');
            }

            // ??????????????????LINE??????????????????????????????????????????????????????????????????????????????
            if ($customer->getStatus()->getId() == 2) {
                $token = new UsernamePasswordToken($customer, null, 'customer',
                    array('ROLE_USER'));
                $this->tokenStorage->setToken($token);
                log_info('???????????????????????????dtb_customer.id:'.$this->getUser()->getId());

                // ????????????????????????????????????
                $loginEvent = new InteractiveLoginEvent($request, $token);
                $this->eventDispatcher->dispatch(
                    SecurityEvents::INTERACTIVE_LOGIN, $loginEvent);

                // ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                if ($session->get('$previousUrl') == '/shopping/login') {
                    return $this->redirectToRoute('shopping');
                }

                return $this->redirectToRoute('mypage');
            }

            // ?????????????????????????????????????????????
            return $this->redirectToRoute('login');
        }
    }

    /**
     * ????????????????????????????????????
     * @return string
     */
    private function getLineLoginIntegrationSetting()
    {
        $lineIntegrationSetting = $this->lineIntegrationSettingRepository
            ->find(LineLoginIntegrationAdminController::LINE_LOGIN_INTEGRATION_SETTING_TABLE_ID);

        return $lineIntegrationSetting;
    }


    /**
     * LINE API???????????????????????????????????????????????????????????????????????????????????????
     * @param $code
     * @param $state
     * @param $originalState
     *
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    private function validateParameter($code, $state, $originalState){
        if (empty($code)) {
            log_error('LINE API ?????????(0): ?????????????????????');
            $config = $this->lineIntegrationSettingRepository->find(1);
            if (is_null($config) || is_null($config->getLineAddCancelRedirectUrl())) {
                log_error("[LineIntegration] ???????????????????????????????????????");
                return $this->render('error.twig', [
                    'error_title'   => '???????????????????????????????????????????????????:0???',
                    'error_message' => '???????????????????????????????????????????????????',
                ]);
            } else {
                return $this->redirect($config->getLineAddCancelRedirectUrl());
            }
        }
        if (empty($state)) {
            log_error('LINE API ?????????(1): CSRF????????????????????????????????????????????????');
            return $this->render('error.twig', [
                'error_title'   => '???????????????????????????????????????????????????:1???',
                'error_message' => '???????????????????????????????????????????????????',
            ]);
        }
        if (empty($originalState)) {
            log_error('LINE API ?????????(2): ?????????????????????????????????');
            return $this->render('error.twig', [
                'error_title'   => '???????????????????????????????????????????????????:2???',
                'error_message' => '???????????????????????????????????????????????????????????????????????????????????????',
            ]);
        }
        if ($state != $originalState) {
            log_error('LINE API ?????????(3): CSRF?????????????????????????????????????????????????????????????????????????????????');
            return $this->render('error.twig', [
                'error_title'   => '???????????????????????????????????????????????????:3???',
                'error_message' => '???????????????????????????????????????????????????',
            ]);
        }
        return null;
    }

    /**
     * LINE API?????????????????????????????????????????????
     * @param $code
     *
     * @return mixed
     */
    private function publishAccessToken($code){
        $url = $this->generateUrl('plugin_line_login_callback',array(),0);
        $accessTokenUrl = $this->apiUrl->getApiUrl() . "/oauth2/v2.1/token";
        $accessTokenData = array(
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => $url,
            "client_id" => $this->lineChannelId,
            "client_secret" => $this->lineChannelSecret,
        );
        $accessTokenData = http_build_query($accessTokenData, "", "&");
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: " . strlen($accessTokenData)
        );
        $context = array(
            "http" => array(
                "method" => "POST",
                "header" => implode("\r\n", $header),
                "content" => $accessTokenData
            )
        );

        $response = file_get_contents($accessTokenUrl, false, stream_context_create($context));
        $tokenJson = json_decode($response, true);

        return $tokenJson;
    }

    /**
     * LINE API??????LINE ID??????????????????
     * @param $accessToken
     *
     * @return mixed
     */
    private function getProfile($accessToken){
        $lineProfileUrl = $this->apiUrl->getApiUrl() . "/v2/profile";
        $context = array(
            "http" => array(
                "method" => "GET",
                "header" => "Authorization: Bearer " . $accessToken
            )
        );

        $response = file_get_contents($lineProfileUrl, false, stream_context_create($context));
        $profileJson = json_decode($response, true);

        return $profileJson;
    }

    /**
     * ?????????LINE?????????????????????????????????????????????
     * @param $customer
     * @param $lineUserId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function associationCustomerAndLineid($lineUserId){
        log_info('plg_line_login_integration??????????????????');
        $lineIntegration = new LineLoginIntegration();
        $lineIntegration->setLineUserId($lineUserId);
        $lineIntegration->setCustomerId($this->getUser()->getId());
        $this->entityManager->persist($lineIntegration);
        $this->entityManager->flush();
        log_info('LINE ID????????????????????????????????????');
    }
}
