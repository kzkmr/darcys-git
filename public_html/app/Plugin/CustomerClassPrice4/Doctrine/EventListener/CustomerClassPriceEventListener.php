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

            // ??????????????????????????????????????????????????????????????????????????????
            if ($customerClass->getDiscountRate()) {
                $entity->setPrice02IncTax(
                    $this->taxRuleService->getPriceIncTax(
                        $this->discountHelper->calculatePrice($entity->getPrice02(), $this->getCurrentUser()),
                        $entity->getProduct(),
                        $entity
                    )
                );
                // ???????????????????????????????????????????????????????????????????????????
                $entity->setPrice02($this->discountHelper->calculatePrice($entity->getPrice02(), $this->getCurrentUser()));
            }

            $customerClassPrice = $this->entityManager->getRepository(CustomerClassPrice::class)->findOneBy([
                "customerClass" => $customerClass,
                "productClass" => $entity
            ]);

            // ???????????????????????????????????????????????????????????????
            if ($customerClassPrice instanceof CustomerClassPrice) {
                if ($customerClassPrice->getPrice()) {
                    $entity->setPrice02IncTax(
                        $this->taxRuleService->getPriceIncTax(
                            $customerClassPrice->getPrice(),
                            $entity->getProduct(),
                            $entity
                        )
                    );
                    // ?????????????????????????????????????????????????????????????????????????????????
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

            // ??????????????????????????????????????????????????????????????????
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
        // ????????????????????????????????????
        if (false === $productClass->getProduct()->isPlgCcpEnabledDiscount()) {
            return false;
        }

        if (!$this->getCurrentUser() instanceof Customer) {
            return false;
        }

        // ??????????????????????????????????????????
        if (!$this->getCurrentUser()->isPlgCcpCustomerClass()) {
            return false;
        }

        return true;
    }
}
