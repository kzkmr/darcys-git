<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\Tests\Web;


use Eccube\Common\Constant;
use Eccube\Entity\ProductClass;
use Eccube\Tests\Web\AbstractShoppingControllerTestCase;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class CartValidationTest extends AbstractShoppingControllerTestCase
{
    use TestCaseTrait;

    /**
     * @var \Plugin\CustomerGroup\Entity\Group
     */
    protected $group;

    /**
     * @var \Eccube\Entity\Customer
     */
    protected $customer;

    /**
     * @var \Eccube\Entity\Product
     */
    protected $product;

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->product = $this->createProduct(null, 0);
    }

    public function test未ログインユーザー_会員グループ設定商品_カートNG()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        /** @var ProductClass $productClass */
        $productClass = $this->product->getProductClasses()->first();

        $this->client->request(
            'POST',
            $this->generateUrl('product_add_cart', ['id' => $this->product->getId()]),
            [
                'product_id' => $this->product->getId(),
                'ProductClass' => $productClass->getId(),
                'quantity' => 1,
                Constant::TOKEN_NAME => 'dummy'
            ]
        );
        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('cart')));

        $crawler = $this->client->followRedirect();

        $message = $crawler->filter('.ec-alert-warning')->text();
        self::assertContains(trans('customer_group.front.cart.error', ['%product%' => $productClass->formattedProductName()]), $message);
    }

    public function test会員グループ登録ユーザー_会員グループ登録商品_一致したらカートOK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        /** @var ProductClass $productClass */
        $productClass = $this->product->getProductClasses()->first();

        $this->loginTo($this->customer);

        $this->client->request(
            'POST',
            $this->generateUrl('product_add_cart', ['id' => $this->product->getId()]),
            [
                'product_id' => $this->product->getId(),
                'ProductClass' => $productClass->getId(),
                'quantity' => 1,
                Constant::TOKEN_NAME => 'dummy'
            ]
        );
        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('cart')));

        $crawler = $this->client->followRedirect();

        self::assertCount(0, $crawler->filter('.ec-alert-warning'));
    }

    public function test会員グループ登録ユーザー_会員グループ登録商品_一致しなかったらカートNG()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $group = $this->createGroup();
        $this->product->addGroup($group);
        $group->addProduct($this->product);

        /** @var ProductClass $productClass */
        $productClass = $this->product->getProductClasses()->first();

        $this->loginTo($this->customer);

        $this->client->request(
            'POST',
            $this->generateUrl('product_add_cart', ['id' => $this->product->getId()]),
            [
                'product_id' => $this->product->getId(),
                'ProductClass' => $productClass->getId(),
                'quantity' => 1,
                Constant::TOKEN_NAME => 'dummy'
            ]
        );
        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('cart')));

        $crawler = $this->client->followRedirect();

        $message = $crawler->filter('.ec-alert-warning')->text();
        self::assertContains(trans('customer_group.front.cart.error', ['%product%' => $productClass->formattedProductName()]), $message);
    }
}
