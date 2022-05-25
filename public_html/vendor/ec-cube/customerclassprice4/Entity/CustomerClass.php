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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;

if (!class_exists(CustomerClass::class)) {
    /**
     * @ORM\Table(name="plg_ccp_customer_class")
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Plugin\CustomerClassPrice4\Repository\CustomerClassRepository")
     */
    class CustomerClass extends AbstractEntity
    {
        /**
         * @return string
         */
        public function __toString(): string
        {
            return $this->name;
        }

        public function __construct()
        {
            $this->customerClassPrices = new ArrayCollection();
        }

        /**
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id()
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $name;

        /**
         * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
         */
        private $discountRate;

        /**
         * @ORM\OneToMany(targetEntity="Plugin\CustomerClassPrice4\Entity\CustomerClassPrice", mappedBy="customerClass", cascade={"persist","remove"})
         */
        private $customerClassPrices;

        /**
         * @return int|null
         */
        public function getId(): ?int
        {
            return $this->id;
        }

        /**
         * @return string|null
         */
        public function getName(): ?string
        {
            return $this->name;
        }

        /**
         * @param string $name
         * @return $this
         */
        public function setName(string $name): self
        {
            $this->name = $name;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getDiscountRate()
        {
            return $this->discountRate;
        }

        /**
         * @param $discountRate
         * @return $this
         */
        public function setDiscountRate($discountRate): self
        {
            $this->discountRate = $discountRate;

            return $this;
        }

        /**
         * @return Collection
         */
        public function getCustomerClassPrices(): Collection
        {
            return $this->customerClassPrices;
        }

        /**
         * @param CustomerClassPrice $customerClassPrice
         * @return $this
         */
        public function addCustomerClassPrices(CustomerClassPrice $customerClassPrice): self
        {
            if(!$this->customerClassPrices->contains($customerClassPrice)) {
                $this->customerClassPrices[] = $customerClassPrice;
                $customerClassPrice->setCustomerClass($this);
            }

            return $this;
        }

        /**
         * @param CustomerClassPrice $customerClassPrice
         * @return $this
         */
        public function removeCustomerClassPrices(CustomerClassPrice $customerClassPrice): self
        {
            if($this->customerClassPrices->contains($customerClassPrice)) {
                $this->customerClassPrices->removeElement($customerClassPrice);

                if($customerClassPrice->getCustomerClass() === $this) {
                    $customerClassPrice->setCustomerClass(null);
                }
            }

            return $this;
        }
    }

}
