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

namespace Plugin\CustomerGroup\Tests\Web;


use Plugin\CustomerGroup\Tests\TestCaseTrait;

class UserDataControllerTest extends \Eccube\Tests\Web\UserDataControllerTest
{
    use TestCaseTrait;

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

        $this->group = $this->createGroup();
        $this->customer = $this->createCustomer();
        $this->page = $this->createPage();

        file_put_contents(
            $this->userDataDir . '/' . $this->page->getFileName() . '.twig',
            '<h1>test</h1>'
        );
    }

    public function tearDown()
    {
        if (file_exists($this->userDataDir.'/'.$this->page->getFileName().'.twig')) {
            unlink($this->userDataDir.'/'.$this->page->getFileName().'.twig');
        }

        parent::tearDown();
    }

    public function testグループ未登録ページ_OK()
    {
        $crawler = $this->client->request('GET', $this->generateUrl('user_data', ['route' => $this->page->getUrl()]));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test未ログインユーザー_グループ登録ページ_NG()
    {
        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        $crawler = $this->client->request('GET', $this->generateUrl('user_data', ['route' => $this->page->getUrl()]));
        self::assertFalse($this->client->getResponse()->isSuccessful());
        self::assertContains(trans('exception.error_title_can_not_access'), $crawler->filter('.ec-404Role .ec-reportHeading')->text());
    }

    public function testログインユーザー_グループ未登録ユーザー_グループ登録ページ_NG()
    {
        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        $this->loginTo($this->customer);

        $crawler = $this->client->request('GET', $this->generateUrl('user_data', ['route' => $this->page->getUrl()]));
        self::assertFalse($this->client->getResponse()->isSuccessful());
        self::assertContains(trans('exception.error_title_can_not_access'), $crawler->filter('.ec-404Role .ec-reportHeading')->text());
    }

    public function testログインユーザー_グループ登録ユーザー_グループ登録商品_グループ一致_OK()
    {
        $this->customer->addGroup($this->group);
        $this->group->addCustomer($this->customer);

        $this->page->addGroup($this->group);
        $this->group->addPage($this->page);

        $this->loginTo($this->customer);

        $this->client->request('GET', $this->generateUrl('user_data', ['route' => $this->page->getUrl()]));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }
}
