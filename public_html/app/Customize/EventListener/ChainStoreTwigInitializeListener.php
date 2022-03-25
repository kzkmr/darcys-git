<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\EventListener;

use Doctrine\ORM\NoResultException;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\AuthorityRole;
use Eccube\Entity\Layout;
use Eccube\Entity\Master\DeviceType;
use Eccube\Entity\Member;
use Eccube\Entity\Customer;
use Eccube\Entity\Page;
use Eccube\Entity\PageLayout;
use Eccube\Repository\AuthorityRoleRepository;
use Eccube\Repository\BaseInfoRepository;
use Customize\Repository\ChainStoreRepository;
use Eccube\Repository\LayoutRepository;
use Eccube\Repository\Master\DeviceTypeRepository;
use Eccube\Repository\PageRepository;
use Eccube\Repository\PageLayoutRepository;
use Eccube\Repository\BlockPositionRepository;
use Eccube\Request\Context;
use Eccube\Service\CartService;
use SunCat\MobileDetectBundle\DeviceDetector\MobileDetector;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class ChainStoreTwigInitializeListener implements EventSubscriberInterface
{
    /**
     * @var bool 初期化済かどうか.
     */
    protected $initialized = false;

    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var BaseInfoRepository
     */
    protected $baseInfoRepository;

    /**
     * @var DeviceTypeRepository
     */
    protected $deviceTypeRepository;

    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * @var PageLayoutRepository
     */
    protected $pageLayoutRepository;

    /**
     * @var BlockPositionRepository
     */
    protected $blockPositionRepository;

    /**
     * @var Context
     */
    protected $requestContext;

    /**
     * @var AuthorityRoleRepository
     */
    private $authorityRoleRepository;

    /**
     * @var EccubeConfig
     */
    private $eccubeConfig;

    /**
     * @var MobileDetector
     */
    private $mobileDetector;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var LayoutRepository
     */
    private $layoutRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var ChainStoreRepository
     */
    private $chainStoreRepository;

    /**
     * @var CartService
     */
    protected $cartService;

    /**
     * TwigInitializeListener constructor.
     *
     * @param Environment $twig
     * @param BaseInfoRepository $baseInfoRepository
     * @param PageRepository $pageRepository
     * @param PageLayoutRepository $pageLayoutRepository
     * @param BlockPositionRepository $blockPositionRepository
     * @param DeviceTypeRepository $deviceTypeRepository
     * @param AuthorityRoleRepository $authorityRoleRepository
     * @param EccubeConfig $eccubeConfig
     * @param Context $context
     * @param MobileDetector $mobileDetector
     * @param UrlGeneratorInterface $router
     * @param LayoutRepository $layoutRepository
     * @param TokenStorageInterface $tokenStorage
     * @param ChainStoreRepository $chainStoreRepository
     * @param CartService $cartService
     */
    public function __construct(
        Environment $twig,
        BaseInfoRepository $baseInfoRepository,
        PageRepository $pageRepository,
        PageLayoutRepository $pageLayoutRepository,
        BlockPositionRepository $blockPositionRepository,
        DeviceTypeRepository $deviceTypeRepository,
        AuthorityRoleRepository $authorityRoleRepository,
        EccubeConfig $eccubeConfig,
        Context $context,
        MobileDetector $mobileDetector,
        UrlGeneratorInterface $router,
        LayoutRepository $layoutRepository,
        TokenStorageInterface $tokenStorage,
        ChainStoreRepository $chainStoreRepository,
        CartService $cartService
    ) {
        $this->twig = $twig;
        $this->baseInfoRepository = $baseInfoRepository;
        $this->pageRepository = $pageRepository;
        $this->pageLayoutRepository = $pageLayoutRepository;
        $this->blockPositionRepository = $blockPositionRepository;
        $this->deviceTypeRepository = $deviceTypeRepository;
        $this->authorityRoleRepository = $authorityRoleRepository;
        $this->eccubeConfig = $eccubeConfig;
        $this->requestContext = $context;
        $this->mobileDetector = $mobileDetector;
        $this->router = $router;
        $this->layoutRepository = $layoutRepository;
        $this->tokenStorage = $tokenStorage;
        $this->chainStoreRepository = $chainStoreRepository;
        $this->cartService = $cartService;
    }

    /**
     * @param GetResponseEvent $event
     *
     * @throws NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($this->initialized) {
            return;
        }

        if (!$this->requestContext->isAdmin()) {
            $this->setFrontVariables($event);
        }

        $this->initialized = true;
    }

    /**
     * @param GetResponseEvent $event
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function setFrontVariables(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        
        if($user = $this->getCurrentUser()){
            $ChainStore = $user->getChainStore();
            if(is_object($ChainStore)){
                $this->twig->addGlobal('ChainStore', $ChainStore);
            }else{
                $this->twig->addGlobal('ChainStore', null);
            }
        }else{
            $this->twig->addGlobal('ChainStore', null);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                // SecurityServiceProviderで、認証処理が完了した後に実行.
                ['onKernelRequest', 6],
            ],
        ];
    }

    private function getCurrentUser()
    {
        if(!$this->tokenStorage){
            return null;
        }

        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        if (!$token->isAuthenticated()) {
            return null;
        }

        if(!$user = $token->getUser()){
            return null;
        }

        if(is_object($user)){
            return $user;
        }

        return null;
    }
}
