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

namespace Plugin\CustomerGroup\Tests\Web\Admin\Customer;


use Eccube\Common\Constant;
use Eccube\Entity\Customer;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GroupCsvImportControllerTest extends AbstractAdminWebTestCase
{
    use TestCaseTrait;

    /**
     * @var string
     */
    protected $filepath;

    /**
     * @var Customer
     */
    protected $customer;

    public function setUp()
    {
        parent::setUp();

        $project_dir = self::$container->getParameter('kernel.project_dir');

        $this->filepath = __DIR__ . '/customer_group.csv';
        copy($project_dir . '/app/Plugin/CustomerGroup/Tests/Fixtures/customer_group.csv', $this->filepath);

        $this->customer = $this->createCustomer();
    }

    public function testRouting()
    {
        $this->client->request('GET', $this->generateUrl('admin_customer_group_csv_upload'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test追加()
    {
        $csv = [];
        for ($i = 0; $i < 100; $i++) {
            $group = $this->createGroup();
            $csv[] = [
                'customer_id' => $this->customer->getId(),
                'customer_name' => $this->customer,
                'group_id' => $group->getId(),
                'delete_flag' => ''
            ];
        }

        $file = $this->createCsvFile($csv);

        $file = new UploadedFile(
            $file->getPathname(),
            'customer_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_group_csv_upload'),
            [
                'admin_csv_import' => [
                    'import_file' => $file,
                    Constant::TOKEN_NAME => 'dummy'
                ]
            ]
        );
        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('admin_customer_group_csv_upload')));
        self::assertCount(100, $this->customer->getGroups());
    }

    public function test会員が存在しなければエラー()
    {
        $csv = [[
            'customer_id' => 100000,
            'customer_name' => 'sample',
            'group_id' => $this->createGroup()->getId(),
            'delete_flag' => ''
        ]];

        $file = $this->createCsvFile($csv);

        $file = new UploadedFile(
            $file->getPathname(),
            'customer_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $crawler = $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_group_csv_upload'),
            [
                'admin_csv_import' => [
                    'import_file' => $file,
                    Constant::TOKEN_NAME => 'dummy'
                ]
            ]
        );
        self::assertTrue($this->client->getResponse()->isSuccessful());
        self::assertContains('行目の会員IDが存在しません', $crawler->filter('.text-danger')->text());
    }

    public function test会員グループが存在しなければエラー()
    {
        $customer = $this->createCustomer();
        $csv = [[
            'customer_id' => $customer->getId(),
            'customer_name' => $customer,
            'group_id' => 1000000,
            'delete_flag' => ''
        ]];

        $file = $this->createCsvFile($csv);

        $file = new UploadedFile(
            $file->getPathname(),
            'customer_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $crawler = $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_group_csv_upload'),
            [
                'admin_csv_import' => [
                    'import_file' => $file,
                    Constant::TOKEN_NAME => 'dummy'
                ]
            ]
        );
        self::assertTrue($this->client->getResponse()->isSuccessful());
        self::assertContains('行目の会員グループIDが存在しません', $crawler->filter('.text-danger')->text());
    }

    public function test削除()
    {
        $group = $this->createGroup();
        $this->customer->addGroup($group);
        $group->addCustomer($this->customer);

        self::assertCount(1, $this->customer->getGroups());

        $file = $this->createCsvFile([[
            'customer_id' => $this->customer->getId(),
            'customer_name' => $this->customer,
            'group_id' => $group->getId(),
            'delete_flag' => 'D'
        ]]);

        $file = new UploadedFile(
            $file->getPathname(),
            'customer_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $this->client->request(
            'POST',
            $this->generateUrl('admin_customer_group_csv_upload'),
            [
                'admin_csv_import' => [
                    'import_file' => $file,
                    Constant::TOKEN_NAME => 'dummy'
                ]
            ]
        );
        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('admin_customer_group_csv_upload')));
        self::assertCount(0, $this->customer->getGroups());
    }

    protected function createCsvFile(array $datas)
    {
        $file = new \SplFileObject($this->filepath, 'w');

        // ヘッダー設定
        $file->fputcsv([
            trans('会員ID'),
            trans('お名前'),
            trans('会員グループID'),
            trans('削除フラグ')
        ]);

        /** @var Customer $customer */
        foreach ($datas as $data) {
            $file->fputcsv([
                $data['customer_id'],
                $data['customer_name'],
                $data['group_id'],
                $data['delete_flag']
            ]);
        }

        return $file;
    }
}
