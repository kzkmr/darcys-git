<?php

namespace Plugin\Webapi\Security;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Customer as Customer;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Eccube\Common\EccubeConfig;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Psr\Container\ContainerInterface;


class HandlerToken extends AbstractGuardAuthenticator{

    private $em;

    private $privateKey;

    private $publicKey;

    private $eccubeConfig;

    private $dispatcher;

    private $container;

    public function __construct(EntityManagerInterface $em, EccubeConfig  $config, EventDispatcherInterface $dispatcher,ContainerInterface $container)
    {
        $this->em = $em;
        $this->eccubeConfig = $config;
        $this->dispatcher = $dispatcher;
        $this->container = $container;
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
        return true;
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
        if(!$token) return  null;
        try{
            $decoded = JWT::decode($token, new Key($this->publicKey, 'RS256'));
            $Customer = $this->em->getRepository(Customer::class)
                ->findOneBy(['id' => $decoded->id]);
            if(!$Customer) return null;

            return $Customer;
        }
        catch(\Exception $e){

        }
        return null;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // check credentials - e.g. make sure the password is valid
        // no credential check is needed in this case

        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        // Fire the login event
        // Logging the user in above the way we do it doesn't do this automatically
        $event = new InteractiveLoginEvent($request, $token);
        $this->dispatcher->dispatch('security.interactive_login', $event);
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return null;
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $url = $this->container->get('router')->generate('mypage_login', array(), UrlGeneratorInterface::RELATIVE_PATH);
        return new RedirectResponse($url);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
