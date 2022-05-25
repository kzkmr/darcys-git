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

namespace Plugin\CustomerClassPrice4;

use Eccube\Common\EccubeNav;

class Nav implements EccubeNav
{
    /**
     * @return array
     */
    public static function getNav()
    {
        return [
            'customer_class_price4' => [
                'name' => '会員種別管理',
                'icon' => 'fa-users',
                'children' => [
                    'customer_class_price4_customer_class' => [
                        'name' => '会員種別登録',
                        'url' => 'plg_ccp_customer_class_admin',
                    ],
                    'customer_class_price4_csv_customer_import' => [
                        'name' => '会員の会員種別一括登録',
                        'url' => 'customer_class_price_admin_csv_customer_import'
                    ],
                    'customer_class_price4_config' => [
                        'name' => '割引設定',
                        'url' => 'customer_class_price4_admin_config'
                    ]
                ],
            ],
        ];
    }
}
