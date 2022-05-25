<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;

/**
 * Class CategoryTrait
 * @package Plugin\CustomerGroup\Entity
 *
 * @EntityExtension("Eccube\Entity\Category")
 */
trait CategoryTrait
{
    /**
     * @var Group[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="Plugin\CustomerGroup\Entity\Group", inversedBy="categories", cascade={"persist"})
     * @ORM\JoinTable(name="plg_customer_group_categories_groups",
     *     joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     *     )
     */
    private $groups;

    /**
     * @return Collection
     */
    public function getGroups(): Collection
    {
        if (null === $this->groups) {
            $this->groups = new ArrayCollection();
        }

        return $this->groups;
    }

    /**
     * @param Group $group
     * @return $this
     */
    public function addGroup(Group $group): self
    {
        if (null === $this->groups) {
            $this->groups = new ArrayCollection();
        }

        if (false === $this->groups->contains($group)) {
            $this->groups->add($group);
        }

        return $this;
    }

    /**
     * @param Group $group
     * @return $this
     */
    public function removeGroup(Group $group): self
    {
        if (null === $this->groups) {
            $this->groups = new ArrayCollection();
        }

        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasGroups(): bool
    {
        if (null === $this->groups) {
            $this->groups = new ArrayCollection();
        }

        return $this->groups->count() > 0;
    }
}
