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

namespace Plugin\CustomerGroup\Tests\Web\Admin;


use Eccube\Common\Constant;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;

class ConfigControllerTest extends AbstractAdminWebTestCase
{
    /**
     * @var int[]
     */
    protected $formData = [
        'optionGroupProductHidden' => 1,
        'optionGroupCategoryHidden' => 1,
    ];

    public function setUp()
    {
        parent::setUp();
    }

    public function test表示()
    {
        $this->client->request('GET', $this->generateUrl('admin_customer_group_config'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test有効にして更新()
    {
        $this->formData[Constant::TOKEN_NAME] = 'dummy';

        $this->client->request('POST', $this->generateUrl('admin_customer_group_config'), [
            'config' => $this->formData
        ]);
        self::assertTrue($this->client->getResponse()->isRedirect());

        $crawler = $this->client->followRedirect();
        self::assertEquals('checked', $crawler->filter('#config_optionGroupProductHidden')->attr('checked'));
        self::assertEquals('checked', $crawler->filter('#config_optionGroupCategoryHidden')->attr('checked'));
    }

    public function test無効にして更新()
    {
        unset($this->formData['optionGroupProductHidden']);
        unset($this->formData['optionGroupCategoryHidden']);
        $this->formData[Constant::TOKEN_NAME] = 'dummy';

        $this->client->request('POST', $this->generateUrl('admin_customer_group_config'), [
            'config' => $this->formData
        ]);
        self::assertTrue($this->client->getResponse()->isRedirect());

        $crawler = $this->client->followRedirect();
        self::assertEquals(null, $crawler->filter('#config_optionGroupProductHidden')->attr('checked'));
        self::assertEquals(null, $crawler->filter('#config_optionGroupCategoryHidden')->attr('checked'));
    }
}
