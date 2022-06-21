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
  * @EntityExtension("Eccube\Entity\CustomerAddress")
 */
trait  CustomerAddressTrait
{

        /**
         * @var \Customize\Entity\Master\RelatedChainStoreType 販売店舗の関連性
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\RelatedChainStoreType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="related_chainstore_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $RelatedChainStoreType;

        /**
         * @var \Customize\Entity\Master\ChainStoreBusinessType 販売店の業務形態
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreBusinessType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_business_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $ChainStoreBusinessType;

        /**
         * @var string|null 販売店舗の業務形態(その他)
         *
         * @ORM\Column(name="chainstore_business_other_type", type="string", length=255, nullable=true, options={"comment":"販売店舗の業務形態(その他)"}) 
         */
        private $chainstore_business_other_type;

        /**
         * @var string|null 販売店舗名（フリガナ）
         *
         * @ORM\Column(name="chainstore_name_kana", type="string", length=255, nullable=true, options={"comment":"販売店舗名（フリガナ）"}) 
         */
        private $chainstore_name_kana;

        /**
         * @var string  運営会社・運営者
         *
         * @ORM\Column(name="operating_name", type="string", length=255, nullable=true, options={"comment":"運営会社・運営者"}) 
         */
        private $operating_name;

        /**
         * @var string|null 運営会社・運営者（フリガナ）
         *
         * @ORM\Column(name="operating_kana", type="string", length=255, nullable=true, options={"comment":"運営会社・運営者（フリガナ）"}) 
         */
        private $operating_kana;

        /**
         * @var \Customize\Entity\Master\ChainStoreProvideType 提供方法
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreProvideType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_provide_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $ChainStoreProvideType;

        /**
         * @var \Customize\Entity\Master\ChainStoreProvideStyleType 提供スタイル
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreProvideStyleType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_provide_style_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $ChainStoreProvideStyleType;

        /**
         * @var string|null 販売店舗メールアドレス
         *
         * @ORM\Column(name="chainstore_email", type="string", length=255, nullable=true, options={"comment":"販売店舗メールアドレス"}) 
         */
        private $chainstore_email;

        /**
         * @var string|null WEBショップでダシーズの出品予定はありますか
         *
         * @ORM\Column(name="option_webshop", type="string", length=255, nullable=true, options={"comment":"WEBショップでダシーズの出品予定はありますか"}) 
         */
        private $option_webshop;

        /**
         * @var string|null ＷＥＢショップ店舗名
         *
         * @ORM\Column(name="webshop_name", type="string", length=255, nullable=true, options={"comment":"ＷＥＢショップ店舗名"}) 
         */
        private $webshop_name;

        /**
         * @var string|null 出店WEBショップURL
         *
         * @ORM\Column(name="webshop_url", type="string", length=255, nullable=true, options={"comment":"出店WEBショップURL"}) 
         */
        private $webshop_url;

        /**
         * @var \Customize\Entity\Master\ChainStoreWebShopOpeningType 出店WEBショップの運営会社
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreWebShopOpeningType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_webshop_opening_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $chainStoreWebShopOpeningType;

        /**
         * @var string|null 出店WEBショップの運営会社(その他)
         *
         * @ORM\Column(name="chainstore_webshop_opening_other_type", type="string", length=255, nullable=true, options={"comment":"出店WEBショップの運営会社(その他)"}) 
         */
        private $chainstore_webshop_opening_other_type;

        /**
         * @var \Customize\Entity\Master\ChainStoreWebShopOwnerType WEBショップ運営担当者
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreWebShopOwnerType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_webshop_owner_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $chainStoreWebShopOwnerType;

        /**
         * @var string|null 上記WEBショップ運営担当者名
         *
         * @ORM\Column(name="webshop_main_operation_name", type="string", length=255, nullable=true, options={"comment":"上記WEBショップ運営担当者名"}) 
         */
        private $webshop_main_operation_name;

        /**
         * @var \Customize\Entity\Master\ChainStoreWebShopPhoneType 運営担当者電話番号
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreWebShopPhoneType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_webshop_phone_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $chainStoreWebShopPhoneType;

        /**
         * @var string|null 運営担当者電話番号(その他)
         *
         * @ORM\Column(name="chainstore_webshop_phone_other_type", type="string", length=255, nullable=true, options={"comment":"運営担当者電話番号(その他)"}) 
         */
        private $chainstore_webshop_phone_other_type;

        /**
         * @var \Customize\Entity\Master\ChainStoreWebShopEmailType 運営担当者メールアドレス
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreWebShopEmailType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_webshop_mail_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $chainStoreWebShopEmailType;

        /**
         * @var string|null 運営担当者メールアドレス(その他)
         *
         * @ORM\Column(name="chainstore_webshop_mail_other_type", type="string", length=255, nullable=true, options={"comment":"運営担当者メールアドレス(その他)"}) 
         */
        private $chainstore_webshop_mail_other_type;


        /**
         * Set relatedChainStoreType.
         *
         * @param \Customize\Entity\Master\RelatedChainStoreType $relatedChainStoreType
         *
         * @return SubChainStore
         */
        public function setRelatedChainStoreType(\Customize\Entity\Master\RelatedChainStoreType $relatedChainStoreType = null)
        {
            $this->RelatedChainStoreType = $relatedChainStoreType;

            return $this;
        }

        /**
         * Get relatedChainStoreType.
         *
         * @return \Customize\Entity\Master\RelatedChainStoreType
         */
        public function getRelatedChainStoreType()
        {
            return $this->RelatedChainStoreType;
        }


        /**
         * Set chainStoreBusinessType.
         *
         * @param \Customize\Entity\Master\ChainStoreBusinessType $chainStoreBusinessType
         *
         * @return SubChainStore
         */
        public function setChainStoreBusinessType(\Customize\Entity\Master\ChainStoreBusinessType $chainStoreBusinessType = null)
        {
            $this->ChainStoreBusinessType = $chainStoreBusinessType;

            return $this;
        }

        /**
         * Get chainStoreBusinessType.
         *
         * @return \Customize\Entity\Master\ChainStoreBusinessType
         */
        public function getChainStoreBusinessType()
        {
            return $this->ChainStoreBusinessType;
        }

        
        /**
         * Get chainstore_business_other_type.
         *
         * @return string|null
         */
        public function getChainstoreBusinessOtherType()
        {
            return $this->chainstore_business_other_type;
        }

        /**
         * Set chainstore_business_other_type.
         *
         * @param string|null $chainstore_business_other_type
         *
         * @return ChainStore
         */
        public function setChainstoreBusinessOtherType($chainstore_business_other_type = null)
        {
            $this->chainstore_business_other_type = $chainstore_business_other_type;

            return $this;
        }


        /**
         * Set chainstore_name_kana.
         *
         * @param string|null $chainstore_name_kana
         *
         * @return ChainStore
         */
        public function setChainstoreNameKana($chainstore_name_kana = null)
        {
            $this->chainstore_name_kana = $chainstore_name_kana;

            return $this;
        }

        /**
         * Get chainstore_name_kana.
         *
         * @return string|null
         */
        public function getChainstoreNameKana()
        {
            return $this->chainstore_name_kana;
        }


        /**
         * Set operating_name.
         *
         * @param string $operating_name
         *
         * @return ChainStore
         */
        public function setOperatingName($operating_name)
        {
            $this->operating_name = $operating_name;

            return $this;
        }

        /**
         * Get operating_name.
         *
         * @return string
         */
        public function getOperatingName()
        {
            return $this->operating_name;
        }

        /**
         * Set operating_kana.
         *
         * @param string|null $operating_kana
         *
         * @return ChainStore
         */
        public function setOperatingKana($operating_kana = null)
        {
            $this->operating_kana = $operating_kana;

            return $this;
        }

        /**
         * Get operating_kana.
         *
         * @return string|null
         */
        public function getOperatingKana()
        {
            return $this->operating_kana;
        }

        /**
         * Set chainStoreProvideType.
         *
         * @param \Customize\Entity\Master\ChainStoreProvideType $chainStoreProvideType
         *
         * @return SubChainStore
         */
        public function setChainStoreProvideType(\Customize\Entity\Master\ChainStoreProvideType $chainStoreProvideType = null)
        {
            $this->ChainStoreProvideType = $chainStoreProvideType;

            return $this;
        }

        /**
         * Get chainStoreProvideType.
         *
         * @return \Customize\Entity\Master\ChainStoreProvideType
         */
        public function getChainStoreProvideType()
        {
            return $this->ChainStoreProvideType;
        }

        /**
         * Set chainStoreProvideStyleType.
         *
         * @param \Customize\Entity\Master\ChainStoreProvideStyleType $chainStoreProvideStyleType
         *
         * @return SubChainStore
         */
        public function setChainStoreProvideStyleType(\Customize\Entity\Master\ChainStoreProvideStyleType $chainStoreProvideStyleType = null)
        {
            $this->ChainStoreProvideStyleType = $chainStoreProvideStyleType;

            return $this;
        }

        /**
         * Get chainStoreProvideStyleType.
         *
         * @return \Customize\Entity\Master\ChainStoreProvideStyleType
         */
        public function getChainStoreProvideStyleType()
        {
            return $this->ChainStoreProvideStyleType;
        }

        /**
         * Set chainstore_email.
         *
         * @param string|null $chainstore_email
         *
         * @return SubChainStore
         */
        public function setChainstoreEmail($chainstore_email = null)
        {
            $this->chainstore_email = $chainstore_email;

            return $this;
        }

        /**
         * Get chainstore_email.
         *
         * @return string|null
         */
        public function getChainstoreEmail()
        {
            return $this->chainstore_email;
        }
        

        /**
         * Set option_webshop.
         *
         * @param string|null $option_webshop
         *
         * @return SubChainStore
         */
        public function setOptionWebshop($option_webshop = null)
        {
            $this->option_webshop = $option_webshop;

            return $this;
        }

        /**
         * Get option_webshop.
         *
         * @return string|null
         */
        public function getOptionWebshop()
        {
            return $this->option_webshop;
        }


        /**
         * Set webshop_name.
         *
         * @param string|null $webshop_name
         *
         * @return SubChainStore
         */
        public function setWebshopName($webshop_name = null)
        {
            $this->webshop_name = $webshop_name;

            return $this;
        }

        /**
         * Get webshop_name.
         *
         * @return string|null
         */
        public function getWebshopName()
        {
            return $this->webshop_name;
        }

        /**
         * Set webshop_url.
         *
         * @param string|null $webshop_url
         *
         * @return SubChainStore
         */
        public function setWebshopUrl($webshop_url = null)
        {
            $this->webshop_url = $webshop_url;

            return $this;
        }

        /**
         * Get webshop_url.
         *
         * @return string|null
         */
        public function getWebshopUrl()
        {
            return $this->webshop_url;
        }

        /**
         * Set chainStoreWebShopOpeningType.
         *
         * @param string|null $chainStoreWebShopOpeningType
         *
         * @return SubChainStore
         */
        public function setChainStoreWebShopOpeningType($chainStoreWebShopOpeningType = null)
        {
            $this->chainStoreWebShopOpeningType = $chainStoreWebShopOpeningType;

            return $this;
        }

        /**
         * Get chainStoreWebShopOpeningType.
         *
         * @return string|null
         */
        public function getChainStoreWebShopOpeningType()
        {
            return $this->chainStoreWebShopOpeningType;
        }
        
        /**
         * Set chainstore_webshop_opening_other_type.
         *
         * @param string|null $chainstore_webshop_opening_other_type
         *
         * @return SubChainStore
         */
        public function setChainstoreWebshopOpeningOtherType($chainstore_webshop_opening_other_type = null)
        {
            $this->chainstore_webshop_opening_other_type = $chainstore_webshop_opening_other_type;

            return $this;
        }

        /**
         * Get chainstore_webshop_opening_other_type.
         *
         * @return string|null
         */
        public function getChainstoreWebshopOpeningOtherType()
        {
            return $this->chainstore_webshop_opening_other_type;
        }
        
        /**
         * Set chainStoreWebShopOwnerType.
         *
         * @param string|null $chainStoreWebShopOwnerType
         *
         * @return SubChainStore
         */
        public function setChainStoreWebShopOwnerType($chainStoreWebShopOwnerType = null)
        {
            $this->chainStoreWebShopOwnerType = $chainStoreWebShopOwnerType;

            return $this;
        }

        /**
         * Get chainStoreWebShopOwnerType.
         *
         * @return string|null
         */
        public function getChainStoreWebShopOwnerType()
        {
            return $this->chainStoreWebShopOwnerType;
        }
        
        /**
         * Set webshop_main_operation_name.
         *
         * @param string|null $webshop_main_operation_name
         *
         * @return SubChainStore
         */
        public function setWebshopMainOperationName($webshop_main_operation_name = null)
        {
            $this->webshop_main_operation_name = $webshop_main_operation_name;

            return $this;
        }

        /**
         * Get webshop_main_operation_name.
         *
         * @return string|null
         */
        public function getWebshopMainOperationName()
        {
            return $this->webshop_main_operation_name;
        }
        
        /**
         * Set chainStoreWebShopPhoneType.
         *
         * @param string|null $chainStoreWebShopPhoneType
         *
         * @return SubChainStore
         */
        public function setChainStoreWebShopPhoneType($chainStoreWebShopPhoneType = null)
        {
            $this->chainStoreWebShopPhoneType = $chainStoreWebShopPhoneType;

            return $this;
        }

        /**
         * Get chainStoreWebShopPhoneType.
         *
         * @return string|null
         */
        public function getChainStoreWebShopPhoneType()
        {
            return $this->chainStoreWebShopPhoneType;
        }

        /**
         * Set chainstore_webshop_phone_other_type.
         *
         * @param string|null $chainstore_webshop_phone_other_type
         *
         * @return SubChainStore
         */
        public function setChainstoreWebshopPhoneOtherType($chainstore_webshop_phone_other_type = null)
        {
            $this->chainstore_webshop_phone_other_type = $chainstore_webshop_phone_other_type;

            return $this;
        }

        /**
         * Get chainstore_webshop_phone_other_type.
         *
         * @return string|null
         */
        public function getChainstoreWebshopPhoneOtherType()
        {
            return $this->chainstore_webshop_phone_other_type;
        }
        

        /**
         * Set chainStoreWebShopEmailType.
         *
         * @param string|null $chainStoreWebShopEmailType
         *
         * @return SubChainStore
         */
        public function setChainStoreWebShopEmailType($chainStoreWebShopEmailType = null)
        {
            $this->chainStoreWebShopEmailType = $chainStoreWebShopEmailType;

            return $this;
        }

        /**
         * Get chainStoreWebShopEmailType.
         *
         * @return string|null
         */
        public function getChainStoreWebShopEmailType()
        {
            return $this->chainStoreWebShopEmailType;
        }

        
        /**
         * Set chainstore_webshop_mail_other_type.
         *
         * @param string|null $chainstore_webshop_mail_other_type
         *
         * @return SubChainStore
         */
        public function setChainstoreWebshopMailOtherType($chainstore_webshop_mail_other_type = null)
        {
            $this->chainstore_webshop_mail_other_type = $chainstore_webshop_mail_other_type;

            return $this;
        }

        /**
         * Get chainstore_webshop_mail_other_type.
         *
         * @return string|null
         */
        public function getChainstoreWebshopMailOtherType()
        {
            return $this->chainstore_webshop_mail_other_type;
        }

}
