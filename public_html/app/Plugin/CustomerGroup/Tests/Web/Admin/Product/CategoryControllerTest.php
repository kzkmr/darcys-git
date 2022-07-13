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


use Eccube\Entity\Category;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class CategoryControllerTest extends AbstractAdminWebTestCase
{
    use TestCaseTrait;

    /**
     * @var \Plugin\CustomerGroup\Entity\Group
     */
    protected $group;

    /**
     * @var array
     */
    protected $formData;

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->createGroup();
        $this->formData = $this->createCategoryFormData();
    }

    public function testRoutingAdminProductCategory()
    {
        $this->client->request('GET',
            $this->generateUrl('admin_product_category')
        );

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test会員グループが登録されたカテゴリは削除できない()
    {
        /** @var Category $category */
        $category = $this->entityManager->find(Category::class, 1);

        $category->addGroup($this->group);
        $this->group->addCategory($category);
        $this->entityManager->flush();

        $this->client->request('DELETE', $this->generateUrl('admin_product_category_delete', ['id' => $category->getId()]));

        $crawler = $this->client->followRedirect();

        $message = trans('admin.common.delete_error_foreign_key', ['%name%' => $category->getName()]);
        self::assertContains($message, $crawler->filter('.alert-danger')->text());
    }

    public function test新規カテゴリ登録できるか()
    {
        $this->client->request(
            'POST',
            $this->generateUrl('admin_product_category'),
            ['admin_category' => $this->formData]
        );

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());
    }

    public function test会員グループを設定して新規カテゴリ登録できるか()
    {
        $this->formData['groups'][] = $this->group->getId();

        $crawler = $this->client->request('GET', $this->generateUrl('admin_product_category'));
        self::assertNull($crawler->filter('input#category_1_groups_' . $this->group->getId())->attr('checked'));

        $this->client->request(
            'POST',
            $this->generateUrl('admin_product_category'),
            ['category_1' => $this->formData]
        );

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());
        // チェックされているか
        self::assertEquals('checked', $crawler->filter('input#category_1_groups_' . $this->group->getId())->attr('checked'));
    }
}
