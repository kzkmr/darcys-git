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

namespace Plugin\DeliveryPlus4\Service\PurchaseFlow\Processor;

use Plugin\DeliveryPlus4\Service\DeliveryPlusService;
use Eccube\Annotation\ShoppingFlow;
use Eccube\Entity\ItemHolderInterface;
use Eccube\Entity\Order;
use Eccube\Service\PurchaseFlow\ItemHolderValidator;
use Eccube\Service\PurchaseFlow\PurchaseContext;

/**
 * @ShoppingFlow
 */
class DeliveryChangeValidator extends ItemHolderValidator
{
    protected $deliveryService;


    public function __construct(DeliveryPlusService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function validate(ItemHolderInterface $itemHolder, PurchaseContext $context)
    {
        if (!$itemHolder instanceof Order) {
            return;
        }

        foreach($itemHolder->getShippings() as $Shipping)
        {
            $Deliveries = $this->deliveryService->getDeliveries($Shipping);
            if(count($Deliveries) > 0){
                $Delivery = $Shipping->getDelivery();
                if(is_null($Delivery) || !in_array($Delivery, $Deliveries))$Shipping->setDelivery($Deliveries[0]);
            }else{
                $this->throwInvalidItemException('deliveryplus.front.shopping.delivery_not_fount');
            }
        }
    }


}
