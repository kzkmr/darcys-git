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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

if (!class_exists('\Customize\Entity\PreChainStore')) {
    /**
     * PreChainStore
     *
     * @ORM\Table(name="dtb_pre_chain_store")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\Entity(repositoryClass="Customize\Repository\PreChainStoreRepository")
     */
    class PreChainStore extends \Eccube\Entity\AbstractEntity
    {
        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var \Customize\Entity\Master\ContractType 契約区分
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ContractType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="contract_type_id", referencedColumnName="id", nullable=false)
         * })
         */
        private $ContractType;

        
        /**
         * @var string|null
         *
         * @ORM\Column(name="stock_number", type="string", length=20, nullable=false, options={"comment":"03.契約番号(証券番号)"})
         */
        private $stock_number;

        /**
         * @var \DateTime 
         *
         * @ORM\Column(name="time_stamp", type="date", nullable=true, options={"comment":"01.タイムスタンプ"})
         */
        private $time_stamp;


        /**
         * @var string 
         *
         * @ORM\Column(name="applicant_contract_type_name", type="string", length=255, nullable=false, options={"comment":"05.申込者の契約区分"})
         */
        private $applicant_contract_type_name;

        /**
         * @var string 
         *
         * @ORM\Column(name="corporate_number", type="string", length=20, nullable=true, options={"comment":"07.法人番号"})
         */
        private $corporateNumber;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="company_name", type="string", length=255, nullable=true, options={"comment":"09.法人名・屋号"})
         */
        private $company_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="company_name_kana", type="string", length=255, nullable=true, options={"comment":"11.法人名・屋号（フリガナ）"})
         */
        private $company_name_kana;

        /**
         * @var \DateTime 
         *
         * @ORM\Column(name="begin_day", type="date", nullable=true, options={"comment":"13.設立日（開業日）"})
         */
        private $begin_day;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="postal_code", type="string", length=8, nullable=true, options={"comment":"15.所在地：郵便番号"})
         */
        private $postal_code;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="addr01", type="string", length=255, nullable=true, options={"comment":"17.所在地・住所（都道府県）"})
         */
        private $addr01;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="addr02", type="string", length=255, nullable=true, options={"comment":"19.所在地・住所（市町村名）"})
         */
        private $addr02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="addr03", type="string", length=255, nullable=true, options={"comment":"21.所在地・住所（番地・ビル名）"})
         */
        private $addr03;

        /**
         * @var string|null
         *
         * @ORM\Column(name="addr01_ka", type="string", length=255, nullable=true, options={"comment":"23.所在地・住所(フリガナ)"})
         */
        private $addr01_ka;


        /**
         * @var string 
         *
         * @ORM\Column(name="name01", type="string", length=255, nullable=true, options={"comment":"25.代表者名・氏名「姓」"})
         */
        private $name01;

        /**
         * @var string
         *
         * @ORM\Column(name="name02", type="string", length=255, nullable=true, options={"comment":"27.代表者名・氏名「名」"})
         */
        private $name02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="kana01", type="string", length=255, nullable=true, options={"comment":"29.代表者名・氏名「姓」（フリガナ）"})
         */
        private $kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="kana02", type="string", length=255, nullable=true, options={"comment":"31.代表者名・氏名「名」（フリガナ）"})
         */
        private $kana02;

        /**
         * @var \DateTime 
         *
         * @ORM\Column(name="birthday", type="date", nullable=true, options={"comment":"33.生年月日(設立日ではなく生年月日をログイン用に使う)"})
         */
        private $birthday;

        /**
         * @var string|null
         *
         * @ORM\Column(name="email", type="string", length=255, nullable=true, options={"comment":"35.連絡用メールアドレス"})
         */
        private $email;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="telephone_no", type="string", length=30, nullable=true, options={"comment":"39.固定電話"})
         */
        private $telephone_no;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="cellphone_no", type="string", length=30, nullable=true, options={"comment":"41.携帯電話"})
         */
        private $cellphone_no;
        
        /**
         * @var string|null
         *
         * @ORM\Column(name="mediator_company_name", type="string", length=255, nullable=true, options={"comment":"43.法人名・屋号（仲介者）"})
         */
        private $mediator_company_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="mediator_company_name_kana", type="string", length=255, nullable=true, options={"comment":"45.仲介者 法人名・屋号（フリガナ）"})
         */
        private $mediator_company_name_kana;


        /**
         * @var string
         *
         * @ORM\Column(name="mediator_name01", type="string", length=255, nullable=true, options={"comment":"47.代表者氏名「姓」（仲介者）"})
         */
        private $mediator_name01;

        /**
         * @var string
         *
         * @ORM\Column(name="mediator_name02", type="string", length=255, nullable=true, options={"comment":"49.代表者氏名「名」（仲介者）"})
         */
        private $mediator_name02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="mediator_kana01", type="string", length=255, nullable=true, options={"comment":"51.代表者氏名「姓」（フリガナ）（仲介者）"})
         */
        private $mediator_kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="mediator_kana02", type="string", length=255, nullable=true, options={"comment":"53.代表者氏名「名」（フリガナ）（仲介者）"})
         */
        private $mediator_kana02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="dealer_code", type="string", length=20, nullable=true, options={"comment":"55.ディーラーコード"})
         */
        private $dealer_code;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="mediator_phone_number", type="string", length=30, nullable=true, options={"comment":"57.電話番号（仲介者）"})
         */
        private $mediator_phone_number;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="is_postbank_list", type="string", length=30, nullable=true, options={"comment":"59.取引口座選択(ゆうちょ銀行以外の銀行・ゆうちょ銀行)"})
         */
        private $is_postbank_list;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="bank_id", type="string", length=30, nullable=true, options={"comment":"61.金融機関コード"})
         */
        private $bank_id;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="bank_name", type="string", length=255, nullable=true, options={"comment":"63.金融機関名"})
         */
        private $bank_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="bank_branch_id", type="string", length=30, nullable=true, options={"comment":"65.支店コード"})
         */
        private $bank_branch_id;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="bank_branch_name", type="string", length=255, nullable=true, options={"comment":"67.支店名"})
         */
        private $bank_branch_name;
        
        /**
         * @var string|null 
         *
         * @ORM\Column(name="bank_account_type_name", type="string", length=255, nullable=true, options={"comment":"69.預金種目"})
         */
        private $bank_account_type_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="bank_account", type="string", length=30, nullable=true, options={"comment":"71.口座番号"})
         */
        private $bank_account;

        /**
         * @var string|null
         *
         * @ORM\Column(name="bank_holder01", type="string", length=100, nullable=true, options={"comment":"73.口座名義「姓」"})
         */
        private $bank_holder01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="bank_holder02", type="string", length=100, nullable=true, options={"comment":"75.口座名義「名」"})
         */
        private $bank_holder02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="bank_holder_kana01", type="string", length=200, nullable=true, options={"comment":"77.口座名義「姓」（フリガナ）"})
         */
        private $bank_holder_kana01;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="bank_holder_kana02", type="string", length=200, nullable=true, options={"comment":"79.口座名義「名」（フリガナ）"})
         */
        private $bank_holder_kana02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="post_code_number", type="string", length=10, nullable=true, options={"comment":"81.通帳記号（下5桁）（ゆうちょ）"})
         */
        private $post_code_number;

        /**
         * @var string|null
         *
         * @ORM\Column(name="post_passbook_number", type="string", length=20, nullable=true, options={"comment":"83.通帳番号（8桁）（ゆうちょ）"})
         */
        private $post_passbook_number;


        /**
         * @var string|null
         *
         * @ORM\Column(name="post_bank_holder01", type="string", length=100, nullable=true, options={"comment":"85.口座名義「姓」（ゆうちょ）"})
         */
        private $post_bank_holder01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="post_bank_holder02", type="string", length=100, nullable=true, options={"comment":"87.口座名義「名」（ゆうちょ）"})
         */
        private $post_bank_holder02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="post_bank_holder_kana01", type="string", length=200, nullable=true, options={"comment":"89.口座名義「姓」（フリガナ）（ゆうちょ）"})
         */
        private $post_bank_holder_kana01;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="post_bank_holder_kana02", type="string", length=200, nullable=true, options={"comment":"91.口座名義「名」（フリガナ）（ゆうちょ）"})
         */
        private $post_bank_holder_kana02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="related_chainstore_type_name", type="string", length=255, nullable=true, options={"comment":"93.販売店舗の関連性"})
         */
        private $related_chainstore_type_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_business_type_name", type="string", length=255, nullable=true, options={"comment":"95.販売店の業務形態"})
         */
        private $chainstore_business_type_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_name", type="string", length=255, nullable=true, options={"comment":"97.販売店舗名"})
         */
        private $chainstore_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_name_kana", type="string", length=255, nullable=true, options={"comment":"99.販売店舗名（フリガナ）"})
         */
        private $chainstore_name_kana;

        /**
         * @var string 
         *
         * @ORM\Column(name="operating_name", type="string", length=255, nullable=true, options={"comment":"101.運営会社・運営者"})
         */
        private $operating_name;

        /**
         * @var string
         *
         * @ORM\Column(name="operating_name_kana", type="string", length=255, nullable=true, options={"comment":"103.運営会社・運営者（フリガナ）"})
         */
        private $operating_name_kana;

        /**
         * @var string 
         *
         * @ORM\Column(name="chainstore_provide_type_name", type="string", length=255, nullable=true, options={"comment":"105.アイスの提供方法（予定）"})
         */
        private $chainstore_provide_type_name;

        /**
         * @var string 
         *
         * @ORM\Column(name="chainstore_provide_style_type_name", type="string", length=255, nullable=true, options={"comment":"107.アイスの提供スタイル（予定）"})
         */
        private $chainstore_provide_style_type_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_postal_code", type="string", length=8, nullable=true, options={"comment":"109.販売店舗所在地：（郵便番号）"})
         */
        private $chainstore_postal_code;

        /**
         * @var string|null
         *
         * @ORM\Column(name="chainstore_addr01", type="string", length=255, nullable=true, options={"comment":"111.販売店舗所在地：（都道府県）"})
         */
        private $chainstore_addr01;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_addr02", type="string", length=255, nullable=true, options={"comment":"113.販売店舗所在地：（市町村名）"})
         */
        private $chainstore_addr02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_addr03", type="string", length=255, nullable=true, options={"comment":"115.販売店舗所在地：（番地・ビル名）"})
         */
        private $chainstore_addr03;

        /**
         * @var string  
         *
         * @ORM\Column(name="chainstore_owner", type="string", length=255, nullable=true, options={"comment":"117.販売店舗担当者名"})
         */
        private $chainstore_owner;

        /**
         * @var string  
         *
         * @ORM\Column(name="chainstore_telephone_no", type="string", length=30, nullable=true, options={"comment":"119.販売店舗連絡先（電話番号）"})
         */
        private $chainstore_telephone_no;

        /**
         * @var string  
         *
         * @ORM\Column(name="chainstore_email", type="string", length=255, nullable=true, options={"comment":"121.販売店舗メールアドレス"})
         */
        private $chainstore_email;

        /**
         * @var string  
         *
         * @ORM\Column(name="webshop_sale_ice_list", type="string", length=255, nullable=true, options={"comment":"125.WEBショップでダシーズの出品予定はありますか"})
         */
        private $webshop_sale_ice_list;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="webshop_name", type="string", length=255, nullable=true, options={"comment":"127.ＷＥＢショップ店舗名"})
         */
        private $webshop_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="webshop_url", type="string", length=255, nullable=true, options={"comment":"129.出店WEBショップURL"})
         */
        private $webshop_url;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_webshop_opening_type_name", type="string", length=255, nullable=true, options={"comment":"131.出店WEBショップの運営会社"})
         */
        private $chainstore_webshop_opening_type_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="chainstore_webshop_owner_type_name", type="string", length=255, nullable=true, options={"comment":"133.WEBショップ運営担当者"})
         */
        private $chainstore_webshop_owner_type_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="chainstore_webshop_owner_name", type="string", length=255, nullable=true, options={"comment":"135.上記WEBショップ運営担当者名"})
         */
        private $chainstore_webshop_owner_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="chainstore_webshop_phone_type_name", type="string", length=255, nullable=true, options={"comment":"137.運営担当者電話番号"})
         */
        private $chainstore_webshop_phone_type_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="chainstore_webshop_email_type_name", type="string", length=255, nullable=true, options={"comment":"139.運営担当者メールアドレス"})
         */
        private $chainstore_webshop_email_type_name;

        /**
         * @var string  
         *
         * @ORM\Column(name="option_partner", type="string", length=255, nullable=true, options={"comment":"141.パートナー指定"})
         */
        private $option_partner;

        /**
         * @var string|null
         *
         * @ORM\Column(name="partner_company_name", type="string", length=255, nullable=true, options={"comment":"143.パートナーの法人名・屋号"})
         */
        private $partner_company_name;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="partner_company_name_kana", type="string", length=255, nullable=true, options={"comment":"145.パートナーの法人名・屋号（フリガナ）"})
         */
        private $partner_company_name_kana;

        /**
         * @var string
         *
         * @ORM\Column(name="partner_name01", type="string", length=255, nullable=true, options={"comment":"147.パートナーの代表者名・氏名「姓」"})
         */
        private $partner_name01;

        /**
         * @var string
         *
         * @ORM\Column(name="partner_name02", type="string", length=255, nullable=true, options={"comment":"149.パートナーの代表者名・氏名「名」"})
         */
        private $partner_name02;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="partner_kana01", type="string", length=255, nullable=true, options={"comment":"151.パートナーの代表者名・氏名「姓」（フリガナ）"})
         */
        private $partner_kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="partner_kana02", type="string", length=255, nullable=true, options={"comment":"153.パートナーの代表者名・氏名「名」（フリガナ）"})
         */
        private $partner_kana02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="partner_phone_number", type="string", length=30, nullable=true, options={"comment":"155.パートナーの代表者名・氏名「名」（フリガナ）"})
         */
        private $partner_phone_number;

        /**
         * @var string|null
         *
         * @ORM\Column(name="note", type="string", length=4000, nullable=true)
         */
        private $note;

        /**
         * @var string|null
         *
         * @ORM\Column(name="sort_no", type="integer", options={"unsigned":true})
         */
        private $sort_no;

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->sort_no = 0;
        }

        /**
         * @return string
         */
        public function __toString()
        {
            return "";
        }

        /**
         * Get id.
         *
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set contractType.
         *
         * @param \Customize\Entity\Master\ContractType|null $contractType
         *
         * @return PreChainStore
         */
        public function setContractType(\Customize\Entity\Master\ContractType $contractType = null)
        {
            $this->ContractType = $contractType;

            return $this;
        }

        /**
         * Get contractType.
         *
         * @return \Customize\Entity\Master\ContractType|null
         */
        public function getContractType()
        {
            return $this->ContractType;
        }


        /**
         * Set time_stamp.
         *
         * @param \DateTime $time_stamp
         *
         * @return PreChainStore
         */
        public function setTimeStamp($time_stamp)
        {
            $this->time_stamp = $time_stamp;

            return $this;
        }

        /**
         * Get time_stamp.
         *
         * @return \DateTime
         */
        public function getTimeStamp()
        {
            return $this->time_stamp;
        }

        /**
         * Set stock Number.
         *
         * @param string|null $stockNumber
         *
         * @return PreChainStore
         */
        public function setStockNumber($stockNumber = null)
        {
            $this->stock_number = $stockNumber;

            return $this;
        }

        /**
         * Get stock Number.
         *
         * @return string|null
         */
        public function getStockNumber()
        {
            return $this->stock_number;
        }

        /**
         * Set applicantContractType.
         *
         * @param string|null $applicantContractType
         *
         * @return PreChainStore
         */
        public function setApplicantContractTypeName($applicantContractType = null)
        {
            $this->applicant_contract_type_name = $applicantContractType;

            return $this;
        }

        /**
         * Get applicantContractType.
         *
         * @return string|null
         */
        public function getApplicantContractTypeName()
        {
            return $this->applicant_contract_type_name;
        }


        /**
         * Set corporateNumber.
         *
         * @param string $corporateNumber
         *
         * @return PreChainStore
         */
        public function setCorporateNumber($corporateNumber)
        {
            $this->corporateNumber = $corporateNumber;

            return $this;
        }

        /**
         * Get corporateNumber.
         *
         * @return string
         */
        public function getCorporateNumber()
        {
            return $this->corporateNumber;
        }


        /**
         * Set companyName.
         *
         * @param string|null $companyName
         *
         * @return PreChainStore
         */
        public function setCompanyName($companyName = null)
        {
            $this->company_name = $companyName;

            return $this;
        }

        /**
         * Get companyName.
         *
         * @return string|null
         */
        public function getCompanyName()
        {
            return $this->company_name;
        }

        /**
         * Set companyNameKana.
         *
         * @param string|null $companyNameKana
         *
         * @return PreChainStore
         */
        public function setCompanyNameKana($companyNameKana = null)
        {
            $this->company_name_kana = $companyNameKana;

            return $this;
        }

        /**
         * Get companyNameKana.
         *
         * @return string|null
         */
        public function getCompanyNameKana()
        {
            return $this->company_name_kana;
        }

        /**
         * Set beginDay.
         *
         * @param \DateTime $beginDay
         *
         * @return PreChainStore
         */
        public function setBeginDay($beginDay)
        {
            $this->begin_day = $beginDay;

            return $this;
        }

        /**
         * Get beginDay.
         *
         * @return \DateTime
         */
        public function getBeginDay()
        {
            return $this->begin_day;
        }


        /**
         * Set postal_code.
         *
         * @param string|null $postal_code
         *
         * @return PreChainStore
         */
        public function setPostalCode($postal_code = null)
        {
            $this->postal_code = $postal_code;

            return $this;
        }

        /**
         * Get postal_code.
         *
         * @return string|null
         */
        public function getPostalCode()
        {
            return $this->postal_code;
        }

        /**
         * Set addr01.
         *
         * @param string|null $addr01
         *
         * @return PreChainStore
         */
        public function setAddr01($addr01 = null)
        {
            $this->addr01 = $addr01;

            return $this;
        }

        /**
         * Get addr01.
         *
         * @return string|null
         */
        public function getAddr01()
        {
            return $this->addr01;
        }

        /**
         * Set addr02.
         *
         * @param string|null $addr02
         *
         * @return PreChainStore
         */
        public function setAddr02($addr02 = null)
        {
            $this->addr02 = $addr02;

            return $this;
        }

        /**
         * Get addr02.
         *
         * @return string|null
         */
        public function getAddr02()
        {
            return $this->addr02;
        }

        /**
         * Set addr03.
         *
         * @param string|null $addr03
         *
         * @return PreChainStore
         */
        public function setAddr03($addr03 = null)
        {
            $this->addr03 = $addr03;

            return $this;
        }

        /**
         * Get addr03.
         *
         * @return string|null
         */
        public function getAddr03()
        {
            return $this->addr03;
        }

        /**
         * Set addr01_ka.
         *
         * @param string|null $addr01_ka
         *
         * @return PreChainStore
         */
        public function setAddr01Ka($addr01_ka = null)
        {
            $this->addr01_ka = $addr01_ka;

            return $this;
        }

        /**
         * Get addr01_ka.
         *
         * @return string|null
         */
        public function getAddr01Ka()
        {
            return $this->addr01_ka;
        }

        /**
         * Set name01.
         *
         * @param string $name01
         *
         * @return PreChainStore
         */
        public function setName01($name01)
        {
            $this->name01 = $name01;

            return $this;
        }

        /**
         * Get name01.
         *
         * @return string
         */
        public function getName01()
        {
            return $this->name01;
        }

        /**
         * Set name02.
         *
         * @param string $name02
         *
         * @return PreChainStore
         */
        public function setName02($name02)
        {
            $this->name02 = $name02;

            return $this;
        }

        /**
         * Get name02.
         *
         * @return string
         */
        public function getName02()
        {
            return $this->name02;
        }

        /**
         * Set kana01.
         *
         * @param string|null $kana01
         *
         * @return PreChainStore
         */
        public function setKana01($kana01 = null)
        {
            $this->kana01 = $kana01;

            return $this;
        }

        /**
         * Get kana01.
         *
         * @return string|null
         */
        public function getKana01()
        {
            return $this->kana01;
        }

        /**
         * Set kana02.
         *
         * @param string|null $kana02
         *
         * @return PreChainStore
         */
        public function setKana02($kana02 = null)
        {
            $this->kana02 = $kana02;

            return $this;
        }

        /**
         * Get kana02.
         *
         * @return string|null
         */
        public function getKana02()
        {
            return $this->kana02;
        }

        /**
         * Set birthday.
         *
         * @param \DateTime $birthday
         *
         * @return PreChainStore
         */
        public function setBirthday($birthday)
        {
            $this->birthday = $birthday;

            return $this;
        }

        /**
         * Get birthday.
         *
         * @return \DateTime
         */
        public function getBirthday()
        {
            return $this->birthday;
        }


        /**
         * Set email.
         *
         * @param string|null $email
         *
         * @return PreChainStore
         */
        public function setEmail($email = null)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get email.
         *
         * @return string|null
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set telephone_no.
         *
         * @param string|null $telephone_no
         *
         * @return PreChainStore
         */
        public function setTelephoneNo($telephone_no = null)
        {
            $this->telephone_no = $telephone_no;

            return $this;
        }

        /**
         * Get telephone_no.
         *
         * @return string|null
         */
        public function getTelephoneNo()
        {
            return $this->telephone_no;
        }

        /**
         * Set cellphone_no.
         *
         * @param string|null $cellphone_no
         *
         * @return PreChainStore
         */
        public function setCellphoneNo($cellphone_no = null)
        {
            $this->cellphone_no = $cellphone_no;

            return $this;
        }

        /**
         * Get cellphone_no.
         *
         * @return string|null
         */
        public function getCellphoneNo()
        {
            return $this->cellphone_no;
        }
        
        /**
         * Set mediator_company_name.
         *
         * @param string|null $mediator_company_name
         *
         * @return PreChainStore
         */
        public function setMediatorCompanyName($mediator_company_name = null)
        {
            $this->mediator_company_name = $mediator_company_name;

            return $this;
        }

        /**
         * Get mediator_company_name.
         *
         * @return string|null
         */
        public function getMediatorCompanyName()
        {
            return $this->mediator_company_name;
        }
        
        /**
         * Set mediator_company_name_kana.
         *
         * @param string|null $mediator_company_name_kana
         *
         * @return PreChainStore
         */
        public function setMediatorCompanyNameKana($mediator_company_name_kana = null)
        {
            $this->mediator_company_name_kana = $mediator_company_name_kana;

            return $this;
        }

        /**
         * Get mediator_company_name_kana.
         *
         * @return string|null
         */
        public function getMediatorCompanyNameKana()
        {
            return $this->mediator_company_name_kana;
        }
        
        /**
         * Set mediator_name01.
         *
         * @param string|null $mediator_name01
         *
         * @return PreChainStore
         */
        public function setMediatorName01($mediator_name01 = null)
        {
            $this->mediator_name01 = $mediator_name01;

            return $this;
        }

        /**
         * Get mediator_name01.
         *
         * @return string|null
         */
        public function getMediatorName01()
        {
            return $this->mediator_name01;
        }
        
        /**
         * Set mediator_name02.
         *
         * @param string|null $mediator_name02
         *
         * @return PreChainStore
         */
        public function setMediatorName02($mediator_name02 = null)
        {
            $this->mediator_name02 = $mediator_name02;

            return $this;
        }

        /**
         * Get mediator_name02.
         *
         * @return string|null
         */
        public function getMediatorName02()
        {
            return $this->mediator_name02;
        }
        
        /**
         * Set mediator_kana01.
         *
         * @param string|null $mediator_kana01
         *
         * @return PreChainStore
         */
        public function setMediatorKana01($mediator_kana01 = null)
        {
            $this->mediator_kana01 = $mediator_kana01;

            return $this;
        }

        /**
         * Get mediator_kana01.
         *
         * @return string|null
         */
        public function getMediatorKana01()
        {
            return $this->mediator_kana01;
        }
        
        /**
         * Set mediator_kana02.
         *
         * @param string|null $mediator_kana02
         *
         * @return PreChainStore
         */
        public function setMediatorKana02($mediator_kana02 = null)
        {
            $this->mediator_kana02 = $mediator_kana02;

            return $this;
        }

        /**
         * Get mediator_kana02.
         *
         * @return string|null
         */
        public function getMediatorKana02()
        {
            return $this->mediator_kana02;
        }
        

        /**
         * Set dealer code
         *
         * @param string $dealerCode
         *
         * @return PreChainStore
         */
        public function setDealerCode($dealerCode)
        {
            $this->dealer_code = $dealerCode;

            return $this;
        }

        /**
         * Get dealer code
         *
         * @return string
         */
        public function getDealerCode()
        {
            return $this->dealer_code;
        }

        /**
         * Set mediatorPhoneNumber
         *
         * @param string $mediatorPhoneNumber
         *
         * @return PreChainStore
         */
        public function setMediatorPhoneNumber($mediatorPhoneNumber)
        {
            $this->mediator_phone_number = $mediatorPhoneNumber;

            return $this;
        }

        /**
         * Get mediatorPhoneNumber
         *
         * @return string
         */
        public function getMediatorPhoneNumber()
        {
            return $this->mediator_phone_number;
        }

        /**
         * Set is_postbank_list
         *
         * @param string $is_postbank_list
         *
         * @return PreChainStore
         */
        public function setIsPostbankList($is_postbank_list)
        {
            $this->is_postbank_list = $is_postbank_list;

            return $this;
        }

        /**
         * Get is_postbank_list
         *
         * @return string
         */
        public function getIsPostbankList()
        {
            return $this->is_postbank_list;
        }
        

        /**
         * Set bank_id.
         *
         * @param string $bank_id
         *
         * @return PreChainStore
         */
        public function setBankId(string $bank_id)
        {
            $this->bank_id = $bank_id;

            return $this;
        }

        /**
         * Get bank_id.
         *
         * @return string
         */
        public function getBankId()
        {
            return $this->bank_id;
        }

        /**
         * Set bank_name.
         *
         * @param string $bank_name
         *
         * @return PreChainStore
         */
        public function setBankName(string $bank_name)
        {
            $this->bank_name = $bank_name;

            return $this;
        }

        /**
         * Get bank_name.
         *
         * @return string
         */
        public function getBankName()
        {
            return $this->bank_name;
        }

        /**
         * Set bank_branch_id.
         *
         * @param string $bank_branch_id
         *
         * @return PreChainStore
         */
        public function setBankBranchId($bank_branch_id)
        {
            $this->bank_branch_id = $bank_branch_id;

            return $this;
        }

        /**
         * Get bank_branch_id.
         *
         * @return string
         */
        public function getBankBranchId()
        {
            return $this->bank_branch_id;
        }

        /**
         * Set bank_branch_name.
         *
         * @param string $bank_branch_name
         *
         * @return PreChainStore
         */
        public function setBankBranchName($bank_branch_name)
        {
            $this->bank_branch_name = $bank_branch_name;

            return $this;
        }

        /**
         * Get bank_branch_name.
         *
         * @return string
         */
        public function getBankBranchName()
        {
            return $this->bank_branch_name;
        }

        /**
         * Set bank_account_type_name.
         *
         * @param string $bank_account_type_name
         *
         * @return PreChainStore
         */
        public function setBankAccountTypeName(string $bank_account_type_name)
        {
            $this->bank_account_type_name = $bank_account_type_name;

            return $this;
        }

        /**
         * Get bank_account_type_name.
         *
         * @return string
         */
        public function getBankAccountTypeName()
        {
            return $this->bank_account_type_name;
        }

        /**
         * Set BankAccount.
         *
         * @param string $bank_account
         *
         * @return PreChainStore
         */
        public function setBankAccount($bank_account)
        {
            $this->bank_account = $bank_account;

            return $this;
        }

        /**
         * Get BankAccount.
         *
         * @return string|null
         */
        public function getBankAccount()
        {
            return $this->bank_account;
        }
        
        /**
         * Set bank_holder01.
         *
         * @param string $bank_holder01
         *
         * @return PreChainStore
         */
        public function setBankHolder01($bank_holder01)
        {
            $this->bank_holder01 = $bank_holder01;

            return $this;
        }

        /**
         * Get bank_holder01.
         *
         * @return string|null
         */
        public function getBankHolder01()
        {
            return $this->bank_holder01;
        }

        /**
         * Set bank_holder02.
         *
         * @param string $bank_holder02
         *
         * @return PreChainStore
         */
        public function setBankHolder02($bank_holder02)
        {
            $this->bank_holder02 = $bank_holder02;

            return $this;
        }

        /**
         * Get bank_holder02.
         *
         * @return string|null
         */
        public function getBankHolder02()
        {
            return $this->bank_holder02;
        }

        /**
         * Set bank_holder_kana01.
         *
         * @param string $bank_holder_kana01
         *
         * @return PreChainStore
         */
        public function setBankHolderKana01($bank_holder_kana01)
        {
            $this->bank_holder_kana01 = $bank_holder_kana01;

            return $this;
        }

        /**
         * Get bank_holder_kana01.
         *
         * @return string|null
         */
        public function getBankHolderKana01()
        {
            return $this->bank_holder_kana01;
        }

        /**
         * Set bank_holder_kana02.
         *
         * @param string $bank_holder_kana02
         *
         * @return PreChainStore
         */
        public function setBankHolderKana02($bank_holder_kana02)
        {
            $this->bank_holder_kana02 = $bank_holder_kana02;

            return $this;
        }

        /**
         * Get bank_holder_kana02.
         *
         * @return string|null
         */
        public function getBankHolderKana02()
        {
            return $this->bank_holder_kana02;
        }

        /**
         * Set post_code_number.
         *
         * @param string $post_code_number
         *
         * @return PreChainStore
         */
        public function setPostCodeNumber($post_code_number)
        {
            $this->post_code_number = $post_code_number;

            return $this;
        }

        /**
         * Get post_code_number.
         *
         * @return string|null
         */
        public function getPostCodeNumber()
        {
            return $this->post_code_number;
        }

        /**
         * Set post_passbook_number.
         *
         * @param string $post_passbook_number
         *
         * @return PreChainStore
         */
        public function setPostPassbookNumber($post_passbook_number)
        {
            $this->post_passbook_number = $post_passbook_number;

            return $this;
        }

        /**
         * Get post_passbook_number.
         *
         * @return string|null
         */
        public function getPostPassbookNumber()
        {
            return $this->post_passbook_number;
        }

        /**
         * Set post_bank_holder01.
         *
         * @param string $post_bank_holder01
         *
         * @return PreChainStore
         */
        public function setPostBankHolder01($post_bank_holder01)
        {
            $this->post_bank_holder01 = $post_bank_holder01;

            return $this;
        }

        /**
         * Get post_bank_holder01.
         *
         * @return string|null
         */
        public function getPostBankHolder01()
        {
            return $this->post_bank_holder01;
        }

        /**
         * Set post_bank_holder02.
         *
         * @param string $post_bank_holder02
         *
         * @return PreChainStore
         */
        public function setPostBankHolder02($post_bank_holder02)
        {
            $this->post_bank_holder02 = $post_bank_holder02;

            return $this;
        }

        /**
         * Get post_bank_holder02.
         *
         * @return string|null
         */
        public function getPostBankHolder02()
        {
            return $this->post_bank_holder02;
        }

        /**
         * Set post_bank_holder_kana01.
         *
         * @param string $post_bank_holder_kana01
         *
         * @return PreChainStore
         */
        public function setPostBankHolderKana01($post_bank_holder_kana01)
        {
            $this->post_bank_holder_kana01 = $post_bank_holder_kana01;

            return $this;
        }

        /**
         * Get post_bank_holder_kana01.
         *
         * @return string|null
         */
        public function getPostBankHolderKana01()
        {
            return $this->post_bank_holder_kana01;
        }

        /**
         * Set post_bank_holder_kana02.
         *
         * @param string $post_bank_holder_kana02
         *
         * @return PreChainStore
         */
        public function setPostBankHolderKana02($post_bank_holder_kana02)
        {
            $this->post_bank_holder_kana02 = $post_bank_holder_kana02;

            return $this;
        }

        /**
         * Get post_bank_holder_kana02.
         *
         * @return string|null
         */
        public function getPostBankHolderKana02()
        {
            return $this->post_bank_holder_kana02;
        }
        

        /**
         * Set related_chainstore_type_name.
         *
         * @param string $relatedChainStoreType
         *
         * @return PreChainStore
         */
        public function setRelatedChainStoreTypeName($relatedChainStoreType)
        {
            $this->related_chainstore_type_name = $relatedChainStoreType;

            return $this;
        }

        /**
         * Get related_chainstore_type_name.
         *
         * @return string
         */
        public function getRelatedChainStoreTypeName()
        {
            return $this->related_chainstore_type_name;
        }


        /**
         * Set chainstore_business_type_name.
         *
         * @param string $chainStoreBusinessType
         *
         * @return PreChainStore
         */
        public function setChainStoreBusinessTypeName($chainStoreBusinessType = null)
        {
            $this->chainstore_business_type_name = $chainStoreBusinessType;

            return $this;
        }

        /**
         * Get chainstore_business_type_name.
         *
         * @return string
         */
        public function getChainStoreBusinessTypeName()
        {
            return $this->chainstore_business_type_name;
        }


        /**
         * Set chainstore_name.
         *
         * @param string|null $chainstore_name
         *
         * @return PreChainStore
         */
        public function setChainstoreName($chainstore_name = null)
        {
            $this->chainstore_name = $chainstore_name;

            return $this;
        }

        /**
         * Get chainstore_name.
         *
         * @return string|null
         */
        public function getChainstoreName()
        {
            return $this->chainstore_name;
        }

        /**
         * Set chainstore_name_kana.
         *
         * @param string|null $chainstore_name_kana
         *
         * @return PreChainStore
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
         * @param string|null $operating_name
         *
         * @return PreChainStore
         */
        public function setOperatingName($operating_name = null)
        {
            $this->operating_name = $operating_name;

            return $this;
        }

        /**
         * Get operating_name.
         *
         * @return string|null
         */
        public function getOperatingName()
        {
            return $this->operating_name;
        }
        
        /**
         * Set operating_name_kana.
         *
         * @param string|null $operating_name_kana
         *
         * @return PreChainStore
         */
        public function setOperatingNameKana($operating_name_kana = null)
        {
            $this->operating_name_kana = $operating_name_kana;

            return $this;
        }

        /**
         * Get operating_name_kana.
         *
         * @return string|null
         */
        public function getOperatingNameKana()
        {
            return $this->operating_name_kana;
        }
        

        /**
         * Set chainstore_provide_type_name.
         *
         * @param string $chainStoreProvideType
         *
         * @return PreChainStore
         */
        public function setChainStoreProvideTypeName(string $chainStoreProvideType = null)
        {
            $this->chainstore_provide_type_name = $chainStoreProvideType;

            return $this;
        }

        /**
         * Get chainstore_provide_type_name.
         *
         * @return string
         */
        public function getChainStoreProvideTypeName()
        {
            return $this->chainstore_provide_type_name;
        }

        /**
         * Set chainstore_provide_style_type_name.
         *
         * @param string $chainStoreProvideStyleType
         *
         * @return PreChainStore
         */
        public function setChainStoreProvideStyleTypeName(string $chainStoreProvideStyleType = null)
        {
            $this->chainstore_provide_style_type_name = $chainStoreProvideStyleType;

            return $this;
        }

        /**
         * Get chainstore_provide_style_type_name.
         *
         * @return string
         */
        public function getChainStoreProvideStyleTypeName()
        {
            return $this->chainstore_provide_style_type_name;
        }

        /**
         * Set chainstore_postal_code.
         *
         * @param string|null $chainstore_postal_code
         *
         * @return PreChainStore
         */
        public function setChainstorePostalCode($chainstore_postal_code = null)
        {
            $this->chainstore_postal_code = $chainstore_postal_code;

            return $this;
        }

        /**
         * Get chainstore_postal_code.
         *
         * @return string|null
         */
        public function getChainstorePostalCode()
        {
            return $this->chainstore_postal_code;
        }

        /**
         * Set chainstore_addr01.
         *
         * @param string|null $chainstore_addr01
         *
         * @return PreChainStore
         */
        public function setChainstoreAddr01($chainstore_addr01 = null)
        {
            $this->chainstore_addr01 = $chainstore_addr01;

            return $this;
        }

        /**
         * Get chainstore_addr01.
         *
         * @return string|null
         */
        public function getChainstoreAddr01()
        {
            return $this->chainstore_addr01;
        }

        /**
         * Set chainstore_addr02.
         *
         * @param string|null $chainstore_addr02
         *
         * @return PreChainStore
         */
        public function setChainstoreAddr02($chainstore_addr02 = null)
        {
            $this->chainstore_addr02 = $chainstore_addr02;

            return $this;
        }

        /**
         * Get chainstore_addr02.
         *
         * @return string|null
         */
        public function getChainstoreAddr02()
        {
            return $this->chainstore_addr02;
        }

        /**
         * Set chainstore_addr03.
         *
         * @param string|null $chainstore_addr03
         *
         * @return PreChainStore
         */
        public function setChainstoreAddr03($chainstore_addr03 = null)
        {
            $this->chainstore_addr03 = $chainstore_addr03;

            return $this;
        }

        /**
         * Get chainstore_addr03.
         *
         * @return string|null
         */
        public function getChainstoreAddr03()
        {
            return $this->chainstore_addr03;
        }

        /**
         * Set chainstore_owner.
         *
         * @param string|null $chainstore_owner
         *
         * @return PreChainStore
         */
        public function setChainstoreOwner($chainstore_owner = null)
        {
            $this->chainstore_owner = $chainstore_owner;

            return $this;
        }

        /**
         * Get chainstore_owner.
         *
         * @return string|null
         */
        public function getChainstoreOwner()
        {
            return $this->chainstore_owner;
        }

        /**
         * Set chainstore_telephone_no.
         *
         * @param string|null $chainstore_telephone_no
         *
         * @return PreChainStore
         */
        public function setChainstoreTelephoneNo($chainstore_telephone_no = null)
        {
            $this->chainstore_telephone_no = $chainstore_telephone_no;

            return $this;
        }

        /**
         * Get chainstore_telephone_no.
         *
         * @return string|null
         */
        public function getChainstoreTelephoneNo()
        {
            return $this->chainstore_telephone_no;
        }
        
        /**
         * Set chainstore_email.
         *
         * @param string|null $chainstore_email
         *
         * @return PreChainStore
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
         * Set webshop_sale_ice_list.
         *
         * @param string|null $webshop_sale_ice_list
         *
         * @return PreChainStore
         */
        public function setWebshopSaleIceList($webshop_sale_ice_list = null)
        {
            $this->webshop_sale_ice_list = $webshop_sale_ice_list;

            return $this;
        }

        /**
         * Get webshop_sale_ice_list.
         *
         * @return string|null
         */
        public function getWebshopSaleIceList()
        {
            return $this->webshop_sale_ice_list;
        }
        

        /**
         * Set webshop_name.
         *
         * @param string|null $webshop_name
         *
         * @return PreChainStore
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
         * @return PreChainStore
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
         * Set chainstore_webshop_opening_type_name.
         *
         * @param string $chainStoreWebShopOpeningType
         *
         * @return PreChainStore
         */
        public function setChainStoreWebShopOpeningTypeName(string $chainStoreWebShopOpeningType = null)
        {
            $this->chainstore_webshop_opening_type_name = $chainStoreWebShopOpeningType;

            return $this;
        }

        /**
         * Get chainstore_webshop_opening_type_name.
         *
         * @return string
         */
        public function getChainStoreWebShopOpeningTypeName()
        {
            return $this->chainstore_webshop_opening_type_name;
        }

        /**
         * Set chainstore_webshop_owner_type_name.
         *
         * @param string $chainStoreWebShopOwnerType
         *
         * @return PreChainStore
         */
        public function setChainStoreWebShopOwnerTypeName(string $chainStoreWebShopOwnerType = null)
        {
            $this->chainstore_webshop_owner_type_name = $chainStoreWebShopOwnerType;

            return $this;
        }

        /**
         * Get chainstore_webshop_owner_type_name
         *
         * @return string
         */
        public function getChainStoreWebShopOwnerTypeName()
        {
            return $this->chainstore_webshop_owner_type_name;
        }
        
        /**
         * Set chainstore_webshop_owner_name.
         *
         * @param string|null $chainstore_webshop_owner_name
         *
         * @return PreChainStore
         */
        public function setChainstoreWebshopOwnerName($chainstore_webshop_owner_name = null)
        {
            $this->chainstore_webshop_owner_name = $chainstore_webshop_owner_name;

            return $this;
        }

        /**
         * Get chainstore_webshop_owner_name.
         *
         * @return string|null
         */
        public function getChainstoreWebshopOwnerName()
        {
            return $this->chainstore_webshop_owner_name;
        }

        /**
         * Set chainstore_webshop_phone_type_name.
         *
         * @param string $chainStoreWebShopPhoneType
         *
         * @return PreChainStore
         */
        public function setChainStoreWebShopPhoneTypeName($chainStoreWebShopPhoneType = null)
        {
            $this->chainstore_webshop_phone_type_name = $chainStoreWebShopPhoneType;

            return $this;
        }

        /**
         * Get chainstore_webshop_phone_type_name.
         *
         * @return string
         */
        public function getChainStoreWebShopPhoneTypeName()
        {
            return $this->chainstore_webshop_phone_type_name;
        }
        
        /**
         * Set chainstore_webshop_email_type_name.
         *
         * @param string $chainStoreWebShopEmailType
         *
         * @return PreChainStore
         */
        public function setChainStoreWebShopEmailTypeName($chainStoreWebShopEmailType = null)
        {
            $this->chainstore_webshop_email_type_name = $chainStoreWebShopEmailType;

            return $this;
        }

        /**
         * Get chainstore_webshop_email_type_name.
         *
         * @return string
         */
        public function getChainStoreWebShopEmailTypeName()
        {
            return $this->chainstore_webshop_email_type_name;
        }
        
        /**
         * Set option_partner.
         *
         * @param string|null $option_partner
         *
         * @return PreChainStore
         */
        public function setOptionPartner($option_partner = null)
        {
            $this->option_partner = $option_partner;

            return $this;
        }

        /**
         * Get option_partner.
         *
         * @return string|null
         */
        public function getOptionPartner()
        {
            return $this->option_partner;
        }

        /**
         * Set partner_company_name.
         *
         * @param string|null $partner_company_name
         *
         * @return PreChainStore
         */
        public function setPartnerCompanyName($partner_company_name = null)
        {
            $this->partner_company_name = $partner_company_name;

            return $this;
        }

        /**
         * Get partner_company_name.
         *
         * @return string|null
         */
        public function getPartnerCompanyName()
        {
            return $this->partner_company_name;
        }

        /**
         * Set partner_company_name_kana.
         *
         * @param string|null $partner_company_name_kana
         *
         * @return PreChainStore
         */
        public function setPartnerCompanyNameKana($partner_company_name_kana = null)
        {
            $this->partner_company_name_kana = $partner_company_name_kana;

            return $this;
        }

        /**
         * Get partner_company_name_kana.
         *
         * @return string|null
         */
        public function getPartnerCompanyNameKana()
        {
            return $this->partner_company_name_kana;
        }

        /**
         * Set partner_name01.
         *
         * @param string|null $partner_name01
         *
         * @return PreChainStore
         */
        public function setPartnerName01($partner_name01 = null)
        {
            $this->partner_name01 = $partner_name01;

            return $this;
        }

        /**
         * Get partner_name01.
         *
         * @return string|null
         */
        public function getPartnerName01()
        {
            return $this->partner_name01;
        }
        
        /**
         * Set partner_name02.
         *
         * @param string|null $partner_name02
         *
         * @return PreChainStore
         */
        public function setPartnerName02($partner_name02 = null)
        {
            $this->partner_name02 = $partner_name02;

            return $this;
        }

        /**
         * Get partner_name02.
         *
         * @return string|null
         */
        public function getPartnerName02()
        {
            return $this->partner_name02;
        }

        /**
         * Set partner_kana01.
         *
         * @param string|null $partner_kana01
         *
         * @return PreChainStore
         */
        public function setPartnerNameKana01($partner_kana01 = null)
        {
            $this->partner_kana01 = $partner_kana01;

            return $this;
        }

        /**
         * Get partner_kana01.
         *
         * @return string|null
         */
        public function getPartnerNameKana01()
        {
            return $this->partner_kana01;
        }

        /**
         * Set partner_kana02.
         *
         * @param string|null $partner_kana02
         *
         * @return PreChainStore
         */
        public function setPartnerNameKana02($partner_kana02 = null)
        {
            $this->partner_kana02 = $partner_kana02;

            return $this;
        }

        /**
         * Get partner_kana02.
         *
         * @return string|null
         */
        public function getPartnerNameKana02()
        {
            return $this->partner_kana02;
        }
        
        /**
         * Set partner_phone_number.
         *
         * @param string|null $partner_phone_number
         *
         * @return PreChainStore
         */
        public function setPartnerPhoneNumber($partner_phone_number = null)
        {
            $this->partner_phone_number = $partner_phone_number;

            return $this;
        }

        /**
         * Get partner_phone_number.
         *
         * @return string|null
         */
        public function getPartnerPhoneNumber()
        {
            return $this->partner_phone_number;
        }
        
        
        /**
         * Set note.
         *
         * @param string|null $note
         *
         * @return PreChainStore
         */
        public function setNote($note = null)
        {
            $this->note = $note;

            return $this;
        }

        /**
         * Get note.
         *
         * @return string|null
         */
        public function getNote()
        {
            return $this->note;
        }


        /**
         * Set Sort No
         *
         * @param string $sortNo
         *
         * @return PreChainStore
         */
        public function setSortNo($sortNo)
        {
            $this->sort_no = $sortNo;

            return $this;
        }

        /**
         * Get Sort No
         *
         * @return string
         */
        public function getSortNo()
        {
            return $this->sort_no;
        }
    }
}
