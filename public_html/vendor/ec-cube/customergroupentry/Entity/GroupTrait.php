<?php
/**
 * This file is part of CustomerGroupEntry
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroupEntry\Entity;


use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;

/**
 * Trait GroupTrait
 * @package Plugin\CustomerGroupEntry\Entity
 *
 * @EntityExtension("Plugin\CustomerGroup\Entity\Group")
 */
trait GroupTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default": false}, nullable=true)
     */
    private $optionEntry;

    /**
     * @return bool|null
     */
    public function isOptionEntry(): ?bool
    {
        return $this->optionEntry;
    }

    /**
     * @param bool $optionEntry
     * @return $this
     */
    public function setOptionEntry(bool $optionEntry): self
    {
        $this->optionEntry = $optionEntry;

        return $this;
    }
}
