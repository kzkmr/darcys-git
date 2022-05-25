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


use Eccube\Entity\Category;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class ProductControllerTest extends \Eccube\Tests\Web\ProductControllerTest
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

    /**
     * @var Category
     */
    protected $category;

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->product = $this->createProduct(null, 0);
        $this->category = $this->entityManager->find(Category::class, 1);
    }

    public function testグループ未登録商品_OK()
    {
        $this->client->request('GET', $this->generateUrl('product_detail', ['id' => $this->product->getId()]));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test未ログインユーザー_グループ登録商品_NG()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $crawler = $this->client->request('GET', $this->generateUrl('product_detail', ['id' => $this->product->getId()]));
        self::assertFalse($this->client->getResponse()->isSuccessful());
        self::assertContains(trans('exception.error_title_can_not_access'), $crawler->filter('.ec-404Role .ec-reportHeading')->text());
    }

    public function test未ログインユーザー_グループ登録商品_非会員公開_OK()
    {
        $this->group->setOptionNonMemberDisplay(true);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $this->client->request('GET', $this->generateUrl('product_detail', ['id' => $this->product->getId()]));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testログインユーザー_グループ未登録ユーザー_グループ登録商品_NG()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $this->loginTo($this->customer);

        $crawler = $this->client->request('GET', $this->generateUrl('product_detail', ['id' => $this->product->getId()]));
        self::assertFalse($this->client->getResponse()->isSuccessful());
        self::assertContains(trans('exception.error_title_can_not_access'), $crawler->filter('.ec-404Role .ec-reportHeading')->text());
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録商品_グループ一致_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $this->loginTo($this->customer);

        $this->client->request('GET', $this->generateUrl('product_detail', ['id' => $this->product->getId()]));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testグロープ未登録カテゴリ_OK()
    {
        $this->client->request('GET', $this->generateUrl('product_list', ['category_id' => $this->category->getId()]));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test未ログインユーザー_グループ登録カテゴリ_NG()
    {
        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        $crawler = $this->client->request('GET', $this->generateUrl('product_list', ['category_id' => $this->category->getId()]));
        self::assertFalse($this->client->getResponse()->isSuccessful());
        self::assertContains(trans('exception.error_title_can_not_access'), $crawler->filter('.ec-404Role .ec-reportHeading')->text());
    }

    public function testログインユーザー_グループ未登録ユーザー_グループ登録カテゴリ_NG()
    {
        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        $this->loginTo($this->customer);

        $crawler = $this->client->request('GET', $this->generateUrl('product_list', ['category_id' => $this->category->getId()]));
        self::assertFalse($this->client->getResponse()->isSuccessful());
        self::assertContains(trans('exception.error_title_can_not_access'), $crawler->filter('.ec-404Role .ec-reportHeading')->text());
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録カテゴリ_グループ一致_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        $this->loginTo($this->customer);

        $this->client->request('GET', $this->generateUrl('product_list', ['category_id' => $this->category->getId()]));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }
}
