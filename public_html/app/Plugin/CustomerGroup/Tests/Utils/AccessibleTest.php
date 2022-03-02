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

namespace Plugin\CustomerGroup\Tests\Utils;


use Eccube\Entity\Customer;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Security\Authorization\Voter\ProductVoter;
use Plugin\CustomerGroup\Service\Access\Gate\ProductGate;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Plugin\CustomerGroup\Utils\Accessible;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AccessibleTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var ProductGate
     */
    protected $product;

    /**
     * @var Group
     */
    protected $group;

    /**
     * @var Accessible
     */
    protected $accessible;

    public function setUp()
    {
        parent::setUp();

        $this->customer = $this->createCustomer();
        $this->product = $this->createProduct();
        $this->group = $this->createGroup();

        $this->accessible = self::$container->get(Accessible::class);
    }

    public function test未ログインユーザー_グループ未登録商品_OK()
    {
        $token = $this->createMock(AnonymousToken::class);
        self::assertTrue($this->accessible->can(ProductVoter::VIEW, $this->product, $token));
    }

    public function test未ログインユーザー_グループ登録商品_NG()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $token = $this->createMock(AnonymousToken::class);
        self::assertFalse($this->accessible->can(ProductVoter::VIEW, $this->product, $token));
    }

    public function testログインユーザー_グループ未登録ユーザー_グループ登録商品_NG()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);
        self::assertFalse($this->accessible->can(ProductVoter::VIEW, $this->product, $token));
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録商品_グループ一致_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);
        self::assertTrue($this->accessible->can(ProductVoter::VIEW, $this->product, $token));
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録商品_グループ未一致_NG()
    {
        $group1 = $this->createGroup();
        $group2 = $this->createGroup();

        $this->customer->addGroup($group1);
        $group1->addCustomer($this->customer);
        $this->product->addGroup($group2);
        $group2->addProduct($this->product);

        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($this->customer);
        self::assertFalse($this->accessible->can(ProductVoter::VIEW, $this->product, $token));
    }
}
