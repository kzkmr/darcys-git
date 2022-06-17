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

namespace Plugin\CustomerGroup\Tests\Service\PurchaseFlow;


use Eccube\Entity\CartItem;
use Eccube\Entity\Customer;
use Eccube\Entity\Product;
use Eccube\Service\PurchaseFlow\ItemValidator;
use Eccube\Service\PurchaseFlow\PurchaseContext;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Service\PurchaseFlow\GroupValidator;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class GroupValidatorTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Group
     */
    protected $group;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var GroupValidator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();

        $this->customer = $this->createCustomer();
        $this->product = $this->createProduct();
        $this->group = $this->createGroup();

        $this->tokenStorage = self::$container->get('security.token_storage');
        $this->validator = self::$container->get(GroupValidator::class);
    }

    public function testInstance()
    {
        self::assertInstanceOf(GroupValidator::class, $this->getValidatorForAnonymousToken());
        self::assertInstanceOf(GroupValidator::class, $this->getValidatorForUsernamePasswordToken($this->customer));
    }

    public function test商品にグループが登録されていない場合はカートに入れる()
    {
        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setProductClass($this->product->getProductClasses()->first());

        $validator = $this->getValidatorForUsernamePasswordToken($this->customer);
        $validator->execute($cartItem, new PurchaseContext(null, null));

        self::assertEquals(1, $cartItem->getQuantity());
    }

    public function test商品にグループが登録されている場合未ログインユーザーはカートに入れられない()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setProductClass($this->product->getProductClasses()->first());

        $validator = $this->getValidatorForAnonymousToken();
        $validator->execute($cartItem, new PurchaseContext(null, null));

        self::assertEquals(0, $cartItem->getQuantity());
    }

    public function testグループ登録商品_グループ未登録ユーザー_カートNG()
    {
        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setProductClass($this->product->getProductClasses()->first());

        $validator = $this->getValidatorForUsernamePasswordToken($this->customer);
        $validator->execute($cartItem, new PurchaseContext(null, null));

        self::assertEquals(0, $cartItem->getQuantity());
    }

    public function test会員と商品に登録されているグループが一致したらカートに入れる()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setProductClass($this->product->getProductClasses()->first());

        $validator = $this->getValidatorForUsernamePasswordToken($this->customer);
        $validator->execute($cartItem, new PurchaseContext(null, null));

        self::assertEquals(1, $cartItem->getQuantity());
    }

    public function test会員と商品に登録されているグループが一致しない場合カートに入れない()
    {
        $group1 = $this->createGroup();
        $group2 = $this->createGroup();

        $this->customer->addGroup($group1);

        $this->product->addGroup($group2);
        $group2->addProduct($this->product);

        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setProductClass($this->product->getProductClasses()->first());

        $validator = $this->getValidatorForUsernamePasswordToken($this->customer);
        $validator->execute($cartItem, new PurchaseContext(null, null));

        self::assertEquals(0, $cartItem->getQuantity());
    }

    public function test非会員が閲覧可能な会員グループが登録された商品はカートに入れられない()
    {
        $this->group->setOptionNonMemberDisplay(true);

        $this->product->addGroup($this->group);
        $this->group->addProduct($this->product);

        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setProductClass($this->product->getProductClasses()->first());

        $validator = $this->getValidatorForAnonymousToken();
        $validator->execute($cartItem, new PurchaseContext(null, null));

        self::assertEquals(0, $cartItem->getQuantity());
    }

    /**
     * @return ItemValidator
     */
    protected function getValidatorForAnonymousToken(): ItemValidator
    {
        $token = $this->createMock(AnonymousToken::class);
        $token->method('isAuthenticated')->willReturn(true);
        $tokenStorage = $this->tokenStorage;
        $tokenStorage->setToken($token);

        return $this->validator;
    }

    /**
     * @param Customer $customer
     * @return ItemValidator
     */
    protected function getValidatorForUsernamePasswordToken(Customer $customer): ItemValidator
    {
        $token = $this->createMock(UsernamePasswordToken::class);
        $token->method('getUser')->willReturn($customer);
        $token->method('isAuthenticated')->willReturn(true);
        $tokenStorage = $this->tokenStorage;
        $tokenStorage->setToken($token);

        return $this->validator;
    }
}
