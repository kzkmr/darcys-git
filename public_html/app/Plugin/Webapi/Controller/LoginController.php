<?php

/**
 * Class TestController
 * @package Plugin\Webapi\Controller
 * @author Tyler Nguyen <tylermagento@gmail.com>
 * @created : 13/03/2022
 */

namespace Plugin\Webapi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Customer as Customer;
use Eccube\Security\Core\Encoder\PasswordEncoder;
use Eccube\Common\EccubeConfig;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpKernel\KernelInterface;
use Eccube\Repository\CustomerRepository;
use Eccube\Service\MailService;
use Exception;

class LoginController extends AbstractController {

    private $entityManager;

    private $passwordencoder;

    private $eccubeConfig;

    private  $mailer;

    private  $twig;

    private $appKernel;

    private $customerRepository;

    private $emailService;


    public function __construct(
        EntityManagerInterface $entityManager,
        PasswordEncoder $passwordencoder,
        EccubeConfig $eccubeConfig,
        \Twig_Environment $twig,
        \Swift_Mailer $mailer,
        KernelInterface $appKernel,
        MailService $mailService,
        CustomerRepository $customerRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->passwordencoder = $passwordencoder;
        $this->eccubeConfig  = $eccubeConfig;
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->appKernel = $appKernel;
        $this->emailService = $mailService;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @Route("/api/login", name="login")
     */
    public function login(Request $request){
        $this->privateKey = openssl_pkey_get_private(
            file_get_contents($this->eccubeConfig->get('jwt_key_private')),
            $this->eccubeConfig->get('jwt_key_passphrase')
        );
        // dd($this->privateKey);
        $requestContent = $request->getContent();
        $requestContent = json_decode($requestContent);

        if(!$requestContent){
            return new JsonResponse(['error'=>true], Response::HTTP_UNAUTHORIZED);
        }

        $email = $requestContent->email;
        $password = $requestContent->password;

        if(!$email || !$password){
            return new JsonResponse(['error'=>true,'message'=>'Email and password are required'], Response::HTTP_UNAUTHORIZED);
        }

        $Customer = $this->entityManager->getRepository(Customer::class)
            ->findOneBy(['email' => $email]);
        if(!$Customer){
            return new JsonResponse(['error'=>true,'message'=>'Can\'t found user email'], Response::HTTP_UNAUTHORIZED);
        }
        $checkPassword = $this->passwordencoder->isPasswordValid($Customer->getPassword(),$password,$Customer->getSalt());
        if(!$checkPassword) {
            return new Response(
                json_encode(['error'=>true,'message'=>'Wrong email or password']),
                Response::HTTP_UNAUTHORIZED,
                ['content-type' => 'application/json']
            );
        }

        $payload = array(
            'id' => $Customer->getId(),
            'name01' => $Customer->getName01(),
            'name02' => $Customer->getName02(),
            'kana01' => $Customer->getKana01(),
            'kana02' => $Customer->getKana02(),
            'phone_number' => $Customer->getPhoneNumber(),
            'status' => $Customer->getStatus()->getName(),
            'expire' => strtotime("+1 day", time())
            // 'gender' => $Customer->getSex()->getName()
        );
        if($Customer->getSex()){
            $payload['gender'] = $Customer->getSex()->getName();
        }

        $jwt = JWT::encode($payload, $this->privateKey , 'RS256');

        return new JsonResponse($payload+['token'=>$jwt], Response::HTTP_OK);
    }

    /**
     * @Route("api/forgot_id", name="forgot_id")
     */
    public function forgotID(Request $request){

        $requestContent = $request->getContent();
        $requestContent = json_decode($requestContent,true);

        if(!isset($requestContent['email'])) {
            return new JsonResponse(['error'=>true,'message'=>'email is required field'],Response::HTTP_BAD_REQUEST);
        }

        $Customer = $this->entityManager->getRepository(Customer::class)
            ->findOneBy(['email' => $requestContent['email']]);
        if(!$Customer){
            return new JsonResponse(['error'=>true,'message'=>'Can\'t found user email'],Response::HTTP_BAD_REQUEST);
        }
        try{
            $emailBody = $this->twig->render('Mail/forgot_id.twig',[
                'Customer' => $Customer
            ]);
        }
        catch(Exception $e){
           return new JsonResponse(['error'=>true,'message'=>$e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
        
        $message = (new \Swift_Message())
            ->setSubject('Your ID')
            ->setFrom(['info@demo.com' => 'Demo Store'])
            ->setTo([$Customer->getEmail()])
            ->setReplyTo('reply@demo.com')
            ->setReturnPath('no-reply@demo.com');

        $message
            ->setContentType('text/plain; charset=UTF-8')
            ->setBody($emailBody, 'text/plain');

        $this->mailer->send($message);

        return new JsonResponse(['error'=>false,'message'=>'Send mail successfully'],Response::HTTP_OK);
    }

    /**
     * @Route("api/forgot_password"), methods={"POST"}
     */
    public function forgotPassword(Request  $request){
        $requestContent = $request->getContent();
        $requestContent = json_decode($requestContent,true);

        if(!isset($requestContent['email'])) {
            return new JsonResponse(['error'=>true,'message'=>'Email and id are required field'],Response::HTTP_OK);
        }

        $Customer = $this->entityManager->getRepository(Customer::class)
            ->findOneBy(['email' => $requestContent['email']]);
        if(!$Customer){
            return new JsonResponse(['error'=>true,'message'=>'Can\'t found user email'],Response::HTTP_OK);
        }

        $Customer
            ->setResetKey($this->customerRepository->getUniqueResetKey())
            ->setResetExpire(new \DateTime('+'.$this->eccubeConfig['eccube_customer_reset_expire'].' min'));

        // リセットキーを更新
        $this->entityManager->persist($Customer);
        $this->entityManager->flush();

        $reset_url = $this->generateUrl('forgot_reset_app', ['key' => $Customer->getResetKey()], UrlGeneratorInterface::ABSOLUTE_URL);
        // $reset_url = 'darcy.forgot://reset/'.$Customer->getResetKey();
        // メール送信
        $this->emailService->sendPasswordResetNotificationMail($Customer, $reset_url);

        // ログ出力
        log_info('send reset password mail to:'."{$Customer->getId()} {$Customer->getEmail()} {$request->getClientIp()}");

        return new JsonResponse(['error'=>false,'message'=>'Send mail successfully'],Response::HTTP_OK);
    }

    /**
     * @Route("api/checktoken"), methods={"GET"}
     */
    public function checkToken(Request  $request){
    	return new JsonResponse(['error'=>false,'message'=>'You look great today!'],Response::HTTP_OK);
    }

    /**
     * @Route("api/changepassword"), methods={"POST"}
     */
    public function changePassword(Request  $request){
        $requestContent = $request->getContent();
        $requestContent = json_decode($requestContent,true);

        if(!isset($requestContent['reset_key'])) {
            return new JsonResponse(['error'=>true,'message'=>'Please provide your reset key'],Response::HTTP_BAD_REQUEST);
        }

        if(!isset($requestContent['new_password'])) {
            return new JsonResponse(['error'=>true,'message'=>'Please provide new password'],Response::HTTP_BAD_REQUEST);
        }

        $Customer = $this->entityManager->getRepository(Customer::class)
            ->findOneBy(['reset_key' => $requestContent['reset_key']]);

        if(!$Customer) return new JsonResponse(['error'=>true,'message'=>'Reset key incorrect'],Response::HTTP_BAD_REQUEST);

        
        try {
            $Customer->setPassword(
                $this->passwordencoder->encodePassword($requestContent['new_password'],$Customer->getSalt())
            );
            $Customer
            ->setResetKey('');
            $this->entityManager->persist($Customer);
            $this->entityManager->flush();
            return new JsonResponse(['error'=>false,'message'=>'Change password successfully'],Response::HTTP_OK);
        }
        catch(Exception $e){
            return new JsonResponse(['error'=>false,'message'=>$e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }
}
