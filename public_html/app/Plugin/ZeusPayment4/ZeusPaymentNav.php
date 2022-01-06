<?php

namespace Plugin\ZeusPayment4;

use Eccube\Common\EccubeNav;

/*
 * ナビゲーションメニュー登録
 */
class ZeusPaymentNav implements EccubeNav
{
    public static function getNav()
    {
        return [
            'order' => [
                'children' => [
                    'zeus_order_list' => [
                        'name' => 'ゼウス受注管理',
                        'url' => 'zeus_order_list',
                    ],
                ],
            ],
        ];
    }
}
