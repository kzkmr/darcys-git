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

namespace Eccube\Entity\Master;

use Doctrine\ORM\Mapping as ORM;

if (!class_exists(OrderStatusColor::class, false)) {
    /**
     * OrderStatusColor
     *
     * @ORM\Table(name="mtb_order_status_color")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Eccube\Repository\Master\OrderStatusColorRepository")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    class OrderStatusColor extends \Eccube\Entity\Master\AbstractMasterEntity
    {
    }
}
