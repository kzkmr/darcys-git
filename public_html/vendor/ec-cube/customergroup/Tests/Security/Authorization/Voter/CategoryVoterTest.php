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


use Eccube\Entity\Category;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Security\Authorization\Voter\CategoryVoter;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class CategoryVoterTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var CategoryVoter
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
     * @var Category
     */
    protected $category;

    public function setUp()
    {
        parent::setUp();

        $this->voter = self::$container->get(CategoryVoter::class);
        $this->token = $this->createMock(UsernamePasswordToken::class);
        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->category = $this->entityManager->find(Category::class, 1);
    }

    public function testグロープ未登録カテゴリ_OK()
    {
        self::assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->token, $this->category, [CategoryVoter::VIEW]));
    }

    public function test未ログインユーザー_グループ登録カテゴリ_NG()
    {
        $token = $this->createMock(AnonymousToken::class);

        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        self::assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($token, $this->category, [CategoryVoter::VIEW]));
    }

    public function testログインユーザー_グループ未登録ユーザー_グループ登録カテゴリ_NG()
    {
        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        $this->token->method('getUser')->willReturn($this->customer);

        self::assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($this->token, $this->category, [CategoryVoter::VIEW]));
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録カテゴリ_グループ一致_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->category->addGroup($this->group);
        $this->group->addCategory($this->category);

        $this->token->method('getUser')->willReturn($this->customer);

        self::assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->token, $this->category, [CategoryVoter::VIEW]));
    }
}
