<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Tests\Web\Admin\Product;


use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Plugin\CustomerClassPrice4\Repository\CustomerClassPriceRepository;
use Plugin\CustomerClassPrice4\Repository\CustomerClassRepository;
use Plugin\CustomerClassPrice4\Tests\Web\Admin\AbstractWebTestCase;

class ProductControllerTest extends AbstractWebTestCase
{
    /**
     * @var \Plugin\CustomerClassPrice4\Entity\CustomerClass
     */
    protected $CustomerClass;

    /**
     * @var CustomerClassRepository
     */
    protected $CustomerClassRepository;

    /**
     * @var CustomerClassPriceRepository
     */
    protected $CustomerClassPriceRepository;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $container = self::$kernel->getContainer();

        $this->CustomerClassRepository = $this->entityManager->getRepository(CustomerClass::class);
        $this->CustomerClassPriceRepository = $this->entityManager->getRepository(CustomerClassPrice::class);

        $this->CustomerClass = $this->createCustomerClass();
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function test商品規格なし商品で特定会員価格設定欄が表示されるか()
    {
        $CustomerClassName = $this->CustomerClass->getName();

        $crawler = $this->client->request('GET', $this->generateUrl('admin_product_product_new'));

        $this->assertContains(
            $CustomerClassName,
            $crawler->filter('#customer_class_prices')->text()
        );
    }

    public function test商品規格あり商品は特定会員価格設定が表示されない()
    {
        $Product = $this->createProduct();

        $crawler = $this->client->request('GET', $this->generateUrl('admin_product_product_edit', ['id' => $Product->getId()]));

        $this->assertEquals(
            0,
            $crawler->filter('#customer_class_prices')->count()
        );
    }

    public function test商品規格あり商品は商品規格登録ページで特定会員価格設定欄が表示される()
    {
        $CustomerClassName = $this->CustomerClass->getName();
        $Product = $this->createProduct();

        $crawler = $this->client->request('GET', $this->generateUrl('admin_product_product_class', ['id' => $Product->getId()]));

        $this->assertContains(
            $CustomerClassName,
            $crawler->text()
        );
    }

    public function test商品登録ができるか()
    {
        $faker = $this->getFaker();

        $formData = $this->createProductFormData();

        $CustomerClasses = $this->CustomerClassRepository->findAll();
        /** @var CustomerClass $CustomerClass */
        foreach ($CustomerClasses as $key => $CustomerClass) {
            $customerClassPrice = $faker->randomNumber(5);

            $formData['class']['CustomerClassPrices'][$key]['customerClass'] = $CustomerClass->getId();
            $formData['class']['CustomerClassPrices'][$key]['price'] = $customerClassPrice;
        }

        $this->client->request(
            'POST',
            $this->generateUrl('admin_product_product_new'),
            [
                'admin_product' => $formData
            ]
        );

        self::assertTrue($this->client->getResponse()->isRedirection());
    }
}