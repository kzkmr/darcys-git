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
    //CSV-お名前（代表者）(姓)(名)
    private $merge_chainstore_name;
    //CSV-お名前（代表者）(カナ)(姓)(名)
    private $merge_chainstore_kana;
    //CSV-E-ASPROのギフトモード
    private $e_aspro;

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

    /**
     * Set merge_chainstore_name
     *
     * @param string|null $merge_chainstore_name
     *
     * @return Shipping
     */
    public function setMergeChainStoreName($merge_chainstore_name = null)
    {
        $this->merge_chainstore_name = $merge_chainstore_name;

        return $this;
    }

    /**
     * Get merge_chainstore_name
     *
     * @return string|null
     */
    public function getMergeChainStoreName()
    {
        return $this->merge_chainstore_name;
    }

    /**
     * Set merge_chainstore_kana
     *
     * @param string|null $merge_chainstore_kana
     *
     * @return Shipping
     */
    public function setMergeChainStoreKana($merge_chainstore_kana = null)
    {
        $this->merge_chainstore_kana = $merge_chainstore_kana;

        return $this;
    }

    /**
     * Get merge_chainstore_kana
     *
     * @return string|null
     */
    public function getMergeChainStoreKana()
    {
        return $this->merge_chainstore_kana;
    }

    /**
     * Set e_aspro
     *
     * @param string|null $e_aspro
     *
     * @return Shipping
     */
    public function setEAspro($e_aspro = null)
    {
        $this->e_aspro = $e_aspro;

        return $this;
    }

    /**
     * Get e_aspro
     *
     * @return string|null
     */
    public function getEAspro()
    {
        return $this->e_aspro;
    }
    
}
