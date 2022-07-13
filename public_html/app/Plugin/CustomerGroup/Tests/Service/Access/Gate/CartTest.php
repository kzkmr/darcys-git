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
use Plugin\CustomerGroup\Security\Authorization\Voter\ProductVoter;
use Plugin\CustomerGroup\Service\Access\Context;
use Plugin\CustomerGroup\Service\Access\Request;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CartTest extends EccubeTestCase
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

    public function setUp()
    {
        parent::setUp();

        $this->context = self::$container->get(Context::class);

        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->product = $this->createProduct(null, 0);
    }

    public function testグループ登録商品_未ログインユーザー_カートNG()
    {
        $token = $this->createMock(AnonymousToken::class);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->product);

        self::assertFalse($this->context->allow(ProductVoter::CART, $request));
    }

    public function testグールプA登録商品_グループA登録ユーザー_ログインユーザー_カートOK()
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->product);

        self::assertTrue($this->context->allow(ProductVoter::CART, $request));
    }

    public function testグループ登録商品_ログインユーザー_カートNG()
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($this->product);

        self::assertFalse($this->context->allow(ProductVoter::CART, $request));
    }
}
