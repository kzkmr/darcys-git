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
use Eccube\Entity\Master\RoundingType;

if (!class_exists(Config::class)) {
    /**
     * Config
     *
     * @ORM\Table(name="plg_ccp_config")
     * @ORM\Entity(repositoryClass="Plugin\CustomerClassPrice4\Repository\ConfigRepository")
     */
    class Config
    {
        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var \Eccube\Entity\Master\RoundingType
         *
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\RoundingType")
         * @ORM\JoinColumn(nullable=false)
         */
        private $roundingType;

        /**
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getRoundingType()
        {
            return $this->roundingType;
        }

        /**
         * @param RoundingType $roundingType
         * @return $this
         */
        public function setRoundingType(RoundingType $roundingType)
        {
            $this->roundingType = $roundingType;

            return $this;
        }
    }
}
