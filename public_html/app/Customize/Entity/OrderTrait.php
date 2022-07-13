<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;

/**
  * @EntityExtension("Eccube\Entity\Order")
 */
trait  OrderTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="use_coupon", type="string", length=1, nullable=true)
     */
    private $use_coupon;

    /**
     * Set use coupon.
     *
     * @param string|null $useCoupon
     *
     * @return Order
     */
    public function setUseCoupon($useCoupon = null)
    {
        $this->use_coupon = $useCoupon;

        return $this;
    }

    /**
     * Get use coupon.
     *
     * @return string|null
     */
    public function getUseCoupon()
    {
        return $this->use_coupon;
    }

}
