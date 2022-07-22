<?php
/*
* Plugin Name : HiddenDeliveryDate
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\HiddenDeliveryDate\Service;

use Eccube\Entity\Shipping;
use Plugin\HiddenDeliveryDate\Repository\HiddendayRepository;

class ShoppingService
{
    private $hiddendayRepository;

    public function __construct(
        HiddendayRepository $hiddendayRepository
    ) {
        $this->hiddendayRepository = $hiddendayRepository;
    }

    public function getHiddenDeliveryDates($deliveryDates, Shipping $Shipping)
    {
        $hiddenDays = [];
        $Hiddendays = $this->hiddendayRepository->findBy(['Product' => NULL]);
        if(count($Hiddendays) > 0){
            foreach($Hiddendays as $Hiddenday){
                $hiddenDays[] = $Hiddenday->getDate();
            }
        }
        foreach($Shipping->getProductOrderItems() as $OrderItem){
            $Product = $OrderItem->getProduct();
            if(!is_null($Product)){
                $Hiddendays = $this->hiddendayRepository->findBy(['Product' => $Product]);
                if(count($Hiddendays) > 0){
                    foreach($Hiddendays as $Hiddenday){
                        $hiddenDays[] = $Hiddenday->getDate();
                    }
                }
            }
        }

        if(count($hiddenDays) > 0){
            foreach($deliveryDates as $key => $date){
                foreach($hiddenDays as $hiddenday){
                    if($key == $hiddenday->format('Y/m/d')){
                        unset($deliveryDates[$key]);
                    }
                }
            }
        }
        return $deliveryDates;

    }
}
