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


use Eccube\Common\Constant;
use Eccube\Entity\Customer;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class CustomerControllerTest extends \Eccube\Tests\Web\Admin\Customer\CustomerControllerTest
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

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->createGroup();
        $this->customer = $this->entityManager->getRepository(Customer::class)->findOneBy([]);
    }

    public function test会員グループで絞り込み検索()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);
        $this->entityManager->flush();

        $crawler = $this->client->request('POST', $this->generateUrl('admin_customer'), [
            'admin_search_customer' => [
                Constant::TOKEN_NAME => 'dummy',
                'group' => $this->group->getId()
            ]
        ]);

        $this->expected = '検索結果：1件が該当しました';
        $this->actual = $crawler->filter('div.c-outsideBlock__contents.mb-5 > span')->text();
        $this->verify();
    }

    public function test会員グループが登録された会員は削除できない()
    {
        $customer = $this->createCustomer();

        $customer->addGroup($this->group);
        $this->group->addCustomer($customer);
        $this->entityManager->flush();

        $this->client->request('DELETE', $this->generateUrl('admin_customer_delete', ['id' => $customer->getId()]));

        $crawler = $this->client->followRedirect();

        $message = trans('admin.common.delete_error_foreign_key', ['%name%' => $customer->getName01().' '.$customer->getName02()]);
        self::assertContains($message, $crawler->filter('.alert-danger')->text());
    }
}
