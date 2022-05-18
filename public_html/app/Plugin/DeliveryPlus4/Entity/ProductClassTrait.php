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
 * @EntityExtension("Eccube\Entity\ProductClass")
 */
trait ProductClassTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_weight", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_weight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_size", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_size;

    public function setDeliveryplusWeight($weight)
    {
        $this->deliveryplus_weight = $weight;

        return $this;
    }

    public function getDeliveryplusWeight()
    {
        return $this->deliveryplus_weight;
    }

    public function setDeliveryplusSize($size)
    {
        $this->deliveryplus_size = $size;

        return $this;
    }

    public function getDeliveryplusSize()
    {
        return $this->deliveryplus_size;
    }
}
