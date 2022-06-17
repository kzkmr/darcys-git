<?php
/**
 * This file is part of CustomerGroupEntry
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroupEntry\Tests\Web\Admin\Customer;


use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class GroupControllerTest extends AbstractAdminWebTestCase
{
    use TestCaseTrait;

    /**
     * @var array
     */
    protected $formData;

    public function setUp()
    {
        parent::setUp();

        $this->formData = $this->createGroupFormData();
    }

    public function test会員登録時に会員グループ登録が有効化された会員グループがある場合、他の会員グループは有効化できない()
    {
        $group1 = $this->createGroup();
        $group1->setOptionEntry(true);
        $this->entityManager->flush();

        $group2 = $this->createGroup();

        $this->formData['optionEntry'] = 1;
        $crawler = $this->client->request('POST',
            $this->generateUrl('admin_customer_group_edit', ['id' => $group2->getId()]),
            ['group' => $this->formData]
        );

        self::assertContains(
            trans('customer_group_entry.admin.group.option_entry_error', ['%name%' => $group1->getName()]),
            $crawler->filter('span.form-error-message')->text()
        );
    }
}
