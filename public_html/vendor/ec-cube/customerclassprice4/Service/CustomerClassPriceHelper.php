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

namespace Plugin\CustomerClassPrice4\Service;

use Eccube\Entity\Master\RoundingType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CustomerClassPriceHelper
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * 割引規則に応じて端数処理を行う
     *
     * @param  integer $value    端数処理を行う数値
     * @param integer $RoundingType
     *
     * @return double        端数処理後の数値
     */
    public function roundByRoundingType($value, RoundingType $RoundingType)
    {
        switch ($RoundingType->getId()) {
            // 四捨五入
            case \Eccube\Entity\Master\RoundingType::ROUND:
                if ($this->container->getParameter('currency') == 'JPY') {
                    $ret = round($value);
                } else {
                    $ret = round($value, 3);
                }

                break;
            // 切り捨て
            case \Eccube\Entity\Master\RoundingType::FLOOR:
                $ret = floor($value);
                break;
            // 切り上げ
            case \Eccube\Entity\Master\RoundingType::CEIL:
                $ret = ceil($value);
                break;
            // デフォルト:切り上げ
            default:
                $ret = ceil($value);
                break;
        }

        return $ret;
    }
}
