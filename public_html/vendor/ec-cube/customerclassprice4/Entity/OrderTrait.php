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
use Eccube\Annotation\EntityExtension;

/**
 * Trait OrderTrait
 * @package Plugin\CustomerClassPrice4\Entity
 *
 * @EntityExtension("Eccube\Entity\Order")
 */
trait OrderTrait
{
    /**
     * @var CustomerClass
     *
     * @ORM\ManyToOne(targetEntity="Plugin\CustomerClassPrice4\Entity\CustomerClass")
     * @ORM\JoinColumn(name="plg_ccp_customer_class_id", referencedColumnName="id")
     */
    private $plgCcpCustomerClass;

    public function isPlgCcpCustomerClass(): bool
    {
        return $this->plgCcpCustomerClass !== null;
    }

    public function getPlgCcpCustomerClass(): ?CustomerClass
    {
        return $this->plgCcpCustomerClass;
    }

    public function setPlgCcpCustomerClass(?CustomerClass $customerClass): self
    {
        $this->plgCcpCustomerClass = $customerClass;

        return $this;
    }
}
