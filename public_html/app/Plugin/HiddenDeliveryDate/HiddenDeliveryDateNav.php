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

namespace Plugin\HiddenDeliveryDate;

use Eccube\Common\EccubeNav;

class HiddenDeliveryDateNav implements EccubeNav
{
    /**
     * @return array
     */
    public static function getNav()
    {
        return [
            'setting' => [
                'children' => [
                    'shop' => [
                        'children' => [
                            'hiddenday' => [
                                'id' => 'admin_setting_hiddendeliverydate_hiddenday',
                                'name' => 'hiddendeliverydate.admin.nav.setting.hiddendeliverydate.hiddenday',
                                'url' => 'admin_setting_hiddendeliverydate_hiddenday',
                                ]
                            ]
                    ],
                ],
            ],
        ];
    }
}