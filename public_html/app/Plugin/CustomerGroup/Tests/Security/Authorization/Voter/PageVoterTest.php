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


use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Security\Authorization\Voter\PageVoter;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class PageVoterTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var PageVoter
     */
    protected $voter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|UsernamePasswordToken
     */
    protected $token;

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

        $this->voter = self::$container->get(PageVoter::class);
        $this->token = $this->createMock(UsernamePasswordToken::class);
        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->page = $this->createPage();
    }

    public function testグループ未登録ページ_OK()
    {
        self::assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->token, $this->page, [PageVoter::VIEW]));
    }

    public function test未ログインユーザー_グループ登録ページ_NG()
    {
        $token = $this->createMock(AnonymousToken::class);

        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        self::assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($token, $this->page, [PageVoter::VIEW]));
    }

    public function testログインユーザー_グループ未登録ユーザー_グループ登録ページ_NG()
    {
        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        $this->token->method('getUser')->willReturn($this->customer);

        self::assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($this->token, $this->page, [PageVoter::VIEW]));
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録ページ_グループ一致_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        $this->token->method('getUser')->willReturn($this->customer);

        self::assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->token, $this->page, [PageVoter::VIEW]));
    }
}
