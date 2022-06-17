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


use Plugin\CustomerGroup\Tests\TestCaseTrait;

class CustomerEditControllerTest extends \Eccube\Tests\Web\Admin\Customer\CustomerEditControllerTest
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
        $this->formData = $this->createCustomerFormData();
    }

    public function test会員グループを設定して新規会員登録できるか()
    {
        $this->formData['groups'][] = $this->group->getId();

        $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_new'),
            ['admin_customer' => $this->formData]
        );

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());
        // チェックされているか
        self::assertEquals('checked', $crawler->filter('input#admin_customer_groups_' . $this->group->getId())->attr('checked'));
    }
}
