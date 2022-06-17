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

if (!class_exists('\Customize\Entity\DealerSummary')) {
    /**
     * DealerSummary
     *
     * @ORM\Table(name="dtb_dealer_summary")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\DealerSummaryRepository")
     */
    class DealerSummary extends \Eccube\Entity\AbstractEntity
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
         * @ORM\Column(name="sales_total", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $sales_total;

        /**
         * @var string|null
         *
         * @ORM\Column(name="sales_margin", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $sales_margin;

        /**
         * @var string|null
         *
         * @ORM\Column(name="self_total", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $self_total;

        /**
         * @var string|null
         *
         * @ORM\Column(name="oen_self_total", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $oen_self_total;


        /**
         * @var string|null
         *
         * @ORM\Column(name="kouri_self_total", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $kouri_self_total;

        /**
         * @var string|null
         *
         * @ORM\Column(name="chain_total", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $chain_total;

        /**
         * @var string|null
         *
         * @ORM\Column(name="margin_total", type="decimal", precision=12, scale=2, options={"unsigned":true,"default":0})
         */
        private $margin_total;
        
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
         * @return DealerSummary
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
         * @return DealerSummary
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
         * Set sales_total.
         *
         * @param string $sales_total
         *
         * @return DealerSummary
         */
        public function setSalesTotal(string $sales_total)
        {
            $this->sales_total = $sales_total;

            return $this;
        }

        /**
         * Get sales_total.
         *
         * @return string
         */
        public function getSalesTotal()
        {
            return $this->sales_total;
        }


        /**
         * Set sales_margin
         *
         * @param string $sales_margin
         *
         * @return DealerSummary
         */
        public function setSalesMargin(string $sales_margin)
        {
            $this->sales_margin = $sales_margin;

            return $this;
        }

        /**
         * Get sales_margin
         *
         * @return string
         */
        public function getSalesMargin()
        {
            return $this->sales_margin;
        }

        /**
         * Set self_total
         *
         * @param string $self_total
         *
         * @return DealerSummary
         */
        public function setSelfTotal(string $self_total)
        {
            $this->self_total = $self_total;

            return $this;
        }

        /**
         * Get self_total
         *
         * @return string
         */
        public function getSelfTotal()
        {
            return $this->self_total;
        }

        /**
         * Set oen_self_total
         *
         * @param string $oen_self_total
         *
         * @return DealerSummary
         */
        public function setOenSelfTotal(string $oen_self_total)
        {
            $this->oen_self_total = $oen_self_total;

            return $this;
        }

        /**
         * Get oen_self_total
         *
         * @return string
         */
        public function getOenSelfTotal()
        {
            return $this->oen_self_total;
        }

        /**
         * Set kouri_self_total
         *
         * @param string $kouri_self_total
         *
         * @return DealerSummary
         */
        public function setKouriSelfTotal(string $kouri_self_total)
        {
            $this->kouri_self_total = $kouri_self_total;

            return $this;
        }

        /**
         * Get kouri_self_total
         *
         * @return string
         */
        public function getKouriSelfTotal()
        {
            return $this->kouri_self_total;
        }

        /**
         * Set chain_total
         *
         * @param string $chain_total
         *
         * @return DealerSummary
         */
        public function setChainTotal(string $chain_total)
        {
            $this->chain_total = $chain_total;

            return $this;
        }

        /**
         * Get chain_total
         *
         * @return string
         */
        public function getChainTotal()
        {
            return $this->chain_total;
        }


        /**
         * Set margin_total
         *
         * @param string $margin_total
         *
         * @return DealerSummary
         */
        public function setMarginTotal(string $margin_total)
        {
            $this->margin_total = $margin_total;

            return $this;
        }

        /**
         * Get margin_total
         *
         * @return string
         */
        public function getMarginTotal()
        {
            return $this->margin_total;
        }

        /**
         * Set note.
         *
         * @param string|null $note
         *
         * @return DealerSummary
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
         * @return DealerSummary
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
