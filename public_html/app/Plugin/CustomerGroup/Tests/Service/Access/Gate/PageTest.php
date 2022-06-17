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
use Plugin\CustomerGroup\Security\Authorization\Voter\PageVoter;
use Plugin\CustomerGroup\Service\Access\Context;
use Plugin\CustomerGroup\Service\Access\Request;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class PageTest extends EccubeTestCase
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

    /**
     * @var \Eccube\Entity\Page
     */
    protected $page;

    public function setUp()
    {
        parent::setUp();

        $this->context = self::$container->get(Context::class);
        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->page = $this->createPage();
    }

    public function testグループ未登録ページ_未ログインユーザー_OK()
    {
        $token = $this->createMock(AnonymousToken::class);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->page);

        self::assertTrue($this->context->allow(PageVoter::VIEW, $request));
    }

    public function testグループ登録ページ_未ログインユーザー_NG()
    {
        $token = $this->createMock(AnonymousToken::class);

        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->page);

        self::assertFalse($this->context->allow(PageVoter::VIEW, $request));
    }

    public function testグループ登録ページ_ログインユーザー_ユーザーが登録しているグループのページがある_OK()
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->page);

        self::assertTrue($this->context->allow(PageVoter::VIEW, $request));
    }

    public function testグループ登録ページ_ログインユーザー_ユーザーが登録しているグループのページがない_NG()
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $group = $this->createGroup();
        $this->page->addGroup($group);
        $group->addPage($this->page);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->page);

        self::assertFalse($this->context->allow(PageVoter::VIEW, $request));
    }
}
