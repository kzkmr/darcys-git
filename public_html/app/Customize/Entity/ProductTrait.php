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
  * @EntityExtension("Eccube\Entity\Product")
 */
trait  ProductTrait
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="option_margin_activate", type="boolean", options={"default":true})
     */
    private $option_margin_activate = true;
    
    private $hide_class_category1 = false;
    private $hide_class_category2 = false;
    private $LoginTypeInfo;
    private $ContractTypeList;


        /**
         * Set optionMarginActivate.
         *
         * @param boolean $optionMarginActivate
         *
         * @return BaseInfo
         */
        public function setOptionMarginActivate($optionMarginActivate)
        {
            $this->option_margin_activate = $optionMarginActivate;

            return $this;
        }

        /**
         * Get optionMarginActivate.
         *
         * @return boolean
         */
        public function isOptionMarginActivate()
        {
            return $this->option_margin_activate;
        }

    /**
     * Set HideClassCategory1.
     *
     * @param string $HideClassCategory1
     *
     * @return Product
     */
    public function setHideClassCategory1($HideClassCategory1)
    {
        $this->hide_class_category1 = $HideClassCategory1;

        return $this;
    }

    /**
     * Get HideClassCategory1.
     *
     * @return string
     */
    public function getHideClassCategory1()
    {
        return $this->hide_class_category1;
    }

    /**
     * Set HideClassCategory2.
     *
     * @param string $HideClassCategory2
     *
     * @return Product
     */
    public function setHideClassCategory2($HideClassCategory2)
    {
        $this->hide_class_category2 = $HideClassCategory2;

        return $this;
    }

    /**
     * Get HideClassCategory2.
     *
     * @return string
     */
    public function getHideClassCategory2()
    {
        return $this->hide_class_category2;
    }

    public function setLoginTypeInfo($LoginTypeInfo, $ContractTypeList){
        $this->_calc = false;
        $this->LoginTypeInfo = $LoginTypeInfo;
        $this->ContractTypeList = $ContractTypeList;
        $this->_calcChainStore();
    }

    public function setHiddenClassCategory($ContractTypeList)
    {
        $this->hide_class_category1 = false;
        $this->hide_class_category2 = false;
        
        foreach ($this->getProductClasses() as $ProductClass) {
            $ClassCategory1 = $ProductClass->getClassCategory1();
            $ClassCategory2 = $ProductClass->getClassCategory2();

            if ($ClassCategory1) {
                $isContain1 = $this->getContainClassCategory($ContractTypeList, $ClassCategory1);
                if($isContain1){
                    $this->hide_class_category1 = true;
                }
            }
            if ($ClassCategory2) {
                $isContain2 = $this->getContainClassCategory($ContractTypeList, $ClassCategory2);
                if($isContain2){
                    $this->hide_class_category2 = true;
                }
            }
        }
    }

    public function getContainClassCategory($ContractTypeList, $SrcClassCategory)
    {
        if(is_array($ContractTypeList)){
            foreach($ContractTypeList as $ContractType){
                $DstClassCategory = $ContractType->getClassCategory();

                if($DstClassCategory->getId() == $SrcClassCategory->getId()){
                    return true;
                }
            }
        }

        return false;
    }

    public function _IsContainContractTypeList($ContractTypeId)
    {
        if($this->ContractTypeList && is_array($this->ContractTypeList)){
            foreach ($this->ContractTypeList as $ObjContractType) {
                $ClassCategory = $ObjContractType->getClassCategory();

                if($ClassCategory->getId() == $ContractTypeId){
                    return true;
                }
            }
        }

        return false;
    }

    public function _calcChainStore()
    {
        if (!$this->_calc) {
            $LoginType = null;
            $Customer = null;
            $ChainStore = null;
            $ContractType = null;

            if(isset($this->LoginTypeInfo)){
                $LoginTypeInfo = $this->LoginTypeInfo;
                $LoginType = $LoginTypeInfo["LoginType"];
                $Customer = $LoginTypeInfo["Customer"];
                $ChainStore = $LoginTypeInfo["ChainStore"];
                $ContractType = $LoginTypeInfo["ContractType"];
            }

            $i = 0;
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

                if($ContractType && is_object($ContractType)){
                    $ClassCategory = $ContractType->getClassCategory();
                    if($ClassCategory){
                        if(is_object($ClassCategory1) && $ClassCategory->getId() != $ClassCategory1->getId()){
                            continue;
                        }else{
                            if(is_object($ClassCategory2) && $ClassCategory->getId() != $ClassCategory2->getId()){
                                //continue;
                            }
                        }
                    }
                }else{
            
                    if($ClassCategory1)
                    {
                        $isContain1 = $this->_IsContainContractTypeList($ClassCategory1->getId());

                        if($isContain1)
                        {
                            continue;
                        }
                    }

                    if($ClassCategory2)
                    {
                        $isContain2 = $this->_IsContainContractTypeList($ClassCategory2->getId());

                        if($isContain2)
                        {
                            continue;
                        }
                    }
                }

                // stock_find
                $this->stockFinds[] = $ProductClass->getStockFind();

                // stock
                $this->stocks[] = $ProductClass->getStock();

                // stock_unlimited
                $this->stockUnlimiteds[] = $ProductClass->isStockUnlimited();

                // price01
                if (!is_null($ProductClass->getPrice01())) {
                    $this->price01[] = $ProductClass->getPrice01();
                    // price01IncTax
                    $this->price01IncTaxs[] = $ProductClass->getPrice01IncTax();
                }

                // price02
                $this->price02[] = $ProductClass->getPrice02();

                // price02IncTax
                $this->price02IncTaxs[] = $ProductClass->getPrice02IncTax();

                // product_code
                $this->codes[] = $ProductClass->getCode();

                if ($i === 0) {
                    if ($ProductClass->getClassCategory1() && $ProductClass->getClassCategory1()->getId()) {
                        $this->className1 = $ProductClass->getClassCategory1()->getClassName()->getName();
                    }
                    if ($ProductClass->getClassCategory2() && $ProductClass->getClassCategory2()->getId()) {
                        $this->className2 = $ProductClass->getClassCategory2()->getClassName()->getName();
                    }
                }
                if ($ProductClass->getClassCategory1()) {
                    $classCategoryId1 = $ProductClass->getClassCategory1()->getId();
                    if (!empty($classCategoryId1)) {
                        if ($ProductClass->getClassCategory2()) {
                            $this->classCategories1[$ProductClass->getClassCategory1()->getId()] = $ProductClass->getClassCategory1()->getName();
                            $this->classCategories2[$ProductClass->getClassCategory1()->getId()][$ProductClass->getClassCategory2()->getId()] = $ProductClass->getClassCategory2()->getName();
                        } else {
                            $this->classCategories1[$ProductClass->getClassCategory1()->getId()] = $ProductClass->getClassCategory1()->getName().($ProductClass->getStockFind() ? '' : trans('front.product.out_of_stock_label'));
                        }
                    }
                }
                $i++;
            }
            $this->_calc = true;
        }
    }

}
