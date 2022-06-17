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

namespace Plugin\CustomerGroup\Tests\Repository;


use Eccube\Tests\Repository\ProductRepositoryGetQueryBuilderBySearchDataTest;
use Plugin\CustomerGroup\Entity\Config;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProductRepositoryTest extends ProductRepositoryGetQueryBuilderBySearchDataTest
{
    use TestCaseTrait;

    /**
     * @var Group
     */
    protected $group;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->createGroup();
        $this->tokenStorage = self::$container->get('security.token_storage');

        /** @var Config $config */
        $config = $this->entityManager->getRepository(Config::class)->get();
        $config->setOptionGroupProductHidden(true);
        $this->entityManager->flush();
    }

    public function test未ログイン時は会員グループが登録されている商品は非表示()
    {
        $token = $this->createMock(AnonymousToken::class);
        $this->tokenStorage->setToken($token);

        $product = $this->productRepository->findOneBy([], ['id' => 'ASC']);
        $product->addGroup($this->group);
        $this->group->addProduct($product);
        $this->entityManager->flush();

        $this->scenario();

        $this->expected = 2;
        $this->actual = count($this->Results);
        $this->verify();
    }

    public function test会員に登録されていない会員グループが登録されている商品は非表示()
    {
        $group = $this->createGroup();

        $customer = $this->createCustomer();
        $customer->addGroup($group);

        $product = $this->productRepository->findOneBy([], ['id' => 'ASC']);
        $product->addGroup($this->group);
        $this->group->addProduct($product);
        $this->entityManager->flush();

        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($customer);
        $this->tokenStorage->setToken($token);

        $this->scenario();

        $this->expected = 2;
        $this->actual = count($this->Results);
        $this->verify();
    }

    public function test会員グループが登録されていない会員は、会員グループが登録されている商品は非表示()
    {
        $customer = $this->createCustomer();

        $product = $this->productRepository->findOneBy([], ['id' => 'ASC']);
        $product->addGroup($this->group);
        $this->group->addProduct($product);
        $this->entityManager->flush();

        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($customer);
        $this->tokenStorage->setToken($token);

        $this->scenario();

        $this->expected = 2;
        $this->actual = count($this->Results);
        $this->verify();
    }

    public function testすべての商品に会員グループを登録すると未ログインではすべて非表示()
    {
        $token = $this->createMock(AnonymousToken::class);
        $token->method('getSecret')->willReturn('firewall');
        $token->method('getUser')->willReturn('anon.');
        $this->tokenStorage->setToken($token);

        $products = $this->productRepository->findAll();
        foreach ($products as $product) {
            $product->addGroup($this->group);
            $this->group->addProduct($product);
        }
        $this->entityManager->flush();

        $this->scenario();

        $this->expected = 0;
        $this->actual = count($this->Results);
        $this->verify();
    }

    public function test商品検索から会員グループ設定商品を非表示設定を無効化するとすべて表示()
    {
        /** @var Config $config */
        $config = $this->entityManager->getRepository(Config::class)->get();
        $config->setOptionGroupProductHidden(false);
        $this->entityManager->flush();

        $token = $this->createMock(AnonymousToken::class);
        $this->tokenStorage->setToken($token);

        $product = $this->productRepository->findOneBy([], ['id' => 'ASC']);
        $product->addGroup($this->group);
        $this->group->addProduct($product);
        $this->entityManager->flush();

        $this->scenario();

        $this->expected = 3;
        $this->actual = count($this->Results);
        $this->verify();
    }

    public function test会員にグループ1、商品にグループ1とグループ2を設定した場合正しく表示されるか()
    {
        $group1 = $this->createGroup();
        $group2 = $this->createGroup();

        $customer = $this->createCustomer();
        $customer->addGroup($group1);

        $product = $this->productRepository->findOneBy([], ['id' => 'ASC']);
        $product->addGroup($group1);
        $group1->addProduct($product);
        $product->addGroup($group2);
        $group2->addProduct($product);

        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($customer);
        $this->tokenStorage->setToken($token);

        $this->scenario();

        $this->expected = 3;
        $this->actual = count($this->Results);
        $this->verify();
    }
}
