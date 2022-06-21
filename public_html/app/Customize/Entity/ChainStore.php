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

if (!class_exists('\Customize\Entity\ChainStore')) {
    /**
     * ChainStore
     *
     * @ORM\Table(name="dtb_chain_store", indexes={@ORM\Index(name="dtb_chain_store_create_date_idx", columns={"create_date"}), @ORM\Index(name="dtb_chain_store_update_date_idx", columns={"update_date"})})
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\Entity(repositoryClass="Customize\Repository\ChainStoreRepository")
     */
    class ChainStore extends \Eccube\Entity\AbstractEntity
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
         * @var \Customize\Entity\PreChainStore
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\PreChainStore")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="pre_chainstore_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $PreChainStore;

        /**
         * @var \Customize\Entity\Master\ContractType 契約区分
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ContractType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="contract_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $ContractType;

        /**
         * @var \Customize\Entity\Master\ApplicantContractType 申込者の契約区分
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ApplicantContractType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="applicant_contract_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $ApplicantContractType;

        /**
         * @var string 法人番号
         *
         * @ORM\Column(name="corporate_number", type="string", length=20, nullable=true, options={"comment":"法人番号"}) 
         */
        private $corporateNumber;

        /**
         * @var string|null
         *
         * @ORM\Column(name="stock_number", type="string", length=20, nullable=true, options={"comment":"契約番号"}) 
         */
        private $stock_number;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="timestamp", type="datetimetz", nullable=true, options={"comment":"タイムスタンプ"}) 
         */
        private $timestamp;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="contract_begin_ymd", type="date", nullable=true, options={"comment":"契約開始年月"}) 
         */
        private $contract_begin_ymd;

        /**
         * @var string|null 
         *
         * @ORM\Column(name="company_name", type="string", length=255, nullable=true, options={"comment":"法人名・屋号"}) 
         */
        private $company_name;

        /**
         * @var string|null 法人名・屋号（フリガナ）
         *
         * @ORM\Column(name="company_name_kana", type="string", length=255, nullable=true, options={"comment":"法人名・屋号（フリガナ）"}) 
         */
        private $company_name_kana;

        /**
         * @var \DateTime 設立日（開業日）
         *
         * @ORM\Column(name="begin_day", type="date", nullable=true, options={"comment":"設立日（開業日）"}) 
         */
        private $begin_day;

        /**
         * @var string|null 所在地：郵便番号
         *
         * @ORM\Column(name="chainstore_postal_code", type="string", length=8, nullable=true, options={"comment":"所在地：郵便番号"}) 
         */
        private $chainstore_postal_code;

        /**
         * @var \Eccube\Entity\Master\Pref 所在地・住所（都道府県）
         *
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\Pref")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="pref_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $chainstore_pref;

        /**
         * @var string|null 所在地・住所
         *
         * @ORM\Column(name="chainstore_address_full", type="string", length=255, nullable=true, options={"comment":"所在地・住所"}) 
         */
        private $chainstore_address_full;

        /**
         * @var string|null 所在地・住所（市町村名）
         *
         * @ORM\Column(name="chainstore_address01", type="string", length=255, nullable=true, options={"comment":"所在地・住所（市町村名）"}) 
         */
        private $chainstore_address01;

        /**
         * @var string|null 所在地・住所（番地・ビル名）
         *
         * @ORM\Column(name="chainstore_address02", type="string", length=255, nullable=true, options={"comment":"所在地・住所（番地・ビル名）"}) 
         */
        private $chainstore_address02;

        /**
         * @var string|null 所在地・住所(フリガナ)
         *
         * @ORM\Column(name="addr01_ka", type="string", length=255, nullable=true, options={"comment":"所在地・住所(フリガナ)"}) 
         */
        private $addr01_ka;

        /**
         * @var string  代表者名・氏名
         *
         * @ORM\Column(name="full_name", type="string", length=255, nullable=true, options={"comment":"代表者名・氏名"}) 
         */
        private $full_name;

        /**
         * @var string  代表者名・氏名
         *
         * @ORM\Column(name="name01", type="string", length=255, nullable=true, options={"comment":"代表者名・氏名-姓"}) 
         */
        private $name01;

        /**
         * @var string
         *
         * @ORM\Column(name="name02", type="string", length=255, nullable=true, options={"comment":"代表者名・氏名-姓名"}) 
         */
        private $name02;

        /**
         * @var string|null 代表者名・氏名（フリガナ）
         *
         * @ORM\Column(name="kana01", type="string", length=255, nullable=true, options={"comment":"代表者名・氏名（フリガナ）-姓"}) 
         */
        private $kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="kana02", type="string", length=255, nullable=true, options={"comment":"代表者名・氏名（フリガナ）-名"}) 
         */
        private $kana02;

        /**
         * @var string|null 固定電話
         *
         * @ORM\Column(name="contact_phone_number", type="string", length=50, nullable=true, options={"comment":"固定電話"}) 
         */
        private $contact_phone_number;

        /**
         * @var string|null 携帯電話
         *
         * @ORM\Column(name="cellphone_number", type="string", length=50, nullable=true, options={"comment":"携帯電話"}) 
         */
        private $cellphone_number;
        
        /**
         * @var string|null 仲介者 法人名・屋号 
         *
         * @ORM\Column(name="mediator_company_name", type="string", nullable=true, length=255, options={"comment":"仲介者 法人名・屋号"}) 
         */
        private $mediator_company_name;

        /**
         * @var string|null 仲介者 法人名・屋号（フリガナ）
         *
         * @ORM\Column(name="mediator_company_name_kana", type="string", nullable=true, length=255, options={"comment":"仲介者 法人名・屋号（フリガナ）"}) 
         */
        private $mediator_company_name_kana;

        /**
         * @var string  代表者氏名「姓名」
         *
         * @ORM\Column(name="mediator_fullname", type="string", length=255, nullable=true, options={"comment":"仲介者 代表者氏名「姓名」"}) 
         */
        private $mediator_fullname;

        /**
         * @var string  仲介者 代表者氏名
         *
         * @ORM\Column(name="mediator_name01", type="string", length=255, nullable=true, options={"comment":"仲介者 代表者氏名-姓"}) 
         */
        private $mediator_name01;

        /**
         * @var string
         *
         * @ORM\Column(name="mediator_name02", type="string", length=255, nullable=true, options={"comment":"仲介者 代表者氏名-名"}) 
         */
        private $mediator_name02;

        /**
         * @var string|null 仲介者 代表者氏名（フリガナ）
         *
         * @ORM\Column(name="mediator_kana01", type="string", length=255, nullable=true, options={"comment":"仲介者 代表者氏名（フリガナ）-姓"}) 
         */
        private $mediator_kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="mediator_kana02", type="string", length=255, nullable=true, options={"comment":"仲介者 代表者氏名（フリガナ）-名"}) 
         */
        private $mediator_kana02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="mediator_address01", type="string", length=255, nullable=true, options={"comment":"仲介者 所在地・住所"}) 
         */
        private $mediator_address01;

        /**
         * @var string|null 仲介者 ディーラーコード
         *
         * @ORM\Column(name="dealer_code", type="string", length=20, nullable=true, options={"comment":"仲介者 ディーラーコード"}) 
         */
        private $dealer_code;

        /**
         * @var string|null 仲介者 電話番号
         *
         * @ORM\Column(name="mediator_phone_number", type="string", length=14, nullable=true, options={"comment":"仲介者 電話番号"}) 
         */
        private $mediator_phone_number;

        /**
         * @var \Customize\Entity\Master\ChainStoreTradingAccountType 取引口座選択
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreTradingAccountType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chainstore_trading_account_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $chainStoreTradingAccountType;
        
        /**
         * @var \Customize\Entity\Master\Bank 金融機関名
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\Bank")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="bank_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $Bank;

        /**
         * @var string|null 支店
         *
         * @ORM\Column(name="bank_branch_id", type="integer", nullable=true, options={"unsigned":true})
         */
        private $BankBranch;
        
        /**
         * @var \Customize\Entity\Master\BankAccountType 預金種目
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\BankAccountType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="bank_account_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $BankAccountType;

        /**
         * @var string|null 口座番号
         *
         * @ORM\Column(name="bank_account", type="string", length=15, nullable=true, options={"comment":"口座番号"}) 
         */
        private $BankAccount;

        /**
         * @var string|null 通帳記号（下5桁）（ゆうちょ）
         *
         * @ORM\Column(name="code_number", type="string", length=10, nullable=true, options={"comment":"通帳記号（下5桁）（ゆうちょ）"}) 
         */
        private $codeNumber;

        /**
         * @var string|null 通帳番号（8桁）（ゆうちょ）
         *
         * @ORM\Column(name="account_number", type="string", length=20, nullable=true, options={"comment":"通帳番号（8桁）（ゆうちょ）"}) 
         */
        private $accountNumber;

        /**
         * @var string|null 口座名義
         *
         * @ORM\Column(name="bank_holder_name", type="string", length=100, nullable=true, options={"comment":"口座名義"}) 
         */
        private $BankHolderName;

        /**
         * @var string|null 口座名義（フリガナ）
         *
         * @ORM\Column(name="bank_holder", type="string", length=100, nullable=true, options={"comment":"口座名義（フリガナ）"}) 
         */
        private $BankHolder;

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
         * @var string|null 販売店舗名
         *
         * @ORM\Column(name="chainstore_name", type="string", length=255, nullable=true, options={"comment":"販売店舗名"}) 
         */
        private $chainstore_name;

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
         * @var string|null 店舗郵便番号
         *
         * @ORM\Column(name="postal_code", type="string", length=8, nullable=true, options={"comment":"販売店舗所在地：（郵便番号）"}) 
         */
        private $postal_code;

        /**
         * @var \Eccube\Entity\Master\Pref 販売店舗所在地：（都道府県）
         *
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\Pref")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="addr01_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $addr01;

        /**
         * @var string|null 販売店舗所在地：（市町村名）
         *
         * @ORM\Column(name="addr02", type="string", length=255, nullable=true, options={"comment":"販売店舗所在地：（市町村名）"}) 
         */
        private $addr02;

        /**
         * @var string|null 販売店舗所在地：（番地・ビル名）
         *
         * @ORM\Column(name="addr03", type="string", length=255, nullable=true, options={"comment":"販売店舗所在地：（番地・ビル名）"}) 
         */
        private $addr03;

        /**
         * @var string  担当者名
         *
         * @ORM\Column(name="main_name01", type="string", length=255, nullable=true, options={"comment":"販売店舗担当者名-姓"}) 
         */
        private $main_name01;

        /**
         * @var string
         *
         * @ORM\Column(name="main_name02", type="string", length=255, nullable=true, options={"comment":"販売店舗担当者名-名"}) 
         */
        private $main_name02;

        /**
         * @var string  販売店舗担当者名 カナ
         *
         * @ORM\Column(name="main_kana01", type="string", length=255, nullable=true, options={"comment":"販売店舗担当者名（フリガナ）-姓"}) 
         */
        private $main_kana01;

        /**
         * @var string
         *
         * @ORM\Column(name="main_kana02", type="string", length=255, nullable=true, options={"comment":"販売店舗担当者名（フリガナ）-名"}) 
         */
        private $main_kana02;

        /**
         * @var string|null 販売店舗連絡先（電話番号）
         *
         * @ORM\Column(name="phone_number", type="string", length=14, nullable=true, options={"comment":"販売店舗連絡先（電話番号）"}) 
         */
        private $phone_number;

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
         * @var string|null パートナー指定
         *
         * @ORM\Column(name="option_partner", type="string", length=255, nullable=true, options={"comment":"パートナー指定"}) 
         */
        private $option_partner;

        /**
         * @var string|null パートナー 法人名・屋号 
         *
         * @ORM\Column(name="partner_company_name", type="string", length=255, nullable=true, options={"comment":"パートナー 法人名・屋号"}) 
         */
        private $partner_company_name;

        /**
         * @var string|null パートナー 法人名・屋号（フリガナ）
         *
         * @ORM\Column(name="partner_company_name_kana", type="string", length=255, nullable=true, options={"comment":"パートナー 法人名・屋号（フリガナ）"}) 
         */
        private $partner_company_name_kana;

        
        /**
         * @var string  パートナー 代表者氏名
         *
         * @ORM\Column(name="partner_name01", type="string", length=255, nullable=true, options={"comment":"パートナー 代表者氏名-姓"}) 
         */
        private $partner_name01;

        /**
         * @var string
         *
         * @ORM\Column(name="partner_name02", type="string", length=255, nullable=true, options={"comment":"パートナー 代表者氏名-名"}) 
         */
        private $partner_name02;

        /**
         * @var string|null パートナー 代表者氏名（フリガナ）
         *
         * @ORM\Column(name="partner_kana01", type="string", length=255, nullable=true, options={"comment":"パートナー 代表者氏名（フリガナ）-姓"}) 
         */
        private $partner_kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="partner_kana02", type="string", length=255, nullable=true, options={"comment":"パートナー 代表者氏名（フリガナ）-名"}) 
         */
        private $partner_kana02;

        /**
         * @var string|null パートナー 電話番号
         *
         * @ORM\Column(name="partner_phone_number", type="string", length=14, nullable=true, options={"comment":"パートナー 電話番号"}) 
         */
        private $partner_phone_number;

        /**
         * @var \Customize\Entity\Master\ChainStoreMakeContractType この情報を基に契約書を作成します
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreMakeContractType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chain_store_make_contract_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $chainStoreMakeContractType;

        /**
         * @var string|null
         *
         * @ORM\Column(name="note", type="string", length=4000, nullable=true)
         */
        private $note;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="create_date", type="datetimetz")
         */
        private $create_date;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="update_date", type="datetimetz")
         */
        private $update_date;

        /**
         * @var \Customize\Entity\Master\ChainStoreStatus
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreStatus")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chain_store_status_id", referencedColumnName="id")
         * })
         */
        private $Status;

        /**
         * @var boolean
         *
         * @ORM\Column(name="option_order_limit", type="boolean", options={"default":false})
         */
        private $optionOrderLimit = false;

        /**
         * @var string|null
         *
         * @ORM\Column(name="order_limit_text", type="string", length=4000, nullable=true)
         */
        private $orderLimitText;

        /**
         * @var string|null
         *
         * @ORM\Column(name="margin_price", type="integer", options={"unsigned":true, "default":0})
         */
        private $marginPrice;

        /**
         * @var string|null
         *
         * @ORM\Column(name="margin_not_included", type="boolean", options={"default":false})
         */
        private $marginNotIncluded;

        /**
         * @var string|null
         *
         * @ORM\Column(name="purchasing_limit_price", type="integer", options={"unsigned":true, "default":0})
         */
        private $purchasingLimitPrice;

        /**
         * @var string|null
         *
         * @ORM\Column(name="delivery_registrations", type="integer", options={"unsigned":true, "default":1})
         */
        private $deliveryRegistrations;

        /**
         * @var string|null
         *
         * @ORM\Column(name="sort_no", type="integer", nullable=true, options={"unsigned":true})
         */
        private $sort_no;

        //Private Use
        private $point = '0';
        private $relatedCustomer = null;
        private $currentPurchasedPrice = 0;
        private $balancePrice = 0;

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->sort_no = 0;
            $this->timestamp = new \DateTime();
        }

        /**
         * @return string
         */
        public function __toString()
        {
            return (string) ($this->getDealerCode().'-'.$this->getCompanyName().' ('.$this->getName01().' '.$this->getName02().')');
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
         * Set preChainStore.
         *
         * @param \Customize\Entity\PreChainStore|null $preChainStore
         *
         * @return ChainStore
         */
        public function setPreChainStore($preChainStore)
        {
            $this->PreChainStore = $preChainStore;

            return $this;
        }

        /**
         * Get preChainStore.
         *
         * @return \Customize\Entity\PreChainStore|null
         */
        public function getPreChainStore()
        {
            return $this->PreChainStore;
        }


        /**
         * Set contractType.
         *
         * @param \Customize\Entity\Master\ContractType|null $contractType
         *
         * @return ChainStore
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
         * Set applicantContractType.
         *
         * @param \Customize\Entity\Master\ApplicantContractType|null $applicantContractType
         *
         * @return ChainStore
         */
        public function setApplicantContractType(\Customize\Entity\Master\ApplicantContractType $applicantContractType = null)
        {
            $this->ApplicantContractType = $applicantContractType;

            return $this;
        }

        /**
         * Get applicantContractType.
         *
         * @return \Customize\Entity\Master\ApplicantContractType|null
         */
        public function getApplicantContractType()
        {
            return $this->ApplicantContractType;
        }

        /**
         * Set corporateNumber.
         *
         * @param string $corporateNumber
         *
         * @return ChainStore
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
         * Set stock Number.
         *
         * @param string|null $stockNumber
         *
         * @return ChainStore
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
         * Set timestamp.
         *
         * @param \DateTime $timestamp
         *
         * @return ChainStore
         */
        public function setTimestamp($timestamp)
        {
            $this->timestamp = $timestamp;

            return $this;
        }

        /**
         * Get timestamp.
         *
         * @return \DateTime
         */
        public function getTimestamp()
        {
            return $this->timestamp;
        }
        
        /**
         * Set contractBeginYmd.
         *
         * @param \DateTime $contractBeginYmd
         *
         * @return ChainStore
         */
        public function setContractBeginYmd($contractBeginYmd)
        {
            $this->contract_begin_ymd = $contractBeginYmd;

            return $this;
        }

        /**
         * Get contractBeginYmd.
         *
         * @return \DateTime
         */
        public function getContractBeginYmd()
        {
            return $this->contract_begin_ymd;
        }

        /**
         * Set companyName.
         *
         * @param string|null $companyName
         *
         * @return ChainStore
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
         * @return ChainStore
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
         * @return ChainStore
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
         * Set chainstore_postal_code.
         *
         * @param string|null $chainstore_postal_code
         *
         * @return ChainStore
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
         * Set chainstore_pref.
         *
         * @param \Eccube\Entity\Master\Pref|null $chainstore_pref
         *
         * @return Customer
         */
        public function setChainstorePref(\Eccube\Entity\Master\Pref $chainstore_pref = null)
        {
            $this->chainstore_pref = $chainstore_pref;

            return $this;
        }

        /**
         * Get chainstore_pref.
         *
         * @return \Eccube\Entity\Master\Pref|null
         */
        public function getChainstorePref()
        {
            return $this->chainstore_pref;
        }
        
        /**
         * Set chainstore_address_full.
         *
         * @param string|null $chainstore_address_full
         *
         * @return ChainStore
         */
        public function setChainstoreAddressFull($chainstore_address_full = null)
        {
            $this->chainstore_address_full = $chainstore_address_full;

            return $this;
        }

        /**
         * Get chainstore_address_full.
         *
         * @return string|null
         */
        public function getChainstoreAddressFull()
        {
            return $this->chainstore_address_full;
        }

        /**
         * Set chainstore_address01.
         *
         * @param string|null $chainstore_address01
         *
         * @return ChainStore
         */
        public function setChainstoreAddress01($chainstore_address01 = null)
        {
            $this->chainstore_address01 = $chainstore_address01;

            return $this;
        }

        /**
         * Get chainstore_address01.
         *
         * @return string|null
         */
        public function getChainstoreAddress01()
        {
            return $this->chainstore_address01;
        }

        /**
         * Set chainstore_address02.
         *
         * @param string|null $chainstore_address02
         *
         * @return ChainStore
         */
        public function setChainstoreAddress02($chainstore_address02 = null)
        {
            $this->chainstore_address02 = $chainstore_address02;

            return $this;
        }

        /**
         * Get chainstore_address02.
         *
         * @return string|null
         */
        public function getChainstoreAddress02()
        {
            return $this->chainstore_address02;
        }


        /**
         * Set addr01_ka.
         *
         * @param string|null $addr01_ka
         *
         * @return ChainStore
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
         * Set full_name.
         *
         * @param string|null $full_name
         *
         * @return ChainStore
         */
        public function setFullName($full_name = null)
        {
            $this->full_name = $full_name;

            return $this;
        }

        /**
         * Get full_name.
         *
         * @return string|null
         */
        public function getFullName()
        {
            return $this->full_name;
        }
        
        /**
         * Set name01.
         *
         * @param string $name01
         *
         * @return ChainStore
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
         * @return ChainStore
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
         * @return ChainStore
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
         * @return ChainStore
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
         * Set contact_phone_number.
         *
         * @param string|null $contact_phone_number
         *
         * @return Customer
         */
        public function setContactPhoneNumber($contact_phone_number = null)
        {
            $this->contact_phone_number = $contact_phone_number;

            return $this;
        }

        /**
         * Get contact_phone_number.
         *
         * @return string|null
         */
        public function getContactPhoneNumber()
        {
            return $this->contact_phone_number;
        }

        /**
         * Set cellphone_number.
         *
         * @param string|null $cellphone_number
         *
         * @return Customer
         */
        public function setCellphoneNumber($cellphone_number = null)
        {
            $this->cellphone_number = $cellphone_number;

            return $this;
        }

        /**
         * Get cellphone_number.
         *
         * @return string|null
         */
        public function getCellphoneNumber()
        {
            return $this->cellphone_number;
        }
        

        /**
         * Set mediator_company_name.
         *
         * @param string|null $mediator_company_name
         *
         * @return Customer
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
         * @return Customer
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
         * Set mediator_fullname.
         *
         * @param string|null $mediator_fullname
         *
         * @return Customer
         */
        public function setMediatorFullname($mediator_fullname = null)
        {
            $this->mediator_fullname = $mediator_fullname;

            return $this;
        }

        /**
         * Get mediator_fullname.
         *
         * @return string|null
         */
        public function getMediatorFullname()
        {
            return $this->mediator_fullname;
        }

        /**
         * Set mediator_name01.
         *
         * @param string|null $mediator_name01
         *
         * @return Customer
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
         * @return Customer
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
         * @return Customer
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
         * @return Customer
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
         * Set mediator_address01.
         *
         * @param string|null $mediator_address01
         *
         * @return Customer
         */
        public function setMediatorAddress01($mediator_address01 = null)
        {
            $this->mediator_address01 = $mediator_address01;

            return $this;
        }

        /**
         * Get mediator_address01.
         *
         * @return string|null
         */
        public function getMediatorAddress01()
        {
            return $this->mediator_address01;
        }

        /**
         * Set note.
         *
         * @param string|null $note
         *
         * @return ChainStore
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
         * Set createDate.
         *
         * @param \DateTime $createDate
         *
         * @return ChainStore
         */
        public function setCreateDate($createDate)
        {
            $this->create_date = $createDate;

            return $this;
        }

        /**
         * Get createDate.
         *
         * @return \DateTime
         */
        public function getCreateDate()
        {
            return $this->create_date;
        }

        /**
         * Set updateDate.
         *
         * @param \DateTime $updateDate
         *
         * @return ChainStore
         */
        public function setUpdateDate($updateDate)
        {
            $this->update_date = $updateDate;

            return $this;
        }

        /**
         * Get updateDate.
         *
         * @return \DateTime
         */
        public function getUpdateDate()
        {
            return $this->update_date;
        }

        /**
         * Set status.
         *
         * @param \Customize\Entity\Master\ChainStoreStatus|null $status
         *
         * @return ChainStore
         */
        public function setStatus(Master\ChainStoreStatus $status = null)
        {
            $this->Status = $status;

            return $this;
        }

        /**
         * Get status.
         *
         * @return \Customize\Entity\Master\ChainStoreStatus|null
         */
        public function getStatus()
        {
            return $this->Status;
        }

        /**
         * Set dealer code
         *
         * @param string $dealerCode
         *
         * @return ChainStore
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
         * @return ChainStore
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
         * Set chainStoreTradingAccountType.
         *
         * @param string $chainStoreTradingAccountType
         *
         * @return ChainStore
         */
        public function setChainStoreTradingAccountType(\Customize\Entity\Master\ChainStoreTradingAccountType $chainStoreTradingAccountType)
        {
            $this->chainStoreTradingAccountType = $chainStoreTradingAccountType;

            return $this;
        }

        /**
         * Get chainStoreTradingAccountType.
         *
         * @return string
         */
        public function getChainStoreTradingAccountType()
        {
            return $this->chainStoreTradingAccountType;
        }

        /**
         * Set Bank.
         *
         * @param string $bank
         *
         * @return ChainStore
         */
        public function setBank(\Customize\Entity\Master\Bank $bank)
        {
            $this->Bank = $bank;

            return $this;
        }

        /**
         * Get Bank.
         *
         * @return string
         */
        public function getBank()
        {
            return $this->Bank;
        }

        /**
         * Set BankBranch.
         *
         * @param string $bankbranch
         *
         * @return ChainStore
         */
        public function setBankBranch($bankbranch)
        {
            $this->BankBranch = $bankbranch;

            return $this;
        }

        /**
         * Get BankBranch.
         *
         * @return string
         */
        public function getBankBranch()
        {
            return $this->BankBranch;
        }


        /**
         * Set BankAccountType.
         *
         * @param string $bankAccountType
         *
         * @return ChainStore
         */
        public function setBankAccountType(\Customize\Entity\Master\BankAccountType $bankAccountType)
        {
            $this->BankAccountType = $bankAccountType;

            return $this;
        }

        /**
         * Get BankAccountType.
         *
         * @return string
         */
        public function getBankAccountType()
        {
            return $this->BankAccountType;
        }


        /**
         * Set codeNumber.
         *
         * @param string $codeNumber
         *
         * @return ChainStore
         */
        public function setCodeNumber($codeNumber)
        {
            $this->codeNumber = $codeNumber;

            return $this;
        }

        /**
         * Get codeNumber.
         *
         * @return string|null
         */
        public function getCodeNumber()
        {
            return $this->codeNumber;
        }

        /**
         * Set BankAccount.
         *
         * @param string $account
         *
         * @return ChainStore
         */
        public function setBankAccount($account)
        {
            $this->BankAccount = $account;

            return $this;
        }

        /**
         * Get BankAccount.
         *
         * @return string|null
         */
        public function getBankAccount()
        {
            return $this->BankAccount;
        }
        
        /**
         * Set accountNumber.
         *
         * @param string $accountNumber
         *
         * @return ChainStore
         */
        public function setAccountNumber($accountNumber)
        {
            $this->accountNumber = $accountNumber;

            return $this;
        }

        /**
         * Get accountNumber.
         *
         * @return string|null
         */
        public function getAccountNumber()
        {
            return $this->accountNumber;
        }

        /**
         * Set BankHolderName.
         *
         * @param string $BankHolderName
         *
         * @return ChainStore
         */
        public function setBankHolderName($BankHolderName)
        {
            $this->BankHolderName = $BankHolderName;

            return $this;
        }

        /**
         * Get BankHolderName.
         *
         * @return string|null
         */
        public function getBankHolderName()
        {
            return $this->BankHolderName;
        }

        /**
         * Set BankHolder.
         *
         * @param string $bankholder
         *
         * @return ChainStore
         */
        public function setBankHolder($bankholder)
        {
            $this->BankHolder = $bankholder;

            return $this;
        }

        /**
         * Get BankHolder.
         *
         * @return string|null
         */
        public function getBankHolder()
        {
            return $this->BankHolder;
        }


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
         * Set chainstore_name.
         *
         * @param string|null $chainstore_name
         *
         * @return ChainStore
         */
        public function setChainstoreName($chainstore_name = null)
        {
            $this->chainstore_name = $chainstore_name;

            return $this;
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
         * Set postal_code.
         *
         * @param string|null $postal_code
         *
         * @return SubChainStore
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
         * @return SubChainStore
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
         * @return SubChainStore
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
         * @return SubChainStore
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
         * Set main_name01.
         *
         * @param string $main_name01
         *
         * @return SubChainStore
         */
        public function setMainName01($main_name01)
        {
            $this->main_name01 = $main_name01;

            return $this;
        }

        /**
         * Get main_name01.
         *
         * @return string
         */
        public function getMainName01()
        {
            return $this->main_name01;
        }

        /**
         * Set main_name02.
         *
         * @param string $main_name02
         *
         * @return SubChainStore
         */
        public function setMainName02($main_name02)
        {
            $this->main_name02 = $main_name02;

            return $this;
        }

        /**
         * Get main_name02.
         *
         * @return string
         */
        public function getMainName02()
        {
            return $this->main_name02;
        }


        /**
         * Set main_kana01.
         *
         * @param string $main_kana01
         *
         * @return SubChainStore
         */
        public function setMainKana01($main_kana01)
        {
            $this->main_kana01 = $main_kana01;

            return $this;
        }

        /**
         * Get main_kana01.
         *
         * @return string
         */
        public function getMainKana01()
        {
            return $this->main_kana01;
        }


        /**
         * Set main_kana02.
         *
         * @param string $main_kana02
         *
         * @return SubChainStore
         */
        public function setMainKana02($main_kana02)
        {
            $this->main_kana02 = $main_kana02;

            return $this;
        }

        /**
         * Get main_kana02.
         *
         * @return string
         */
        public function getMainKana02()
        {
            return $this->main_kana02;
        }
        
        /**
         * Set phone_number.
         *
         * @param string|null $phone_number
         *
         * @return Customer
         */
        public function setPhoneNumber($phone_number = null)
        {
            $this->phone_number = $phone_number;

            return $this;
        }

        /**
         * Get phone_number.
         *
         * @return string|null
         */
        public function getPhoneNumber()
        {
            return $this->phone_number;
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

        /**
         * Set option_partner.
         *
         * @param string|null $option_partner
         *
         * @return SubChainStore
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
         * @return SubChainStore
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
         * @return SubChainStore
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
         * @return SubChainStore
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
         * @return SubChainStore
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
         * @return SubChainStore
         */
        public function setPartnerKana01($partner_kana01 = null)
        {
            $this->partner_kana01 = $partner_kana01;

            return $this;
        }

        /**
         * Get partner_kana01.
         *
         * @return string|null
         */
        public function getPartnerKana01()
        {
            return $this->partner_kana01;
        }
        

        /**
         * Set partner_kana02.
         *
         * @param string|null $partner_kana02
         *
         * @return SubChainStore
         */
        public function setPartnerKana02($partner_kana02 = null)
        {
            $this->partner_kana02 = $partner_kana02;

            return $this;
        }

        /**
         * Get partner_kana02.
         *
         * @return string|null
         */
        public function getPartnerKana02()
        {
            return $this->partner_kana02;
        }


        /**
         * Set partner_phone_number.
         *
         * @param string|null $partner_phone_number
         *
         * @return SubChainStore
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
         * Set chainStoreMakeContractType.
         *
         * @param string|null $chainStoreMakeContractType
         *
         * @return SubChainStore
         */
        public function setChainStoreMakeContractType($chainStoreMakeContractType = null)
        {
            $this->chainStoreMakeContractType = $chainStoreMakeContractType;

            return $this;
        }

        /**
         * Get chainStoreMakeContractType.
         *
         * @return string|null
         */
        public function getChainStoreMakeContractType()
        {
            return $this->chainStoreMakeContractType;
        }
        
        /**
         * Set Sort No
         *
         * @param string $sortNo
         *
         * @return ChainStore
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

        /**
         * Set point
         *
         * @param string $point
         *
         * @return ChainStore
         */
        public function setPoint($point)
        {
            $this->point = $point;

            return $this;
        }

        /**
         * Get point
         *
         * @return string
         */
        public function getPoint()
        {
            return $this->point;
        }

        /**
         * Set related Customer
         *
         * @param string $relatedCustomer
         *
         * @return ChainStore
         */
        public function setRelatedCustomer($relatedCustomer)
        {
            $this->relatedCustomer = $relatedCustomer;

            return $this;
        }

        /**
         * Get related Customer
         *
         * @return string
         */
        public function getRelatedCustomer()
        {
            return $this->relatedCustomer;
        }


        /**
         * Set optionOrderLimit.
         *
         * @param boolean $optionOrderLimit
         *
         * @return ChainStore
         */
        public function setOptionOrderLimit($optionOrderLimit)
        {
            $this->optionOrderLimit = $optionOrderLimit;

            return $this;
        }

        /**
         * Get optionOrderLimit.
         *
         * @return boolean
         */
        public function isOptionOrderLimit()
        {
            return $this->optionOrderLimit;
        }

        /**
         * Set orderLimitText.
         *
         * @param string $orderLimitText
         *
         * @return ChainStore
         */
        public function setOrderLimitText($orderLimitText)
        {
            $this->orderLimitText = $orderLimitText;

            return $this;
        }

        /**
         * Get orderLimitText.
         *
         * @return string
         */
        public function getOrderLimitText()
        {
            return $this->orderLimitText;
        }


        /**
         * Set marginPrice.
         *
         * @param string $marginPrice
         *
         * @return ChainStore
         */
        public function setMarginPrice($marginPrice)
        {
            $this->marginPrice = $marginPrice;

            return $this;
        }

        /**
         * Get marginPrice.
         *
         * @return string
         */
        public function getMarginPrice()
        {
            return $this->marginPrice;
        }


        /**
         * Set marginNotIncluded.
         *
         * @param string $marginNotIncluded
         *
         * @return ChainStore
         */
        public function setMarginNotIncluded($marginNotIncluded)
        {
            $this->marginNotIncluded = $marginNotIncluded;

            return $this;
        }

        /**
         * Get marginNotIncluded.
         *
         * @return string
         */
        public function getMarginNotIncluded()
        {
            return $this->marginNotIncluded;
        }
        
        
        /**
         * Set purchasingLimitPrice.
         *
         * @param string $purchasingLimitPrice
         *
         * @return ChainStore
         */
        public function setPurchasingLimitPrice($purchasingLimitPrice)
        {
            $this->purchasingLimitPrice = $purchasingLimitPrice;

            return $this;
        }

        /**
         * Get purchasingLimitPrice.
         *
         * @return string
         */
        public function getPurchasingLimitPrice()
        {
            return $this->purchasingLimitPrice;
        }

        /**
         * Set deliveryRegistrations.
         *
         * @param string $deliveryRegistrations
         *
         * @return ChainStore
         */
        public function setDeliveryRegistrations($deliveryRegistrations)
        {
            $this->deliveryRegistrations = $deliveryRegistrations;

            return $this;
        }

        /**
         * Get deliveryRegistrations.
         *
         * @return string
         */
        public function getDeliveryRegistrations()
        {
            return $this->deliveryRegistrations;
        }

        public function getBalancePrice(){
            $this->balancePrice = (($this->marginPrice + $this->purchasingLimitPrice) - $this->currentPurchasedPrice);
            return $this->balancePrice;
        }

        public function setBalancePrice($currentPurchasedPrice){
            $this->currentPurchasedPrice = $currentPurchasedPrice;
            $this->balancePrice = (($this->marginPrice + $this->purchasingLimitPrice) - $currentPurchasedPrice);
        }
    }
}
