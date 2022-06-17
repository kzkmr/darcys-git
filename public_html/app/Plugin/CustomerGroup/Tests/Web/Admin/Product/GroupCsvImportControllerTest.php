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

namespace Plugin\CustomerGroup\Tests\Web\Admin\Product;


use Eccube\Common\Constant;
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
     * @var \Eccube\Entity\Product
     */
    protected $product;

    public function setUp()
    {
        parent::setUp();

        $project_dir = self::$container->getParameter('kernel.project_dir');

        $this->filepath = __DIR__ . '/product_group.csv';
        copy($project_dir . '/app/Plugin/CustomerGroup/Tests/Fixtures/product_group.csv', $this->filepath);

        $this->product = $this->createProduct();
    }

    public function testRouting()
    {
        $this->client->request('GET', $this->generateUrl('admin_customer_group_csv_upload'));
        self::assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function test追加()
    {
        $csv = [];
        for ($i = 0; $i < 1000; $i++) {
            $group = $this->createGroup();
            $csv[] = [
                'product_id' => $this->product->getId(),
                'product_name' => $this->product,
                'group_id' => $group->getId(),
                'delete_flag' => ''
            ];
        }

        $file = $this->createCsvFile($csv);

        $file = new UploadedFile(
            $file->getPathname(),
            'product_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $this->client->request(
            'POST',
            $this->generateUrl('admin_product_group_csv_upload'),
            [
                'admin_csv_import' => [
                    'import_file' => $file,
                    Constant::TOKEN_NAME => 'dummy'
                ]
            ]
        );
        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('admin_product_group_csv_upload')));
        self::assertCount(1000, $this->product->getGroups());
    }

    public function test商品が存在しなければエラー()
    {
        $csv = [[
            'product_id' => 100000,
            'product_name' => 'sample',
            'group_id' => $this->createGroup()->getId(),
            'delete_flag' => ''
        ]];

        $file = $this->createCsvFile($csv);

        $file = new UploadedFile(
            $file->getPathname(),
            'product_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $crawler = $this->client->request(
            'POST',
            $this->generateUrl('admin_product_group_csv_upload'),
            [
                'admin_csv_import' => [
                    'import_file' => $file,
                    Constant::TOKEN_NAME => 'dummy'
                ]
            ]
        );
        self::assertTrue($this->client->getResponse()->isSuccessful());
        self::assertContains('行目の商品IDが存在しません', $crawler->filter('.text-danger')->text());
    }

    public function test会員グループが存在しなければエラー()
    {
        $product = $this->createProduct();
        $csv = [[
            'product_id' => $product->getId(),
            'product_name' => $product,
            'group_id' => 1000000,
            'delete_flag' => ''
        ]];

        $file = $this->createCsvFile($csv);

        $file = new UploadedFile(
            $file->getPathname(),
            'product_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $crawler = $this->client->request(
            'POST',
            $this->generateUrl('admin_product_group_csv_upload'),
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
        $this->product->addGroup($group);
        $group->addProduct($this->product);

        self::assertCount(1, $this->product->getGroups());

        $file = $this->createCsvFile([[
            'product_id' => $this->product->getId(),
            'product_name' => $this->product,
            'group_id' => $group->getId(),
            'delete_flag' => 'D'
        ]]);

        $file = new UploadedFile(
            $file->getPathname(),
            'product_group.csv',
            'text/csv',
            null,
            null,
            true
        );

        $this->client->request(
            'POST',
            $this->generateUrl('admin_product_group_csv_upload'),
            [
                'admin_csv_import' => [
                    'import_file' => $file,
                    Constant::TOKEN_NAME => 'dummy'
                ]
            ]
        );
        self::assertTrue($this->client->getResponse()->isRedirect($this->generateUrl('admin_product_group_csv_upload')));
        self::assertCount(0, $this->product->getGroups());
    }

    protected function createCsvFile(array $datas)
    {
        $file = new \SplFileObject($this->filepath, 'w');

        // ヘッダー設定
        $file->fputcsv([
            trans('商品ID'),
            trans('商品名'),
            trans('会員グループID'),
            trans('削除フラグ')
        ]);

        foreach ($datas as $data) {
            $file->fputcsv([
                $data['product_id'],
                $data['product_name'],
                $data['group_id'],
                $data['delete_flag']
            ]);
        }

        return $file;
    }
}
