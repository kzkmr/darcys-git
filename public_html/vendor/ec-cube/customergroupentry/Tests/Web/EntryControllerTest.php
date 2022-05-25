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

namespace Plugin\CustomerGroupEntry\Tests\Web;


use Doctrine\Common\Collections\Criteria;
use Eccube\Entity\Customer;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class EntryControllerTest extends \Eccube\Tests\Web\EntryControllerTest
{
    use TestCaseTrait;

    public function test新規会員登録で会員グループが登録されるか()
    {
        $group = $this->createGroup();

        $formData = $this->createFormData();
        $formData['groups'] = $group->getId();

        $this->client->request('POST',
            $this->generateUrl('entry'),
            [
                'entry' => $formData,
                'mode' => 'complete'
            ]
        );

        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('entry_complete')));

        /** @var Customer $customer */
        $customer = $this->entityManager->getRepository(Customer::class)->findOneBy([], ['id' => Criteria::DESC]);
        self::assertEquals($group, $customer->getGroups()->first());
    }
}
