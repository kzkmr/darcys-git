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

namespace Plugin\CustomerGroup\Tests\Security\Authorization\Voter;


use Eccube\Entity\Customer;
use Eccube\Entity\Product;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Security\Authorization\Voter\ProductVoter;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class ProductVoterTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var ProductVoter
     */
    protected $voter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|TokenInterface
     */
    protected $token;

    /**
     * @var Group
     */
    protected $group;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var Product
     */
    protected $product;

    public function setUp()
    {
        parent::setUp();

        $this->voter = self::$container->get(ProductVoter::class);
        $this->token = $this->createMock(UsernamePasswordToken::class);
        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->product = $this->createProduct();
    }

    public function testグループ未登録商品_OK()
    {
        self::assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->token, $this->product, [ProductVoter::VIEW]));
    }

    public function test未ログインユーザー_グループ登録商品_NG()
    {
        $token = $this->createMock(AnonymousToken::class);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        self::assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($token, $this->product, [ProductVoter::VIEW]));
    }

    public function testログインユーザー_グループ未登録ユーザー_グループ登録商品_NG()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $this->token->method('getUser')->willReturn($this->customer);

        self::assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($this->token, $this->product, [ProductVoter::VIEW]));
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録商品_グループ一致_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $this->token->method('getUser')->willReturn($this->customer);

        self::assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->token, $this->product, [ProductVoter::VIEW]));
    }
}
