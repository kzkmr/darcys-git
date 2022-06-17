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

if (!class_exists(ChainStoreStatus::class, false)) {
    /**
     * ChainStoreStatus
     *
     * @ORM\Table(name="mtb_chain_store_status")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\Master\ChainStoreStatusRepository")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    class ChainStoreStatus extends \Eccube\Entity\Master\AbstractMasterEntity
    {
        /**
         * 仮販売店.
         *
         * @deprecated
         */
        const NONACTIVE = 1;

        /**
         * 本販売店.
         *
         * @deprecated
         */
        const ACTIVE = 2;

        /**
         * 仮販売店.
         */
        const PROVISIONAL = 1;

        /**
         * 本販売店
         */
        const REGULAR = 2;

        /**
         * 無効販売店
         */
        const WITHDRAWING = 3;
    }
}
