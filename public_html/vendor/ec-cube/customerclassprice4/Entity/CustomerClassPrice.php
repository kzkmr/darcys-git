<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Entity;


use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Eccube\Entity\ProductClass;

if (!class_exists(CustomerClassPrice::class)) {
    /**
     * @ORM\Table(name="plg_ccp_customer_class_price")
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Plugin\CustomerClassPrice4\Repository\CustomerClassPriceRepository")
     *
     * Class CustomerClassPrice
     * @package Plugin\CustomerClassPrice4\Entity
     */
    class CustomerClassPrice extends AbstractEntity
    {
        private $price_inc_tax = null;

        /**
         * @return string
         */
        public function getPriceIncTax(): string
        {
            return $this->price_inc_tax;
        }

        /**
         * @param string $price_inc_tax
         * @return $this
         */
        public function setPriceIncTax(string $price_inc_tax): self
        {
            $this->price_inc_tax = $price_inc_tax;

            return $this;
        }

        /**
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id()
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
         */
        private $price;

        /**
         * @ORM\ManyToOne(targetEntity="Plugin\CustomerClassPrice4\Entity\CustomerClass", inversedBy="customerClassPrices")
         * @ORM\JoinColumn(nullable=false)
         */
        private $customerClass;

        /**
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\ProductClass", inversedBy="plgCcpCustomerClassPrices", cascade={"persist"})
         * @ORM\JoinColumn(nullable=false)
         */
        private $productClass;

        /**
         * @return int|null
         */
        public function getId(): ?int
        {
            return $this->id;
        }

        /**
         * @return string|nullZ
         */
        public function getPrice(): ?string
        {
            return $this->price;
        }

        /**
         * @param string|null $price
         * @return $this
         */
        public function setPrice(?string $price): self
        {
            $this->price = $price;

            return $this;
        }

        /**
         * @return CustomerClass
         */
        public function getCustomerClass(): CustomerClass
        {
            return $this->customerClass;
        }

        /**
         * @param CustomerClass $customerClass
         * @return $this
         */
        public function setCustomerClass(CustomerClass $customerClass): self
        {
            $this->customerClass = $customerClass;

            return $this;
        }

        /**
         * @return ProductClass
         */
        public function getProductClass(): ProductClass
        {
            return $this->productClass;
        }

        /**
         * @param ProductClass $productClass
         * @return $this
         */
        public function setProductClass(ProductClass $productClass): self
        {
            $this->productClass = $productClass;

            return $this;
        }
    }
}
