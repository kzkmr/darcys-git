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

namespace Plugin\Coupon4\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Coupon
 *
 * @ORM\Table(name="plg_coupon")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Plugin\Coupon4\Repository\CouponRepository")
 * @UniqueEntity("coupon_cd")
 */
class Coupon extends AbstractEntity
{
    const PRODUCT = 1;
    const CATEGORY = 2;
    const ALL = 3;

    const DISCOUNT_PRICE = 1;
    const DISCOUNT_RATE = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="coupon_id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon_cd", type="string", nullable=true, length=20, unique=true)
     */
    private $coupon_cd;

    /**
     * @var int
     *
     * @ORM\Column(name="coupon_type", type="smallint", nullable=true)
     */
    private $coupon_type;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon_name", type="string", nullable=true, length=50)
     */
    private $coupon_name;

    /**
     * @var int
     *
     * @ORM\Column(name="discount_type", type="smallint", nullable=true)
     */
    private $discount_type;

    /**
     * @var int
     *
     * @ORM\Column(name="coupon_use_time", type="integer", nullable=true)
     */
    private $coupon_use_time;

    /**
     * @var string
     *
     * @ORM\Column(name="reuse", type="string", nullable=true)
     */
    private $reuse;

    /**
     * @var string
     *
     * @ORM\Column(name="unlimited", type="string", nullable=true)
     */
    private $unlimited;

    /**
     * @var int
     *
     * @ORM\Column(name="unlimited_use_time", type="integer", nullable=true)
     */
    private $unlimited_use_time;

    /**
     * @var float
     *
     * @ORM\Column(name="discount_price", type="decimal", nullable=true, precision=12, scale=2, options={"unsigned":true,"default":0})
     */
    private $discount_price;

    /**
     * @var float
     *
     * @ORM\Column(name="discount_rate", type="decimal", nullable=true, precision=10, scale=0, options={"unsigned":true,"default":0})
     */
    private $discount_rate;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable_flag", type="boolean", nullable=false, options={"default":true})
     */
    private $enable_flag;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="available_from_date", type="datetimetz")
     */
    private $available_from_date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="available_to_date", type="datetimetz")
     */
    private $available_to_date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean", options={"default":true})
     */
    private $visible;

    /**
     * @var boolean
     *
     * @ORM\Column(name="coupon_member", type="boolean", options={"default":false})
     */
    private $coupon_member;

    /**
     * @var float
     *
     * @ORM\Column(name="coupon_lower_limit", type="decimal", nullable=true, precision=12, scale=2, options={"unsigned":true,"default":0})
     */
    private $coupon_lower_limit;

    /**
     * The number of coupon release
     *
     * @var int
     *
     * @ORM\Column(name="coupon_release", type="integer", nullable=true)
     */
    private $coupon_release;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Plugin\Coupon4\Entity\CouponDetail", mappedBy="Coupon", cascade={"persist","remove"})
     */
    private $CouponDetails;

    /**
     * @var \Customize\Entity\ChainStore
     *
     * @ORM\ManyToOne(targetEntity="Customize\Entity\ChainStore")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chain_store_id", referencedColumnName="id")
     * })
     */
    private $ChainStore;

    //Private use
    private $order_discount_price;
    private $can_delete;
    private $coupon_real_type;
    private $coupon_real_message;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->CouponDetails = new ArrayCollection();
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
     * Set coupon_cd.
     *
     * @param string $couponCd
     *
     * @return Coupon
     */
    public function setCouponCd($couponCd)
    {
        $this->coupon_cd = $couponCd;

        return $this;
    }

    /**
     * Get coupon_cd.
     *
     * @return string
     */
    public function getCouponCd()
    {
        return $this->coupon_cd;
    }

    /**
     * Set coupon_type.
     *
     * @param int $couponType
     *
     * @return Coupon
     */
    public function setCouponType($couponType)
    {
        $this->coupon_type = $couponType;

        return $this;
    }

    /**
     * Get coupon_type.
     *
     * @return int
     */
    public function getCouponType()
    {
        return $this->coupon_type;
    }

    /**
     * Set coupon_name.
     *
     * @param string $couponName
     *
     * @return Coupon
     */
    public function setCouponName($couponName)
    {
        $this->coupon_name = $couponName;

        return $this;
    }

    /**
     * Get coupon_name.
     *
     * @return string
     */
    public function getCouponName()
    {
        return $this->coupon_name;
    }

    /**
     * Set discount_type.
     *
     * @param int $discountType
     *
     * @return Coupon
     */
    public function setDiscountType($discountType)
    {
        $this->discount_type = $discountType;

        return $this;
    }

    /**
     * Get discount_type.
     *
     * @return int
     */
    public function getDiscountType()
    {
        return $this->discount_type;
    }

    /**
     * Set coupon_use_time.
     *
     * @param int $couponUseTime
     *
     * @return Coupon
     */
    public function setCouponUseTime($couponUseTime)
    {
        $this->coupon_use_time = $couponUseTime;

        return $this;
    }

    /**
     * Get coupon_use_time.
     *
     * @return int
     */
    public function getCouponUseTime()
    {
        return $this->coupon_use_time;
    }

    /**
     * Set reuse.
     *
     * @param string $reuse
     *
     * @return Coupon
     */
    public function setReuse($reuse)
    {
        $this->reuse = $reuse;

        return $this;
    }

    /**
     * Get reuse.
     *
     * @return string
     */
    public function getReuse()
    {
        return $this->reuse;
    }


    /**
     * Set unlimited.
     *
     * @param string $unlimited
     *
     * @return Coupon
     */
    public function setUnlimited($unlimited)
    {
        $this->unlimited = $unlimited;

        return $this;
    }

    /**
     * Get unlimited.
     *
     * @return string
     */
    public function getUnlimited()
    {
        return $this->unlimited;
    }

    /**
     * Set Unlimited Use Time.
     *
     * @param int $unlimitedUseTime
     *
     * @return Coupon
     */
    public function setUnlimitedUseTime($unlimitedUseTime)
    {
        $this->unlimited_use_time = $unlimitedUseTime;

        return $this;
    }

    /**
     * Get Unlimited Use Time.
     *
     * @return int
     */
    public function getUnlimitedUseTime()
    {
        return $this->unlimited_use_time;
    }

    /**
     * Set discount_price.
     *
     * @param string $discountPrice
     *
     * @return Coupon
     */
    public function setDiscountPrice($discountPrice)
    {
        $this->discount_price = $discountPrice;

        return $this;
    }

    /**
     * Get discount_price.
     *
     * @return string
     */
    public function getDiscountPrice()
    {
        return $this->discount_price;
    }

    /**
     * Set discount_rate.
     *
     * @param string $discountRate
     *
     * @return Coupon
     */
    public function setDiscountRate($discountRate)
    {
        $this->discount_rate = $discountRate;

        return $this;
    }

    /**
     * Get discount_rate.
     *
     * @return string
     */
    public function getDiscountRate()
    {
        return $this->discount_rate;
    }

    /**
     * Set enable_flag.
     *
     * @param bool $enableFlag
     *
     * @return Coupon
     */
    public function setEnableFlag($enableFlag)
    {
        $this->enable_flag = $enableFlag;

        return $this;
    }

    /**
     * Get enable_flag.
     *
     * @return bool
     */
    public function getEnableFlag()
    {
        return $this->enable_flag;
    }

    /**
     * Set available_from_date.
     *
     * @param \DateTime $availableFromDate
     *
     * @return Coupon
     */
    public function setAvailableFromDate($availableFromDate)
    {
        $this->available_from_date = $availableFromDate;

        return $this;
    }

    /**
     * Get available_from_date.
     *
     * @return \DateTime
     */
    public function getAvailableFromDate()
    {
        return $this->available_from_date;
    }

    /**
     * Set available_to_date.
     *
     * @param \DateTime $availableToDate
     *
     * @return Coupon
     */
    public function setAvailableToDate($availableToDate)
    {
        $this->available_to_date = $availableToDate;

        return $this;
    }

    /**
     * Get available_to_date.
     *
     * @return \DateTime
     */
    public function getAvailableToDate()
    {
        return $this->available_to_date;
    }

    /**
     * Set del_flg.
     *
     * @param bool $visible
     *
     * @return Coupon
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get del_flg.
     *
     * @return bool
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * Set create_date.
     *
     * @param \DateTime $createDate
     *
     * @return Coupon
     */
    public function setCreateDate($createDate)
    {
        $this->create_date = $createDate;

        return $this;
    }

    /**
     * Get create_date.
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * Set update_date.
     *
     * @param \DateTime $updateDate
     *
     * @return Coupon
     */
    public function setUpdateDate($updateDate)
    {
        $this->update_date = $updateDate;

        return $this;
    }

    /**
     * Get update_date.
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * Add CouponDetails.
     *
     * @param CouponDetail $couponDetails
     *
     * @return Coupon
     */
    public function addCouponDetail(CouponDetail $couponDetails)
    {
        $this->CouponDetails[] = $couponDetails;

        return $this;
    }

    /**
     * Remove CouponDetails.
     *
     * @param CouponDetail $couponDetails
     */
    public function removeCouponDetail(CouponDetail $couponDetails)
    {
        $this->CouponDetails->removeElement($couponDetails);
    }

    /**
     * Get CouponDetails.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCouponDetails()
    {
        return $this->CouponDetails;
    }

    /**
     * @return bool
     */
    public function getCouponMember()
    {
        return $this->coupon_member;
    }

    /**
     * @param bool $couponMember
     */
    public function setCouponMember($couponMember)
    {
        $this->coupon_member = $couponMember;
    }

    /**
     * @return int
     */
    public function getCouponLowerLimit()
    {
        return $this->coupon_lower_limit;
    }

    /**
     * @param int $couponLowerLimit
     */
    public function setCouponLowerLimit($couponLowerLimit)
    {
        $this->coupon_lower_limit = $couponLowerLimit;
    }

    /**
     * @return int
     */
    public function getCouponRelease()
    {
        return $this->coupon_release;
    }

    /**
     * @param int $coupon_release
     */
    public function setCouponRelease($coupon_release)
    {
        $this->coupon_release = $coupon_release;
    }

    /**
     * @return \Customize\Entity\ChainStore
     */
    public function getChainStore()
    {
        return $this->ChainStore;
    }

    /**
     * @param \Customize\Entity\ChainStore $chainStore
     */
    public function setChainStore($chainStore)
    {
        $this->ChainStore = $chainStore;
    }

    /**
     * @param int $orderDiscountPrice
     */
    public function setOrderDiscountPrice($orderDiscountPrice)
    {
        $this->order_discount_price = $orderDiscountPrice;
    }

    /**
     * @return int
     */
    public function getOrderDiscountPrice()
    {
        return $this->order_discount_price;
    }

    /**
     * @param bool $canDelete
     */
    public function setCanDelete($canDelete)
    {
        $this->can_delete = $canDelete;
    }

    /**
     * @return bool
     */
    public function getCanDelete()
    {
        return $this->can_delete;
    }

    /**
     * @param string $couponRealType
     */
    public function setCouponRealType($couponRealType)
    {
        $this->coupon_real_type = $couponRealType;
    }

    /**
     * @return string
     */
    public function getCouponRealType()
    {
        return $this->coupon_real_type;
    }

    /**
     * @param string $couponRealMessage
     */
    public function setCouponRealMessage($couponRealMessage)
    {
        $this->coupon_real_message = $couponRealMessage;
    }

    /**
     * @return string
     */
    public function getCouponRealMessage()
    {
        return $this->coupon_real_message;
    }
}
