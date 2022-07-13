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
 * @EntityExtension("Eccube\Entity\Product")
 */
trait ProductTrait
{
        private $_calc_deliveryplus = false;
        private $deliveryplus_weight = [];
        private $deliveryplus_size = [];
        private $deliveryplus_weight_min = null;
        private $deliveryplus_weight_max = null;
        private $deliveryplus_size_min = null;
        private $deliveryplus_size_max = null;

        public function _calc_deliveryplus()
        {
            if (!$this->_calc_deliveryplus) {
                foreach ($this->getProductClasses() as $ProductClass) {
                    /* @var $ProductClass \Eccube\Entity\ProductClass */
                    // stock_find
                    if ($ProductClass->isVisible() == false) {
                        continue;
                    }
                    $ClassCategory1 = $ProductClass->getClassCategory1();
                    $ClassCategory2 = $ProductClass->getClassCategory2();
                    if ($ClassCategory1 && !$ClassCategory1->isVisible()) {
                        continue;
                    }
                    if ($ClassCategory2 && !$ClassCategory2->isVisible()) {
                        continue;
                    }

                    $weight = $ProductClass->getDeliveryplusWeight();
                    if(!is_null($weight))$this->deliveryplus_weight[] = $weight;
                    $size = $ProductClass->getDeliveryplusSize();
                    if(!is_null($size))$this->deliveryplus_size[] = $size;

                }
                if(count($this->deliveryplus_weight) > 0)$this->deliveryplus_weight_min = min($this->deliveryplus_weight);
                if(count($this->deliveryplus_weight) > 0)$this->deliveryplus_weight_max = max($this->deliveryplus_weight);
                if(count($this->deliveryplus_size) > 0)$this->deliveryplus_size_min = min($this->deliveryplus_size);
                if(count($this->deliveryplus_size) > 0)$this->deliveryplus_size_max = max($this->deliveryplus_size);
                $this->_calc_deliveryplus = true;
            }
        }

        public function getDeliveryplusWeightMin()
        {
            $this->_calc_deliveryplus();

            return $this->deliveryplus_weight_min;
        }

        public function getDeliveryplusWeightMax()
        {
            $this->_calc_deliveryplus();

            return $this->deliveryplus_weight_max;
        }

        public function getDeliveryplusSizeMin()
        {
            $this->_calc_deliveryplus();

            return $this->deliveryplus_size_min;
        }

        public function getDeliveryplusSizeMax()
        {
            $this->_calc_deliveryplus();

            return $this->deliveryplus_size_max;
        }
}
