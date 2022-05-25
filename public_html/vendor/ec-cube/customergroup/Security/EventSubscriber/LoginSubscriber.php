<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\Security\EventSubscriber;


use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Category;
use Eccube\Entity\Customer;
use Eccube\Entity\Product;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

/**
 * Class LoginSubscriber
 * @package Plugin\CustomerGroup\Security\EventSubscriber
 *
 *
 */
class LoginSubscriber implements EventSubscriberInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        EntityManagerInterface $entityManager
    )
    {
        $this->urlGenerator = $urlGenerator;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onInteractiveLogin'
        ];
    }

    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if (!$user instanceof Customer) {
            return;
        }

        $event->getAuthenticationToken()->setAttribute('canViewProducts', array_map(function (Product $product) {
            return $product->getId();
        }, $user->getGroupProducts()->toArray()));

        $event->getAuthenticationToken()->setAttribute('canViewCategories', array_map(function (Category $category) {
            return $category->getId();
        }, $user->getGroupCategories()->toArray()));
    }
}
