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
use Eccube\Entity\AbstractEntity;
use Eccube\Entity\Category;
use Eccube\Entity\Customer;
use Eccube\Entity\Page;
use Eccube\Entity\Product;

if (!class_exists(Group::class)) {
    /**
     * Class Group
     * @package Plugin\CustomerGroup\Entity
     *
     * @ORM\Table(name="plg_customer_group")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Plugin\CustomerGroup\Repository\GroupRepository")
     */
    class Group extends AbstractEntity
    {
        /**
         * @var int
         *
         * @ORM\Column(type="integer", options={"unsigned":true})
         * @ORM\Id()
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var string
         *
         * @ORM\Column(type="string", length=255)
         */
        private $name;

        /**
         * @var string
         *
         * @ORM\Column(type="string", length=255, nullable=true)
         */
        private $backendName;

        /**
         * @var bool
         *
         * @ORM\Column(type="boolean", options={"default":false})
         */
        private $optionNonMemberDisplay;

        /**
         * @var int
         *
         * @ORM\Column(type="smallint", nullable=true, options={"unsigned":true})
         */
        private $sortNo;

        /**
         * @var Collection
         *
         * @ORM\ManyToMany(targetEntity="Eccube\Entity\Customer", mappedBy="groups")
         */
        private $customers;

        /**
         * @var Collection
         *
         * @ORM\ManyToMany(targetEntity="Eccube\Entity\Product", mappedBy="groups")
         */
        private $products;

        /**
         * @var Collection
         *
         * @ORM\ManyToMany(targetEntity="Eccube\Entity\Category", mappedBy="groups")
         */
        private $categories;

        /**
         * @var Collection
         *
         * @ORM\ManyToMany(targetEntity="Eccube\Entity\Page", mappedBy="groups")
         */
        private $pages;

        public function __construct()
        {
            $this->customers = new ArrayCollection();
            $this->products = new ArrayCollection();
            $this->categories = new ArrayCollection();
            $this->pages = new ArrayCollection();
        }

        public function __toString(): string
        {
            return $this->name;
        }

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
         * @return string|null
         */
        public function getBackendName(): ?string
        {
            return $this->backendName;
        }

        /**
         * @param string $backendName
         * @return $this
         */
        public function setBackendName(string $backendName): self
        {
            $this->backendName = $backendName;

            return $this;
        }

        /**
         * @return bool|null
         */
        public function isOptionNonMemberDisplay(): ?bool
        {
            return $this->optionNonMemberDisplay;
        }

        /**
         * @param bool $optionNonMemberDisplay
         * @return $this
         */
        public function setOptionNonMemberDisplay(bool $optionNonMemberDisplay): self
        {
            $this->optionNonMemberDisplay = $optionNonMemberDisplay;

            return $this;
        }

        /**
         * @return int
         */
        public function getSortNo(): int
        {
            return $this->sortNo;
        }

        /**
         * @param int $sortNo
         * @return $this
         */
        public function setSortNo(int $sortNo): self
        {
            $this->sortNo = $sortNo;

            return $this;
        }

        /**
         * @return Collection
         */
        public function getCustomers(): Collection
        {
            return $this->customers;
        }

        /**
         * @param Customer $customer
         * @return $this
         */
        public function addCustomer(Customer $customer): self
        {
            if (false === $this->customers->contains($customer)) {
                $this->customers->add($customer);
            }

            return $this;
        }

        /**
         * @param Customer $customer
         * @return $this
         */
        public function removeCustomer(Customer $customer): self
        {
            if ($this->customers->contains($customer)) {
                $this->customers->removeElement($customer);
            }

            return $this;
        }

        /**
         * @return Collection
         */
        public function getProducts(): Collection
        {
            return $this->products;
        }

        /**
         * @param Product $product
         * @return $this
         */
        public function addProduct(Product $product): self
        {
            if (false === $this->products->contains($product)) {
                $this->products->add($product);
            }

            return $this;
        }

        /**
         * @param Product $product
         * @return $this
         */
        public function removeProduct(Product $product): self
        {
            if ($this->products->contains($product)) {
                $this->products->removeElement($product);
            }

            return $this;
        }

        /**
         * @return Collection
         */
        public function getCategories(): Collection
        {
            return $this->categories;
        }

        /**
         * @param Category $category
         * @return $this
         */
        public function addCategory(Category $category): self
        {
            if (false === $this->categories->contains($category)) {
                $this->categories->add($category);
            }

            return $this;
        }

        /**
         * @param Category $category
         * @return $this
         */
        public function removeCategory(Category $category): self
        {
            if ($this->categories->contains($category)) {
                $this->categories->removeElement($category);
            }

            return $this;
        }

        /**
         * @return Collection
         */
        public function getPages(): Collection
        {
            return $this->pages;
        }

        /**
         * @param Page $page
         * @return $this
         */
        public function addPage(Page $page): self
        {
            if (false === $this->pages->contains($page)) {
                $this->pages->add($page);
            }

            return $this;
        }
        
        /**
         * @param Page $page
         * @return $this
         */
        public function removePage(Page $page): self
        {
            if ($this->pages->contains($page)) {
                $this->pages->removeElement($page);
            }

            return $this;
        }
    }
}
