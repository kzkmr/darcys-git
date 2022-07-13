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

namespace Plugin\DeliveryPlus4\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="plg_deliveryplus_dtb_config")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Plugin\DeliveryPlus4\Repository\ConfigRepository")
 */
class DeliveryPlusConfig extends \Eccube\Entity\AbstractEntity
{
    const ALL = 0;
    const SHIPPING = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false, length=255)
     * @ORM\Id
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", nullable=true, length=255)
     */
    private $value;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
}
