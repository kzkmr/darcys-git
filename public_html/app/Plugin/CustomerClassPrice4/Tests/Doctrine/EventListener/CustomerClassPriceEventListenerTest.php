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

namespace Plugin\CustomerClassPrice4\Tests\Doctrine\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Eccube\Entity\Customer;
use Eccube\Entity\ProductClass;
use Eccube\Service\TaxRuleService;
use Plugin\CustomerClassPrice4\Doctrine\EventListener\CustomerClassPriceEventListener;
use Plugin\CustomerClassPrice4\Service\CustomerClassPriceHelper;
use Plugin\CustomerClassPrice4\Service\DiscountHelper;
use Plugin\CustomerClassPrice4\Tests\Web\AbstractWebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CustomerClassPriceEventListenerTest extends AbstractWebTestCase
{
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    /**
     * @dataProvider discountRateProvider
     *
     * @param $discountRate
     * @param $price02
     * @param $discountPrice
     * @param $discountPriceIncTax
     */
    public function test割引率が設定されている特定会員だったら割引価格がセットされるか($discountRate, $price02, $discountPrice, $discountPriceIncTax)
    {
        $CustomerClass = $this->createCustomerClass();
        $CustomerClass->setDiscountRate($discountRate);

        $Customer = $this->createCustomer();
        $Customer->setPlgCcpCustomerClass($CustomerClass);

        $listener = $this->createCustomerClassPriceEventListener($Customer);

        $Product = $this->createProduct();
        /** @var ProductClass $ProductClass */
        $ProductClass = $Product->getProductClasses()->first();
        $ProductClass->setPrice02($price02);

        $eventArgs = $this->createMock(LifecycleEventArgs::class);

        $eventArgs->expects($this->once())
            ->method('getObject')
            ->willReturn($ProductClass);

        $listener->postLoad($eventArgs);

        self::assertSame((float)$discountPrice, $ProductClass->getPrice02());
        self::assertSame((float)$discountPriceIncTax, $ProductClass->getPrice02IncTax());
    }

    public function discountRateProvider()
    {
        return [
            [10, 1000, 900, 990],
            [50, 1000, 500, 550],
            [99, 1000, 10, 11],
            [50, 999, 500, 550],
        ];
    }

    /**
     * @dataProvider customerClassPriceProvider
     *
     * @param $price02
     * @param $customerClassPrice
     * @param $customerClassPriceIncTax
     */
    public function test特定会員価格が設定されている会員の場合、特定会員価格がセットされる($customerClassPrice, $customerClassPriceIncTax)
    {
        $CustomerClass = $this->createCustomerClass();

        $Customer = $this->createCustomer();
        $Customer->setPlgCcpCustomerClass($CustomerClass);

        $listener = $this->createCustomerClassPriceEventListener($Customer);

        $Product = $this->createProduct();
        /** @var ProductClass $ProductClass */
        $ProductClass = $Product->getProductClasses()->first();

        $this->createCustomerClassPrice($CustomerClass, $ProductClass, $customerClassPrice);

        $eventArgs = $this->createMock(LifecycleEventArgs::class);

        $eventArgs->expects($this->once())
            ->method('getObject')
            ->willReturn($ProductClass);

        $listener->postLoad($eventArgs);

        self::assertEquals($customerClassPrice, $ProductClass->getPrice02());
        self::assertEquals($customerClassPriceIncTax, $ProductClass->getPrice02IncTax());
    }

    public function customerClassPriceProvider()
    {
        return [
            [100, 110],
            [300, 330],
            [500, 550],
            [900, 990],
        ];
    }

    public function test更新時に販売価格が割引価格に上書きされない()
    {
        $price02 = 2000;
        $customerClassPrice = 1000;

        $CustomerClass = $this->createCustomerClass();

        $Customer = $this->createCustomer();
        $Customer->setPlgCcpCustomerClass($CustomerClass);

        $listener = $this->createCustomerClassPriceEventListener($Customer);

        $Product = $this->createProduct();
        /** @var ProductClass $ProductClass */
        $ProductClass = $Product->getProductClasses()->first();
        $ProductClass->setPrice02($price02);

        $this->createCustomerClassPrice($CustomerClass, $ProductClass, $customerClassPrice);

        $eventArgs = $this->createMock(LifecycleEventArgs::class);
        $eventArgs->expects($this->once())
            ->method('getObject')
            ->willReturn($ProductClass);

        $listener->postLoad($eventArgs);

        $eventArgs = $this->createMock(PreUpdateEventArgs::class);
        $eventArgs->expects($this->once())
            ->method('getObject')
            ->willReturn($ProductClass);
        $eventArgs->method('hasChangedField')
            ->willReturn(true);
        $eventArgs->method('getOldValue')
            ->willReturn($price02);

        $listener->preUpdate($eventArgs);

        self::assertEquals($price02, $ProductClass->getPrice02());
    }

    public function createCustomerClassPriceEventListener(Customer $customer)
    {
        $customerClassPriceHelper = new CustomerClassPriceHelper(self::$container);

        $discountHelper = new DiscountHelper(
            $this->entityManager,
            $customerClassPriceHelper
        );

        $token = new UsernamePasswordToken($customer, null, 'customer', ['ROLE_USER']);
        $tokenStorage = new TokenStorage();
        $tokenStorage->setToken($token);

        $request = new Request();
        $requestStack = new RequestStack();
        $requestStack->push($request);

        return new CustomerClassPriceEventListener(
            $this->entityManager,
            self::$container->get(TaxRuleService::class),
            $discountHelper,
            $tokenStorage,
            $requestStack
        );
    }
}
