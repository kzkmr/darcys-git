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
use Eccube\Annotation\EntityExtension;

/**
 * @EntityExtension("Eccube\Entity\ProductClass")
 *
 * Trait ProductClassTrait
 * @package Plugin\CustomerClassPrice4\Entity
 */
trait ProductClassTrait
{
    /**
     * @ORM\OneToMany(targetEntity="Plugin\CustomerClassPrice4\Entity\CustomerClassPrice", mappedBy="productClass", cascade={"persist","remove"})
     */
    private $plgCcpCustomerClassPrices;

    /**
     * @return Collection
     */
    public function getPlgCcpCustomerClassPrices(): Collection
    {
        if(!$this->plgCcpCustomerClassPrices) {
            $this->plgCcpCustomerClassPrices = new ArrayCollection();
        }

        return $this->plgCcpCustomerClassPrices;
    }

    /**
     * @param CustomerClassPrice $customerClassPrice
     * @return $this
     */
    public function addPlgCcpCustomerClassPrice(CustomerClassPrice $customerClassPrice): self
    {
        if(!$this->plgCcpCustomerClassPrices) {
            $this->plgCcpCustomerClassPrices = new ArrayCollection();
        }

        if(!$this->plgCcpCustomerClassPrices->contains($customerClassPrice)) {
            $this->plgCcpCustomerClassPrices[] = $customerClassPrice;
            $customerClassPrice->setProductClass($this);
        }

        return $this;
    }

    /**
     * @param CustomerClassPrice $customerClassPrice
     * @return $this
     */
    public function removePlgCcpCustomerClassPrice(CustomerClassPrice $customerClassPrice): self
    {
        if(!$this->plgCcpCustomerClassPrices) {
            $this->plgCcpCustomerClassPrices = new ArrayCollection();
        }

        if($this->plgCcpCustomerClassPrices->contains($customerClassPrice)) {
            $this->plgCcpCustomerClassPrices->removeElement($customerClassPrice);

            if($customerClassPrice->getProductClass() === $this) {
                $customerClassPrice->setProductClass(null);
            }
        }

        return $this;
    }
}
