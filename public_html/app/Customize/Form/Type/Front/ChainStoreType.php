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

namespace Customize\Form\Type\Front;

use Eccube\Common\EccubeConfig;
use Customize\Entity\ChainStore;
use Eccube\Form\Type\AddressType;
use Eccube\Form\Type\KanaType;
use Eccube\Form\Type\Master\PrefType;
use Customize\Entity\Master\ContractType;
use Customize\Entity\Master\ApplicantContractType;
use Customize\Entity\Master\RelatedChainStoreType;
use Customize\Entity\Master\ChainStoreBusinessType;
use Customize\Entity\Master\ChainStoreProvideType;
use Customize\Entity\Master\ChainStoreProvideStyleType;
use Customize\Entity\Master\ChainStoreWebShopOpeningType;
use Customize\Entity\Master\ChainStoreWebShopOwnerType;
use Customize\Entity\Master\ChainStoreWebShopPhoneType;
use Customize\Entity\Master\ChainStoreWebShopEmailType;
use Customize\Entity\Master\ChainStoreTradingAccountType;
use Customize\Entity\Master\ChainStoreMakeContractType;
use Customize\Form\Type\Master\BankType;
use Customize\Form\Type\Master\BankBranchType;
use Customize\Form\Type\Master\BankAccountTypeType;
use Customize\Form\Type\Master\ContractTypeType;
use Customize\Repository\Master\ContractTypeRepository;
use Customize\Repository\Master\ApplicantContractTypeRepository;
use Customize\Repository\Master\RelatedChainStoreTypeRepository;
use Customize\Repository\Master\ChainStoreBusinessTypeRepository;
use Customize\Repository\Master\ChainStoreProvideTypeRepository;
use Customize\Repository\Master\ChainStoreProvideStyleTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopOpeningTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopOwnerTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopPhoneTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopEmailTypeRepository;
use Customize\Repository\Master\ChainStoreTradingAccountTypeRepository;
use Customize\Repository\Master\ChainStoreMakeContractTypeRepository;
use Eccube\Form\Type\Master\JobType;
use Eccube\Form\Type\Master\SexType;
use Eccube\Form\Type\NameType;
use Eccube\Form\Type\PhoneNumberType;
use Eccube\Form\Type\PostalType;
use Eccube\Form\Validator\Email;
use Eccube\Form\Type\RepeatedEmailType;
use Eccube\Form\Type\RepeatedPasswordType;
use Customize\Form\Type\NorequiredRepeatedEmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ChainStoreType extends AbstractType
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var ContractTypeRepository
     */
    protected $contractTypeRepository;

    /**
     * @var ApplicantContractTypeRepository
     */
    protected $applicantContractTypeRepository;

    /**
     * @var RelatedChainStoreTypeRepository
     */
    protected $relatedChainStoreTypeRepository;

    /**
     * @var ChainStoreBusinessTypeRepository
     */
    protected $chainStoreBusinessTypeRepository;

    /**
     * @var ChainStoreProvideTypeRepository
     */
    protected $chainStoreProvideTypeRepository;
    
    /**
     * @var ChainStoreProvideStyleTypeRepository
     */
    protected $chainStoreProvideStyleTypeRepository;

    /**
     * @var ChainStoreWebShopOpeningType
     */
    protected $chainStoreWebShopOpeningTypeRepository;

    /**
     * @var ChainStoreWebShopOwnerType
     */
    protected $chainStoreWebShopOwnerTypeRepository;

    /**
     * @var ChainStoreWebShopPhoneType
     */
    protected $chainStoreWebShopPhoneTypeRepository;

    /**
     * @var ChainStoreWebShopEmailType
     */
    protected $chainStoreWebShopEmailTypeRepository;

    /**
     * @var ChainStoreTradingAccountTypeRepository
     */
    protected $chainStoreTradingAccountTypeRepository;

    /**
     * @var ChainStoreMakeContractTypeRepository
     */
    protected $chainStoreMakeContractTypeRepository;

    /**
     * EntryType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(
                        EccubeConfig $eccubeConfig,
                        ContractTypeRepository $contractTypeRepository,
                        ApplicantContractTypeRepository $applicantContractTypeRepository,
                        RelatedChainStoreTypeRepository $relatedChainStoreTypeRepository,
                        ChainStoreBusinessTypeRepository $chainStoreBusinessTypeRepository,
                        ChainStoreProvideTypeRepository $chainStoreProvideTypeRepository,
                        ChainStoreProvideStyleTypeRepository $chainStoreProvideStyleTypeRepository,
                        ChainStoreWebShopOpeningTypeRepository $chainStoreWebShopOpeningTypeRepository,
                        ChainStoreWebShopOwnerTypeRepository $chainStoreWebShopOwnerTypeRepository,
                        ChainStoreWebShopPhoneTypeRepository $chainStoreWebShopPhoneTypeRepository,
                        ChainStoreWebShopEmailTypeRepository $chainStoreWebShopEmailTypeRepository,
                        ChainStoreTradingAccountTypeRepository $chainStoreTradingAccountTypeRepository,
                        ChainStoreMakeContractTypeRepository $chainStoreMakeContractTypeRepository
                        )
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->contractTypeRepository = $contractTypeRepository;
        $this->applicantContractTypeRepository = $applicantContractTypeRepository;
        $this->relatedChainStoreTypeRepository = $relatedChainStoreTypeRepository;
        $this->chainStoreBusinessTypeRepository = $chainStoreBusinessTypeRepository;
        $this->chainStoreProvideTypeRepository = $chainStoreProvideTypeRepository;
        $this->chainStoreProvideStyleTypeRepository = $chainStoreProvideStyleTypeRepository;
        $this->chainStoreWebShopOpeningTypeRepository = $chainStoreWebShopOpeningTypeRepository;
        $this->chainStoreWebShopOwnerTypeRepository = $chainStoreWebShopOwnerTypeRepository;
        $this->chainStoreWebShopPhoneTypeRepository = $chainStoreWebShopPhoneTypeRepository;
        $this->chainStoreWebShopEmailTypeRepository = $chainStoreWebShopEmailTypeRepository;
        $this->chainStoreTradingAccountTypeRepository = $chainStoreTradingAccountTypeRepository;
        $this->chainStoreMakeContractTypeRepository = $chainStoreMakeContractTypeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $contractType = $this->contractTypeRepository->findBy(['is_hidden' => 'N'], ['sort_no' => 'ASC']);
        $applicantContractType = $this->applicantContractTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $relatedChainStoreType = $this->relatedChainStoreTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreBusinessType = $this->chainStoreBusinessTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreProvideType = $this->chainStoreProvideTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreProvideStyleType = $this->chainStoreProvideStyleTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopOpeningType = $this->chainStoreWebShopOpeningTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopOwnerType = $this->chainStoreWebShopOwnerTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopPhoneType = $this->chainStoreWebShopPhoneTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopEmailType = $this->chainStoreWebShopEmailTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreTradingAccountType = $this->chainStoreTradingAccountTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreMakeContractType = $this->chainStoreMakeContractTypeRepository->findBy([], ['sort_no' => 'ASC']);

        $yesorno_name = array("なし", "あり");
        $yesorno2_name = array("なし", "あり");
        $yesorno_val = array("N", "Y");

        $builder
            ->add('pre_chainstore', TextType::class, [
                'required' => false,
            ])
            //契約区分
            ->add('contract_type', EntityType::class, [
                'required' => true,
                'class' => ContractType::class,
                'choices' => $contractType,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //契約開始年月
            ->add('contract_begin_ymd', BirthdayType::class, [
                'required' => false,
                'years' => range((date("Y")+1), 2021 ),
                'constraints' => [
                ],
            ])
            //申込者の契約区分
            ->add('applicant_contract_type', EntityType::class, [
                'required' => true,
                'class' => ApplicantContractType::class,
                'placeholder' => 'common.select__applicant_contract_type',
                'choices' => $applicantContractType,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //法人番号
            ->add('corporate_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //契約番号
            ->add('stock_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 10,
                    ]),
                ],
            ])
            //タイムスタンプ
            ->add('timestamp', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'input' => 'datetime',
                'constraints' => [
                ],
            ])
            //法人名・屋号
            ->add('company_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //法人名・屋号（フリガナ）
            ->add('company_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //設立日（開業日）
            ->add('begin_day', BirthdayType::class, [
                'required' => false,
                'years' => range((date("Y")+1), 1980 ),
                'format' => 'yyyy/MM/dd',
                'input' => 'datetime',
                'placeholder' => ['year' => '----', 'month' => '--', 'day' => '--'],
                'constraints' => [
                    new Assert\LessThanOrEqual([
                        'value' => date('Y-m-d', strtotime('-1 day')),
                        'message' => 'form_error.select_is_future_or_now_date',
                    ]),
                ],
            ])
            //所在地：郵便番号
            ->add('chainstore_postal_code', PostalType::class)
            //所在地・住所（都道府県）
            ->add('chainstore_pref', PrefType::class,[
                'required' => true,
                'attr' => ['class' => 'p-region-id'],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //所在地・住所
            ->add('chainstore_address_full', TextType::class,[
                'required' => false,
                'constraints' => [
                    
                ],
            ])
            //所在地・住所（市町村名）
            ->add('chainstore_address01', TextType::class,[
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //所在地・住所（番地・ビル名）
            ->add('chainstore_address02', TextType::class,[
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //所在地・住所(フリガナ)
            ->add('addr01_ka', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 200,
                    ]),
                ],
            ])
            //代表者名・氏名
            ->add('full_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //代表者名・氏名
            ->add('name', NameType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 100,
                    ]),
                ],
            ])
            //代表者名・氏名（フリガナ）
            ->add('kana', KanaType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 100,
                    ]),
                ],
            ])
            //固定電話
            ->add('contact_phone_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //携帯電話
            ->add('cellphone_number', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //仲介者 法人名・屋号
            ->add('mediator_company_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //仲介者 法人名・屋号（フリガナ）
            ->add('mediator_company_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //仲介者 代表者名・氏名
            ->add('mediator_fullname', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //仲介者 代表者名・氏名
            ->add('mediator_name', NameType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 100,
                    ]),
                ],
            ])
            //仲介者 代表者名・氏名（フリガナ）
            ->add('mediator_kana', KanaType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 100,
                    ]),
                ],
            ])
            //仲介者 所在地・住所
            ->add('mediator_address01', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //仲介者 ディーラーコード
            ->add('dealer_code', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 8,
                    ]),
                ],
            ])
            //仲介者 電話番号
            ->add('mediator_phone_number', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //取引口座選択
            ->add('chainStoreTradingAccountType', EntityType::class, [
                'required' => true,
                'class' => ChainStoreTradingAccountType::class,
                'placeholder' => 'common.select__chainstore_bank_trading_type',
                'choices' => $chainStoreTradingAccountType,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //金融機関名
            ->add('bank', BankType::class, [
                'required' => false,
                'constraints' => [
                    
                ],
            ])
            //支店名
            ->add('bank_branch', TextType::class, [
                'required' => false,
                'constraints' => [
                ],
            ])
            //預金種目
            ->add('bank_account_type', BankAccountTypeType::class, [
                'required' => false,
                'constraints' => [
                ],
            ])
            //通帳記号（下5桁）（ゆうちょ）
            ->add('code_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 5,
                    ]),
                    new Assert\Regex([
                        'pattern' => "/^\d+$/u",
                        'message' => 'form_error.numeric_only',
                    ])
                ],
            ])
            //通帳番号（8桁）（ゆうちょ）
            ->add('account_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 8,
                    ]),
                    new Assert\Regex([
                        'pattern' => "/^\d+$/u",
                        'message' => 'form_error.numeric_only',
                    ])
                ],
            ])
            //口座番号
            ->add('bank_account', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                    new Assert\Regex([
                        'pattern' => "/^\d+$/u",
                        'message' => 'form_error.numeric_only',
                    ])
                ],
            ])
            //口座名義
            ->add('bankHolderName', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                ],
            ])
            //口座名義（フリガナ）
            ->add('bank_holder', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                ],
            ])
            //販売店舗の関連性
            ->add('related_chainstore_type', EntityType::class, [
                'required' => false,
                'class' => RelatedChainStoreType::class,
                'placeholder' => 'common.select__related_chainstore_type',
                'choices' => $relatedChainStoreType,
                'constraints' => [
                ],
            ])
            //販売店の業務形態
            ->add('chainstore_business_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreBusinessType::class,
                'placeholder' => 'common.select__chainstore_business_type',
                'choices' => $chainStoreBusinessType,
                'constraints' => [
                ],
            ])
            //販売店舗の業務形態(その他)
            ->add('chainstore_business_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //販売店名
            ->add('chainstore_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //販売店名（フリガナ）
            ->add('chainstore_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //運営会社・運営者
            ->add('operating_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //運営会社・運営者（フリガナ）
            ->add('operating_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //提供方法
            ->add('chainstore_provide_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreProvideType::class,
                'placeholder' => 'common.select__chainstore_provide_type',
                'choices' => $chainStoreProvideType,
                'constraints' => [
                ],
            ])
            //提供スタイル
            ->add('chainstore_provide_style_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreProvideStyleType::class,
                'placeholder' => 'common.select__chainstore_provide_style_type',
                'choices' => $chainStoreProvideStyleType,
                'constraints' => [
                ],
            ])
            //販売店舗所在地：（郵便番号）
            ->add('postal_code', PostalType::class,[
                'required' => false,
            ])
            //販売店舗所在地：（都道府県）
            ->add('addr01', PrefType::class,[
                'required' => false,
                'attr' => ['class' => 'p-region-id'],
                'constraints' => [
                ],
            ])
            //販売店舗所在地：（市町村名）
            ->add('addr02', TextType::class,[
                'required' => false,
                'constraints' => [
                ],
            ])
            //販売店舗所在地：（番地・ビル名）
            ->add('addr03', TextType::class,[
                'required' => false,
                'constraints' => [
                ],
            ])
            //担当者名
            ->add('main_name', NameType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])      
            //担当者名 カナ
            ->add('main_kana', KanaType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])         
            //店舗連絡先（電話番号）
            ->add('phone_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //店舗メールアドレス
            ->add('chainstore_email', EmailType::class,[
                'required' => false,
                'constraints' => [
                    new Email(['strict' => $this->eccubeConfig['eccube_rfc_email_check']]),
                ],
                'attr' => [
                    'placeholder' => 'common.mail_address_sample',
                ],
            ])
            //WEBショップでダシーズの出品予定はありますか
            ->add('option_webshop', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'admin.common.select',
                'choices' => array_combine($yesorno_name, $yesorno_val),
            ])
            //ＷＥＢショップ店舗名
            ->add('webshop_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //出店WEBショップURL
            ->add('webshop_url', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //出店WEBショップの運営会社
            ->add('chain_store_web_shop_opening_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopOpeningType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopOpeningType,
            ])
            //出店WEBショップの運営会社(その他)
            ->add('chainstore_webshop_opening_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //WEBショップ運営担当者
            ->add('chain_store_web_shop_owner_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopOwnerType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopOwnerType,
            ]) 
            //上記WEBショップ運営担当者名
            ->add('webshop_main_operation_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ])
                ],
            ])
            //運営担当者電話番号
            ->add('chain_store_web_shop_phone_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopPhoneType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopPhoneType
            ])
            //運営担当者電話番号(その他)
            ->add('chainstore_webshop_phone_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //運営担当者メールアドレス
            ->add('chain_store_web_shop_email_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopEmailType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopEmailType
            ])
            //運営担当者メールアドレス(その他)
            ->add('chainstore_webshop_mail_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //パートナー指定
            ->add('option_partner', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'admin.common.select',
                'choices' => array_combine($yesorno2_name, $yesorno_val),
            ])
            //パートナー 法人名・屋号
            ->add('partner_company_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //パートナー 法人名・屋号（フリガナ）
            ->add('partner_company_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //パートナー 代表者名・氏名
            ->add('partner_name', NameType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //パートナー 代表者名・氏名（フリガナ）
            ->add('partner_kana', KanaType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //パートナー 固定電話
            ->add('partner_phone_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //この情報を基に契約書を作成します
            ->add('chain_store_make_contract_type', EntityType::class, [
                'required' => true,
                'class' => ChainStoreMakeContractType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreMakeContractType,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ]) 
            ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $ChainStore = $event->getData();
        }
        );

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            /** @var ChainStore $ChainStore */
            $ChainStore = $event->getData();
            
            if(!is_null($ChainStore->getBankHolder())){
                //「全角カタカナ」かチェックする
                if (!preg_match("/^[a-zA-Z0-9ァ-ヶーｱ-ﾝﾞﾟｧ-ｫｬ-ｮｰ　 ﾞﾟ\\\\｢｣\(\)\/\.\-]+$/u", $ChainStore->getBankHolder())) {
                    $form['bank_holder']->addError(new FormError("全角カタカナか半角カタカナか英数字かスペース ﾞ ﾟ \ ｢ ｣ ( ) / . - を入力してください。"));
                }
            }
            
            if ($ChainStore instanceof ChainStore) {
                $form = $event->getForm();
                //
                $ContractType = $ChainStore->getContractType();
                $ApplicantContractType = $ChainStore->getApplicantContractType();

                if (is_object($ApplicantContractType)) {
                    if ($ApplicantContractType->getId() == "1") {
                        if (trim($ChainStore->getCorporateNumber()) == "") {
                            $form['corporate_number']->addError(new FormError("入力されていません。"));
                        }
                    }
                    if ($ApplicantContractType->getId() != "3") {
                        if (trim($ChainStore->getCompanyName()) == "") {
                            $form['company_name']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getCompanyNameKana()) == "") {
                            $form['company_name_kana']->addError(new FormError("入力されていません。"));
                        }
                    }
                }

                if(is_object($ChainStore->getChainStoreTradingAccountType())){
                    //ゆうちょ銀行以外の銀行
                    if($ChainStore->getChainStoreTradingAccountType()->getId() == "1") {
                        if (!is_object($ChainStore->getBank())) {
                            $form['bank']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getBankBranch()) == "") {
                            $form['bank_branch']->addError(new FormError("入力されていません。"));
                        }
                        if (!is_object($ChainStore->getBankAccountType())) {
                            $form['bank_account_type']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getBankAccount()) == "") {
                            $form['bank_account']->addError(new FormError("入力されていません。"));
                        }
                    }
                    //ゆうちょ銀行
                    if($ChainStore->getChainStoreTradingAccountType()->getId() == "2") {
                        if (trim($ChainStore->getCodeNumber()) == "") {
                            $form['code_number']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getAccountNumber()) == "") {
                            $form['account_number']->addError(new FormError("入力されていません。"));
                        }
                    }
                }

                if ($ContractType->getId() != "1") {
                    if (trim($ChainStore->getOptionPartner()) == "") {
                        $form['option_partner']->addError(new FormError("入力されていません。"));
                    }

                    if (trim($ChainStore->getOptionPartner()) == "Y") {
                        if (trim($ChainStore->getPartnerName01()) == "") {
                            $form['partner_name.partner_name01']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getPartnerName02()) == "") {
                            $form['partner_name.partner_name02']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getPartnerKana01()) == "") {
                            $form['partner_name.partner_kana01']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getPartnerKana02()) == "") {
                            $form['partner_name.partner_kana02']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getPartnerPhoneNumber()) == "") {
                            $form['partner_phone_number']->addError(new FormError("入力されていません。"));
                        }
                    }
                }

                if ($ContractType->getId() != "2") {
                    if ($ContractType->getId() != "3") {
                        if (trim($ChainStore->getRelatedChainStoreType()) == "") {
                            $form['related_chainstore_type']->addError(new FormError("入力されていません。"));
                        }
                    }
                    if (trim($ChainStore->getChainStoreBusinessType()) == "") {
                        $form['chainstore_business_type']->addError(new FormError("入力されていません。"));
                    }else{
                        if ($ChainStore->getChainStoreBusinessType()->getId() == "3") {
                            if (trim($ChainStore->getChainstoreBusinessOtherType()) == "") {
                                $form['chainstore_business_other_type']->addError(new FormError("入力されていません。"));
                            }
                        }
                    }
                    if (trim($ChainStore->getChainstoreName()) == "") {
                        $form['chainstore_name']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getChainstoreNameKana()) == "") {
                        $form['chainstore_name_kana']->addError(new FormError("入力されていません。"));
                    }
                    if ($ContractType->getId() != "3") {
                        if (trim($ChainStore->getOperatingName()) == "") {
                            $form['operating_name']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getOperatingKana()) == "") {
                            $form['operating_kana']->addError(new FormError("入力されていません。"));
                        }
                    }
                    if (trim($ChainStore->getChainStoreProvideType()) == "") {
                        $form['chainstore_provide_type']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getChainStoreProvideStyleType()) == "") {
                        $form['chainstore_provide_style_type']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getPostalCode()) == "") {
                        $form['postal_code']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getAddr01()) == "") {
                        $form['addr01']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getAddr02()) == "") {
                        $form['addr02']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getAddr03()) == "") {
                        $form['addr03']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getMainName01()) == "") {
                        $form['main_name']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getMainName02()) == "") {
                        $form['main_name']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getMainKana01()) == "") {
                        $form['main_kana']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getMainKana02()) == "") {
                        $form['main_kana']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getPhoneNumber()) == "") {
                        $form['phone_number']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getChainstoreEmail()) == "") {
                        $form['chainstore_email']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($ChainStore->getOptionWebshop()) == "") {
                        $form['option_webshop']->addError(new FormError("入力されていません。"));
                    }

                    if (trim($ChainStore->getOptionWebshop()) == "Y") {
                        if (trim($ChainStore->getWebshopName()) == "") {
                            $form['webshop_name']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getWebshopUrl()) == "") {
                            $form['webshop_url']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getChainStoreWebShopOpeningType()) == "") {
                            $form['chain_store_web_shop_opening_type']->addError(new FormError("入力されていません。"));
                        }else{
                            if ($ChainStore->getChainStoreWebShopOpeningType()->getId() == "3") {
                                if (trim($ChainStore->getChainstoreWebshopOpeningOtherType()) == "") {
                                    $form['chainstore_webshop_opening_other_type']->addError(new FormError("入力されていません。"));
                                }
                            }
                        }
                        if (trim($ChainStore->getChainStoreWebShopOwnerType()) == "") {
                            $form['chain_store_web_shop_owner_type']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getWebshopMainOperationName()) == "") {
                            $form['webshop_main_operation_name']->addError(new FormError("入力されていません。"));
                        }
                        if (trim($ChainStore->getChainStoreWebShopPhoneType()) == "") {
                            $form['chain_store_web_shop_phone_type']->addError(new FormError("入力されていません。"));
                        }else{
                            if ($ChainStore->getChainStoreWebShopPhoneType()->getId() == "3") {
                                if (trim($ChainStore->getChainstoreWebshopPhoneOtherType()) == "") {
                                    $form['chainstore_webshop_phone_other_type']->addError(new FormError("入力されていません。"));
                                }
                            }
                        }
                        if (trim($ChainStore->getChainStoreWebShopEmailType()) == "") {
                            $form['chain_store_web_shop_email_type']->addError(new FormError("入力されていません。"));
                        }else{
                            if ($ChainStore->getChainStoreWebShopEmailType()->getId() == "3") {
                                if (trim($ChainStore->getChainstoreWebshopMailOtherType()) == "") {
                                    $form['chainstore_webshop_mail_other_type']->addError(new FormError("入力されていません。"));
                                }
                            }
                        }
                    }
                }
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Customize\Entity\ChainStore',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        // todo entry,mypageで共有されているので名前を変更する
        return 'entry_chainstore';
    }
}
