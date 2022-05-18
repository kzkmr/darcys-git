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

namespace Plugin\DeliveryPlus4\Form\Type\Admin;

use Plugin\DeliveryPlus4\Entity\DeliveryPlusConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

class ConfigType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $methodChoices = [
            DeliveryPlusConfig::ALL => trans('deliveryplus.form.admin.config.method.choice.all'),
            DeliveryPlusConfig::SHIPPING => trans('deliveryplus.form.admin.config.method.choice.shipping'),
            ];

        $builder
            ->add('method', Type\ChoiceType::class, [
                'label' => 'deliveryplus.admin.config.label',
                'required' => true,
                'choices' => array_flip($methodChoices),
                'multiple' => false,
                'expanded' => false,
            ])
        ;

    }
}
