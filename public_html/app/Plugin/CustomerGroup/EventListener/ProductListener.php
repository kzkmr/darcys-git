<?php
/**
 * This file is part of CustomerGroupPrice
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\EventListener;


use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Category;
use Eccube\Entity\Page;
use Eccube\Entity\Product;
use Plugin\CustomerGroup\Security\Authorization\Voter\CategoryVoter;
use Plugin\CustomerGroup\Security\Authorization\Voter\PageVoter;
use Plugin\CustomerGroup\Security\Authorization\Voter\ProductVoter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class ProductListener implements EventSubscriberInterface
{

    /**
     * @var Security
     */
    private $security;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function __construct(
        Security $security,
        EntityManagerInterface $entityManager
    )
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (false === $event->isMasterRequest()) {
            return;
        }

        switch ($event->getRequest()->attributes->get('_route')) {
            case 'product_list':
                if ($category = $this->findCategory($event->getRequest())) {
                    if (false === $this->security->isGranted(CategoryVoter::VIEW, $category)) {
                        throw new AccessDeniedHttpException();
                    }
                }
                break;
            case 'product_detail':
                if ($product = $this->findProduct($event->getRequest())) {
                    if (false === $this->security->isGranted(ProductVoter::VIEW, $product)) {
                        throw new AccessDeniedHttpException();
                    }
                }
                break;
            case 'user_data':
                if ($page = $this->findPage($event->getRequest())) {
                    if (false === $this->security->isGranted(PageVoter::VIEW, $page)) {
                        throw new AccessDeniedHttpException();
                    }
                }
        }
    }

    /**
     * @param Request $request
     * @return Category|null
     */
    protected function findCategory(Request $request): ?Category
    {
        // 数字以外だとpsglでエラーが発生するので
        if (!preg_match('/^\d+$/', $request->query->get('category_id'), $matches)) {
            return null;
        }

        return $this->entityManager->getRepository(Category::class)->find($matches[0]);
    }

    /**
     * @param Request $request
     * @return Product|null
     */
    protected function findProduct(Request $request): ?Product
    {
        if (!$id = $request->get('id')) {
            return null;
        }

        return $this->entityManager->getRepository(Product::class)->find($id);
    }

    protected function findPage(Request $request): ?Page
    {
        if (!$route = $request->get('route')) {
            return null;
        }

        return $this->entityManager->getRepository(Page::class)->findOneBy([
            'url' => $route,
            'edit_type' => Page::EDIT_TYPE_USER
        ]);
    }
}
