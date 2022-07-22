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

use Eccube\Annotation\EntityExtension;
use Doctrine\ORM\Mapping as ORM;

/**
 * @EntityExtension("Eccube\Entity\Product")
 */

trait ProductTrait
{
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Plugin\HiddenDeliveryDate\Entity\Hiddenday", mappedBy="Product", cascade={"persist","remove"})
     */
    private $Hiddendays;

    public function addHiddenDay(\Plugin\HiddenDeliveryDate\Entity\Hiddenday $day)
    {
        $this->Hiddendays[] = $day;

        return $this;
    }

    public function removeHiddenDay(\Plugin\HiddenDeliveryDate\Entity\Hiddenday $day)
    {
        return $this->Hiddendays->removeElement($day);
    }

    public function getHiddenDays()
    {
        return $this->Hiddendays;
    }
}
