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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

if (!class_exists('\Customize\Entity\ChainStore')) {
    /**
     * ChainStore
     *
     * @ORM\Table(name="dtb_chain_store", indexes={@ORM\Index(name="dtb_chain_store_create_date_idx", columns={"create_date"}), @ORM\Index(name="dtb_chain_store_update_date_idx", columns={"update_date"})})
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\Entity(repositoryClass="Customize\Repository\ChainStoreRepository")
     */
    class ChainStore extends \Eccube\Entity\AbstractEntity
    {
        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var string
         *
         * @ORM\Column(name="name01", type="string", length=255, nullable=true)
         */
        private $name01;

        /**
         * @var string
         *
         * @ORM\Column(name="name02", type="string", length=255, nullable=true)
         */
        private $name02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="kana01", type="string", length=255, nullable=true)
         */
        private $kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="kana02", type="string", length=255, nullable=true)
         */
        private $kana02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="company_name", type="string", length=255)
         */
        private $company_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="company_name_kana", type="string", length=255)
         */
        private $company_name_kana;

        /**
         * @var string|null
         *
         * @ORM\Column(name="stock_number", type="string", length=20, nullable=true)
         */
        private $stock_number;
        
        /**
         * @var \Customize\Entity\Master\ContractType
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ContractType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="contract_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $ContractType;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="contract_begin_ymd", type="date", nullable=true)
         */
        private $contract_begin_ymd;

        /**
         * @var string|null
         *
         * @ORM\Column(name="note", type="string", length=4000, nullable=true)
         */
        private $note;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="create_date", type="datetimetz")
         */
        private $create_date;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="update_date", type="datetimetz")
         */
        private $update_date;

        /**
         * @var \Customize\Entity\Master\ChainStoreStatus
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\ChainStoreStatus")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chain_store_status_id", referencedColumnName="id")
         * })
         */
        private $Status;

        /**
         * @var string|null
         *
         * @ORM\Column(name="dealer_code", type="string", length=20, nullable=true)
         */
        private $dealer_code;

        /**
         * @var \Customize\Entity\Master\Bank
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\Bank")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="bank_id", referencedColumnName="id")
         * })
         */
        private $Bank;

        /**
         * @var string|null
         *
         * @ORM\Column(name="bank_branch_id", type="integer", options={"unsigned":true})
         */
        private $BankBranch;
        
        /**
         * @var \Customize\Entity\Master\BankAccountType
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\Master\BankAccountType")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="bank_account_type_id", referencedColumnName="id", nullable=true)
         * })
         */
        private $BankAccountType;

        /**
         * @var string|null
         *
         * @ORM\Column(name="bank_account", type="string", length=15, nullable=true)
         */
        private $BankAccount;

        /**
         * @var string|null
         *
         * @ORM\Column(name="bank_holder", type="string", length=100, nullable=true)
         */
        private $BankHolder;

        /**
         * @var string|null
         *
         * @ORM\Column(name="sort_no", type="integer", options={"unsigned":true})
         */
        private $sort_no;

        //Private Use
        private $point = '0';
        private $relatedCustomer = null;

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->sort_no = 0;
        }

        /**
         * @return string
         */
        public function __toString()
        {
            return (string) ($this->getDealerCode().'-'.$this->getCompanyName().' ('.$this->getName01().' '.$this->getName02().')');
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
         * Set name01.
         *
         * @param string $name01
         *
         * @return ChainStore
         */
        public function setName01($name01)
        {
            $this->name01 = $name01;

            return $this;
        }

        /**
         * Get name01.
         *
         * @return string
         */
        public function getName01()
        {
            return $this->name01;
        }

        /**
         * Set name02.
         *
         * @param string $name02
         *
         * @return ChainStore
         */
        public function setName02($name02)
        {
            $this->name02 = $name02;

            return $this;
        }

        /**
         * Get name02.
         *
         * @return string
         */
        public function getName02()
        {
            return $this->name02;
        }

        /**
         * Set kana01.
         *
         * @param string|null $kana01
         *
         * @return ChainStore
         */
        public function setKana01($kana01 = null)
        {
            $this->kana01 = $kana01;

            return $this;
        }

        /**
         * Get kana01.
         *
         * @return string|null
         */
        public function getKana01()
        {
            return $this->kana01;
        }

        /**
         * Set kana02.
         *
         * @param string|null $kana02
         *
         * @return ChainStore
         */
        public function setKana02($kana02 = null)
        {
            $this->kana02 = $kana02;

            return $this;
        }

        /**
         * Get kana02.
         *
         * @return string|null
         */
        public function getKana02()
        {
            return $this->kana02;
        }

        /**
         * Set companyName.
         *
         * @param string|null $companyName
         *
         * @return ChainStore
         */
        public function setCompanyName($companyName = null)
        {
            $this->company_name = $companyName;

            return $this;
        }

        /**
         * Get companyName.
         *
         * @return string|null
         */
        public function getCompanyName()
        {
            return $this->company_name;
        }

        /**
         * Set companyNameKana.
         *
         * @param string|null $companyNameKana
         *
         * @return ChainStore
         */
        public function setCompanyNameKana($companyNameKana = null)
        {
            $this->company_name_kana = $companyNameKana;

            return $this;
        }

        /**
         * Get companyNameKana.
         *
         * @return string|null
         */
        public function getCompanyNameKana()
        {
            return $this->company_name_kana;
        }

        /**
         * Set stock Number.
         *
         * @param string|null $stockNumber
         *
         * @return ChainStore
         */
        public function setStockNumber($stockNumber = null)
        {
            $this->stock_number = $stockNumber;

            return $this;
        }

        /**
         * Get stock Number.
         *
         * @return string|null
         */
        public function getStockNumber()
        {
            return $this->stock_number;
        }

        /**
         * Set contractType.
         *
         * @param \Customize\Entity\Master\ContractType|null $contractType
         *
         * @return ChainStore
         */
        public function setContractType(\Customize\Entity\Master\ContractType $contractType = null)
        {
            $this->ContractType = $contractType;

            return $this;
        }

        /**
         * Get contractType.
         *
         * @return \Customize\Entity\Master\ContractType|null
         */
        public function getContractType()
        {
            return $this->ContractType;
        }

        /**
         * Set contractBeginYmd.
         *
         * @param \DateTime $contractBeginYmd
         *
         * @return ChainStore
         */
        public function setContractBeginYmd($contractBeginYmd)
        {
            $this->contract_begin_ymd = $contractBeginYmd;

            return $this;
        }

        /**
         * Get contractBeginYmd.
         *
         * @return \DateTime
         */
        public function getContractBeginYmd()
        {
            return $this->contract_begin_ymd;
        }

        /**
         * Set note.
         *
         * @param string|null $note
         *
         * @return ChainStore
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
         * Set createDate.
         *
         * @param \DateTime $createDate
         *
         * @return ChainStore
         */
        public function setCreateDate($createDate)
        {
            $this->create_date = $createDate;

            return $this;
        }

        /**
         * Get createDate.
         *
         * @return \DateTime
         */
        public function getCreateDate()
        {
            return $this->create_date;
        }

        /**
         * Set updateDate.
         *
         * @param \DateTime $updateDate
         *
         * @return ChainStore
         */
        public function setUpdateDate($updateDate)
        {
            $this->update_date = $updateDate;

            return $this;
        }

        /**
         * Get updateDate.
         *
         * @return \DateTime
         */
        public function getUpdateDate()
        {
            return $this->update_date;
        }

        /**
         * Set status.
         *
         * @param \Customize\Entity\Master\ChainStoreStatus|null $status
         *
         * @return ChainStore
         */
        public function setStatus(Master\ChainStoreStatus $status = null)
        {
            $this->Status = $status;

            return $this;
        }

        /**
         * Get status.
         *
         * @return \Customize\Entity\Master\ChainStoreStatus|null
         */
        public function getStatus()
        {
            return $this->Status;
        }

        /**
         * Set dealer code
         *
         * @param string $dealerCode
         *
         * @return ChainStore
         */
        public function setDealerCode($dealerCode)
        {
            $this->dealer_code = $dealerCode;

            return $this;
        }

        /**
         * Get dealer code
         *
         * @return string
         */
        public function getDealerCode()
        {
            return $this->dealer_code;
        }

        /**
         * Set Bank.
         *
         * @param string $bank
         *
         * @return ChainStore
         */
        public function setBank(\Customize\Entity\Master\Bank $bank)
        {
            $this->Bank = $bank;

            return $this;
        }

        /**
         * Get Bank.
         *
         * @return string
         */
        public function getBank()
        {
            return $this->Bank;
        }

        /**
         * Set BankBranch.
         *
         * @param string $bankbranch
         *
         * @return ChainStore
         */
        public function setBankBranch($bankbranch)
        {
            $this->BankBranch = $bankbranch;

            return $this;
        }

        /**
         * Get BankBranch.
         *
         * @return string
         */
        public function getBankBranch()
        {
            return $this->BankBranch;
        }


        /**
         * Set BankAccountType.
         *
         * @param string $bankAccountType
         *
         * @return ChainStore
         */
        public function setBankAccountType(\Customize\Entity\Master\BankAccountType $bankAccountType)
        {
            $this->BankAccountType = $bankAccountType;

            return $this;
        }

        /**
         * Get BankAccountType.
         *
         * @return string
         */
        public function getBankAccountType()
        {
            return $this->BankAccountType;
        }

        /**
         * Set BankAccount.
         *
         * @param string $account
         *
         * @return ChainStore
         */
        public function setBankAccount($account)
        {
            $this->BankAccount = $account;

            return $this;
        }

        /**
         * Get BankAccount.
         *
         * @return string|null
         */
        public function getBankAccount()
        {
            return $this->BankAccount;
        }
        
        /**
         * Set BankHolder.
         *
         * @param string $bankholder
         *
         * @return ChainStore
         */
        public function setBankHolder($bankholder)
        {
            $this->BankHolder = $bankholder;

            return $this;
        }

        /**
         * Get BankHolder.
         *
         * @return string|null
         */
        public function getBankHolder()
        {
            return $this->BankHolder;
        }

        /**
         * Set Sort No
         *
         * @param string $sortNo
         *
         * @return Customer
         */
        public function setSortNo($sortNo)
        {
            $this->sort_no = $sortNo;

            return $this;
        }

        /**
         * Get Sort No
         *
         * @return string
         */
        public function getSortNo()
        {
            return $this->sort_no;
        }

        /**
         * Set point
         *
         * @param string $point
         *
         * @return Customer
         */
        public function setPoint($point)
        {
            $this->point = $point;

            return $this;
        }

        /**
         * Get point
         *
         * @return string
         */
        public function getPoint()
        {
            return $this->point;
        }

        /**
         * Set related Customer
         *
         * @param string $relatedCustomer
         *
         * @return Customer
         */
        public function setRelatedCustomer($relatedCustomer)
        {
            $this->relatedCustomer = $relatedCustomer;

            return $this;
        }

        /**
         * Get related Customer
         *
         * @return string
         */
        public function getRelatedCustomer()
        {
            return $this->relatedCustomer;
        }
    }
}
