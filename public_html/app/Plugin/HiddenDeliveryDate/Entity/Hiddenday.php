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

namespace Plugin\HiddenDeliveryDate\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hiddenday
 *
 * @ORM\Table(name="plg_hiddendeliverydate_dtb_hiddenday")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Plugin\HiddenDeliveryDate\Repository\HiddendayRepository")
 */
class Hiddenday extends \Eccube\Entity\AbstractEntity
{
    const SUNDAY = 'Sun';
    const MONDAY = 'Mon';
    const TUESDAY = 'Tue';
    const WEDNESDAY = 'Wed';
    const THURSDAY = 'Thu';
    const FRIDAY = 'Fri';
    const SATURDAY = 'Sat';

    private $add;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="datetimetz", nullable=true)
     */
    private $date;

    /**
     * @var \Eccube\Entity\Product|null
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\Product", inversedBy="Hiddendays", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $Product;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setProduct($product)
    {
        $this->Product = $product;

        return $this;
    }

    public function getProduct()
    {
        return $this->Product;
    }

    public function setAdd($add)
    {
        $this->add = $add;

        return $this;
    }

    public function getAdd()
    {
        return $this->add;
    }
}
