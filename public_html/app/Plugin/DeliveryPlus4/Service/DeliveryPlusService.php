<?php
/*
* Plugin Name : DeliveryPlus4
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\DeliveryPlus4\Service;

use Eccube\Repository\DeliveryRepository;
use Eccube\Service\TaxRuleService;
use Plugin\DeliveryPlus4\Entity\DeliveryPlusConfig;
use Plugin\DeliveryPlus4\Repository\ConfigRepository;

class DeliveryPlusService
{
    private $deliveryRepository;
    private $configRepository;
    private $taxRuleService;

    public function __construct(
        DeliveryRepository $deliveryRepository,
        ConfigRepository $configRepository,
        TaxRuleService $taxRuleService
    ) {
        $this->deliveryRepository = $deliveryRepository;
        $this->configRepository = $configRepository;
        $this->taxRuleService = $taxRuleService;
    }

    public function getDeliveries($Shipping)
    {
        $Config = $this->configRepository->find(['name' => 'method']);
        $method = DeliveryPlusConfig::ALL;
        if($Config){
            $method = $Config->getValue();
        }
        // 配送商品に含まれる販売種別を抽出.
        $OrderItems = $Shipping->getProductOrderItems();

        $SaleTypes = [];
        foreach ($OrderItems as $OrderItem) {
            if($OrderItem->isProduct()){
                $ProductClass = $OrderItem->getProductClass();
                $SaleType = $ProductClass->getSaleType();
                $SaleTypes[$SaleType->getId()] = $SaleType;
            }
        }

        // 販売種別に紐づく配送業者を取得.
        $Delives = $this->deliveryRepository->getDeliveries($SaleTypes);

        $total_weight = 0;
        $total_size = 0;
        $subtotal = 0;
        foreach($OrderItems as $shipmentItem){
            if($shipmentItem->isProduct()){
                $ProductClass = $shipmentItem->getProductClass();
                $weight = $ProductClass->getDeliveryplusWeight();
                if(!is_null($weight))$total_weight += $weight * $shipmentItem->getQuantity();
                $size = $ProductClass->getDeliveryplusSize();
                if(!is_null($size))$total_size += $size * $shipmentItem->getQuantity();
                $Product = $shipmentItem->getProduct();
                $ProductClass = $shipmentItem->getProductClass();
                $subtotal += $this->taxRuleService->getPriceIncTax($shipmentItem->getPrice(), $Product, $ProductClass) * $shipmentItem->getQuantity();
            }
        }

        if($method == DeliveryPlusConfig::ALL){
            $subtotal = 0;
            foreach($Shipping->getOrder()->getProductOrderItems() as $orderItem){
                $Product = $orderItem->getProduct();
                $ProductClass = $orderItem->getProductClass();
                $subtotal += $this->taxRuleService->getPriceIncTax($orderItem->getPrice(), $Product, $ProductClass) * $orderItem->getQuantity();
            }
        }

        $Deliveries = [];
        foreach ($Delives as $Delivery) {
            if(method_exists($Delivery, 'getDeliveryCoolFlg')){
                if($Delivery->getDeliveryCoolFlg()){
                    foreach ($Shipping->getProductOrderItems() as $OrderItem) {
                        $type = $OrderItem->getProductClass()->getDeliveryCoolType();
                        if($type > 2){
                            continue 2;
                        }
                    }
                }
            }
            foreach ($OrderItems as $item) {
                $saleType = $item->getProductClass()->getSaleType();
                if ($Delivery->getSaleType()->getId() == $saleType->getId()) {
                    $weight_min = $Delivery->getDeliveryplusWeightMin();
                    $weight_max = $Delivery->getDeliveryplusWeightMax();
                    if(!is_null($weight_min)){
                        if($weight_min > $total_weight)continue;
                    }
                    if(!is_null($weight_max)){
                        if($weight_max < $total_weight)continue;
                    }
                    $size_min = $Delivery->getDeliveryplusSizeMin();
                    $size_max = $Delivery->getDeliveryplusSizeMax();
                    if(!is_null($size_min)){
                        if($size_min > $total_size)continue;
                    }
                    if(!is_null($size_max)){
                        if($size_max < $total_size)continue;
                    }
                    $subtotal_min = $Delivery->getDeliveryplusSubtotalMin();
                    $subtotal_max = $Delivery->getDeliveryplusSubtotalMax();
                    if(!is_null($subtotal_min)){
                        if($subtotal_min > $subtotal)continue;
                    }
                    if(!is_null($subtotal_max)){
                        if($subtotal_max < $subtotal)continue;
                    }
                    $Deliveries[] = $Delivery;
                }
            }
        }

        return $Deliveries;
    }
}
