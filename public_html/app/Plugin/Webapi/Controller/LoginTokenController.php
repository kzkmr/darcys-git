<?php

/**
 * Class TestController
 * @package Plugin\Webapi\Controller
 * @author Tyler Nguyen <tylermagento@gmail.com>
 * @created : 13/03/2022
 */

namespace Plugin\Webapi\Controller;

use Eccube\Controller\AbstractController;
use Eccube\Entity\Customer as Customer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\JsonResponse;


class LoginTokenController extends AbstractController {

    private $privateKey;

    private $publicKey;

    private $tokenStorage;


    public function __construct(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/login_token"), methods={"GET","POST"}
     */
    public function login(Request $request){

        $authorizationHeaderArray = explode(' ', $request->headers->get('Authorization'));
        $token = $authorizationHeaderArray[1] ?? null;
        $this->publicKey = file_get_contents($this->eccubeConfig->get('jwt_key_public'));


        try{
            $decoded = JWT::decode($token, new Key($this->publicKey, 'RS256'));
            if($decoded->expire < time()) {
                throw new CustomUserMessageAuthenticationException(
                    'Token has expired'
                );
            }    
            $Customer = $this->entityManager->getRepository(Customer::class)
                ->findOneBy(['id' => $decoded->id]);
            $token = new UsernamePasswordToken($Customer, $Customer->getPassword(), "customer", $Customer->getRoles());
            $this->get("security.token_storage")->setToken($token);
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            return $this->redirectToRoute('mypage');
        }
        catch(\Exception $e){
            $data = [
                // you might translate this message
                'message' => $e->getMessage()
            ];

            return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
        }

    }

    
}