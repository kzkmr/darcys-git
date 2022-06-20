<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SeoListDetail;

use Eccube\Common\EccubeNav;

class Nav implements EccubeNav
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public static function getNav()
    {
        return [
            'product' => [
                'children' => [
                    'admin_product_category_seo' => [
                        'name' => 'admin_product_category_seo_management',
                        'url' => 'admin_product_category_seo',
                    ],
                    'product_csv_import_seo' => [
                        'name' => 'product_csv_import_seo_management',
                        'url' => 'admin_product_csv_import_seo',
                    ],
                    'category_csv_import_seo' => [
                        'name' => 'category_csv_import_seo_management',
                        'url' => 'admin_product_category_csv_import_seo',
                    ],
                ],
            ],
        ];
    }
}
