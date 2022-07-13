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

namespace Plugin\DeliveryPlus4\Entity;

use Eccube\Annotation\EntityExtension;
use Doctrine\ORM\Mapping as ORM;

/**
 * @EntityExtension("Eccube\Entity\Cart")
 */
trait CartTrait
{
        private $_calc_deliveryplus = false;
        private $deliveryplus_total_weight = null;
        private $deliveryplus_total_size = null;

        public function _calc_deliveryplus()
        {
            if (!$this->_calc_deliveryplus) {
                foreach ($this->getCartItems() as $CartItem) {
                    $this->deliveryplus_total_weight += $CartItem->getProductClass()->getDeliveryplusWeight()*$CartItem->getQuantity();
                    $this->deliveryplus_total_size += $CartItem->getProductClass()->getDeliveryplusSize()*$CartItem->getQuantity();
                }
                $this->_calc_deliveryplus = true;
            }
        }

        public function getDeliveryplusTotalWeight()
        {
            $this->_calc_deliveryplus();

            return $this->deliveryplus_total_weight;
        }

        public function getDeliveryplusTotalSize()
        {
            $this->_calc_deliveryplus();

            return $this->deliveryplus_total_size;
        }


}
