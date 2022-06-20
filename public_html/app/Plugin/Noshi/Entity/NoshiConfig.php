<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Noshi\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Eccube\Entity\Master\CsvType;

/**
 * NoshiConfig
 *
 * @ORM\Table(name="plg_noshi_config")
 * @ORM\Entity(repositoryClass="Plugin\Noshi\Repository\NoshiConfigRepository")
 */
class NoshiConfig extends AbstractEntity
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
	* @var boolean
	*
	* @ORM\Column(name="noshi_enable", type="boolean", options={"default":true})
	*/
    private $noshi_enable = true;

	/** 
	* @var boolean
	*
	* @ORM\Column(name="noshi_kind", type="boolean", options={"default":true})
	*/
    private $noshi_kind = true;
	
	/** 
	* @var boolean
	*
	* @ORM\Column(name="noshi_tie", type="boolean", options={"default":true})
	*/
    private $noshi_tie = true;
	
	/** 
	* @var boolean
	*
	* @ORM\Column(name="noshi_name", type="boolean", options={"default":true})
	*/
    private $noshi_name = true;
	
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var \Eccube\Entity\Master\CsvType
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\CsvType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="csv_type_id", nullable=true, referencedColumnName="id")
     * })
     */
    private $CsvType;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setNoshiEnable($noshiEnable)
    {
        $this->noshi_enable = $noshiEnable;

        return $this;
    }
    public function getNoshiEnable()
    {
        return $this->noshi_enable;
    }
	
    public function setNoshiKind($noshiKind)
    {
        $this->noshi_kind = $noshiKind;

        return $this;
    }
    public function getNoshiKind()
    {
        return $this->noshi_kind;
    }

    public function setNoshiTie($noshiTie)
    {
        $this->noshi_tie = $noshiTie;

        return $this;
    }
    public function getNoshiTie()
    {
        return $this->noshi_tie;
    }
	
    public function setNoshiName($noshiName)
    {
        $this->noshi_name = $noshiName;

        return $this;
    }
    public function getNoshiName()
    {
        return $this->noshi_name;
    }
	
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set CsvType
     *
     * @param CsvType $CsvType
     *
     * @return $this
     */
    public function setCsvType(CsvType $CsvType = null)
    {
        $this->CsvType = $CsvType;

        return $this;
    }

    /**
     * Get CsvType
     *
     * @return \Eccube\Entity\Master\CsvType
     */
    public function getCsvType()
    {
        return $this->CsvType;
    }
}
