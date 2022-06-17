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


use Eccube\Entity\Category;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Security\Authorization\Voter\CategoryVoter;
use Plugin\CustomerGroup\Service\Access\Context;
use Plugin\CustomerGroup\Service\Access\Request;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CategoryTest extends EccubeTestCase
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

        $this->context = self::$container->get(Context::class);

        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->product = $this->createProduct(null, 0);
        $this->category = $this->entityManager->find(Category::class, 1);
    }

    public function testグループ未登録カテゴリ_未ログインユーザー_OK()
    {
        $token = $this->createMock(AnonymousToken::class);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->category);

        self::assertTrue($this->context->allow(CategoryVoter::VIEW, $request));
    }

    public function testグループ登録カテゴリ_未ログインユーザー_NG()
    {
        $token = $this->createMock(AnonymousToken::class);

        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->category);

        self::assertFalse($this->context->allow(CategoryVoter::VIEW, $request));
    }

    public function testグループ登録商品_ログインユーザー_ユーザーが登録しているグループのカテゴリがある_OK()
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->category);

        self::assertTrue($this->context->allow(CategoryVoter::VIEW, $request));
    }

    public function testグループ登録商品_ログインユーザー_ユーザーが登録しているグループのカテゴリがない_NG()
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $group = $this->createGroup();
        $this->category->addGroup($group);
        $group->addCategory($this->category);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->category);

        self::assertFalse($this->context->allow(CategoryVoter::VIEW, $request));
    }
}
