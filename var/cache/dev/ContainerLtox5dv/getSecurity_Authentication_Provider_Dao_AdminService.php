<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.authentication.provider.dao.admin' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/Provider/AuthenticationProviderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/Provider/UserAuthenticationProvider.php';
include_once $this->targetDirs[3].'/vendor/symfony/security/Core/Authentication/Provider/DaoAuthenticationProvider.php';
include_once $this->targetDirs[3].'/vendor/symfony/security/Core/User/UserCheckerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/security/Core/User/UserChecker.php';

return $this->services['security.authentication.provider.dao.admin'] = new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider(${($_ = isset($this->services['Eccube\\Security\\Core\\User\\MemberProvider']) ? $this->services['Eccube\\Security\\Core\\User\\MemberProvider'] : $this->load('getMemberProviderService.php')) && false ?: '_'}, ${($_ = isset($this->services['security.user_checker']) ? $this->services['security.user_checker'] : ($this->services['security.user_checker'] = new \Symfony\Component\Security\Core\User\UserChecker())) && false ?: '_'}, 'admin', ${($_ = isset($this->services['security.encoder_factory']) ? $this->services['security.encoder_factory'] : $this->load('getSecurity_EncoderFactoryService.php')) && false ?: '_'}, true);
