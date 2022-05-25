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


use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;

if (!class_exists(Config::class)) {
    /**
     * Class Config
     * @package Plugin\CustomerGroup\Entity
     *
     * @ORM\Table(name="plg_customer_group_config")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Plugin\CustomerGroup\Repository\ConfigRepository")
     */
    class Config extends AbstractEntity
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
         * @var bool
         *
         * @ORM\Column(type="boolean", options={"default":true})
         */
        private $optionGroupProductHidden;

        /**
         * @var bool
         *
         * @ORM\Column(type="boolean", options={"default":false})
         */
        private $optionGroupCategoryHidden;

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @return bool|null
         */
        public function isOptionGroupProductHidden(): ?bool
        {
            return $this->optionGroupProductHidden;
        }

        /**
         * @param bool $optionGroupProductHidden
         * @return $this
         */
        public function setOptionGroupProductHidden(bool $optionGroupProductHidden): self
        {
            $this->optionGroupProductHidden = $optionGroupProductHidden;

            return $this;
        }

        /**
         * @return bool|null
         */
        public function isOptionGroupCategoryHidden(): ?bool
        {
            return $this->optionGroupCategoryHidden;
        }

        /**
         * @param bool $optionGroupCategoryHidden
         * @return $this
         */
        public function setOptionGroupCategoryHidden(bool $optionGroupCategoryHidden): self
        {
            $this->optionGroupCategoryHidden = $optionGroupCategoryHidden;

            return $this;
        }
    }
}
