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

namespace Plugin\CustomerClassPrice4\Service;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Customer;
use Plugin\CustomerClassPrice4\Entity\Config;

class DiscountHelper
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CustomerClassPriceHelper
     */
    private $customerClassPriceHelper;

    public function __construct(
        EntityManagerInterface $entityManager,
        CustomerClassPriceHelper $customerClassPriceHelper
    )
    {
        $this->entityManager = $entityManager;
        $this->customerClassPriceHelper = $customerClassPriceHelper;
    }

    /**
     * 割引が設定されている特定会員の場合、割引価格を計算
     *
     * @param string $price
     * @param Customer $Customer
     * @return float
     */
    public function calculatePrice(string $price, Customer $Customer): float
    {
        $RoundingType = $this->entityManager->getRepository(Config::class)->get()->getRoundingType();

        $DiscountRate = $Customer->getPlgCcpCustomerClass()->getDiscountRate();
        if ($DiscountRate) {
            // 四捨五入。JPY以外の場合下三桁を四捨五入
            return $this->customerClassPriceHelper->roundByRoundingType($price * ((100 - $DiscountRate) / 100), $RoundingType);
        }

        return $price;
    }
}
