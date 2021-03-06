<?php
/**
 * Copyright(c) 2020 SYSTEM_KD
 * Date: 2020/05/09
 */

namespace Plugin\KokokaraSelect\Service;


use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\CartItem;
use Eccube\Entity\ItemInterface;
use Eccube\Entity\Master\OrderItemType;
use Eccube\Entity\Master\ProductStatus;
use Eccube\Entity\Master\TaxDisplayType;
use Eccube\Entity\Master\TaxType;
use Eccube\Entity\Order;
use Eccube\Entity\OrderItem;
use Eccube\Entity\Product;
use Eccube\Entity\ProductClass;
use Eccube\Entity\TaxRule;
use Eccube\Repository\OrderItemRepository;
use Eccube\Repository\TaxRuleRepository;
use Eccube\Service\CartService;
use Plugin\KokokaraSelect\Entity\KsCartSelectItem;
use Plugin\KokokaraSelect\Entity\KsCartSelectItemGroup;
use Plugin\KokokaraSelect\Entity\KsOrderItemEx;
use Plugin\KokokaraSelect\Entity\KsSelectItem;
use Plugin\KokokaraSelect\Entity\KsSelectItemGroup;
use Plugin\KokokaraSelect\Service\PurchaseFlow\KsOrderItemHelper;
use Plugin\KokokaraSelect\Service\PurchaseFlow\Processor\KokokaraSelectProcessor;

class KsOrderService
{

    use ConfigHelperTrait;

    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var CartService */
    protected $cartService;

    /** @var TaxRuleRepository */
    protected $taxRuleRepository;

    /** @var KsOrderItemService */
    protected $ksOrderItemService;

    /** @var KsService */
    protected $ksService;

    /** @var KsSelectItemGroupService */
    protected $ksSelectItemGroupService;

    /** @var KsSelectItemService */
    protected $ksSelectItemService;

    /** @var KsOrderItemHelper */
    protected $ksOrderItemHelper;

    public function __construct(
        CartService $cartService,
        EntityManagerInterface $entityManager,
        KsOrderItemService $ksOrderItemService,
        KsService $ksService,
        KsSelectItemGroupService $ksSelectItemGroupService,
        KsSelectItemService $ksSelectItemService,
        KsOrderItemHelper $ksOrderItemHelper
    )
    {

        $this->cartService = $cartService;
        $this->entityManager = $entityManager;
        $this->ksOrderItemService = $ksOrderItemService;
        $this->ksService = $ksService;
        $this->ksSelectItemGroupService = $ksSelectItemGroupService;
        $this->ksSelectItemService = $ksSelectItemService;
        $this->ksOrderItemHelper = $ksOrderItemHelper;
    }

    /**
     * @return KsSelectItemService
     */
    public function getKsSelectItemService()
    {
        return $this->ksSelectItemService;
    }

    /**
     * ??????????????????OrderItemType??????
     *
     * @return object|null
     */
    public function getKsOrderItemType()
    {
        return $this->ksOrderItemService->getKsOrderItemType();
    }

    /**
     * ????????????OrderItemType??????
     *
     * @return object|null
     */
    public function getProductOrderItemType()
    {
        return $this->ksOrderItemService->getProductOrderItemType();
    }

    /**
     * ???????????????????????????????????????
     *
     * @param Order $Order
     */
    public function addKsOrderItem(Order $Order)
    {

        $cart = $this->cartService->getCart();

        // ??????????????????OrderItemType??????
        /** @var OrderItemType $ksOrderItemType */
        $ksOrderItemType = $this->getKsOrderItemType();

        // ?????????
        $taxRuleRepository = $this->entityManager->getRepository(TaxRule::class);
        $TaxExcluded = $this->entityManager
            ->find(TaxDisplayType::class, TaxDisplayType::EXCLUDED);
        $taxType = $this->entityManager->find(TaxType::class, TaxType::TAXATION);

        /** @var CartItem $cartItem */
        foreach ($cart->getCartItems() as $key => $cartItem) {

            $baseProduct = $cartItem->getProductClass()->getProduct();
            $index = 1;

            /** @var KsCartSelectItemGroup $ksCartSelectItemGroup */
            foreach ($cartItem->getKsCartSelectItemGroups() as $ksCartSelectItemGroup) {

                $parentProductClass = $ksCartSelectItemGroup->getCartItem()->getProductClass();

                // ????????????OrderItem??????
                /** @var OrderItem $parentOrderItem */
                $parentOrderItem = $this->getParentOrderItem($Order, $parentProductClass);

                // ?????????????????????
                $targetShipping = $parentOrderItem->getShipping();

                if (!$parentOrderItem) {
                    // ???????????????
                    continue;
                }

                /** @var KsCartSelectItem $ksCartSelectItem */
                foreach ($ksCartSelectItemGroup->getKsCartSelectItems() as $ksCartSelectItem) {

                    // 0?????????????????????????????????
                    if ($ksCartSelectItem->getQuantity() == 0) continue;

                    $productClass = $ksCartSelectItem->getKsSelectItem()->getProductClass();
                    $product = $productClass->getProduct();

                    $ksSelectItem = $ksCartSelectItem->getKsSelectItem();

                    $parentKsProduct = $baseProduct->getKsProduct();

                    $name = $this->ksOrderItemHelper->getKsSelectOrderItemName(
                        $parentKsProduct,
                        '',
                        $baseProduct->getName(),
                        $index,
                        $this->ksSelectItemService->getKsProductClassName($productClass)
                    );

                    $orderItem = new OrderItem();

                    // ?????????????????????
                    $orderItem
                        ->setOrder($Order)
                        ->setShipping($targetShipping)
                        ->setProduct($product)
                        ->setProductClass($productClass)
                        ->setProductName($name)
                        ->setProductCode($productClass->getCode())
                        ->setPrice(0)
                        ->setQuantity($ksCartSelectItem->getQuantity())
                        ->setOrderItemType($ksOrderItemType)
                        ->setProcessorName(KokokaraSelectProcessor::class);

                    $TaxRule = $taxRuleRepository->getByRule($product, $productClass);

                    // ?????????????????????
                    $orderItem
                        ->setTax(0)
                        ->setTaxRate($TaxRule->getTaxRate())
                        ->setRoundingType($TaxRule->getRoundingType())
                        ->setTaxRuleId($TaxRule->getId())
                        ->setTaxType($taxType)
                        ->setTaxDisplayType($TaxExcluded);

                    // ??????????????????
                    $ksOrderItemEx = new KsOrderItemEx();
                    $ksOrderItemEx
                        ->setOrderItem($orderItem)
                        ->setParentOrderItem($parentOrderItem)
                        ->setKsSelectItemId($ksSelectItem->getId())
                        ->setKsSelectItemGroupId($ksSelectItem->getKsSelectItemGroup()->getId())
                        ->setGroupId($index)
                        ->setProductName($this->ksSelectItemService->getKsProductClassName($productClass));

                    $this->entityManager->persist($ksOrderItemEx);

                    // ????????????????????????
                    $orderItem->setKsOrderItemEx($ksOrderItemEx);

                    // ???OrderItem???????????????????????????
                    $parentOrderItem
                        ->addKsOrderItemChildren($ksOrderItemEx);

                    $Order->addOrderItem($orderItem);

                }

                $index++;
            }

        }

    }

    /**
     * ????????????????????????????????????
     *
     * @param Order $order
     * @return array
     */
    public function validOrderItem(Order $order)
    {

        $validResults = [];
        $targetQuantities = [];

        /** @var OrderItem $orderItem */
        foreach ($order->getOrderItems() as $orderItem) {

            if (!$orderItem->isProduct()) continue;

            $productClass = $orderItem->getProductClass();

            // ????????????(???)????????? ???????????????????????????????????????
            if ($this->ksService->isKsProduct($orderItem)) {
                $validResults[$productClass->getId()] = $this->ksOrderItemService->validOrderItem($orderItem);

                if ($validResults[$productClass->getId()]['valid']) {
                    // ?????????????????????
                    /** @var KsOrderItemEx $ksOrderItemChild */
                    foreach ($orderItem->getKsOrderItemChildren() as $ksOrderItemChild) {
                        if ($ksOrderItemChild->getKsSelectItem()) {
                            $ksSelectItemId = $ksOrderItemChild->getKsSelectItem()->getId();
                        } else {
                            $ksSelectItemId = $ksOrderItemChild->getKsSelectItemId();
                        }
                        $targetQuantities[$ksSelectItemId] = $ksOrderItemChild;
                    }
                }
            }
        }

        // ????????????
        $quantities = $this->getQuantityByKsSelectItem($order);

        // ??????????????????
        foreach ($quantities as $ksSelectItemId => $quantity) {

            if (!isset($targetQuantities[$ksSelectItemId])) {
                // ???????????????????????????????????????????????????
                continue;
            }

            /** @var KsOrderItemEx $ksOrderItemEx */
            $ksOrderItemEx = $targetQuantities[$ksSelectItemId];
            $ksSelectItem = $ksOrderItemEx->getKsSelectItem();

            if ($ksSelectItem) {
                $stockValid = $this->ksSelectItemService->validStock($ksSelectItem, $quantity);

                if (!$stockValid['result']) {
                    $validResults[$ksSelectItem->getProductClass()->getId()]['valid'] = false;
                    $validResults[$ksSelectItem->getProductClass()->getId()]['NGStock'] = $stockValid['stock'];
                    $validResults[$ksSelectItem->getProductClass()->getId()]['TargetKsSelectItem'] = $ksSelectItem;
                }
            }
        }

        return $validResults;
    }

    /**
     * ??????????????????KsSelectItem???????????????????????????
     * [KsSelectItem??????????????????????????????????????????]
     *
     * @param Order $order
     * @return array
     */
    public function getQuantityByKsSelectItem(Order $order)
    {
        $quantities = [];

        /** @var OrderItem $orderItem */
        foreach ($order->getOrderItems() as $orderItem) {

            if ($orderItem->isKsSelectItem()) {
                // ????????????????????????
                $ksOrderItemEx = $orderItem->getKsOrderItemEx();
                $ksSelectItemId = $ksOrderItemEx->getKsSelectItemId();
                if (isset($quantities[$ksSelectItemId])) {
                    $quantities[$ksSelectItemId] += $ksOrderItemEx->getOrderItem()->getQuantity();
                } else {
                    $quantities[$ksSelectItemId] = $ksOrderItemEx->getOrderItem()->getQuantity();
                }
            }
        }

        return $quantities;
    }

    /**
     * ??????????????????ProductClass???????????????????????????
     *
     * @param Order $order
     * @return array
     */
    public function getQuantityByProductClass(Order $order)
    {
        $quantities = [];

        /** @var OrderItem $orderItem */
        foreach ($order->getOrderItems() as $orderItem) {
            if ($orderItem->isProduct() || $orderItem->isKsSelectItem()) {

                if (isset($quantities[$orderItem->getProductClass()->getId()])) {
                    $quantities[$orderItem->getProductClass()->getId()]['quantity'] += $orderItem->getQuantity();
                } else {
                    $quantities[$orderItem->getProductClass()->getId()] = [
                        'productClass' => $orderItem->getProductClass(),
                        'quantity' => $orderItem->getQuantity()
                    ];
                }
            }
        }

        return $quantities;
    }

    /**
     * ????????????????????????
     *
     * @param Product $product
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isBuyIngProduct(Product $product)
    {
        if ($product && $product->getId()) {

            /** @var OrderItemType $productOrderItemType */
            $productOrderItemType = $this->getProductOrderItemType();

            /** @var OrderItemRepository $orderItemRepository */
            $orderItemRepository = $this->entityManager->getRepository(OrderItem::class);
            $qb = $orderItemRepository->createQueryBuilder('oi')
                ->select('count(oi.id)')
                ->andWhere('oi.OrderItemType = :orderItemType')
                ->setParameter('orderItemType', $productOrderItemType)
                ->andWhere('oi.Product = :product')
                ->setParameter('product', $product);

            $result = $qb->getQuery()->getSingleScalarResult();

            return ($result == 0 ? false : true);
        }

        return false;
    }

    /**
     * Order?????????????????????????????????OrderItem?????????
     *
     * @param Order $order
     * @param ProductClass $targetProductClass
     * @return ItemInterface|null
     */
    private function getParentOrderItem(Order $order, ProductClass $targetProductClass)
    {
        foreach ($order->getItems() as $item) {
            if ($item->isProduct()
                && $item->getProductClass()->getId() == $targetProductClass->getId()) {

                return $item;
            }
        }

        return null;
    }

    /**
     * ??????????????????????????????????????????
     *
     * @param OrderItem $parentOrderItem
     * @param $diff
     * @param $groupCount
     * @param $admin
     */
    public function addKsOrderItemDirectSelect(OrderItem $parentOrderItem, $diff, $groupCount, $admin)
    {

        $ksProduct = $parentOrderItem->getKsProduct();

        if (!$ksProduct) {
            return;
        }

        if (!$ksProduct->isDirectSelect()) {
            return;
        }

        $baseProduct = $parentOrderItem->getProductClass()->getProduct();

        $Order = $parentOrderItem->getOrder();
        $targetShipping = $parentOrderItem->getShipping();

        // ??????????????????OrderItemType??????
        /** @var OrderItemType $ksOrderItemType */
        $ksOrderItemType = $this->getKsOrderItemType();

        // OrderFlow???????????????OrderItemType??????
        /** @var OrderItemType $productOrderItemType */
        $productOrderItemType = $this->getProductOrderItemType();

        // ?????????
        $taxRuleRepository = $this->entityManager->getRepository(TaxRule::class);
        $TaxExcluded = $this->entityManager
            ->find(TaxDisplayType::class, TaxDisplayType::EXCLUDED);
        $taxType = $this->entityManager->find(TaxType::class, TaxType::TAXATION);

        $index = ($groupCount + 1);

        for ($i = 0; $i < $diff; $i++) {

            /** @var KsSelectItemGroup $ksSelectItemGroup */
            foreach ($ksProduct->getKsSelectItemGroups() as $ksSelectItemGroup) {

                /** @var KsSelectItem $ksSelectItem */
                foreach ($ksSelectItemGroup->getKsSelectItems() as $ksSelectItem) {

                    $productClass = $ksSelectItem->getProductClass();
                    $product = $productClass->getProduct();

                    if ($product->getStatus()->getId() != ProductStatus::DISPLAY_SHOW) {
                        continue;
                    }

                    $parentKsProduct = $baseProduct->getKsProduct();

                    $name = $this->ksOrderItemHelper->getKsSelectOrderItemName(
                        $parentKsProduct,
                        '',
                        $baseProduct->getName(),
                        $index,
                        $this->ksSelectItemService->getKsProductClassName($productClass)
                    );

                    $orderItem = new OrderItem();

                    // ?????????????????????
                    $orderItem
                        ->setOrder($Order)
                        ->setShipping($targetShipping)
                        ->setProduct($product)
                        ->setProductClass($productClass)
                        ->setProductName($name)
                        ->setProductCode($productClass->getCode())
                        ->setPrice(0)
                        ->setQuantity($ksSelectItem->getQuantity())
                        ->setOrderItemType($ksOrderItemType)
                        ->setProcessorName(KokokaraSelectProcessor::class);

                    $TaxRule = $taxRuleRepository->getByRule($product, $productClass);

                    // ?????????????????????
                    $orderItem
                        ->setTax(0)
                        ->setTaxRate($TaxRule->getTaxRate())
                        ->setRoundingType($TaxRule->getRoundingType())
                        ->setTaxRuleId($TaxRule->getId())
                        ->setTaxType($taxType)
                        ->setTaxDisplayType($TaxExcluded);

                    // ??????????????????
                    $ksOrderItemEx = new KsOrderItemEx();
                    $ksOrderItemEx
                        ->setOrderItem($orderItem)
                        ->setParentOrderItem($parentOrderItem)
                        ->setKsSelectItemId($ksSelectItem->getId())
                        ->setKsSelectItemGroupId($ksSelectItem->getKsSelectItemGroup()->getId())
                        ->setGroupId($index)
                        ->setProductName($this->ksSelectItemService->getKsProductClassName($productClass));

                    $this->entityManager->persist($ksOrderItemEx);

                    // ????????????????????????
                    $orderItem->setKsOrderItemEx($ksOrderItemEx);

                    $this->entityManager->persist($orderItem);

                    // ???????????????????????????????????????????????????????????????OrderFlow?????????????????????????????????????????????
                    if ($admin) {
                        $orderItem->setOrderItemType($productOrderItemType);
                    }

                    // ???OrderItem???????????????????????????
                    $parentOrderItem
                        ->addKsOrderItemChildren($ksOrderItemEx);

                    // Shipping????????????
                    $shipping = $parentOrderItem->getShipping();
                    if ($shipping) {
                        $shipping
                            ->addOrderItem($orderItem);
                    }

                    // Order????????????
                    $parentOrderItem->getOrder()
                        ->addOrderItem($orderItem);
                }
            }

            $index += 1;
        }
    }
}
