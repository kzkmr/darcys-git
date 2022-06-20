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
    private $time_sort_id;

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

    /**
     * Set time_sort_id
     *
     * @param string|null $time_sort_id
     *
     * @return Shipping
     */
    public function setTimeSortId($time_sort_id = null)
    {
        $this->time_sort_id = $time_sort_id;

        return $this;
    }

    /**
     * Get time_sort_id
     *
     * @return string|null
     */
    public function getTimeSortId()
    {
        return $this->time_sort_id;
    }
}
