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

namespace Plugin\DeliveryPlus4\Repository;

use Eccube\Repository\AbstractRepository;
use Plugin\DeliveryPlus4\Entity\DeliveryPlusConfig;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ConfigRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry, string $entityClass = DeliveryPlusConfig::class)
    {
        parent::__construct($registry, $entityClass);
    }
}