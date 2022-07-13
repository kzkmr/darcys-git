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

use Eccube\Form\Type\Admin\DeliveryType;
use Eccube\Form\Type\PriceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Validator\Constraints as Assert;

class DeliveryExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'deliveryplus_weight_min',
                Type\NumberType::class,
                [
                    'label' => trans('deliveryplus.admin.setting.shop.delivery.delivery_condition.form.weight.under'),
                    'required' => false,
                    'constraints' => [
                        new Assert\Regex([
                            'pattern' => "/^([1-9]\d*|0)(\.\d+)?$/u",
                            'message' => 'form.type.numeric.invalid'
                        ]),
                        new Assert\GreaterThanOrEqual(['value' => 0]),
                    ],
                ]
            )
            ->add(
                'deliveryplus_weight_max',
                Type\NumberType::class,
                [
                    'label' => trans('deliveryplus.admin.setting.shop.delivery.delivery_condition.form.weight.upper'),
                    'required' => false,
                    'constraints' => [
                        new Assert\Regex([
                            'pattern' => "/^([1-9]\d*|0)(\.\d+)?$/u",
                            'message' => 'form.type.numeric.invalid'
                        ]),
                        new Assert\GreaterThanOrEqual(['value' => 0]),
                    ],
                ]
            )
            ->add(
                'deliveryplus_size_min',
                Type\NumberType::class,
                [
                    'label' => trans('deliveryplus.admin.setting.shop.delivery.delivery_condition.form.size.under'),
                    'required' => false,
                    'constraints' => [
                        new Assert\Regex([
                            'pattern' => "/^([1-9]\d*|0)(\.\d+)?$/u",
                            'message' => 'form.type.numeric.invalid'
                        ]),
                        new Assert\GreaterThanOrEqual(['value' => 0]),
                    ],
                ]
            )
            ->add(
                'deliveryplus_size_max',
                Type\NumberType::class,
                [
                    'label' => trans('deliveryplus.admin.setting.shop.delivery.delivery_condition.form.size.upper'),
                    'required' => false,
                    'constraints' => [
                        new Assert\Regex([
                            'pattern' => "/^([1-9]\d*|0)(\.\d+)?$/u",
                            'message' => 'form.type.numeric.invalid'
                        ]),
                        new Assert\GreaterThanOrEqual(['value' => 0]),
                    ],
                ]
            )
            ->add(
                'deliveryplus_subtotal_min',
                PriceType::class,
                [
                    'label' => trans('deliveryplus.admin.setting.shop.delivery.delivery_condition.form.subtotal.under'),
                    'required' => false,
                ]
            )
            ->add(
                'deliveryplus_subtotal_max',
                PriceType::class,
                [
                    'label' => trans('deliveryplus.admin.setting.shop.delivery.delivery_condition.form.subtotal.upper'),
                    'required' => false,
                ]
            );

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $Delivery = $event->getData();
                $form = $event->getForm();
                if (is_null($Delivery)) {
                    return;
                }
                if(method_exists($Delivery, 'getDeliveryCoolFlg')){
                    $form
                        ->add(
                            'delivery_cool_flg',
                            Type\CheckboxType::class,
                            [
                                'label' => trans('deliverydate.admin.setting.shop.delivery.delivery_condition.form.cool_flg'),
                                'required' => false
                            ]
                        );
                }
            });

        $builder
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();

                $deliveryplus_weight_min = $form['deliveryplus_weight_min']->getData();
                $deliveryplus_weight_max = $form['deliveryplus_weight_max']->getData();
                if(strlen($deliveryplus_weight_min) > 0 && strlen($deliveryplus_weight_max) > 0 && $deliveryplus_weight_min > $deliveryplus_weight_max){
                    $form['deliveryplus_weight_min']->addError(new FormError(trans('deliveryplus.type.range.invalid')));
                    $form['deliveryplus_weight_max']->addError(new FormError(trans('deliveryplus.type.range.invalid')));
                }

                $deliveryplus_size_min = $form['deliveryplus_size_min']->getData();
                $deliveryplus_size_max = $form['deliveryplus_size_max']->getData();
                if(strlen($deliveryplus_size_min) > 0 && strlen($deliveryplus_size_max) > 0 && $deliveryplus_size_min > $deliveryplus_size_max){
                    $form['deliveryplus_size_min']->addError(new FormError(trans('deliveryplus.type.range.invalid')));
                    $form['deliveryplus_size_max']->addError(new FormError(trans('deliveryplus.type.range.invalid')));
                }

                $deliveryplus_subtotal_min = $form['deliveryplus_subtotal_min']->getData();
                $deliveryplus_subtotal_max = $form['deliveryplus_subtotal_max']->getData();
                if(strlen($deliveryplus_subtotal_min) > 0 && strlen($deliveryplus_subtotal_max) > 0 && $deliveryplus_subtotal_min > $deliveryplus_subtotal_max){
                    $form['deliveryplus_subtotal_min']->addError(new FormError(trans('deliveryplus.type.range.invalid')));
                    $form['deliveryplus_subtotal_max']->addError(new FormError(trans('deliveryplus.type.range.invalid')));
                }
            });
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return DeliveryType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [DeliveryType::class];
    }
}
