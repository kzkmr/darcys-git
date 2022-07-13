<?php
/*
* Plugin Name : DeliveryPlus4
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\DeliveryPlus4\Form\Extension;

use Eccube\Form\Type\Admin\ProductClassEditType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Validator\Constraints as Assert;

class ProductClassEditExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'deliveryplus_weight',
                Type\NumberType::class,
                [
                    'label' => trans('deliveryplus.common.1'),
                    'required' => false,
                    'constraints' => [
                        new Assert\Regex([
                            'pattern' => "/^([1-9]\d*|0)(\.\d+)?$/u",
                            'message' => 'form.type.numeric.invalid'
                        ]),
                    ],
                ]
            )
            ->add(
                'deliveryplus_size',
                Type\NumberType::class,
                [
                    'label' => trans('deliveryplus.common.2'),
                    'required' => false,
                    'constraints' => [
                        new Assert\Regex([
                            'pattern' => "/^([1-9]\d*|0)(\.\d+)?$/u",
                            'message' => 'form.type.numeric.invalid'
                        ]),
                    ],
                ]
            );

    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return ProductClassEditType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductClassEditType::class];
    }
}
