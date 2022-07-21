<?php
/*
* Plugin Name : HiddenDeliveryDate
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\HiddenDeliveryDate\Form\Extension;

use Eccube\Common\EccubeConfig;
use Eccube\Form\Type\Shopping\ShippingType;
use Plugin\HiddenDeliveryDate\Service\ShoppingService;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type;

class ShippingExtension extends AbstractTypeExtension
{
    protected $eccubeConfig;
    protected $shoppingService;

    public function __construct(
            EccubeConfig $eccubeConfig,
            ShoppingService $shoppingService
    ) {
        $this->eccubeConfig = $eccubeConfig;
        $this->shoppingService = $shoppingService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $Shipping = $event->getData();
                $Delivery = $Shipping->getDelivery();
                if(method_exists($Delivery,'getDeliveryDateFlg')) return;
                if (is_null($Shipping) || !$Shipping->getId()) {
                    return;
                }

                $minDate = 0;
                $deliveryDurationFlag = false;

                foreach ($Shipping->getOrderItems() as $detail) {
                    $ProductClass = $detail->getProductClass();
                    if (is_null($ProductClass)) {
                        continue;
                    }
                    $deliveryDuration = $ProductClass->getDeliveryDuration();
                    if (is_null($deliveryDuration)) {
                        continue;
                    }
                    if ($deliveryDuration->getDuration() < 0) {
                        $deliveryDurationFlag = false;
                        break;
                    }

                    if ($minDate < $deliveryDuration->getDuration()) {
                        $minDate = $deliveryDuration->getDuration();
                    }
                    $deliveryDurationFlag = true;
                }

                $deliveryDurations = [];

                if ($deliveryDurationFlag) {
                    $period = new \DatePeriod(
                        new \DateTime($minDate.' day'),
                        new \DateInterval('P1D'),
                        new \DateTime($minDate + $this->eccubeConfig['eccube_deliv_date_end_max'].' day')
                    );

                    // 曜日設定用
                    $dateFormatter = \IntlDateFormatter::create(
                        'ja_JP@calendar=japanese',
                        \IntlDateFormatter::FULL,
                        \IntlDateFormatter::FULL,
                        'Asia/Tokyo',
                        \IntlDateFormatter::TRADITIONAL,
                        'E'
                    );

                    foreach ($period as $day) {
                        $deliveryDurations[$day->format('Y/m/d')] = $day->format('Y/m/d').'('.$dateFormatter->format($day).')';
                    }

                    $deliveryDurations = $this->shoppingService->getHiddenDeliveryDates($deliveryDurations, $Shipping);
                }

                $form = $event->getForm();
                $form
                    ->add(
                        'shipping_delivery_date',
                        Type\ChoiceType::class,
                        [
                            'choices' => array_flip($deliveryDurations),
                            'required' => false,
                            'placeholder' => 'common.select__unspecified',
                            'mapped' => false,
                            'data' => $Shipping->getShippingDeliveryDate() ? $Shipping->getShippingDeliveryDate()->format('Y/m/d') : null,
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
