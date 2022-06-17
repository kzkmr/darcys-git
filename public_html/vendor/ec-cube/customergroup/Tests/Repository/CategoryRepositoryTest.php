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


use Eccube\Entity\Category;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Repository\CategoryRepository;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CategoryRepositoryTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var array
     */
    protected $Results;

    /**
     * @var array
     */
    protected $searchData;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var \Plugin\CustomerGroup\Entity\Group
     */
    protected $group;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function setUp()
    {
        parent::setUp();

        $this->categoryRepository = self::$container->get(CategoryRepository::class);
        $this->searchData['parent'] = null;

        $this->group = $this->createGroup();
        $this->tokenStorage = self::$container->get('security.token_storage');

        $this->enableOptionCategoryHidden();
    }

    public function scenario()
    {
        $this->Results = $this->categoryRepository->getQueryBuilderBySearchData($this->searchData)
            ->getQuery()
            ->getResult();
    }

    public function test未ログイン時は会員グループが登録されているカテゴリは非表示()
    {
        $token = $this->createMock(AnonymousToken::class);
        $this->tokenStorage->setToken($token);

        /** @var Category $category */
        $category = $this->categoryRepository->find(1);
        $category->addGroup($this->group);
        $this->group->addCategory($category);
        $this->entityManager->flush();

        $this->scenario();

        $this->expected = 2;
        $this->actual = count($this->Results);
        $this->verify();
    }

    public function test会員に登録されていない会員グループが登録されているカテゴリは非表示()
    {
        $group = $this->createGroup();

        $customer = $this->createCustomer();
        $customer->addGroup($group);

        /** @var Category $category */
        $category = $this->categoryRepository->find(1);
        $category->addGroup($this->group);
        $this->group->addCategory($category);
        $this->entityManager->flush();

        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($customer);
        $this->tokenStorage->setToken($token);

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

        /** @var Category $category */
        $category = $this->categoryRepository->find(1);
        $category->addGroup($this->group);
        $this->group->addCategory($category);
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

        /** @var Category $category */
        $category = $this->categoryRepository->find(1);
        $category->addGroup($this->group);
        $this->group->addCategory($category);
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
        $this->tokenStorage->setToken($token);

        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $category->addGroup($this->group);
            $this->group->addCategory($category);
        }
        $this->entityManager->flush();

        $this->scenario();

        $this->expected = 0;
        $this->actual = count($this->Results);
        $this->verify();
    }

    public function test商品検索から会員グループ設定商品を非表示設定を無効化するとすべて表示()
    {
        $this->disableOptionCategoryHidden();

        $token = $this->createMock(AnonymousToken::class);
        $this->tokenStorage->setToken($token);

        $category = $this->categoryRepository->find(1);
        $category->addGroup($this->group);
        $this->group->addCategory($category);
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

        $category = $this->categoryRepository->find(1);
        $category->addGroup($group1);
        $group1->addCategory($category);
        $category->addGroup($group2);
        $group2->addCategory($category);

        $token = $this->createMock(TokenInterface::class);
        $token->method('getUser')->willReturn($customer);
        $this->tokenStorage->setToken($token);

        $this->scenario();

        $this->expected = 3;
        $this->actual = count($this->Results);
        $this->verify();
    }
}
