<?php

namespace Plugin\Webapi\Security;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Customer as Customer;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Eccube\Common\EccubeConfig;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class TokenAuthenticator extends AbstractGuardAuthenticator{

    private $em;

    private $privateKey;

    private $publicKey;

    private $eccubeConfig;

    public function __construct(EntityManagerInterface $em, EccubeConfig  $config)
    {
        $this->em = $em;
        $this->eccubeConfig = $config;
        $this->privateKey = openssl_pkey_get_private(
            file_get_contents($this->eccubeConfig->get('jwt_key_private')),
            $this->eccubeConfig->get('jwt_key_passphrase')
        );
        $this->publicKey = file_get_contents($this->eccubeConfig->get('jwt_key_public'));
    }


    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning false will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request)
    {
        return $request->headers->has('Authorization');
    }


    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        return [
            'token' => $request->headers->get('Authorization'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $authorizationHeaderArray = explode(' ', $credentials['token']);
        $token = $authorizationHeaderArray[1] ?? null;
        try{
            $decoded = JWT::decode($token, new Key($this->publicKey, 'RS256'));
            $Customer = $this->em->getRepository(Customer::class)
                ->findOneBy(['id' => $decoded->id]);
            return $Customer;
        }
        catch(\Exception $e){

        }
        return null;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $authorizationHeaderArray = explode(' ', $credentials['token']);
        $token = $authorizationHeaderArray[1] ?? null;
        $decoded = JWT::decode($token, new Key($this->publicKey, 'RS256'));

        if($decoded->expire < time()) {
            throw new CustomUserMessageAuthenticationException(
                'Token has expired'
            );
        }    
        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'error' => true,
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            // you might translate this message
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
