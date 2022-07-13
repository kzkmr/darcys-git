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

namespace Plugin\MypageReceipt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;

/**
 * MypageReceiptConfig
 *
 * @ORM\Table(name="plg_mypage_receipt_config")
 * @ORM\Entity(repositoryClass="Plugin\MypageReceipt\Repository\MypageReceiptConfigRepository")
 */
class MypageReceiptConfig extends AbstractEntity
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
     * @var int
     *
     * @ORM\Column(name="mypage_receipt_enable", type="smallint", nullable=false, options={"unsigned":true})
     */
    private $mypage_receipt_enable;

	/**
	 * @var \Eccube\Entity\Master\OrderStatus
	 *
	 * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\OrderStatus")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="mypage_receipt_status", referencedColumnName="id")
	 * })
	 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
	 */
	private $OrderStatus;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMypageReceiptEnable()
    {
        return $this->mypage_receipt_enable;
    }

    /**
     * @param int $mypage_receipt_enable
     */
    public function setMypageReceiptEnable($mypage_receipt_enable)
    {
        $this->mypage_receipt_enable = $mypage_receipt_enable;
    }

	/**
	 * Set orderStatus.
	 *
	 * @param \Eccube\Entity\Master\OrderStatus|null $orderStatus
	 */
	public function setOrderStatus(\Eccube\Entity\Master\OrderStatus $orderStatus = null)
	{
		$this->OrderStatus = $orderStatus;
	
		return $this;
	}
	/**
	 * Get orderStatus.
	 *
	 * @return \Eccube\Entity\Master\OrderStatus|null
	 */
	public function getOrderStatus()
	{
		return $this->OrderStatus;
	}

}
