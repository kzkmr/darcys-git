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

namespace Customize\Util;

use Eccube\Util\StringUtil as BaseStringUtil;
use Doctrine\Common\Collections\ArrayCollection;

class StringUtil extends BaseStringUtil
{

    public static function urlArrayEncode($url) {
        return strtr(base64_encode(serialize($url)), '+/=', '._-');
    }

    public static function urlArrayDecode($url) {
        return unserialize(base64_decode(strtr($url, '._-', '+/=')));
    }
}
