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
use Eccube\Annotation\EntityExtension;

/**
  * @EntityExtension("Eccube\Entity\Customer")
 */
trait  CustomerTrait
{
    /**
     * @var \Customize\Entity\ChainStore
     *
     * @ORM\ManyToOne(targetEntity="Customize\Entity\ChainStore", inversedBy="customers", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chain_store_id", referencedColumnName="id")
     * })
     */
    private $ChainStore;

    //Private
    private $IsChainStore;

    /**
     * Set ChainStore
     *
     * @param string $ChainStore
     *
     * @return Customer
     */
    public function setChainStore($ChainStore)
    {
        $this->ChainStore = $ChainStore;

        return $this;
    }

    /**
     * Get ChainStore
     *
     * @return ChainStore
     */
    public function getChainStore()
    {
        return $this->ChainStore;
    }

    /**
     * Set is ChainStore
     *
     * @param string $IsChainStore
     *
     * @return Customer
     */
    public function setIsChainStore($IsChainStore)
    {
        $this->IsChainStore = $IsChainStore;

        return $this;
    }

    /**
     * Get IsChainStore
     *
     * @return ChainStore
     */
    public function getIsChainStore()
    {
        return $this->IsChainStore;
    }

}
