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

use Eccube\Form\Type\Shopping\ShippingType;
use Plugin\DeliveryPlus4\Service\DeliveryPlusService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class ShippingExtension extends AbstractTypeExtension
{

    private $deliveryService;

    public function __construct(
            DeliveryPlusService $deliveryService
            )
    {
        $this->deliveryService = $deliveryService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                /* @var Shipping $Shipping */
                $Shipping = $event->getData();
                if (is_null($Shipping) || !$Shipping->getId()) {
                    return;
                }

                $Deliveries = $this->deliveryService->getDeliveries($Shipping);

                $placeholder = false;
                if(count($Deliveries) == 0){
                    $placeholder = trans('deliveryplus.type.shopping.shipping.nodeliveries');
                }
                // 配送業者のプルダウンにセット.
                $form = $event->getForm();
                $form->add(
                    'Delivery',
                    EntityType::class,
                    [
                        'required' => false,
                        'label' => 'shipping.label.delivery_hour',
                        'class' => 'Eccube\Entity\Delivery',
                        'choice_label' => 'name',
                        'choices' => $Deliveries,
                        'placeholder' => $placeholder,
                        'constraints' => [
                            new NotBlank()
                        ],
                    ]
                );
            });
    }

    public function getExtendedType()
    {
        return ShippingType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ShippingType::class];
    }
}
