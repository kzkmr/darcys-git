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

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;

if (!class_exists('\Customize\Entity\BankTransferInfo')) {
    /**
     * BankTransferInfo
     *
     * @ORM\Table(name="dtb_bank_transfer_info")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\BankTransferInfoRepository")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    class BankTransferInfo extends \Eccube\Entity\AbstractEntity
    {
        /**
         * @var integer
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="reference_ym", type="string", length=10, nullable=false)
         */
        private $referenceYm;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="transfer_date", type="string", length=10, nullable=false)
         */
        private $transferDate;
        
        /**
         * @var string|null
         *
         * @ORM\Column(name="note", type="string", length=4000, nullable=true)
         */
        private $note;

        /**
         * Constructor
         */
        public function __construct()
        {
            
        }

        /**
         * Get id.
         *
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set reference Ym.
         *
         * @param string $referenceYm
         *
         * @return BankTransferInfo
         */
        public function setReferenceYm($referenceYm = null)
        {
            $this->referenceYm = $referenceYm;

            return $this;
        }

        /**
         * Get reference Ym.
         *
         * @return string
         */
        public function getReferenceYm()
        {
            return $this->referenceYm;
        }

        /**
         * Set transfer Date.
         *
         * @param string $transferDate
         *
         * @return BankTransferInfo
         */
        public function setTransferDate($transferDate = null)
        {
            $this->transferDate = $transferDate;

            return $this;
        }

        /**
         * Get transfer Date.
         *
         * @return string
         */
        public function getTransferDate()
        {
            return $this->transferDate;
        }

        /**
         * Set note.
         *
         * @param string|null $note
         *
         * @return BankTransferInfo
         */
        public function setNote($note = null)
        {
            $this->note = $note;

            return $this;
        }

        /**
         * Get note.
         *
         * @return string|null
         */
        public function getNote()
        {
            return $this->note;
        }

    }
}
