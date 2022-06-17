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
use Eccube\Entity\Customer;
use Plugin\Coupon4\Entity\Coupon;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

if (!class_exists('\Customize\Entity\CustomerCoupon')) {
    /**
     * CustomerCoupon
     *
     * @ORM\Table(name="dtb_customer_coupon")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\CustomerCouponRepository")
     */
    class CustomerCoupon extends \Eccube\Entity\AbstractEntity
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
         * @var \Eccube\Entity\Customer
         *
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\Customer")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
         * })
         */
        private $Customer;

        /**
         * @var \Plugin\Coupon4\Entity\Coupon
         *
         * @ORM\ManyToOne(targetEntity="Plugin\Coupon4\Entity\Coupon")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="coupon_id", referencedColumnName="coupon_id")
         * })
         */
        private $Coupon;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="create_date", type="datetimetz")
         */
        private $create_date;

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
         * Set customer.
         *
         * @param \Eccube\Entity\Customer|null $customer
         *
         * @return Order
         */
        public function setCustomer(Customer $customer = null)
        {
            $this->Customer = $customer;

            return $this;
        }

        /**
         * Get customer.
         *
         * @return \Eccube\Entity\Customer|null
         */
        public function getCustomer()
        {
            return $this->Customer;
        }


        /**
         * Set coupon.
         *
         * @param \Plugin\Coupon4\Entity\Coupon|null $coupon
         *
         * @return CustomerCoupon
         */
        public function setCoupon(Coupon $coupon = null)
        {
            $this->Coupon = $coupon;

            return $this;
        }

        /**
         * Get coupon.
         *
         * @return \Plugin\Coupon4\Entity\Coupon|null
         */
        public function getCoupon()
        {
            return $this->Coupon;
        }

        /**
         * Set createDate.
         *
         * @param \DateTime $createDate
         *
         * @return CustomerCoupon
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

    }
}
