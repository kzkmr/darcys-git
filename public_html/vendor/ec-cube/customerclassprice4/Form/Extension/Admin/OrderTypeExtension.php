<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Form\Extension\Admin;


use Eccube\Form\Type\Admin\OrderType;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;


class OrderTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plgCcpCustomerClass', EntityType::class, [
                'label' => '会員種別',
                'class' => CustomerClass::class,
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'common.select__unspecified',
                'required' => false,
                'eccube_form_options' => [
                    'auto_render' => true,
                ],
            ]);
    }

    /**
     * @return string
     */
    public function getExtendedType()
    {
        return OrderType::class;
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        return [OrderType::class];
    }
}
