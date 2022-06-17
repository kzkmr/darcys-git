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
 * Bank Branch
 *
 * @ORM\Table(name="mtb_bank_branch")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Customize\Repository\Master\BankBranchRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class BankBranch extends \Eccube\Entity\Master\AbstractMasterEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bank_id", type="integer", nullable=false)
     */
    protected $bank_id;

    /**
     * @var string
     *
     * @ORM\Column(name="branch_code", type="string", length=5, nullable=false)
     */
    protected $branch_code;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_code", type="string", length=4, nullable=false)
     */
    protected $bank_code;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_name_ka", type="string", length=50, nullable=false)
     */
    protected $bank_name_ka;

    /**
     * @var string
     *
     * @ORM\Column(name="branch_name_ka", type="string", length=50, nullable=false)
     */
    protected $branch_name_ka;


    /**
     * Set BankID.
     *
     * @param string $bank_id
     *
     * @return integer
     */
    public function setBankID($bank_id)
    {
        $this->bank_id = $bank_id;

        return $this;
    }

    /**
     * Get BankID.
     *
     * @return integer
     */
    public function getBankID()
    {
        return $this->bank_id;
    }

    /**
     * Set BranchCode.
     *
     * @param string $branch_code
     *
     * @return string
     */
    public function setBranchCode($branch_code)
    {
        $this->branch_code = $branch_code;

        return $this;
    }

    /**
     * Get BranchCode.
     *
     * @return string
     */
    public function getBranchCode()
    {
        return $this->branch_code;
    }


    /**
     * Set BankCode.
     *
     * @param string $bank_code
     *
     * @return string
     */
    public function setBankCode($bank_code)
    {
        $this->bank_code = $bank_code;

        return $this;
    }

    /**
     * Get BankCode.
     *
     * @return string
     */
    public function getBankCode()
    {
        return $this->bank_code;
    }

    /**
     * Set BankNameKa.
     *
     * @param string $bank_name_ka
     *
     * @return string
     */
    public function setBankNameKa($bank_name_ka)
    {
        $this->bank_name_ka = $bank_name_ka;

        return $this;
    }

    /**
     * Get BankNameKa.
     *
     * @return string
     */
    public function getBankNameKa()
    {
        return $this->bank_name_ka;
    }

    /**
     * Set BranchNameKa.
     *
     * @param string $branch_name_ka
     *
     * @return string
     */
    public function setBranchNameKa($branch_name_ka)
    {
        $this->branch_name_ka = $branch_name_ka;

        return $this;
    }

    /**
     * Get BranchNameKa.
     *
     * @return string
     */
    public function getBranchNameKa()
    {
        return $this->branch_name_ka;
    }
}
