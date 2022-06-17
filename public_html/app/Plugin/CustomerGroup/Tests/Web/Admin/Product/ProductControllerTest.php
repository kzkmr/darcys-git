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

namespace Plugin\CustomerGroup\Tests\Web\Admin\Product;


use Eccube\Common\Constant;
use Eccube\Entity\Product;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class ProductControllerTest extends AbstractAdminWebTestCase
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
     * @var array
     */
    protected $formData;

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->product = $this->entityManager->getRepository(Product::class)->findOneBy([]);
        $this->formData = $this->createProductFormData();
    }

    public function testRoutingAdminProductProduct()
    {
        $this->client->request('GET', $this->generateUrl('admin_product'));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testRoutingAdminProductProductNew()
    {
        $this->client->request('GET', $this->generateUrl('admin_product_product_new'));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test会員グループで絞り込み検索()
    {
        $this->group->addProduct($this->product);
        $this->product->addGroup($this->group);
        $this->entityManager->flush();

        $crawler = $this->client->request('POST', $this->generateUrl('admin_product'), [
            'admin_search_product' => [
                Constant::TOKEN_NAME => 'dummy',
                'group' => $this->group->getId()
            ]
        ]);

        $this->expected = '検索結果：1件が該当しました';
        $this->actual = $crawler->filter('div.c-outsideBlock__contents.mb-5 > span')->text();
        $this->verify();
    }

    public function test新規商品登録できるか()
    {
        $this->client->request(
            'POST',
            $this->generateUrl('admin_product_product_new'),
            ['admin_product' => $this->formData]
        );

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());
    }

    public function test会員グループを設定して新規商品登録できるか()
    {
        $this->formData['groups'][] = $this->group->getId();

        $this->client->request(
            'POST',
            $this->generateUrl('admin_product_product_new'),
            ['admin_product' => $this->formData]
        );

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());
        // チェックされているか
        self::assertEquals('checked', $crawler->filter('input#admin_product_groups_' . $this->group->getId())->attr('checked'));
    }

    public function test会員グループが登録された商品は削除できない()
    {
        $product = $this->createProduct();

        $product->addGroup($this->group);
        $this->group->addProduct($product);
        $this->entityManager->flush();

        $this->client->request('DELETE', $this->generateUrl('admin_product_product_delete', ['id' => $product->getId()]));

        $crawler = $this->client->followRedirect();

        $message = trans('admin.common.delete_error_foreign_key', ['%name%' => $product->getName()]);
        self::assertContains($message, $crawler->filter('.alert-danger')->text());
    }
}
