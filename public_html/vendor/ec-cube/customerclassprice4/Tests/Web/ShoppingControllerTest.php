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

namespace Plugin\CustomerClassPrice4\Tests\Web;


use Eccube\Entity\Order;
use Eccube\Entity\ProductClass;
use Eccube\Tests\Web\AbstractShoppingControllerTestCase;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;

class ShoppingControllerTest extends AbstractShoppingControllerTestCase
{
    public function testカート、購入確認画面、完了画面で販売価格が割引価格に上書きされないか()
    {
        $price02 = 2000;
        $customerClassPrice = 1000;

        $CustomerClass = $this->createCustomerClass();

        $Customer = $this->createCustomer();
        $Customer->setPlgCcpCustomerClass($CustomerClass);

        $Product = $this->createProduct();
        /** @var ProductClass $ProductClass */
        $ProductClass = $Product->getProductClasses()->first();
        $ProductClass->setPrice02($price02);

        $this->createCustomerClassPrice($CustomerClass, $ProductClass, $customerClassPrice);

        // カート画面
        $this->scenarioCartIn($Customer, $ProductClass->getId());

        // 手続き画面
        $crawler = $this->scenarioConfirm($Customer);
        $this->expected = 'ご注文手続き';
        $this->actual = $crawler->filter('.ec-pageHeader h1')->text();
        $this->verify();

        // 確認画面
        $crawler = $this->scenarioComplete($Customer, $this->generateUrl('shopping_confirm'));
        $this->expected = 'ご注文内容のご確認';
        $this->actual = $crawler->filter('.ec-pageHeader h1')->text();
        $this->verify();

        // 完了画面
        $this->scenarioCheckout($Customer);
        $this->assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('shopping_complete')));

        $container = self::$kernel->getContainer();
        $ProductClassRepository = $this->entityManager->getRepository(ProductClass::class);
        $ProductClass = $ProductClassRepository->find($ProductClass->getId());

        self::assertSame($price02, (int)$ProductClass->getPrice02());
    }

    public function test特定会員が購入したら受注データに会員種別が登録されるか()
    {
        $price02 = 2000;
        $customerClassPrice = 1000;

        $CustomerClass = $this->createCustomerClass();

        $Customer = $this->createCustomer();
        $Customer->setPlgCcpCustomerClass($CustomerClass);

        $Product = $this->createProduct();
        /** @var ProductClass $ProductClass */
        $ProductClass = $Product->getProductClasses()->first();
        $ProductClass->setPrice02($price02);

        $this->createCustomerClassPrice($CustomerClass, $ProductClass, $customerClassPrice);

        // カート画面
        $this->scenarioCartIn($Customer, $ProductClass->getId());

        // 手続き画面
        $crawler = $this->scenarioConfirm($Customer);
        $this->expected = 'ご注文手続き';
        $this->actual = $crawler->filter('.ec-pageHeader h1')->text();
        $this->verify();

        // 確認画面
        $crawler = $this->scenarioComplete($Customer, $this->generateUrl('shopping_confirm'));
        $this->expected = 'ご注文内容のご確認';
        $this->actual = $crawler->filter('.ec-pageHeader h1')->text();
        $this->verify();

        // 完了画面
        $this->scenarioCheckout($Customer);
        $this->assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('shopping_complete')));

        $orderRepository = $this->entityManager->getRepository(Order::class);

        // customer_class_id がセットされているか確認
        /** @var Order[] $Orders */
        $Orders = $orderRepository->findBy([], ['create_date' => 'DESC']);
        self::assertNotNull($Orders[0]->getPlgCcpCustomerClass());
        self::assertSame($CustomerClass->getId(), $Orders[0]->getPlgCcpCustomerClass()->getId());

    }

    public function createCustomerClass()
    {
        $CustomerClass = new CustomerClass();
        $CustomerClass->setName('特定会員');
        $this->entityManager->persist($CustomerClass);
        $this->entityManager->flush();

        return $CustomerClass;
    }

    public function createCustomerClassPrice(CustomerClass $customerClass, ProductClass $productClass, int $price)
    {
        $CustomerClassPrice = new CustomerClassPrice();
        $CustomerClassPrice->setCustomerClass($customerClass);
        $CustomerClassPrice->setProductClass($productClass);
        $CustomerClassPrice->setPrice($price);
        $this->entityManager->persist($CustomerClassPrice);
        $this->entityManager->flush();

        return $CustomerClassPrice;
    }
}
