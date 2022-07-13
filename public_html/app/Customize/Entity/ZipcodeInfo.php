<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;

if (!class_exists('\Customize\Entity\ZipcodeInfo')) {
    /**
     * ZipcodeInfo
     *
     * @ORM\Table(name="dtb_zipcode_info"
     * ,indexes={
     *     @ORM\Index(name="zipcode_idx", columns={"zipcode"})
     * })
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\ZipcodeInfoRepository")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    class ZipcodeInfo extends \Eccube\Entity\AbstractEntity
    {
        /**
         * @var integer
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var string 
         *
         * @ORM\Column(name="public_group_code", type="string", length=8, nullable=true, options={"comment":"全国地方公共団体コード"}) 
         */
        private $public_group_code;

        /**
         * @var string 
         *
         * @ORM\Column(name="old_zipcode", type="string", length=5, nullable=true, options={"comment":"（旧）郵便番号（5桁）"}) 
         */
        private $old_zipcode;

        /**
         * @var string 
         *
         * @ORM\Column(name="zipcode", type="string", length=7, nullable=true, options={"comment":"郵便番号（7桁）"}) 
         */
        private $zipcode;
        
        /**
         * @var string 
         *
         * @ORM\Column(name="county_name_ka", type="string", length=100, nullable=true, options={"comment":"都道府県名(半角カタカナ)"}) 
         */
        private $county_name_ka;

        /**
         * @var string 
         *
         * @ORM\Column(name="city_name_ka", type="string", length=100, nullable=true, options={"comment":"市区町村名(半角カタカナ)"}) 
         */
        private $city_name_ka;

        /**
         * @var string 
         *
         * @ORM\Column(name="township_name_ka", type="string", length=100, nullable=true, options={"comment":"町域名(半角カタカナ)"}) 
         */
        private $township_name_ka;

        /**
         * @var string 
         *
         * @ORM\Column(name="county_name", type="string", length=100, nullable=true, options={"comment":"都道府県名"}) 
         */
        private $county_name;

        /**
         * @var string 
         *
         * @ORM\Column(name="city_name", type="string", length=100, nullable=true, options={"comment":"市区町村名"}) 
         */
        private $city_name;

        /**
         * @var string 
         *
         * @ORM\Column(name="township_name", type="string", length=100, nullable=true, options={"comment":"町域名"}) 
         */
        private $township_name;

        /**
         * @var string （「1」は該当、「0」は該当せず）
         *
         * @ORM\Column(name="option_1", type="string", length=1, nullable=true, options={"comment":"一町域が二以上の郵便番号で表される場合の表示"}) 
         */
        private $option_1;

        /**
         * @var string （「1」は該当、「0」は該当せず）
         *
         * @ORM\Column(name="option_2", type="string", length=1, nullable=true, options={"comment":"小字毎に番地が起番されている町域の表示"}) 
         */
        private $option_2;
        
        /**
         * @var string （「1」は該当、「0」は該当せず）
         *
         * @ORM\Column(name="option_3", type="string", length=1, nullable=true, options={"comment":"丁目を有する町域の場合の表示"}) 
         */
        private $option_3;

        /**
         * @var string （「1」は該当、「0」は該当せず）
         *
         * @ORM\Column(name="option_4", type="string", length=1, nullable=true, options={"comment":"一つの郵便番号で二以上の町域を表す場合の表示"}) 
         */
        private $option_4;

        /**
         * @var string （「0」は変更なし、「1」は変更あり、「2」廃止（廃止データのみ使用））
         *
         * @ORM\Column(name="option_is_modify", type="string", length=1, nullable=true, options={"comment":"更新の表示"}) 
         */
        private $option_is_modify;

        /**
         * @var string （「0」は変更なし、「1」市政・区政・町政・分区・政令指定都市施行、「2」住居表示の実施、「3」区画整理、「4」郵便区調整等、「5」訂正、「6」廃止（廃止データのみ使用））
         *
         * @ORM\Column(name="option_reason", type="string", length=1, nullable=true, options={"comment":"変更理由"}) 
         */
        private $option_reason;

        /**
         * Constructor
         */
        public function __construct()
        {
            
        }

        /**
         * Get id.
         *
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set public_group_code
         *
         * @param string $public_group_code
         *
         * @return ZipcodeInfo
         */
        public function setPublicGroupCode($public_group_code = null)
        {
            $this->public_group_code = $public_group_code;

            return $this;
        }

        /**
         * Get public_group_code
         *
         * @return string
         */
        public function getPublicGroupCode()
        {
            return $this->public_group_code;
        }

        /**
         * Set old_zipcode
         *
         * @param string $old_zipcode
         *
         * @return ZipcodeInfo
         */
        public function setOldZipcode($old_zipcode = null)
        {
            $this->old_zipcode = $old_zipcode;

            return $this;
        }

        /**
         * Get old_zipcode
         *
         * @return string
         */
        public function getOldZipcode()
        {
            return $this->old_zipcode;
        }

        /**
         * Set zipcode.
         *
         * @param string|null $zipcode
         *
         * @return ZipcodeInfo
         */
        public function setZipcode($zipcode = null)
        {
            $this->zipcode = $zipcode;

            return $this;
        }

        /**
         * Get zipcode.
         *
         * @return string|null
         */
        public function getZipcode()
        {
            return $this->zipcode;
        }

        /**
         * Set county_name_ka.
         *
         * @param string|null $county_name_ka
         *
         * @return ZipcodeInfo
         */
        public function setCountyNameKa($county_name_ka = null)
        {
            $this->county_name_ka = $county_name_ka;

            return $this;
        }

        /**
         * Get county_name_ka.
         *
         * @return string|null
         */
        public function getCountyNameKa()
        {
            return $this->county_name_ka;
        }

        /**
         * Set city_name_ka.
         *
         * @param string|null $city_name_ka
         *
         * @return ZipcodeInfo
         */
        public function setCityNameKa($city_name_ka = null)
        {
            $this->city_name_ka = $city_name_ka;

            return $this;
        }

        /**
         * Get city_name_ka.
         *
         * @return string|null
         */
        public function getCityNameKa()
        {
            return $this->city_name_ka;
        }


        /**
         * Set township_name_ka.
         *
         * @param string|null $township_name_ka
         *
         * @return ZipcodeInfo
         */
        public function setTownshipNameKa($township_name_ka = null)
        {
            $this->township_name_ka = $township_name_ka;

            return $this;
        }

        /**
         * Get township_name_ka.
         *
         * @return string|null
         */
        public function getTownshipNameKa()
        {
            return $this->township_name_ka;
        }

        /**
         * Set county_name.
         *
         * @param string|null $county_name
         *
         * @return ZipcodeInfo
         */
        public function setCountyName($county_name = null)
        {
            $this->county_name = $county_name;

            return $this;
        }

        /**
         * Get county_name.
         *
         * @return string|null
         */
        public function getCountyName()
        {
            return $this->county_name;
        }


        /**
         * Set city_name.
         *
         * @param string|null $city_name
         *
         * @return ZipcodeInfo
         */
        public function setCityName($city_name = null)
        {
            $this->city_name = $city_name;

            return $this;
        }

        /**
         * Get city_name.
         *
         * @return string|null
         */
        public function getCityName()
        {
            return $this->city_name;
        }


        /**
         * Set township_name.
         *
         * @param string|null $township_name
         *
         * @return ZipcodeInfo
         */
        public function setTownshipName($township_name = null)
        {
            $this->township_name = $township_name;

            return $this;
        }

        /**
         * Get township_name.
         *
         * @return string|null
         */
        public function getTownshipName()
        {
            return $this->township_name;
        }


        /**
         * Set option_1.
         *
         * @param string|null $option_1
         *
         * @return ZipcodeInfo
         */
        public function setOption1($option_1 = null)
        {
            $this->option_1 = $option_1;

            return $this;
        }

        /**
         * Get option_1.
         *
         * @return string|null
         */
        public function getOption1()
        {
            return $this->option_1;
        }

        /**
         * Set option_2.
         *
         * @param string|null $option_2
         *
         * @return ZipcodeInfo
         */
        public function setOption2($option_2 = null)
        {
            $this->option_2 = $option_2;

            return $this;
        }

        /**
         * Get option_2.
         *
         * @return string|null
         */
        public function getOption2()
        {
            return $this->option_2;
        }

        /**
         * Set option_3.
         *
         * @param string|null $option_3
         *
         * @return ZipcodeInfo
         */
        public function setOption3($option_3 = null)
        {
            $this->option_3 = $option_3;

            return $this;
        }

        /**
         * Get option_3.
         *
         * @return string|null
         */
        public function getOption3()
        {
            return $this->option_3;
        }

        /**
         * Set option_4.
         *
         * @param string|null $option_4
         *
         * @return ZipcodeInfo
         */
        public function setOption4($option_4 = null)
        {
            $this->option_4 = $option_4;

            return $this;
        }

        /**
         * Get option_4.
         *
         * @return string|null
         */
        public function getOption4()
        {
            return $this->option_4;
        }

        /**
         * Set option_is_modify.
         *
         * @param string|null $option_is_modify
         *
         * @return ZipcodeInfo
         */
        public function setOptionIsModify($option_is_modify = null)
        {
            $this->option_is_modify = $option_is_modify;

            return $this;
        }

        /**
         * Get option_is_modify.
         *
         * @return string|null
         */
        public function getOptionIsModify()
        {
            return $this->option_is_modify;
        }


        /**
         * Set option_reason.
         *
         * @param string|null $option_reason
         *
         * @return ZipcodeInfo
         */
        public function setOptionReason($option_reason = null)
        {
            $this->option_reason = $option_reason;

            return $this;
        }

        /**
         * Get option_reason.
         *
         * @return string|null
         */
        public function getOptionReason()
        {
            return $this->option_reason;
        }
    }
}
