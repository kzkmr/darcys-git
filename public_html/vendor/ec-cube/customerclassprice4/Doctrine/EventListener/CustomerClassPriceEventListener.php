<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Doctrine\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Eccube\Entity\Customer;
use Eccube\Entity\Member;
use Eccube\Entity\ProductClass;
use Eccube\Service\TaxRuleService;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Plugin\CustomerClassPrice4\Service\DiscountHelper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomerClassPriceEventListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TaxRuleService
     */
    private $taxRuleService;

    /**
     * @var DiscountHelper
     */
    private $discountHelper;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(
        EntityManagerInterface $entityManager,
        TaxRuleService $taxRuleService,
        DiscountHelper $discountHelper,
        TokenStorageInterface $tokenStorage,
        RequestStack $requestStack
    )
    {
        $this->entityManager = $entityManager;
        $this->taxRuleService = $taxRuleService;
        $this->discountHelper = $discountHelper;
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof ProductClass) {

            if (false === $this->supports($entity)) {
                return;
            }

            $customerClass = $this->getCurrentUser()->getPlgCcpCustomerClass();

            // 割引率が設定されている特定会員だったら割引価格セット
            if ($customerClass->getDiscountRate()) {
                $entity->setPrice02IncTax(
                    $this->taxRuleService->getPriceIncTax(
                        $this->discountHelper->calculatePrice($entity->getPrice02(), $this->getCurrentUser()),
                        $entity->getProduct(),
                        $entity
                    )
                );
                // 商品一覧や商品詳細で税抜の販売価格を割引価格に設定
                $entity->setPrice02($this->discountHelper->calculatePrice($entity->getPrice02(), $this->getCurrentUser()));
            }

            $customerClassPrice = $this->entityManager->getRepository(CustomerClassPrice::class)->findOneBy([
                "customerClass" => $customerClass,
                "productClass" => $entity
            ]);

            // 特定会員価格が設定されていたら価格をセット
            if ($customerClassPrice instanceof CustomerClassPrice) {
                if ($customerClassPrice->getPrice()) {
                    $entity->setPrice02IncTax(
                        $this->taxRuleService->getPriceIncTax(
                            $customerClassPrice->getPrice(),
                            $entity->getProduct(),
                            $entity
                        )
                    );
                    // 商品一覧や商品詳細で税抜の販売価格を特定会員価格に設定
                    $entity->setPrice02($customerClassPrice->getPrice());
                }
            }
        }
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof ProductClass) {

            if (false === $this->supports($entity)) {
                return;
            }

            // 特定会員価格に設定された販売価格をもとに戻す
            if ($args->hasChangedField('price02')) {
                $price02 = $args->getOldValue('price02');
                $entity->setPrice02($price02);
            }
        }
    }

    /**
     * @return Customer|Member|null
     */
    protected function getCurrentUser(): ?UserInterface
    {
        $request = $this->requestStack->getMasterRequest();

        if (null === $request) {
            return null;
        }

        if (null === $token = $this->tokenStorage->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return null;
        }

        return $user;
    }

    /**
     * @param ProductClass|null $productClass
     * @return bool
     */
    protected function supports(?ProductClass $productClass)
    {
        // 割引対象外だったらスルー
        if (false === $productClass->getProduct()->isPlgCcpEnabledDiscount()) {
            return false;
        }

        if (!$this->getCurrentUser() instanceof Customer) {
            return false;
        }

        // 特定会員登録されているか確認
        if (!$this->getCurrentUser()->isPlgCcpCustomerClass()) {
            return false;
        }

        return true;
    }
}
