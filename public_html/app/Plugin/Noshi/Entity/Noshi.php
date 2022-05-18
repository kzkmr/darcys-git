<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Noshi\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;

/**
 * Noshi
 *
 * @ORM\Table(name="plg_noshi")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Plugin\Noshi\Repository\NoshiRepository")
 */
class Noshi extends AbstractEntity
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
	 * @ORM\Column(name="order_id", type="integer", nullable=true)
     * })
     */
    private $order_id;

	/**
	* @var string
	*
	* @ORM\Column(name="product", type="string", length=255, nullable=false)
	*/
	private $product;

	/**
	* @var \Eccube\Entity\Master\NoshiKind
	*
	* @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\NoshiKind")
	* @ORM\JoinColumns({
	*   @ORM\JoinColumn(name="noshi_kind", referencedColumnName="id")
	* })
	*/
	private $NoshiKind;

	/**
	* @var \Eccube\Entity\Master\NoshiTie
	*
	* @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\NoshiTie")
	* @ORM\JoinColumns({
	*   @ORM\JoinColumn(name="noshi_tie", referencedColumnName="id")
	* })
	*/
	private $NoshiTie;

	/**
	* @var string
	*
	* @ORM\Column(name="noshi_sonota", type="string", length=255, nullable=true)
	*/
	private $noshi_sonota;

	/**
	* @var string
	*
	* @ORM\Column(name="noshi_name", type="string", length=255, nullable=true)
	*/
	private $noshi_name;

	/**
	 * @var int|null
	 *
	 * @ORM\Column(name="sort_no", type="smallint", nullable=true, options={"unsigned":true})
	 */
	private $sort_no;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="fixed", type="text")
	 */
	private $fixed;

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
	 * @var boolean
	 *
	 * @ORM\Column(name="visible", type="boolean", options={"default":true})
	 */
	private $visible;

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
     * Set orderId.
     *
     * @param int|null $orderId
     *
     * @return Noshi
     */
    public function setOrderId($orderId = null)
    {
        $this->order_id = $orderId;
        return $this;
    }

    /**
     * Get orderId.
     *
     * @return Noshi
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

	/**
	* Set product.
	*
	* @param string|null $product
	*
	* @return Noshi
	*/
	public function setProduct($product = null)
	{
		$this->product = $product;
		return $this;
	}
	/**
	* Get product.
	*
	* @return string|null
	*/
	public function getProduct()
	{
		return $this->product;
	}

	/**
	* Set noshiKind.
	*
	* @param \Eccube\Entity\Master\NoshiKind|null $noshiKind
	*
	* @return Noshi
	*/
	public function setNoshiKind(\Eccube\Entity\Master\NoshiKind $noshiKind = null)
	{
		$this->NoshiKind = $noshiKind;
		return $this;
	}
	/**
	* Get noshiKind.
	*
	* @return \Eccube\Entity\Master\NoshiKind|null
	*/
	public function getNoshiKind()
	{
		return $this->NoshiKind;
	}

	/**
	* Set noshiTie.
	*
	* @param \Eccube\Entity\Master\NoshiTie|null $noshiTie
	*
	* @return Noshi
	*/
	public function setNoshiTie(\Eccube\Entity\Master\NoshiTie $noshiTie = null)
	{
		$this->NoshiTie = $noshiTie;
		return $this;
	}
	/**
	* Get noshiTie.
	*
	* @return \Eccube\Entity\Master\NoshiTie|null
	*/
	public function getNoshiTie()
	{
		return $this->NoshiTie;
	}

	/**
	* Set noshiSonota.
	*
	* @param string|null $noshiSonota
	*
	* @return Noshi
	*/
	public function setNoshiSonota($noshiSonota = null)
	{
		$this->noshi_sonota = $noshiSonota;
		return $this;
	}
	/**
	* Get noshiSonota.
	*
	* @return string|null
	*/
	public function getNoshiSonota()
	{
		return $this->noshi_sonota;
	}

	/**
	* Set noshiName.
	*
	* @param string|null $noshiName
	*
	* @return Noshi
	*/
	public function setNoshiName($noshiName = null)
	{
		$this->noshi_name = $noshiName;
		return $this;
	}
	/**
	* Get noshiName.
	*
	* @return string|null
	*/
	public function getNoshiName()
	{
		return $this->noshi_name;
	}

	/**
	 * Set sortNo.
	 *
	 * @param int|null $sortNo
	 *
	 * @return Payment
	 */
	public function setSortNo($sortNo = null)
	{
	    $this->sort_no = $sortNo;

	    return $this;
	}

	/**
	 * Get sortNo.
	 *
	 * @return int|null
	 */
	public function getSortNo()
	{
	    return $this->sort_no;
	}

	/**
	 * Set fixed.
	 *
	 * @param boolean $fixed
	 *
	 * @return Payment
	 */
	public function setFixed($fixed)
	{
	    $this->fixed = $fixed;

	    return $this;
	}

	/**
	 * Get fixed.
	 *
	 * @return boolean
	 */
	public function isFixed()
	{
	    return $this->fixed;
	}

	/**
	 * Set createDate.
	 *
	 * @param \DateTime $createDate
	 *
	 * @return Noshi
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
	 * @return Noshi
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
	 * @return integer
	 */
	public function isVisible()
	{
	    return $this->visible;
	}

	/**
	 * @param boolean $visible
	 *
	 * @return Noshi
	 */
	public function setVisible($visible)
	{
	    $this->visible = $visible;

	    return $this;
	}

}
