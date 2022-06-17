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
  * @EntityExtension("Eccube\Entity\Shipping")
 */
trait  ShippingTrait
{
    private $shippingDeliveryStringDate;

    /**
     * Set shippingDeliveryStringDate
     *
     * @param string|null $shippingDeliveryStringDate
     *
     * @return Shipping
     */
    public function setShippingDeliveryStringDate($shippingDeliveryStringDate = null)
    {
        $this->shippingDeliveryStringDate = $shippingDeliveryStringDate;

        return $this;
    }

    /**
     * Get shippingDeliveryStringDate
     *
     * @return string|null
     */
    public function getShippingDeliveryStringDate()
    {
        return $this->shippingDeliveryStringDate;
    }

}
