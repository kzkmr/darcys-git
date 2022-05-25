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

namespace Plugin\CustomerGroup\Tests\Service\Access\Gate;


use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Security\Authorization\Voter\GroupVoter;
use Plugin\CustomerGroup\Service\Access\Context;
use Plugin\CustomerGroup\Service\Access\Request;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class GroupTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var Context
     */
    protected $context;

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

        $this->context = self::$container->get(Context::class);

        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
    }

    public function test未ログインユーザー_NG()
    {
        $token = $this->createMock(AnonymousToken::class);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->group);

        self::assertFalse($this->context->allow(GroupVoter::VIEW, $request));
    }

    public function testログインユーザー_グループ未登録ユーザー_NG()
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->group);

        self::assertFalse($this->context->allow(GroupVoter::VIEW, $request));
    }

    public function testログインユーザー_グループ登録ユーザー_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->group);

        self::assertTrue($this->context->allow(GroupVoter::VIEW, $request));
    }
}
