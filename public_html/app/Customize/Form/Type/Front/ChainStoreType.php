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
use Eccube\Form\Type\RepeatedEmailType;
use Eccube\Form\Type\RepeatedPasswordType;
use Customize\Form\Type\NorequiredRepeatedEmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

        $yesorno_name = array("??????", "??????");
        $yesorno2_name = array("??????", "??????");
        $yesorno_val = array("N", "Y");

        $builder
            ->add('pre_chainstore', TextType::class, [
                'required' => false,
            ])
            //????????????
            ->add('contract_type', EntityType::class, [
                'required' => true,
                'class' => ContractType::class,
                'choices' => $contractType,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //??????????????????
            ->add('contract_begin_ymd', BirthdayType::class, [
                'required' => true,
                'years' => range((date("Y")+1), 2021 ),
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //????????????????????????
            ->add('applicant_contract_type', EntityType::class, [
                'required' => true,
                'class' => ApplicantContractType::class,
                'placeholder' => 'common.select__applicant_contract_type',
                'choices' => $applicantContractType,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //????????????
            ->add('corporate_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //?????????????????????
            ->add('timestamp', DateTimeType::class, [
                'required' => false,
                'constraints' => [
                ],
            ])
            //????????????
            ->add('stock_number', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 10,
                    ]),
                ],
            ])
            //??????????????????
            ->add('company_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //????????????????????????????????????
            ->add('company_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //????????????????????????
            ->add('begin_day', BirthdayType::class, [
                'required' => false,
                'years' => range((date("Y")+1), 1900 ),
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
            //????????????????????????
            ->add('chainstore_postal_code', PostalType::class)
            //????????????????????????????????????
            ->add('chainstore_pref', PrefType::class,[
                'required' => true,
                'attr' => ['class' => 'p-region-id'],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //??????????????????
            ->add('chainstore_address_full', TextType::class,[
                'required' => false,
                'constraints' => [
                    
                ],
            ])
            //????????????????????????????????????
            ->add('chainstore_address01', TextType::class,[
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //??????????????????????????????????????????
            ->add('chainstore_address02', TextType::class,[
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            //??????????????????(????????????)
            ->add('addr01_ka', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 200,
                    ]),
                ],
            ])
            //?????????????????????
            ->add('full_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //?????????????????????
            ->add('name', NameType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 100,
                    ]),
                ],
            ])
            //???????????????????????????????????????
            ->add('kana', KanaType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 100,
                    ]),
                ],
            ])
            //????????????
            ->add('contact_phone_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //????????????
            ->add('cellphone_number', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //????????? ??????????????????
            ->add('mediator_company_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //????????? ????????????????????????????????????
            ->add('mediator_company_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //????????? ?????????????????????
            ->add('mediator_fullname', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //????????? ?????????????????????
            ->add('mediator_name', NameType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 50,
                    ]),
                ],
            ])
            //????????? ???????????????????????????????????????
            ->add('mediator_kana', KanaType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 50,
                    ]),
                ],
            ])
            //????????? ??????????????????
            ->add('mediator_address01', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //????????? ????????????????????????
            ->add('dealer_code', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 8,
                    ]),
                ],
            ])
            //????????? ????????????
            ->add('mediator_phone_number', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //??????????????????
            ->add('chainStoreTradingAccountType', EntityType::class, [
                'required' => false,
                'class' => ChainStoreTradingAccountType::class,
                'placeholder' => 'common.select__chainstore_bank_trading_type',
                'choices' => $chainStoreTradingAccountType,
                'constraints' => [
                ],
            ])
            //???????????????
            ->add('bank', BankType::class, [
                'required' => false,
                'constraints' => [
                    
                ],
            ])
            //?????????
            ->add('bank_branch', TextType::class, [
                'required' => false,
                'constraints' => [
                ],
            ])
            //????????????
            ->add('bank_account_type', BankAccountTypeType::class, [
                'required' => false,
                'constraints' => [
                ],
            ])
            //??????????????????5????????????????????????
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
            //???????????????8????????????????????????
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
            //????????????
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
            //????????????
            ->add('bankHolderName', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                ],
            ])
            //??????????????????????????????
            ->add('bank_holder', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                ],
            ])
            //????????????????????????
            ->add('related_chainstore_type', EntityType::class, [
                'required' => false,
                'class' => RelatedChainStoreType::class,
                'placeholder' => 'common.select__related_chainstore_type',
                'choices' => $relatedChainStoreType,
                'constraints' => [
                ],
            ])
            //????????????????????????
            ->add('chainstore_business_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreBusinessType::class,
                'placeholder' => 'common.select__chainstore_business_type',
                'choices' => $chainStoreBusinessType,
                'constraints' => [
                ],
            ])
            //???????????????????????????(?????????)
            ->add('chainstore_business_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //????????????
            ->add('chainstore_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //??????????????????????????????
            ->add('chainstore_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //????????????????????????
            ->add('operating_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //??????????????????????????????????????????
            ->add('operating_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //????????????
            ->add('chainstore_provide_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreProvideType::class,
                'placeholder' => 'common.select__chainstore_provide_type',
                'choices' => $chainStoreProvideType,
                'constraints' => [
                ],
            ])
            //??????????????????
            ->add('chainstore_provide_style_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreProvideStyleType::class,
                'placeholder' => 'common.select__chainstore_provide_style_type',
                'choices' => $chainStoreProvideStyleType,
                'constraints' => [
                ],
            ])
            //??????????????????????????????????????????
            ->add('postal_code', PostalType::class,[
                'required' => false,
            ])
            //??????????????????????????????????????????
            ->add('addr01', PrefType::class,[
                'required' => false,
                'attr' => ['class' => 'p-region-id'],
                'constraints' => [
                ],
            ])
            //??????????????????????????????????????????
            ->add('addr02', TextType::class,[
                'required' => false,
                'constraints' => [
                ],
            ])
            //????????????????????????????????????????????????
            ->add('addr03', TextType::class,[
                'required' => false,
                'constraints' => [
                ],
            ])
            //????????????
            ->add('main_name', NameType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])      
            //???????????? ??????
            ->add('main_kana', KanaType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])         
            //?????????????????????????????????
            ->add('phone_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //???????????????????????????
            ->add('chainstore_email', NorequiredRepeatedEmailType::class,[
                'required' => false
            ])
            //WEB????????????????????????????????????????????????????????????
            ->add('option_webshop', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'admin.common.select',
                'choices' => array_combine($yesorno_name, $yesorno_val),
            ])
            //??????????????????????????????
            ->add('webshop_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ]),
                ],
            ])
            //??????WEB????????????URL
            ->add('webshop_url', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //??????WEB???????????????????????????
            ->add('chain_store_web_shop_opening_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopOpeningType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopOpeningType,
            ])
            //??????WEB???????????????????????????(?????????)
            ->add('chainstore_webshop_opening_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //WEB???????????????????????????
            ->add('chain_store_web_shop_owner_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopOwnerType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopOwnerType,
            ]) 
            //??????WEB??????????????????????????????
            ->add('webshop_main_operation_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ])
                ],
            ])
            //???????????????????????????
            ->add('chain_store_web_shop_phone_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopPhoneType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopPhoneType
            ])
            //???????????????????????????(?????????)
            ->add('chainstore_webshop_phone_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //????????????????????????????????????
            ->add('chain_store_web_shop_email_type', EntityType::class, [
                'required' => false,
                'class' => ChainStoreWebShopEmailType::class,
                'placeholder' => 'admin.common.select',
                'choices' => $chainStoreWebShopEmailType
            ])
            //????????????????????????????????????(?????????)
            ->add('chainstore_webshop_mail_other_type', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ],
            ])
            //?????????????????????
            ->add('option_partner', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'admin.common.select',
                'choices' => array_combine($yesorno2_name, $yesorno_val),
            ])
            //??????????????? ??????????????????
            ->add('partner_company_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //??????????????? ????????????????????????????????????
            ->add('partner_company_name_kana', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //??????????????? ?????????????????????
            ->add('partner_name', NameType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //??????????????? ???????????????????????????????????????
            ->add('partner_kana', KanaType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 150,
                    ])
                ],
            ])
            //??????????????? ????????????
            ->add('partner_phone_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                    ]),
                ],
            ])
            //????????????????????????????????????????????????
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
            if ($ChainStore instanceof ChainStore) {
                $form = $event->getForm();
                //
                $ContractType = $ChainStore->getContractType();
                $ApplicantContractType = $ChainStore->getApplicantContractType();

                if (is_object($ApplicantContractType)) {
                    if ($ApplicantContractType->getId() == "1") {
                        if (trim($ChainStore->getCorporateNumber()) == "") {
                            $form['corporate_number']->addError(new FormError("??????????????????????????????"));
                        }
                    }
                    if ($ApplicantContractType->getId() != "3") {
                        if (trim($ChainStore->getCompanyName()) == "") {
                            $form['company_name']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getCompanyNameKana()) == "") {
                            $form['company_name_kana']->addError(new FormError("??????????????????????????????"));
                        }
                    }
                }

                if ($ContractType->getId() != "1") {
                    if (trim($ChainStore->getOptionPartner()) == "") {
                        $form['option_partner']->addError(new FormError("??????????????????????????????"));
                    }

                    if (trim($ChainStore->getOptionPartner()) == "Y") {
                        if (trim($ChainStore->getPartnerName01()) == "") {
                            $form['partner_name01']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getPartnerName02()) == "") {
                            $form['partner_name02']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getPartnerKana01()) == "") {
                            $form['partner_kana01']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getPartnerKana02()) == "") {
                            $form['partner_kana02']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getPartnerPhoneNumber()) == "") {
                            $form['partner_phone_number']->addError(new FormError("??????????????????????????????"));
                        }
                    }
                }

                if ($ContractType->getId() != "2") {
                    if ($ContractType->getId() != "3") {
                        if (trim($ChainStore->getRelatedChainStoreType()) == "") {
                            $form['related_chainstore_type']->addError(new FormError("??????????????????????????????"));
                        }
                    }
                    if (trim($ChainStore->getChainStoreBusinessType()) == "") {
                        $form['chainstore_business_type']->addError(new FormError("??????????????????????????????"));
                    }else{
                        if ($ChainStore->getChainStoreBusinessType() == "3") {
                            if (trim($ChainStore->getChainstoreBusinessOtherType()) == "") {
                                $form['chainstore_business_other_type']->addError(new FormError("??????????????????????????????"));
                            }
                        }
                    }
                    if (trim($ChainStore->getChainstoreName()) == "") {
                        $form['chainstore_name']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getChainstoreNameKana()) == "") {
                        $form['chainstore_name_kana']->addError(new FormError("??????????????????????????????"));
                    }
                    if ($ContractType->getId() != "3") {
                        if (trim($ChainStore->getOperatingName()) == "") {
                            $form['operating_name']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getOperatingKana()) == "") {
                            $form['operating_kana']->addError(new FormError("??????????????????????????????"));
                        }
                    }
                    if (trim($ChainStore->getChainStoreProvideType()) == "") {
                        $form['chainstore_provide_type']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getChainStoreProvideStyleType()) == "") {
                        $form['chainstore_provide_style_type']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getPostalCode()) == "") {
                        $form['postal_code']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getAddr01()) == "") {
                        $form['addr01']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getAddr02()) == "") {
                        $form['addr02']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getAddr03()) == "") {
                        $form['addr03']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getMainName01()) == "" || trim($ChainStore->getMainName02()) == "") {
                        $form['main_name']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getMainKana01()) == "" || trim($ChainStore->getMainKana02()) == "") {
                        $form['main_kana']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getPhoneNumber()) == "") {
                        $form['phone_number']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getChainstoreEmail()) == "") {
                        $form['chainstore_email']->addError(new FormError("??????????????????????????????"));
                    }
                    if (trim($ChainStore->getOptionWebshop()) == "") {
                        $form['option_webshop']->addError(new FormError("??????????????????????????????"));
                    }

                    if (trim($ChainStore->getOptionWebshop()) == "Y") {
                        if (trim($ChainStore->getWebshopName()) == "") {
                            $form['webshop_name']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getWebshopUrl()) == "") {
                            $form['webshop_url']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getChainStoreWebShopOpeningType()) == "") {
                            $form['chain_store_web_shop_opening_type']->addError(new FormError("??????????????????????????????"));
                        }else{
                            if ($ChainStore->getChainStoreWebShopOpeningType() == "3") {
                                if (trim($ChainStore->getChainstoreWebshopOpeningOtherType()) == "") {
                                    $form['chainstore_webshop_opening_other_type']->addError(new FormError("??????????????????????????????"));
                                }
                            }
                        }
                        if (trim($ChainStore->getChainStoreWebShopOwnerType()) == "") {
                            $form['chain_store_web_shop_owner_type']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getWebshopMainOperationName()) == "") {
                            $form['webshop_main_operation_name']->addError(new FormError("??????????????????????????????"));
                        }
                        if (trim($ChainStore->getChainStoreWebShopPhoneType()) == "") {
                            $form['chain_store_web_shop_phone_type']->addError(new FormError("??????????????????????????????"));
                        }else{
                            if ($ChainStore->getChainStoreWebShopPhoneType() == "3") {
                                if (trim($ChainStore->getChainstoreWebshopPhoneOtherType()) == "") {
                                    $form['chainstore_webshop_phone_other_type']->addError(new FormError("??????????????????????????????"));
                                }
                            }
                        }
                        if (trim($ChainStore->getChainStoreWebShopEmailType()) == "") {
                            $form['chain_store_web_shop_email_type']->addError(new FormError("??????????????????????????????"));
                        }else{
                            if ($ChainStore->getChainStoreWebShopEmailType() == "3") {
                                if (trim($ChainStore->getChainstoreWebshopMailOtherType()) == "") {
                                    $form['chainstore_webshop_mail_other_type']->addError(new FormError("??????????????????????????????"));
                                }
                            }
                        }
                    }
                }
            }
        }
        );

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            /** @var ChainStore $ChainStore */
            $ChainStore = $event->getData();
            
            if(!is_null($ChainStore->getBankHolder())){
                //?????????????????????????????????????????????
                if (!preg_match("/^[a-zA-Z0-9???-?????????-????????????-??????-????????? ??????\\\\??????\(\)\/\.\-]+$/u", $ChainStore->getBankHolder())) {
                    $form['bank_holder']->addError(new FormError("?????????????????????????????????????????????????????????????????? ??? ??? \ ??? ??? ( ) / . - ??????????????????????????????"));
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
        // todo entry,mypage???????????????????????????????????????????????????
        return 'entry_chainstore';
    }
}
