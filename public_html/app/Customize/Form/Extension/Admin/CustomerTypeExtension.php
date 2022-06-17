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

namespace Customize\Form\Extension\Admin;

use Eccube\Form\Type\Admin\CustomerType;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Customer;
use Eccube\Form\Type\AddressType;
use Eccube\Form\Type\KanaType;
use Customize\Form\Type\ChainStoreDropDownType;
use Eccube\Form\Type\Master\CustomerStatusType;
use Eccube\Form\Type\Master\JobType;
use Eccube\Form\Type\Master\SexType;
use Eccube\Form\Type\NameType;
use Eccube\Form\Type\PhoneNumberType;
use Eccube\Form\Type\PostalType;
use Eccube\Form\Type\RepeatedPasswordType;
use Eccube\Form\Validator\Email;
use Eccube\Repository\CustomerRepository;
use Customize\Repository\ChainStoreRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CustomerTypeExtension extends AbstractTypeExtension
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var ChainStoreRepository
     */
    protected $chainstoreRepository;

    public function __construct(
        EccubeConfig $eccubeConfig,
        CustomerRepository $customerRepository,
        ChainStoreRepository $chainstoreRepository)
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->customerRepository = $customerRepository;
        $this->chainstoreRepository = $chainstoreRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chain_store', ChainStoreDropDownType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => $this->eccubeConfig['eccube_stext_len'],
                    ]),
                ],
            ]);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $Customer = $event->getData();

            // ポイント数が入力されていない場合0を登録
            if (is_null($Customer->getPoint())) {
                $Customer->setPoint(0);
            }

            if (is_object($Customer->getChainStore())){
                $ChainStore = $Customer->getChainStore();
                $Customers = $this->customerRepository->findBy(["ChainStore" => $ChainStore]);
                $isRegistered = false;

                foreach($Customers as $cus)
                {
                    if($cus->getId() != $Customer->getId()){
                        $isRegistered = true;
                        break;
                    }
                }
                
                if($isRegistered){
                    $form['chain_store']->addError(new FormError(trans('admin.chainstore.has_registered')));
                }
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return CustomerType::class;
    }

    public function getExtendedTypes()
    {
        return [CustomerType::class];
    }
}
