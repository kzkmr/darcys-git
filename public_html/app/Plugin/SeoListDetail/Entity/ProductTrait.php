<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SeoListDetail\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation as Eccube;

/**
 * @Eccube\EntityExtension("Eccube\Entity\Product")
 */
trait ProductTrait
{
        /**
         * @var string|null
         *
         * @ORM\Column(name="itoben_seo_title", type="text", nullable=true)
         */
        private $itoben_seo_title;

        /**
         * @var string|null
         *
         * @ORM\Column(name="itoben_seo_author", type="text", nullable=true)
         */
        private $itoben_seo_author;

        /**
         * @var string|null
         *
         * @ORM\Column(name="itoben_seo_description", type="text", nullable=true)
         */
        private $itoben_seo_description;

        /**
         * @var string|null
         *
         * @ORM\Column(name="itoben_seo_keyword", type="text", nullable=true)
         */
        private $itoben_seo_keyword;

        /**
         * @var string|null
         *
         * @ORM\Column(name="itoben_seo_meta_robots", type="text", nullable=true)
         */
        private $itoben_seo_meta_robots;

        /**
         * @var string|null
         *
         * @ORM\Column(name="itoben_seo_meta_tags", type="text", nullable=true)
         */
        private $itoben_seo_meta_tags;

        /**
         * Set itobenSeoTitle.
         *
         * @param string|null $itobenSeoTitle
         *
         * @return Category
         */
        public function setItobenSeoTitle($itobenSeoTitle = null)
        {
            $this->itoben_seo_title = $itobenSeoTitle;

            return $this;
        }

        /**
         * Get itobenSeoTitle.
         *
         * @return string|null
         */
        public function getItobenSeoTitle()
        {
            return $this->itoben_seo_title;
        }

        /**
         * Set itobenSeoAuthor.
         *
         * @param string|null $itobenSeoAuthor
         *
         * @return Category
         */
        public function setItobenSeoAuthor($itobenSeoAuthor = null)
        {
            $this->itoben_seo_author = $itobenSeoAuthor;

            return $this;
        }

        /**
         * Get itobenSeoAuthor.
         *
         * @return string|null
         */
        public function getItobenSeoAuthor()
        {
            return $this->itoben_seo_author;
        }

        /**
         * Set itobenSeoDescription.
         *
         * @param string|null $itobenSeoDescription
         *
         * @return Category
         */
        public function setItobenSeoDescription($itobenSeoDescription = null)
        {
            $this->itoben_seo_description = $itobenSeoDescription;

            return $this;
        }

        /**
         * Get itobenSeoDescription.
         *
         * @return string|null
         */
        public function getItobenSeoDescription()
        {
            return $this->itoben_seo_description;
        }

        /**
         * Set itobenSeoKeyword.
         *
         * @param string|null $itobenSeoKeyword
         *
         * @return Category
         */
        public function setItobenSeoKeyword($itobenSeoKeyword = null)
        {
            $this->itoben_seo_keyword = $itobenSeoKeyword;

            return $this;
        }

        /**
         * Get itobenSeoKeyword.
         *
         * @return string|null
         */
        public function getItobenSeoKeyword()
        {
            return $this->itoben_seo_keyword;
        }

        /**
         * Set itobenSeoMetaRobots.
         *
         * @param string|null $itobenSeoMetaRobots
         *
         * @return Category
         */
        public function setItobenSeoMetaRobots($itobenSeoMetaRobots = null)
        {
            $this->itoben_seo_meta_robots = $itobenSeoMetaRobots;

            return $this;
        }

        /**
         * Get itobenSeoMetaRobots.
         *
         * @return string|null
         */
        public function getItobenSeoMetaRobots()
        {
            return $this->itoben_seo_meta_robots;
        }

        /**
         * Set itobenSeoMetaTags.
         *
         * @param string|null $itobenSeoMetaTags
         *
         * @return Category
         */
        public function setItobenSeoMetaTags($itobenSeoMetaTags = null)
        {
            $this->itoben_seo_meta_tags = $itobenSeoMetaTags;

            return $this;
        }

        /**
         * Get itobenSeoMetaTags.
         *
         * @return string|null
         */
        public function getItobenSeoMetaTags()
        {
            return $this->itoben_seo_meta_tags;
        }
}
