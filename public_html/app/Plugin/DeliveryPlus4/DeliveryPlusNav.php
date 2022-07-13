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

namespace Plugin\DeliveryPlus4;

use Eccube\Common\EccubeNav;

class DeliveryPlusNav implements EccubeNav
{
    /**
     * @return array
     */
    public static function getNav()
    {
        return [

            'content' => [
                'children' => [
                    'deliveryplus' => [
                        'id' => 'admin_content_deliveryplus',
                        'name' => 'deliveryplus.admin.nav.content.deliveryplus',
                        'children' => [
                            'detail' => [
                                'id' => 'admin_content_deliveryplus_detail',
                                'name' => 'deliveryplus.admin.nav.content.deliveryplus.detail',
                                'url' => 'admin_content_deliveryplus_detail',
                            ],
                            'cart' => [
                                'id' => 'admin_content_deliveryplus_cart',
                                'name' => 'deliveryplus.admin.nav.content.deliveryplus.cart',
                                'url' => 'admin_content_deliveryplus_cart',
                            ]
                        ]
                    ],
                ],
            ],
        ];
    }
}