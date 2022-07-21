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

namespace Plugin\CustomerClassPrice4;


use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Customer;
use Eccube\Entity\Master\OrderItemType;
use Eccube\Entity\OrderItem;
use Eccube\Entity\Shipping;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Eccube\Repository\Master\OrderItemTypeRepository;
use Eccube\Request\Context;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Plugin\CustomerClassPrice4\Repository\CustomerClassPriceRepository;
use Plugin\ProductOption\Entity\OrderItemOption;
use Plugin\ProductOption\Entity\OrderItemOptionCategory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Event implements EventSubscriberInterface
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var OrderItemTypeRepository
     */
    private $orderItemTypeRepository;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var CustomerClassPriceRepository
     */
    private $customerClassPriceRepository;

    public function __construct(
        Context $context,
        EntityManagerInterface $entityManager,
        OrderItemTypeRepository $orderItemTypeRepository,
        ContainerInterface $container,
        CustomerClassPriceRepository $customerClassPriceRepository
    )
    {
        $this->context = $context;
        $this->entityManager = $entityManager;
        $this->orderItemTypeRepository = $orderItemTypeRepository;
        $this->container = $container;
        $this->customerClassPriceRepository = $customerClassPriceRepository;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Product/detail.twig' => 'onTemplateProductDetail',
            '@admin/Product/product.twig' => 'onRenderAdminProduct',
            EccubeEvents::FRONT_SHOPPING_SHIPPING_MULTIPLE_COMPLETE => [
                ['onFrontShoppingShippingMultipleComplete', -999999]
            ]
        ];
    }

    public function onTemplateProductDetail(TemplateEvent $event)
    {
        $event->addAsset('@CustomerClassPrice4/Product/assets/css/detail.twig');
        $event->addSnippet('@CustomerClassPrice4/Product/assets/js/detail.twig');
    }

    public function onRenderAdminProduct(TemplateEvent $event)
    {
        $event->addSnippet('@CustomerClassPrice4/admin/Product/product.twig');
    }

    /**
     * 商品オプションプラグインのためどうしようもなく対応。
     * なぜかイベント内でDoctrineのイベントが発火しない
     *
     * @param EventArgs $event
     */
    public function onFrontShoppingShippingMultipleComplete(EventArgs $event)
    {
        $enabled = $this->container->getParameter('eccube.plugins.enabled');

        if (false === in_array('ProductOption', $enabled, true)) {
            return;
        }

        $form = $event->getArgument('form');
        $Order = $event->getArgument('Order');

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form['shipping_multiple'];

            // フォームの入力から、送り先ごとに商品の数量を集計する
            $arrOrderItemTemp = [];
            foreach ($data as $multiples) {
                $OrderItem = $multiples->getData();
                foreach ($multiples as $items) {
                    foreach ($items as $item) {
                        $CustomerAddress = $item['customer_address']->getData();
                        $customerAddressName = $CustomerAddress->getShippingMultipleDefaultName();

                        $itemId = $OrderItem->getProductClass()->getId() . '_' . $OrderItem->getOptionSerial();
                        $quantity = $item['quantity']->getData();

                        if (isset($arrOrderItemTemp[$customerAddressName]) && array_key_exists($itemId, $arrOrderItemTemp[$customerAddressName])) {
                            $arrOrderItemTemp[$customerAddressName][$itemId] = $arrOrderItemTemp[$customerAddressName][$itemId] + $quantity;
                        } else {
                            $arrOrderItemTemp[$customerAddressName][$itemId] = $quantity;
                        }
                    }
                }
            }

            // -- ここから先がお届け先を再生成する処理 --

            // お届け先情報をすべて削除
            /** @var Shipping $Shipping */
            foreach ($Order->getShippings() as $Shipping) {
                foreach ($Shipping->getOrderItems() as $OrderItem) {
                    $Shipping->removeOrderItem($OrderItem);
                    $Order->removeOrderItem($OrderItem);
                    $this->entityManager->remove($OrderItem);
                }
                $Order->removeShipping($Shipping);
                $this->entityManager->remove($Shipping);
            }

            // お届け先のリストを作成する
            $ShippingList = [];
            foreach ($data as $multiples) {
                $OrderItem = $multiples->getData();
                $ProductClass = $OrderItem->getProductClass();
                $Delivery = $OrderItem->getShipping()->getDelivery();
                $saleTypeId = $ProductClass->getSaleType()->getId();

                foreach ($multiples as $items) {
                    foreach ($items as $item) {
                        $CustomerAddress = $item['customer_address']->getData();
                        $customerAddressName = $CustomerAddress->getShippingMultipleDefaultName();

                        if (isset($ShippingList[$customerAddressName][$saleTypeId])) {
                            continue;
                        }
                        $Shipping = new Shipping();
                        $Shipping
                            ->setOrder($Order)
                            ->setFromCustomerAddress($CustomerAddress)
                            ->setDelivery($Delivery);
                        $Order->addShipping($Shipping);
                        $ShippingList[$customerAddressName][$saleTypeId] = $Shipping;
                    }
                }
            }
            // お届け先のリストを保存
            foreach ($ShippingList as $ShippingListByAddress) {
                foreach ($ShippingListByAddress as $Shipping) {
                    $this->entityManager->persist($Shipping);
                }
            }

            $ProductOrderType = $this->orderItemTypeRepository->find(OrderItemType::PRODUCT);

            // お届け先に、配送商品の情報(OrderItem)を関連付ける
            foreach ($data as $multiples) {
                /** @var OrderItem $OrderItem */
                $OrderItem = $multiples->getData();
                $ProductClass = $OrderItem->getProductClass();
                $Product = $OrderItem->getProduct();
                $saleTypeId = $ProductClass->getSaleType()->getId();
                $itemId = $OrderItem->getProductClass()->getId() . '_' . $OrderItem->getOptionSerial();
                $optionSerial = $OrderItem->getOptionSerial();
                $OrderItemOptions = $OrderItem->getOrderItemOptions();
                $optionPrice = $OrderItem->getOptionPrice();
                $optionTax = $OrderItem->getOptionTax();

                foreach ($multiples as $items) {
                    foreach ($items as $item) {
                        $CustomerAddress = $item['customer_address']->getData();
                        $customerAddressName = $CustomerAddress->getShippingMultipleDefaultName();

                        // お届け先から商品の数量を取得
                        $quantity = 0;
                        if (isset($arrOrderItemTemp[$customerAddressName]) && array_key_exists($itemId, $arrOrderItemTemp[$customerAddressName])) {
                            $quantity = $arrOrderItemTemp[$customerAddressName][$itemId];
                            unset($arrOrderItemTemp[$customerAddressName][$itemId]);
                        } else {
                            // この配送先には送る商品がないのでスキップ（通常ありえない）
                            continue;
                        }

                        // 関連付けるお届け先のインスタンスを取得
                        $Shipping = $ShippingList[$customerAddressName][$saleTypeId];

                        $Price02 = $ProductClass->getPrice02();
                        $customerClass = $this->getCustomerClass();
                        if (null !== $customerClass) {
                            /** @var CustomerClassPrice $customerClassPrice */
                            $customerClassPrice = $this->customerClassPriceRepository->findOneBy([
                                'customerClass' => $customerClass,
                                'productClass' => $ProductClass
                            ]);

                            if ($customerClassPrice) {
                                $Price02 = $customerClassPrice->getPrice();
                            }
                        }

                        // インスタンスを生成して保存
                        $OrderItem = new OrderItem();
                        $OrderItem->setShipping($Shipping)
                            ->setOrder($Order)
                            ->setProductClass($ProductClass)
                            ->setProduct($Product)
                            ->setProductName($Product->getName())
                            ->setProductCode($ProductClass->getCode())
                            ->setPrice($Price02)
                            ->setQuantity($quantity)
                            ->setOrderItemType($ProductOrderType)
                            ->setOptionSerial($optionSerial);

                        $ClassCategory1 = $ProductClass->getClassCategory1();
                        if (!is_null($ClassCategory1)) {
                            $OrderItem->setClasscategoryName1($ClassCategory1->getName());
                            $OrderItem->setClassName1($ClassCategory1->getClassName()->getName());
                        }
                        $ClassCategory2 = $ProductClass->getClassCategory2();
                        if (!is_null($ClassCategory2)) {
                            $OrderItem->setClasscategoryName2($ClassCategory2->getName());
                            $OrderItem->setClassName2($ClassCategory2->getClassName()->getName());
                        }
                        foreach ($OrderItemOptions as $OrderItemOption) {
                            $newOrderItemOption = new OrderItemOption();
                            $newOrderItemOption->setOptionId($OrderItemOption->getOptionId())
                                ->setOrderItem($OrderItem)
                                ->setLabel($OrderItemOption->getLabel())
                                ->setSortNo($OrderItemOption->getSortNo());
                            foreach ($OrderItemOption->getOrderItemOptionCategories() as $OrderItemOptionCategory) {
                                $newOrderItemOptionCategory = new OrderItemOptionCategory();
                                $newOrderItemOptionCategory->setOptionCategoryId($OrderItemOptionCategory->getOptionCategoryId())
                                    ->setOrderItemOption($newOrderItemOption)
                                    ->setValue($OrderItemOptionCategory->getValue())
                                    ->setPrice($OrderItemOptionCategory->getPrice())
                                    ->setTax($OrderItemOptionCategory->getTax())
                                    ->setDeliveryFreeFlg($OrderItemOptionCategory->getDeliveryFreeFlg())
                                    ->setSortNo($OrderItemOptionCategory->getSortNo());
                                $newOrderItemOption->addOrderItemOptionCategory($newOrderItemOptionCategory);
                            }
                            $OrderItem->addOrderItemOption($newOrderItemOption);
                        }
                        $OrderItem->setPrice($OrderItem->getPrice() + $optionPrice);
                        $OrderItem->setTax($OrderItem->getTax() + $optionTax);
                        $Shipping->addOrderItem($OrderItem);
                        $Order->addOrderItem($OrderItem);
                        $this->entityManager->persist($OrderItem);
                    }
                }
            }

            $this->entityManager->flush();
        }
    }

    protected function getCustomerClass()
    {
        if (!$this->context->getCurrentUser() instanceof Customer) {
            return false;
        }

        $customerClass = $this->context->getCurrentUser()->getPlgCcpCustomerClass();

        if (null === $customerClass) {
            return false;
        }

        return $customerClass;
    }
}
