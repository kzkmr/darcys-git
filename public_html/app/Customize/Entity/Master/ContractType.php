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

namespace Customize\Entity\Master;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContractType
 *
 * @ORM\Table(name="mtb_contract_type")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Customize\Repository\Master\ContractTypeRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class ContractType extends \Eccube\Entity\Master\AbstractMasterEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="url_parameter", type="string", length=20)
     */
    protected $url_parameter;

    /**
     * @var string
     *
     * @ORM\Column(name="reg_url_parameter", type="string", length=20)
     */
    protected $reg_url_parameter;

    /**
     * @var string
     *
     * @ORM\Column(name="page_coupon_list", type="string", length=1)
     */
    protected $page_coupon_list;

    /**
     * @var string
     *
     * @ORM\Column(name="page_coupon_analytic", type="string", length=1)
     */
    protected $page_coupon_analytic;

    /**
     * @var string
     *
     * @ORM\Column(name="is_hidden", type="string", length=1)
     */
    protected $is_hidden;

    /**
     * @var string
     *
     * @ORM\Column(name="show_product", type="string", length=1)
     */
    protected $show_product;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_limit", type="string", length=255)
     */
    protected $paymentLimit;

    /**
     * @var \Eccube\Entity\ClassCategory
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\ClassCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="class_category_id", referencedColumnName="id")
     * })
     */
    private $ClassCategory;

    /**
     * Set url parameter.
     *
     * @param string $url_parameter
     *
     * @return ContractType
     */
    public function setUrlParameter($url_parameter)
    {
        $this->url_parameter = $url_parameter;

        return $this;
    }

    /**
     * Get url parameter.
     *
     * @return string
     */
    public function getUrlParameter()
    {
        return $this->url_parameter;
    }

    /**
     * Set reg url parameter.
     *
     * @param string $reg_url_parameter
     *
     * @return ContractType
     */
    public function setRegUrlParameter($reg_url_parameter)
    {
        $this->reg_url_parameter = $reg_url_parameter;

        return $this;
    }

    /**
     * Get reg url parameter.
     *
     * @return string
     */
    public function getRegUrlParameter()
    {
        return $this->reg_url_parameter;
    }

    /**
     * Set Page Coupon List.
     *
     * @param string $pageCouponList
     *
     * @return ContractType
     */
    public function setPageCouponList($pageCouponList)
    {
        $this->page_coupon_list = $pageCouponList;

        return $this;
    }

    /**
     * Get Page Coupon List.
     *
     * @return string
     */
    public function getPageCouponList()
    {
        return $this->page_coupon_list;
    }

    /**
     * Set Page Coupon Analytic.
     *
     * @param string $pageCouponAnalytic
     *
     * @return ContractType
     */
    public function setPageCouponAnalytic($pageCouponAnalytic)
    {
        $this->page_coupon_analytic = $pageCouponAnalytic;

        return $this;
    }

    /**
     * Get Page Coupon Analytic.
     *
     * @return string
     */
    public function getPageCouponAnalytic()
    {
        return $this->page_coupon_analytic;
    }

    /**
     * Set is hidden.
     *
     * @param string $isHidden
     *
     * @return ContractType
     */
    public function setIsHidden($isHidden)
    {
        $this->is_hidden = $isHidden;

        return $this;
    }

    /**
     * Get is hidden.
     *
     * @return string
     */
    public function getIsHidden()
    {
        return $this->is_hidden;
    }


    /**
     * Set Show Product.
     *
     * @param string $showProduct
     *
     * @return ContractType
     */
    public function setShowProduct($showProduct)
    {
        $this->show_product = $showProduct;

        return $this;
    }

    /**
     * Get Show Product.
     *
     * @return string
     */
    public function getShowProduct()
    {
        return $this->show_product;
    }

    /**
     * Set Payment Limit.
     *
     * @param string $paymentLimit
     *
     * @return ContractType
     */
    public function setPaymentLimit($paymentLimit)
    {
        $this->paymentLimit = $paymentLimit;

        return $this;
    }

    /**
     * Get Payment Limit.
     *
     * @return string
     */
    public function getPaymentLimit()
    {
        return $this->paymentLimit;
    }
    
    /**
     * Set Class Category.
     *
     * @param ClassCategory $ClassCategory
     *
     * @return ContractType
     */
    public function setClassCategory($ClassCategory)
    {
        $this->ClassCategory = $ClassCategory;

        return $this;
    }

    /**
     * Get Class Category.
     *
     * @return ClassCategory
     */
    public function getClassCategory()
    {
        return $this->ClassCategory;
    }
}
