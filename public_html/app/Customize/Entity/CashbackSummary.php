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

if (!class_exists('\Customize\Entity\CashbackSummary')) {
    /**
     * CashbackSummary
     *
     * @ORM\Table(name="dtb_cashback_summary")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\CashbackSummaryRepository")
     */
    class CashbackSummary extends \Eccube\Entity\AbstractEntity
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
         * @var \Customize\Entity\ChainStore
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\ChainStore")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chain_store_id", referencedColumnName="id")
         * })
         */
        private $ChainStore;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="reference_ym", type="string", length=10, nullable=false)
         */
        private $referenceYm;

        /**
         * @var string|null
         *
         * @ORM\Column(name="margin_price", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $marginPrice;

        /**
         * @var string|null
         *
         * @ORM\Column(name="previous_margin_price", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $previousMarginPrice;

        /**
         * @var string|null
         *
         * @ORM\Column(name="purchase_amount", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $purchaseAmount;

        /**
         * @var string|null
         *
         * @ORM\Column(name="request_amount", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $requestAmount;


        /**
         * @var string|null
         *
         * @ORM\Column(name="margin_balance", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $marginBalance;

        /**
         * @var string|null
         *
         * @ORM\Column(name="carried_forward", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $carriedForward;
        
        /**
         * @var string|null
         *
         * @ORM\Column(name="note", type="string", length=4000, nullable=true)
         */
        private $note;

        /**
         * @var string|null
         *
         * @ORM\Column(name="export_cnt", type="decimal", precision=10, options={"unsigned":true})
         */
        private $exportCnt;

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
         * Set ChainStore.
         *
         * @param \Customize\Entity\ChainStore|null $chainStore
         *
         * @return CashbackSummary
         */
        public function setChainStore(\Customize\Entity\ChainStore $chainStore = null)
        {
            $this->ChainStore = $chainStore;

            return $this;
        }

        /**
         * Get ChainStore.
         *
         * @return \Customize\Entity\ChainStore|null
         */
        public function getChainStore()
        {
            return $this->ChainStore;
        }
        
        /**
         * Set reference Ym.
         *
         * @param string $referenceYm
         *
         * @return CashbackSummary
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
         * Set margin Price.
         *
         * @param string $marginPrice
         *
         * @return CashbackSummary
         */
        public function setMarginPrice(string $marginPrice)
        {
            $this->marginPrice = $marginPrice;

            return $this;
        }

        /**
         * Get margin Price.
         *
         * @return string
         */
        public function getMarginPrice()
        {
            return $this->marginPrice;
        }


        /**
         * Set previous Margin Price.
         *
         * @param string $previousMarginPrice
         *
         * @return CashbackSummary
         */
        public function setPreviousMarginPrice(string $previousMarginPrice)
        {
            $this->previousMarginPrice = $previousMarginPrice;

            return $this;
        }

        /**
         * Get previous Margin Price.
         *
         * @return string
         */
        public function getPreviousMarginPrice()
        {
            return $this->previousMarginPrice;
        }

        /**
         * Set purchase Amount
         *
         * @param string $purchaseAmount
         *
         * @return CashbackSummary
         */
        public function setPurchaseAmount(string $purchaseAmount)
        {
            $this->purchaseAmount = $purchaseAmount;

            return $this;
        }

        /**
         * Get purchase Amount
         *
         * @return string
         */
        public function getPurchaseAmount()
        {
            return $this->purchaseAmount;
        }

        /**
         * Set request Amount
         *
         * @param string $requestAmount
         *
         * @return CashbackSummary
         */
        public function setRequestAmount(string $requestAmount)
        {
            $this->requestAmount = $requestAmount;

            return $this;
        }

        /**
         * Get request Amount
         *
         * @return string
         */
        public function getRequestAmount()
        {
            return $this->requestAmount;
        }

        /**
         * Set margin Balance
         *
         * @param string $marginBalance
         *
         * @return CashbackSummary
         */
        public function setMarginBalance(string $marginBalance)
        {
            $this->marginBalance = $marginBalance;

            return $this;
        }

        /**
         * Get margin Balance
         *
         * @return string
         */
        public function getMarginBalance()
        {
            return $this->marginBalance;
        }

        /**
         * Set carried Forward
         *
         * @param string $carriedForward
         *
         * @return CashbackSummary
         */
        public function setCarriedForward(string $carriedForward)
        {
            $this->carriedForward = $carriedForward;

            return $this;
        }

        /**
         * Get carried Forward
         *
         * @return string
         */
        public function getCarriedForward()
        {
            return $this->carriedForward;
        }

        /**
         * Set note.
         *
         * @param string|null $note
         *
         * @return CashbackSummary
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

        /**
         * Set export_cnt.
         *
         * @param string|null $export_cnt
         *
         * @return CashbackSummary
         */
        public function setExportCnt($export_cnt = null)
        {
            $this->exportCnt = $export_cnt;

            return $this;
        }

        /**
         * Get export_cnt.
         *
         * @return string|null
         */
        public function getExportCnt()
        {
            return $this->exportCnt;
        }
        
    }
}
