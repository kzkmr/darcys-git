<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize;

use Eccube\Common\EccubeNav;

class CustomizeNav implements EccubeNav
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public static function getNav()
    {
        return [
            'chainstore' => [
                'name' => 'admin.chainstore.chainstore_management',
                'icon' => 'fa-building',
                'children' => [
                    'chainstore_master' => [
                        'name' => 'admin.chainstore.chainstore_list',
                        'url' => 'admin_chainstore',
                    ],
                    'chainstore_edit' => [
                        'name' => 'admin.chainstore.chainstore_registration',
                        'url' => 'admin_chainstore_new',
                    ],
                ],
            ],
        ];
    }
}
