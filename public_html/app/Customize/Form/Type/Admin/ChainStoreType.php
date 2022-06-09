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

namespace Customize\Form\Type\Admin;

use Eccube\Common\EccubeConfig;
use Customize\Entity\ChainStore;
use Customize\Entity\Master\ContractType;
use Eccube\Form\Type\AddressType;
use Eccube\Form\Type\KanaType;
use Customize\Form\Type\Master\BankType;
use Customize\Form\Type\Master\BankBranchType;
use Customize\Form\Type\Master\BankAccountTypeType;
use Customize\Form\Type\Master\ContractTypeType;
use Customize\Form\Type\Master\ChainStoreStatusType;
use Customize\Repository\Master\ContractTypeRepository;
use Eccube\Form\Type\Master\JobType;
use Eccube\Form\Type\Master\SexType;
use Eccube\Form\Type\NameType;
use Eccube\Form\Type\PhoneNumberType;
use Eccube\Form\Type\PostalType;
use Eccube\Form\Validator\Email;
use Eccube\Form\Type\ToggleSwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Eccube\Form\Type\PriceType;
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
     * ChainStoreType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(
                        EccubeConfig $eccubeConfig,
                        ContractTypeRepository $contractTypeRepository)
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->contractTypeRepository = $contractTypeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $contractType = $this->contractTypeRepository->findBy(['is_hidden' => 'N'], ['sort_no' => 'ASC']);

        $builder
            ->add('name', NameType::class, [
                'required' => false,
            ])
            ->add('kana', KanaType::class, [
                'required' => false,
            ])
            ->add('company_name', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                ],
            ])
            ->add('company_name_kana', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                ],
            ])
            ->add('stock_number', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 10,
                    ]),
                ],
            ])
            ->add('contract_type', EntityType::class, [
                'required' => true,
                'class' => ContractType::class,
                'choices' => $contractType,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('contract_begin_ymd', BirthdayType::class, [
                'required' => true,
                'years' => range(2021, (date("Y")+1) ),
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('status', ChainStoreStatusType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('option_order_limit', ToggleSwitchType::class)
            ->add('order_limit_text', TextareaType::class, [
                'required' => false,
            ])
            ->add('bank', BankType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('bank_branch', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('bank_account_type', BankAccountTypeType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('bank_account', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 15,
                    ]),
                    new Assert\Regex([
                        'pattern' => "/^\d+$/u",
                        'message' => 'form_error.numeric_only',
                    ])
                ],
            ])
            ->add('bank_holder', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('dealer_code', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 8,
                    ]),
                ],
            ])
            ->add('margin_price', PriceType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('purchasing_limit_price', PriceType::class, [
                'required' => false
            ])
            ->add('delivery_registrations', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('note', TextareaType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_ltext_len'],
                    ]),
                ],
            ]);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            /** @var ChainStore $ChainStore */
            $ChainStore = $event->getData();
            
            if ($ChainStore->isOptionOrderLimit()) {
                if (trim($ChainStore->getOrderLimitText() == "")) {
                    $form['order_limit_text']->addError(new FormError("入力されていません。"));
                }
            }

            if (is_object($ChainStore->getContractType())) {
                $ContractType = $ChainStore->getContractType();
                if ($ContractType->getId() == "3") {
                    if ($ChainStore->getPurchasingLimitPrice() < 0) {
                        $form['purchasing_limit_price']->addError(new FormError("入力されていません。"));
                    }
                }
            }
        });

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $ChainStore = $event->getData();

            // ポイント数が入力されていない場合0を登録
            if (is_null($ChainStore->getPoint())) {
                $ChainStore->setPoint(0);
            }

            if(!is_null($ChainStore->getBankHolder())){
                //「全角カタカナ」かチェックする
                if (!preg_match("/^[a-zA-Z0-9ァ-ヶーｱ-ﾝﾞﾟｧ-ｫｬ-ｮｰ　 ﾞﾟ\\\\｢｣\(\)\/\.\-]+$/u", $ChainStore->getBankHolder())) {
                    $form['bank_holder']->addError(new FormError("全角カタカナか半角カタカナか英数字かスペース ﾞ ﾟ \ ｢ ｣ ( ) / . - を入力してください。"));
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
        return 'admin_chain_store';
    }
}
