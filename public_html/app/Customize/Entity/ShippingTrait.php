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
    //CSV-お名前(姓)(名)
    private $merge_name;
    //CSV-お名前(セイ)(メイ)
    private $merge_name_kana;
    //CSV-配送先_お名前(姓)(名)
    private $merge_shipping_name;
    //CSV-配送先_お名前(セイ)(メイ)
    private $merge_shipping_name_kana;

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

    /**
     * Set merge_name
     *
     * @param string|null $merge_name
     *
     * @return Shipping
     */
    public function setMergeName($merge_name = null)
    {
        $this->merge_name = $merge_name;

        return $this;
    }

    /**
     * Get merge_name
     *
     * @return string|null
     */
    public function getMergeName()
    {
        return $this->merge_name;
    }


    /**
     * Set merge_name_kana
     *
     * @param string|null $merge_name_kana
     *
     * @return Shipping
     */
    public function setMergeNameKana($merge_name_kana = null)
    {
        $this->merge_name_kana = $merge_name_kana;

        return $this;
    }

    /**
     * Get merge_name_kana
     *
     * @return string|null
     */
    public function getMergeNameKana()
    {
        return $this->merge_name_kana;
    }


    /**
     * Set merge_shipping_name
     *
     * @param string|null $merge_shipping_name
     *
     * @return Shipping
     */
    public function setMergeShippingName($merge_shipping_name = null)
    {
        $this->merge_shipping_name = $merge_shipping_name;

        return $this;
    }

    /**
     * Get merge_shipping_name
     *
     * @return string|null
     */
    public function getMergeShippingName()
    {
        return $this->merge_shipping_name;
    }


    /**
     * Set merge_shipping_name_kana
     *
     * @param string|null $merge_shipping_name_kana
     *
     * @return Shipping
     */
    public function setMergeShippingNameKana($merge_shipping_name_kana = null)
    {
        $this->merge_shipping_name_kana = $merge_shipping_name_kana;

        return $this;
    }

    /**
     * Get merge_shipping_name_kana
     *
     * @return string|null
     */
    public function getMergeShippingNameKana()
    {
        return $this->merge_shipping_name_kana;
    }
}
