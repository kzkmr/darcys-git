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
 * Trait CustomerTrait
 * @package Plugin\CustomerGroup\Entity
 *
 * @EntityExtension("Eccube\Entity\Customer")
 */
trait CustomerTrait
{
    /**
     * @var Group[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="Plugin\CustomerGroup\Entity\Group", inversedBy="customers", cascade={"persist"})
     * @ORM\JoinTable(name="plg_customer_group_customers_groups",
     *     joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="id")}
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

    /**
     * @return Collection
     */
    public function getGroupProducts(): Collection
    {
        $products = new ArrayCollection();

        /** @var Group $group */
        foreach ($this->getGroups() as $group) {
            foreach ($group->getProducts() as $product) {
                if (false === $products->contains($product)) {
                    $products->add($product);
                }
            }
        }

        return $products;
    }

    /**
     * @return Collection
     */
    public function getGroupCategories(): Collection
    {
        $categories = new ArrayCollection();

        /** @var Group $group */
        foreach ($this->getGroups() as $group) {
            foreach ($group->getCategories() as $category) {
                if (false === $categories->contains($category)) {
                    $categories->add($category);
                }
            }
        }

        return $categories;
    }

    /**
     * @return Collection
     */
    public function getGroupPages(): Collection
    {
        $pages = new ArrayCollection();

        /** @var Group $group */
        foreach ($this->getGroups() as $group) {
            foreach ($group->getPages() as $page) {
                if(false === $pages->contains($page)) {
                    $pages->add($page);
                }
            }
        }

        return $pages;
    }
}
