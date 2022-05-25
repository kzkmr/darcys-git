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

namespace Customize\Entity\Master;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChainStoreWebShopEmailType
 *
 * @ORM\Table(name="mtb_chainstore_webshop_email_type")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Customize\Repository\Master\ChainStoreWebShopEmailTypeRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class ChainStoreWebShopEmailType extends \Eccube\Entity\Master\AbstractMasterEntity
{

}