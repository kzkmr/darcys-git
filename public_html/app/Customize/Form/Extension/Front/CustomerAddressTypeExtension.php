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

namespace Customize\Form\Extension\Front;

use Eccube\Form\Type\Front\CustomerAddressType;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Customer;
use Eccube\Form\Type\AddressType;
use Eccube\Form\Type\KanaType;
use Eccube\Form\Type\Master\JobType;
use Eccube\Form\Type\Master\SexType;
use Eccube\Form\Type\NameType;
use Eccube\Form\Type\PhoneNumberType;
use Eccube\Form\Type\PostalType;
use Eccube\Form\Type\RepeatedEmailType;
use Eccube\Form\Type\RepeatedPasswordType;
use Customize\Entity\Master\RelatedChainStoreType;
use Customize\Entity\Master\ChainStoreBusinessType;
use Customize\Entity\Master\ChainStoreProvideType;
use Customize\Entity\Master\ChainStoreProvideStyleType;
use Customize\Entity\Master\ChainStoreWebShopOpeningType;
use Customize\Entity\Master\ChainStoreWebShopOwnerType;
use Customize\Entity\Master\ChainStoreWebShopPhoneType;
use Customize\Entity\Master\ChainStoreWebShopEmailType;
use Customize\Form\Type\Front\ChainStoreType;
use Customize\Repository\Master\RelatedChainStoreTypeRepository;
use Customize\Repository\Master\ChainStoreBusinessTypeRepository;
use Customize\Repository\Master\ChainStoreProvideTypeRepository;
use Customize\Repository\Master\ChainStoreProvideStyleTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopOpeningTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopOwnerTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopPhoneTypeRepository;
use Customize\Repository\Master\ChainStoreWebShopEmailTypeRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Customize\Form\Type\NorequiredRepeatedEmailType;
use Eccube\Form\Validator\Email;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints as Assert;

class CustomerAddressTypeExtension extends AbstractTypeExtension
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

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

    private $security;

    /**
     * EntryType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(EccubeConfig $eccubeConfig,
                                Security $security,
                                RelatedChainStoreTypeRepository $relatedChainStoreTypeRepository,
                                ChainStoreBusinessTypeRepository $chainStoreBusinessTypeRepository,
                                ChainStoreProvideTypeRepository $chainStoreProvideTypeRepository,
                                ChainStoreProvideStyleTypeRepository $chainStoreProvideStyleTypeRepository,
                                ChainStoreWebShopOpeningTypeRepository $chainStoreWebShopOpeningTypeRepository,
                                ChainStoreWebShopOwnerTypeRepository $chainStoreWebShopOwnerTypeRepository,
                                ChainStoreWebShopPhoneTypeRepository $chainStoreWebShopPhoneTypeRepository,
                                ChainStoreWebShopEmailTypeRepository $chainStoreWebShopEmailTypeRepository)
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->security = $security;
        $this->relatedChainStoreTypeRepository = $relatedChainStoreTypeRepository;
        $this->chainStoreBusinessTypeRepository = $chainStoreBusinessTypeRepository;
        $this->chainStoreProvideTypeRepository = $chainStoreProvideTypeRepository;
        $this->chainStoreProvideStyleTypeRepository = $chainStoreProvideStyleTypeRepository;
        $this->chainStoreWebShopOpeningTypeRepository = $chainStoreWebShopOpeningTypeRepository;
        $this->chainStoreWebShopOwnerTypeRepository = $chainStoreWebShopOwnerTypeRepository;
        $this->chainStoreWebShopPhoneTypeRepository = $chainStoreWebShopPhoneTypeRepository;
        $this->chainStoreWebShopEmailTypeRepository = $chainStoreWebShopEmailTypeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $relatedChainStoreType = $this->relatedChainStoreTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreBusinessType = $this->chainStoreBusinessTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreProvideType = $this->chainStoreProvideTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreProvideStyleType = $this->chainStoreProvideStyleTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopOpeningType = $this->chainStoreWebShopOpeningTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopOwnerType = $this->chainStoreWebShopOwnerTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopPhoneType = $this->chainStoreWebShopPhoneTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $chainStoreWebShopEmailType = $this->chainStoreWebShopEmailTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $yesorno_name = array("なし", "あり");
        $yesorno2_name = array("なし", "あり");
        $yesorno_val = array("N", "Y");

        $builder
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
        ;
        
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $CustomerAddress = $event->getData();
            $Customer = $this->security->getUser();
            $ChainStore = $Customer->getChainStore();
            if (is_object($ChainStore)) {
                $ContractType = $ChainStore->getContractType();

                if ($ContractType->getId() != "3") {
                    if (trim($CustomerAddress->getRelatedChainStoreType()) == "") {
                        $form['related_chainstore_type']->addError(new FormError("入力されていません。"));
                    }
                }
                if (trim($CustomerAddress->getChainStoreBusinessType()) == "") {
                    $form['chainstore_business_type']->addError(new FormError("入力されていません。"));
                }else{
                    if ($CustomerAddress->getChainStoreBusinessType()->getId() == "3") {
                        if (trim($CustomerAddress->getChainstoreBusinessOtherType()) == "") {
                            $form['chainstore_business_other_type']->addError(new FormError("入力されていません。"));
                        }
                    }
                }
                if (trim($CustomerAddress->getCompanyName()) == "") {
                    $form['company_name']->addError(new FormError("入力されていません。"));
                }
                if (trim($CustomerAddress->getChainstoreNameKana()) == "") {
                    $form['chainstore_name_kana']->addError(new FormError("入力されていません。"));
                }
                if ($ContractType->getId() != "3") {
                    if (trim($CustomerAddress->getOperatingName()) == "") {
                        $form['operating_name']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($CustomerAddress->getOperatingKana()) == "") {
                        $form['operating_kana']->addError(new FormError("入力されていません。"));
                    }
                }
                if (trim($CustomerAddress->getChainStoreProvideType()) == "") {
                    $form['chainstore_provide_type']->addError(new FormError("入力されていません。"));
                }
                if (trim($CustomerAddress->getChainStoreProvideStyleType()) == "") {
                    $form['chainstore_provide_style_type']->addError(new FormError("入力されていません。"));
                }
                if (trim($CustomerAddress->getPhoneNumber()) == "") {
                    $form['phone_number']->addError(new FormError("入力されていません。"));
                }
                if (trim($CustomerAddress->getChainstoreEmail()) == "") {
                    $form['chainstore_email']->addError(new FormError("入力されていません。"));
                }
                if (trim($CustomerAddress->getOptionWebshop()) == "") {
                    $form['option_webshop']->addError(new FormError("入力されていません。"));
                }

                if (trim($CustomerAddress->getOptionWebshop()) == "Y") {
                    if (trim($CustomerAddress->getWebshopName()) == "") {
                        $form['webshop_name']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($CustomerAddress->getWebshopUrl()) == "") {
                        $form['webshop_url']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($CustomerAddress->getChainStoreWebShopOpeningType()) == "") {
                        $form['chain_store_web_shop_opening_type']->addError(new FormError("入力されていません。"));
                    }else{
                        if ($CustomerAddress->getChainStoreWebShopOpeningType()->getId() == "3") {
                            if (trim($CustomerAddress->getChainstoreWebshopOpeningOtherType()) == "") {
                                $form['chainstore_webshop_opening_other_type']->addError(new FormError("入力されていません。"));
                            }
                        }
                    }
                    if (trim($CustomerAddress->getChainStoreWebShopOwnerType()) == "") {
                        $form['chain_store_web_shop_owner_type']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($CustomerAddress->getWebshopMainOperationName()) == "") {
                        $form['webshop_main_operation_name']->addError(new FormError("入力されていません。"));
                    }
                    if (trim($CustomerAddress->getChainStoreWebShopPhoneType()) == "") {
                        $form['chain_store_web_shop_phone_type']->addError(new FormError("入力されていません。"));
                    }else{
                        if ($CustomerAddress->getChainStoreWebShopPhoneType()->getId() == "3") {
                            if (trim($CustomerAddress->getChainstoreWebshopPhoneOtherType()) == "") {
                                $form['chainstore_webshop_phone_other_type']->addError(new FormError("入力されていません。"));
                            }
                        }
                    }
                    if (trim($CustomerAddress->getChainStoreWebShopEmailType()) == "") {
                        $form['chain_store_web_shop_email_type']->addError(new FormError("入力されていません。"));
                    }else{
                        if ($CustomerAddress->getChainStoreWebShopEmailType()->getId() == "3") {
                            if (trim($CustomerAddress->getChainstoreWebshopMailOtherType()) == "") {
                                $form['chainstore_webshop_mail_other_type']->addError(new FormError("入力されていません。"));
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
    public function getExtendedType()
    {
        return CustomerAddressType::class;
    }

    public function getExtendedTypes()
    {
        return [CustomerAddressType::class];
    }
}
