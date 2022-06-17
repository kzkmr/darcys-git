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

namespace Plugin\CustomerClassPrice4\Tests\Doctrine\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Eccube\Entity\ProductClass;
use Eccube\Service\TaxRuleService;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerClassPrice4\Doctrine\EventListener\TaxRuleEventSubscriber;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;

class TaxRuleEventSubscriberTest extends EccubeTestCase
{
    protected $listener;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $container = self::$kernel->getContainer();

        $this->listener = new TaxRuleEventSubscriber(
            $container->get(TaxRuleService::class)
        );
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function test税込み価格がセットされるか()
    {
        $customerClass = $this->createCustomerClass();
        $product = $this->createProduct();
        $customerClassPrice = $this->createCustomerClassPrice($customerClass, $product->getProductClasses()->first(), 1000);

        $eventArgs = $this->createMock(LifecycleEventArgs::class);
        $eventArgs->expects($this->once())
            ->method('getObject')
            ->willReturn($customerClassPrice);

        $this->listener->postLoad($eventArgs);

        self::assertEquals(1100, $customerClassPrice->getPriceIncTax());
    }

    private function createCustomerClass()
    {
        $customerClass = new CustomerClass();
        $customerClass->setName('特定会員');
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
