<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Twig;


use Eccube\Entity\Product;
use Eccube\Entity\ProductClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Plugin\CustomerClassPrice4\Repository\CustomerClassPriceRepository;
use Plugin\CustomerClassPrice4\Repository\CustomerClassRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CustomerClassPriceExtension extends AbstractExtension
{
    /**
     * @var CustomerClassPriceRepository
     */
    private $customerClassPriceRepository;

    /**
     * @var CustomerClassRepository
     */
    private $customerClassRepository;

    public function __construct(
        CustomerClassPriceRepository $customerClassPriceRepository,
        CustomerClassRepository $customerClassRepository
    )
    {
        $this->customerClassPriceRepository = $customerClassPriceRepository;
        $this->customerClassRepository = $customerClassRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_customer_class_prices', [$this, 'getCustomerClassPrices']),
            new TwigFunction('get_customer_class_prices_inc_tax', [$this, 'getCustomerClassPricesIncTax']),
            new TwigFunction('get_customer_class_prices_as_json', [$this, 'getCustomerClassPricesAsJson'])
        ];
    }

    /**
     * @param CustomerClass $customerClass
     * @param array $productClasses
     * @return array
     */
    public function getCustomerClassPrices(CustomerClass $customerClass, array $productClasses): array
    {
        $customerClassPrices = $this->customerClassPriceRepository->findBy([
            'customerClass' => $customerClass,
            'productClass' => $productClasses
        ]);

        return array_map(function (CustomerClassPrice $customerClassPrice) {
            if (null === $customerClassPrice->getPrice()) {
                return $customerClassPrice->getProductClass()->getPrice02();
            }
            return $customerClassPrice->getPrice();
        }, $customerClassPrices);
    }

    public function getCustomerClassPricesIncTax(CustomerClass $customerClass, array $productClasses): array
    {
        $customerClassPrices = $this->customerClassPriceRepository->findBy([
            'customerClass' => $customerClass,
            'productClass' => $productClasses
        ]);

        return array_map(function (CustomerClassPrice $customerClassPrice) {
            if (null === $customerClassPrice->getPrice()) {
                return $customerClassPrice->getProductClass()->getPrice02IncTax();
            }
            return $customerClassPrice->getPriceIncTax();
        }, $customerClassPrices);
    }

    public function getCustomerClassPricesAsJson(Product $product)
    {
        $product->_calc();

        $customer_class_prices = [];

        $CustomerClasses = $this->customerClassRepository->findAll();

        /** @var CustomerClass $customerClass */
        foreach ($CustomerClasses as $customerClass) {
            /** @var ProductClass $productClass */
            foreach ($product->getProductClasses() as $productClass) {
                if (!$productClass->isVisible()) {
                    continue;
                }

                $classCategory1 = $productClass->getClassCategory1();
                $classCategory2 = $productClass->getClassCategory2();
                if ($classCategory2 && !$classCategory2->isVisible()) {
                    continue;
                }

                $class_category_id1 = $classCategory1 ? $classCategory1->getId() : '';
                $class_category_id2 = $classCategory2 ? $classCategory2->getId() : '';

                $customerClassPrice = $productClass->getPlgCcpCustomerClassPrices()->filter(function (CustomerClassPrice $customerClassPrice) use ($customerClass) {
                    return $customerClassPrice->getCustomerClass() === $customerClass;
                });

                if ($customerClassPrice->first()) {
                    $customer_class_prices[$customerClass->getId()][$class_category_id1]["#" . $class_category_id2] = [
                        'customer_class_price' => $customerClassPrice->first()->getPrice() ? $customerClassPrice->first()->getPrice() : $productClass->getPrice02(),
                        'customer_class_price_inc_tax' => $customerClassPrice->first()->getPriceIncTax() ? $customerClassPrice->first()->getPriceIncTax() : $productClass->getPrice02IncTax()
                    ];
                }
            }
        }

        return json_encode($customer_class_prices);
    }
}
