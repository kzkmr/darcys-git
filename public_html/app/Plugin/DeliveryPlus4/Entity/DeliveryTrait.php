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
 * @EntityExtension("Eccube\Entity\Delivery")
 */
trait DeliveryTrait
{

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_weight_min", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_weight_min;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_weight_max", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_weight_max;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_size_min", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_size_min;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_size_max", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_size_max;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_subtotal_min", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_subtotal_min;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryplus_subtotal_max", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $deliveryplus_subtotal_max;


    public function setDeliveryplusWeightMin($weightMin)
    {
        $this->deliveryplus_weight_min = $weightMin;

        return $this;
    }

    public function getDeliveryplusWeightMin()
    {
        return $this->deliveryplus_weight_min;
    }

    public function setDeliveryplusWeightMax($weightMax)
    {
        $this->deliveryplus_weight_max = $weightMax;

        return $this;
    }

    public function getDeliveryplusWeightMax()
    {
        return $this->deliveryplus_weight_max;
    }

    public function setDeliveryplusSizeMin($sizeMin)
    {
        $this->deliveryplus_size_min = $sizeMin;

        return $this;
    }

    public function getDeliveryplusSizeMin()
    {
        return $this->deliveryplus_size_min;
    }

    public function setDeliveryplusSizeMax($sizeMax)
    {
        $this->deliveryplus_size_max = $sizeMax;

        return $this;
    }

    public function getDeliveryplusSizeMax()
    {
        return $this->deliveryplus_size_max;
    }

    public function setDeliveryplusSubtotalMin($subtotalMin)
    {
        $this->deliveryplus_subtotal_min = $subtotalMin;

        return $this;
    }

    public function getDeliveryplusSubtotalMin()
    {
        return $this->deliveryplus_subtotal_min;
    }

    public function setDeliveryplusSubtotalMax($subtotalMax)
    {
        $this->deliveryplus_subtotal_max = $subtotalMax;

        return $this;
    }

    public function getDeliveryplusSubtotalMax()
    {
        return $this->deliveryplus_subtotal_max;
    }
}
