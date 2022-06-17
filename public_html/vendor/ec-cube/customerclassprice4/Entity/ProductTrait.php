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
use Eccube\Annotation as Eccube;

/**
 * Trait ProductTrait
 *
 * @Eccube\EntityExtension("Eccube\Entity\Product")
 */
trait ProductTrait
{
    /**
     * @ORM\Column("plg_ccp_enabled_discount", type="boolean", options={"default":true}, nullable=true)
     */
    private $plgCcpEnabledDiscount;

    public function isPlgCcpEnabledDiscount(): ?bool
    {
        return $this->plgCcpEnabledDiscount;
    }

    public function setPlgCcpEnabledDiscount(?bool $plgCcpEnabledDiscount): self
    {
        $this->plgCcpEnabledDiscount = $plgCcpEnabledDiscount;

        return $this;
    }
}
