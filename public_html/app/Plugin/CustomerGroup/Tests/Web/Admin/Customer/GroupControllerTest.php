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

namespace Plugin\CustomerGroup\Tests\Web\Admin\Customer;


use Eccube\Entity\Category;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class GroupControllerTest extends AbstractAdminWebTestCase
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

        $this->formData = $this->createGroupFormData();
    }

    public function test一覧ページが表示されるか()
    {
        $this->client->request('GET', $this->generateUrl('admin_customer_group'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test新規登録ページが表示されるか()
    {
        $this->client->request('GET', $this->generateUrl('admin_customer_group_new'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test新規登録()
    {
        $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_group_new'),
            ['group' => $this->formData]
        );

        self::assertTrue($this->client->getResponse()->isRedirection());

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());

        $group = $this->entityManager->getRepository(Group::class)->findOneBy([], ['id' => 'DESC']);
        self::assertEquals(1, $group->getSortNo());
    }

    public function test編集()
    {
        $group = $this->createGroup();

        $this->formData['name'] = 'グループ名';
        $this->formData['backendName'] = '管理名';

        $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_group_edit', ['id' => $group->getId()]),
            ['group' => $this->formData]
        );

        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('admin_customer_group_edit', ['id' => $group->getId()])));

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());
        self::assertEquals('グループ名', $crawler->filter('#group_name')->attr('value'));
        self::assertEquals('管理名', $crawler->filter('#group_backendName')->attr('value'));
        self::assertEquals('checked', $crawler->filter('#group_optionNonMemberDisplay')->attr('checked'));
    }

    public function test編集2()
    {
        $group = $this->createGroup();

        $this->formData['name'] = 'グループ名';
        unset($this->formData['backendName']);
        unset($this->formData['optionNonMemberDisplay']);

        $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_group_edit', ['id' => $group->getId()]),
            ['group' => $this->formData]
        );

        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('admin_customer_group_edit', ['id' => $group->getId()])));

        $crawler = $this->client->followRedirect();
        self::assertEquals('グループ名', $crawler->filter('#group_name')->attr('value'));
        self::assertEquals('', $crawler->filter('#group_backendName')->attr('value'));
        self::assertEquals(null, $crawler->filter('#group_optionNonMemberDisplay')->attr('checked'));
    }

    public function test会員に会員グループが登録されていても会員グループは削除可能()
    {
        $group = $this->createGroup();
        $customer = $this->createCustomer();

        $customer->addGroup($group);
        $group->addCustomer($customer);
        $this->entityManager->flush();

        $this->client->request('DELETE', $this->generateUrl('admin_customer_group_delete', ['id' => $group->getId()]));

        $crawler = $this->client->followRedirect();

        $message = trans('admin.common.delete_complete');
        self::assertContains($message, $crawler->filter('.alert-success')->text());
    }

    public function test商品に会員グループが登録されていても会員グループは削除可能()
    {
        $group = $this->createGroup();
        $product = $this->createProduct();

        $product->addGroup($group);
        $group->addProduct($product);
        $this->entityManager->flush();

        $this->client->request('DELETE', $this->generateUrl('admin_customer_group_delete', ['id' => $group->getId()]));

        $crawler = $this->client->followRedirect();

        $message = trans('admin.common.delete_complete');
        self::assertContains($message, $crawler->filter('.alert-success')->text());
    }

    public function testカテゴリに会員グループが登録されていても会員グループは削除可能()
    {
        $group = $this->createGroup();

        /** @var Category $category */
        $category = $this->entityManager->find(Category::class, 1);

        $category->addGroup($group);
        $group->addCategory($category);
        $this->entityManager->flush();

        $this->client->request('DELETE', $this->generateUrl('admin_customer_group_delete', ['id' => $group->getId()]));

        $crawler = $this->client->followRedirect();

        $message = trans('admin.common.delete_complete');
        self::assertContains($message, $crawler->filter('.alert-success')->text());
    }

    public function test並べ替え()
    {
        $group1 = $this->createGroup();
        $group2 = $this->createGroup();
        $group3 = $this->createGroup();

        $this->client->request(
            'PUT',
            $this->generateUrl('admin_customer_group_sort', [
                'groups' => 'group[]=' . $group2->getId() . '&group[]=' . $group3->getId() . '&group[]=' . $group1->getId()
            ]),
            [],
            [],
            [
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
                'CONTENT_TYPE' => 'application/json',
            ]
        );

        $data = json_decode($this->client->getResponse()->getContent());

        self::assertEquals($group2->getId(), $data[0]);
        self::assertEquals($group3->getId(), $data[1]);
        self::assertEquals($group1->getId(), $data[2]);

        self::assertEquals(1, $this->entityManager->find(Group::class, $group2->getId())->getSortNo());
        self::assertEquals(2, $this->entityManager->find(Group::class, $group3->getId())->getSortNo());
        self::assertEquals(3, $this->entityManager->find(Group::class, $group1->getId())->getSortNo());
    }
}
