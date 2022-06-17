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

namespace Plugin\CustomerGroup\Tests\Web\Admin\Content;


use Eccube\Common\Constant;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class PageControllerTest extends \Eccube\Tests\Web\Admin\Content\PageControllerTest
{
    use TestCaseTrait;

    /**
     * @var mixed
     */
    protected $userDataDir;

    /**
     * @var \Plugin\CustomerGroup\Entity\Group
     */
    protected $group;

    public function setUp()
    {
        parent::setUp();

        $this->userDataDir = self::$container->getParameter('eccube_theme_user_data_dir');

        $this->group = $this->createGroup();
    }

    public function test会員グループを設定してページを新規作成できるか()
    {
        $faker = $this->getFaker();
        $name = $faker->word;
        $source = $faker->realText();

        $this->client->request('POST',
            $this->generateUrl('admin_content_page_new'),
            [
                'main_edit' => [
                    'name' => $name,
                    'url' => $name,
                    'file_name' => $name,
                    'tpl_data' => $source,
                    Constant::TOKEN_NAME => 'dummy',
                    'groups' => [
                        $this->group->getId()
                    ]
                ]
            ]
        );

        $crawler = $this->client->followRedirect();
        self::assertContains(trans('admin.common.save_complete'), $crawler->filter('.alert-success')->text());
        // チェックされているか
        self::assertEquals('checked', $crawler->filter('input#main_edit_groups_' . $this->group->getId())->attr('checked'));

        if (file_exists($this->userDataDir . '/' . $name . '.twig')) {
            unlink($this->userDataDir . '/' . $name . '.twig');
        }
    }
}
