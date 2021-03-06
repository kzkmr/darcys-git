<?php

namespace Plugin\ECCUBE4LineLoginIntegration;

use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Eccube\Event\EccubeEvents;
use Eccube\Entity\Master\CustomerStatus;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Plugin\ECCUBE4LineLoginIntegration\Controller\LineLoginIntegrationController;
use Plugin\ECCUBE4LineLoginIntegration\Controller\Admin\LineLoginIntegrationAdminController;
use Plugin\ECCUBE4LineLoginIntegration\Entity\LineLoginIntegration;
use Plugin\ECCUBE4LineLoginIntegration\Repository\LineLoginIntegrationRepository;
use Plugin\ECCUBE4LineLoginIntegration\Repository\LineLoginIntegrationSettingRepository;
use Twig_Environment;

class LineLoginIntegrationEvent implements EventSubscriberInterface
{
    private $lineLoginIntegrationRepository;
    private $lineLoginIntegrationSettingRepository;
    private $container;
    private $router;
    private $session;
    private $entityManager;
    private $formFactory;
    private $twig;

    public function __construct(
        LineLoginIntegrationRepository $lineLoginIntegrationRepository,
        LineLoginIntegrationSettingRepository $lineLoginIntegrationSettingRepository,
        ContainerInterface $container,
        Twig_Environment $twig
    ) {
        $this->lineLoginIntegrationRepository = $lineLoginIntegrationRepository;
        $this->lineLoginIntegrationSettingRepository = $lineLoginIntegrationSettingRepository;
        $this->container = $container;
        $this->router = $this->container->get('router');
        $this->session = $this->container->get('session');
        $this->entityManager = $this->container->get('doctrine.orm.default_entity_manager');
        $this->formFactory = $this->container->get('form.factory');
        $this->twig = $twig;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Entry/index.twig' => [
                ['onRenderEntryIndex', 10],
                ['onRenderLineEntryButton', -10]
            ],
            //'Entry/confirm.twig' => 'onRenderEntryConfirm',
            EccubeEvents::FRONT_ENTRY_INDEX_COMPLETE => 'onCompleteEntry',
            'Mypage/login.twig' => 'onRenderLineLoginButton',
            'Mypage/change.twig' => 'onRenderMypageChange',
            'Shopping/login.twig' => 'onRenderShoppingLineLoginButton',
            EccubeEvents::FRONT_MYPAGE_CHANGE_INDEX_COMPLETE => 'onCompleteMypageChange',
            EccubeEvents::FRONT_MYPAGE_WITHDRAW_INDEX_COMPLETE => 'onCompleteMypageWithdraw',
            EccubeEvents::ADMIN_CUSTOMER_EDIT_INDEX_COMPLETE => 'onCompleteCustomerEdit',
        ];
    }


    /**
     * ?????????????????????????????????
     * @param TemplateEvent $event
     */
    public function onRenderEntryIndex(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }
    }

    /**
     * ???????????????????????????LINE???????????????????????????
     *
     * @param TemplateEvent $event
     */
    public function onRenderLineEntryButton(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $lineUserId = $this->session->get(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);

        $linkUrl = $this->router->generate("plugin_line_login", array(), UrlGeneratorInterface::ABSOLUTE_URL);
        $imgUrl = $this->router->generate("homepage", array(),
                UrlGeneratorInterface::ABSOLUTE_URL) . 'html/plugin/line_login_integration/assets/img/btn_register_base.png';

        $snipet = '';
        // LINE??????????????????
        if (empty($lineUserId)) {
            $snipet .= '<div class="btn" style=""><a href="' . $linkUrl . '" class="line-button"><img src="' . $imgUrl . '" alt="LINE?????????"></a></div>' . PHP_EOL;
            $snipet .= PHP_EOL;
        }
        // LINE?????????????????????????????????????????????
        else {
            $snipet .= '<div class="col" style="margin-top:-10px; padding:10px;">LINE??????????????????????????????????????????????????????????????????LINE????????????????????????????????????????????????</div>';
            $snipet .= PHP_EOL;
        }

        $search = '<div class="ec-off1Grid__cell">';
        $replace = $search . $snipet;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

    /**
     * ??????????????????????????????LINE????????????
     * @param EventArgs $event
     */
    public function onCompleteEntry(EventArgs $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        // ?????????LINE????????????ID??????????????????line_login_integration???????????????????????????????????????
        log_info('LINE????????????????????????????????????');

        $lineUserId = $this->session->get(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);
        if (!empty($lineUserId)) {
            log_info('LINE????????????????????????????????????????????????????????????????????????');

            $this->lineLoginIntegration = $this->lineLoginIntegrationRepository->findOneBy(['line_user_id' => $lineUserId]);

            if (empty($this->lineLoginIntegration)) {
                $customer = $event['Customer'];
                log_info('LINE ID???????????????????????????????????????', [$customer['id']]);
                $lineLoginIntegration = new LineLoginIntegration();
                $lineLoginIntegration->setLineUserId($lineUserId);
                $lineLoginIntegration->setCustomer($customer);
                $lineLoginIntegration->setCustomerId($customer['id']);
                $this->entityManager->persist($lineLoginIntegration);
                $this->entityManager->flush($lineLoginIntegration);
                log_info('LINE????????????????????????????????????');
            }

            log_info('LINE????????????????????????????????????');
        } else {
            log_info('LINE?????????????????????????????????????????????');
        }
    }

    /**
     * ?????????????????????LINE???????????????????????????
     * @param TemplateEvent $event
     */
    public function onRenderLineLoginButton(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $linkUrl = $this->router->generate("plugin_line_login", array(), UrlGeneratorInterface::ABSOLUTE_URL);
        $imgUrl = $this->router->generate("homepage", array(),
                UrlGeneratorInterface::ABSOLUTE_URL) . 'html/plugin/line_login_integration/assets/img/btn_login_base.png';
        $snipet = '<div class="btn" style=""><a href="' . $linkUrl . '" class="line-button"><img src="' . $imgUrl . '" alt="LINE????????????"></a></div><br>' . PHP_EOL;
        $search = '<div class="ec-off2Grid__cell">';
        $replace = $search . $snipet;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

    /**
     * ???????????????????????????????????????LINE???????????????????????????
     * @param TemplateEvent $event
     */
    public function onRenderShoppingLineLoginButton(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $linkUrl = $this->router->generate("plugin_line_login", array(), UrlGeneratorInterface::ABSOLUTE_URL);
        $imgUrl = $this->router->generate("homepage", array(),
                UrlGeneratorInterface::ABSOLUTE_URL) . 'html/plugin/line_login_integration/assets/img/btn_login_base.png';
        $snipet = '<div class="btn" style=""><a href="' . $linkUrl . '" class="line-button"><img src="' . $imgUrl . '" alt="LINE????????????"></a></div><br>' . PHP_EOL;
        $search = '<div class="ec-grid3__cell2">';
        $replace = $search . $snipet;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

    /**
     * ?????????????????????????????????
     * @param TemplateEvent $event
     */
    public function onRenderMypageChange(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $form = $event->getParameter('form');
        $customerId = $form->vars['value']['id'];
        if (empty($customerId)) {
            error_log("??????ID?????????????????????????????????", [$form]);
            return;
        }

        $lineLoginIntegration = $this->lineLoginIntegrationRepository
            ->findOneBy(['customer_id' => $customerId]);
        $lineIdBySession = $this->session
            ->get(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);

        // LINE??????????????????????????????
        if (empty($lineLoginIntegration)) {
            // LINE??????????????????????????????
            $linkUrl = $this->router->generate("plugin_line_login", array(), UrlGeneratorInterface::ABSOLUTE_URL);
            $imgUrl = $this->router->generate("homepage", array(),
                    UrlGeneratorInterface::ABSOLUTE_URL) . 'html/plugin/line_login_integration/assets/img/btn_register_base.png';
            $snipet = '<div class="btn"><a href="' . $linkUrl . '" class="line-button"><img src="' . $imgUrl . '" alt="LINE?????????"></a></div>' . PHP_EOL;
            $snipet .= PHP_EOL;
            $snipet .= '<div class="col" style="padding-bottom:10px;">???LINE?????????????????????????????????LINE???????????????????????????LINE???????????????????????????????????????????????????????????????</div>';
            $snipet .= PHP_EOL;
        }
        // LINE???????????????????????????????????????LINE?????????????????????????????????????????????
        else if (empty($lineIdBySession)) {
            // LINE??????????????????????????????
            $linkUrl = $this->router->generate("plugin_line_login", array(), UrlGeneratorInterface::ABSOLUTE_URL);
            $imgUrl = $this->router->generate("homepage", array(),
                    UrlGeneratorInterface::ABSOLUTE_URL) . 'html/plugin/line_login_integration/assets/img/btn_login_base.png';
            $snipet = '<div class="btn"><a href="' . $linkUrl . '" class="line-button"><img src="' . $imgUrl . '" alt="LINE?????????"></a></div>' . PHP_EOL;
            $snipet .= PHP_EOL;
            $snipet .= '<div class="col" style="padding-bottom:10px;">LINE????????????????????????????????????????????????LINE????????????????????????????????????</div>';
            $snipet .= PHP_EOL;
        }
        // LINE????????????????????????????????????LINE???????????????????????????
        else {
            // ???????????????????????????
            $this->replaceMypageChangeForm($event);
            $snipet = '<div class="col" style="padding-bottom:10px;">LINE????????????????????????????????????????????????????????????LINE?????? ????????????????????????????????????????????????????????????????????????????????????</div>';
            $snipet .= PHP_EOL;
        }

        $search = '<div class="ec-off1Grid__cell">';
        $replace = $search . $snipet;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

    /**
     * ???????????????????????????????????????????????????????????????
     *
     * @param EventArgs $event
     */
    public function onCompleteMypageChange(EventArgs $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $customerId = $event['Customer']->getId();
        $lineLoginIntegration = $this->lineLoginIntegrationRepository->findOneBy(['customer_id' => $customerId]);

        // LINE????????????????????????????????????
        if (!empty($lineLoginIntegration)) {
            $form = $event['form'];
            // LINE?????????????????????
            if ($form->has('is_line_delete')) {
                $is_line_delete = $form->get('is_line_delete')->getData();
            }
            if ($is_line_delete == 1) {
                // ????????????
                $this->lineIdUnassociate($customerId, true);
            }
        }
        // LINE???????????????????????????
        else {
            // ???????????????
            // LINE???????????????????????????????????????????????????????????????(LineLoginIntegrationController.php)????????????????????????????????????????????????
        }
    }

    /**
     * ???????????????????????????????????????????????????????????????
     *
     * ?????????????????????LINE?????????????????????
     *
     * @param EventArgs $event
     */
    public function onCompleteMypageWithdraw(EventArgs $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        log_info('???????????????????????????');
        $customerId = $event['Customer']['id'];
        $this->lineIdUnassociate($customerId, true);
    }

    /**
     * ???????????????????????????????????????????????????
     *
     * ????????????????????????????????????LINE?????????????????????
     *
     * @param EventArgs $event
     */
    public function onCompleteCustomerEdit(EventArgs $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $customerId = $event['Customer']->getId();
        $customerStatus = $event['Customer']->getStatus();
        // ?????????????????????
        if ($customerStatus['id'] == CustomerStatus::WITHDRAWING) {
            log_info('?????????????????????????????????????????????????????????');
            $this->lineIdUnassociate($customerId);
        }
    }


    /**
     * LINE?????????????????????????????????????????????
     */
    private function isLineSettingCompleted()
    {
        $lineLoginIntegrationSetting = $this->lineLoginIntegrationSettingRepository
            ->find(LineLoginIntegrationAdminController::LINE_LOGIN_INTEGRATION_SETTING_TABLE_ID);

        if (empty($lineLoginIntegrationSetting)) {
            log_error("Line Line???????????????????????????");
            return false;
        }

        $lineChannelId = $lineLoginIntegrationSetting->getLineChannelId();
        if (empty($lineChannelId)) {
            log_error("Line Channel Id??????????????????");
            return false;
        }

        $lineChannelSecret = $lineLoginIntegrationSetting->getLineChannelSecret();
        if (empty($lineChannelSecret)) {
            log_error("Line Channel Secret??????????????????");
            return false;
        }

        return true;
    }


    /**
     * LINE????????????????????????????????????????????????
     *
     * ??????ID????????????DB???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
     * ????????????????????????????????????????????????true???????????????
     *
     * @param int $customerId       LINE????????????????????????????????????ID
     * @param bool $isDeleteSession ????????????????????????????????????????????????false
     * @return bool                 ?????????LINE???????????????????????????????????????????????????????????????true?????????
     */
    private function lineIdUnassociate(int $customerId, ?bool $isDeleteSession = null) {
        $lineLoginIntegration = $this->lineLoginIntegrationRepository->findOneBy(['customer_id' => $customerId]);
        // LINE?????????????????????
        if (!empty($lineLoginIntegration)) {
            log_info('customer_id:' . $customerId . '???LINE???????????????');
            $this->lineLoginIntegrationRepository->deleteLineAssociation($lineLoginIntegration);
            log_info('LINE??????????????????????????????');

            if ($isDeleteSession) {
                $this->session->remove(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE);
                $this->session->remove(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);
                $this->session->remove($this->session->is_line_delete);
            }
            return true;
        }
        return false;
    }


    private function replaceMypageChangeForm(TemplateEvent $event)
    {
        log_info('LINE?????????????????????');
        $snipet = $this->twig->getLoader()->getSourceContext('ECCUBE4LineLoginIntegration/Resource/template/mypage_change_add_is_line_delete.twig')->getCode();
        $search = '{# ??????????????????????????????????????? #}';
        $replace = $search . $snipet;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }
}
