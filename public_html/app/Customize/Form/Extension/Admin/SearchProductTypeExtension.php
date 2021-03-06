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

use Eccube\Form\Type\Admin\SearchProductType;
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
use Eccube\Form\Type\ToggleSwitchType;
use Eccube\Form\Validator\Email;
use Eccube\Repository\CustomerRepository;
use Customize\Repository\ChainStoreRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SearchProductTypeExtension extends AbstractTypeExtension
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
        //?????? => ASC ; ?????? => DESC
        $fields_name = array("???????????????", "???????????????", "???????????????", "???????????????");
        $fields_val = array("2", "1", "4", "3");

        //?????????????????????
        $builder
            ->add('field_sort', ChoiceType::class, [
                'label' => '',
                'required' => true,
                'choices' => array_combine($fields_name, $fields_val),
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return SearchProductType::class;
    }

    public function getExtendedTypes()
    {
        return [SearchProductType::class];
    }
}
