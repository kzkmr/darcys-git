<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup;


use Eccube\Common\EccubeNav;

class Nav implements EccubeNav
{

    public static function getNav()
    {
        return [
            'product' => [
                'children' => [
                    'admin_product_group_csv_upload' => [
                        'name' => '会員グループCSV登録',
                        'url' => 'admin_product_group_csv_upload'
                    ]
                ]
            ],
            'customer' => [
                'children' => [
                    'admin_customer_group' => [
                        'name' => '会員グループ一覧',
                        'url' => 'admin_customer_group'
                    ],
                    'admin_customer_group_new' => [
                        'name' => '会員グループ登録',
                        'url' => 'admin_customer_group_new'
                    ],
                    'admin_customer_group_csv_upload' => [
                        'name' => '会員グループCSV登録',
                        'url' => 'admin_customer_group_csv_upload'
                    ]
                ]
            ],
            'plugin_customer_group' => [
                'name' => '会員グループ設定',
                'icon' => 'fa-users',
                'children' => [
                    'setting' => [
                        'name' => '基本設定',
                        'url' => 'admin_customer_group_config'
                    ]
                ]
            ]
        ];
    }
}
