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

namespace Plugin\CustomerClassPrice4\Tests\Twig;


use Eccube\Entity\ProductClass;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Plugin\CustomerClassPrice4\Twig\CustomerClassPriceExtension;

class CustomerClassPriceExtensionTest extends EccubeTestCase
{
    /**
     * @var CustomerClassPriceExtension
     */
    protected $Extension;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->Extension = new CustomerClassPriceExtension(
            $this->entityManager->getRepository(CustomerClassPrice::class),
            $this->entityManager->getRepository(CustomerClass::class)
        );
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function testGetCustomerClassPrices()
    {
        $customerClass = $this->createCustomerClass();
        $product = $this->createProduct(null, 3);

        $price = 100;
        $expected = [];
        foreach ($product->getProductClasses() as $productClass) {
            $expected[] = $price;
            $this->createCustomerClassPrice($customerClass, $productClass, $price);
            $price = $price + 100;
        }

        $customerClassPrices = $this->Extension->getCustomerClassPrices($customerClass, $product->getProductClasses()->toArray());
        self::assertEquals($expected, $customerClassPrices);
    }

    public function testGetCustomerClassPricesIncTax()
    {
        self::markTestIncomplete();

//        $customerClass = $this->createCustomerClass();
//        $product = $this->createProduct(null, 3);
//
//        $price = 100;
//        $expected = [];
//        foreach ($product->getProductClasses() as $productClass) {
//            $customerClassPrice = $this->createCustomerClassPrice($customerClass, $productClass, $price);
//            $expected[] = $customerClassPrice->getPriceIncTax();
//            $price = $price + 100;
//        }
//
//        $customerClassPrices = $this->Extension->getCustomerClassPricesIncTax($customerClass, $product->getProductClasses()->toArray());
//        self::assertEquals($expected, $customerClassPrices);
    }

    public function testGetCustomerClassPricesAsJson()
    {
        self::markTestIncomplete();
    }

    private function createCustomerClass()
    {
        $customerClass = new CustomerClass();
        $customerClass->setName('????????????');
        $this->entityManager->persist($customerClass);
        $this->entityManager->flush();

        return $customerClass;
    }

    private function createCustomerClassPrice(CustomerClass $customerClass, ProductClass $productClass, $price)
    {
        $customerClassPrice = new CustomerClassPrice();
        $customerClassPrice
            ->setCustomerClass($customerClass)
            ->setProductClass($productClass)
            ->setPrice($price);
        $this->entityManager->persist($customerClassPrice);
        $this->entityManager->flush();

        return $customerClassPrice;
    }
}
