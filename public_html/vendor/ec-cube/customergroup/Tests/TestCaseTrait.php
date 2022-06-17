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

namespace Plugin\CustomerGroup\Tests;


use Eccube\Common\Constant;
use Eccube\Common\EccubeConfig;
use Plugin\CustomerGroup\Entity\Config;
use Plugin\CustomerGroup\Entity\Group;

trait TestCaseTrait
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @param EccubeConfig $eccubeConfig
     * @required
     */
    public function setEccubeConfig(EccubeConfig $eccubeConfig)
    {
        $this->eccubeConfig = $eccubeConfig;
    }

    /**
     * @param $name
     * @return Group
     */
    protected function createGroup($name = "グループ"): Group
    {

        $group = $this->entityManager->getRepository(Group::class)->findOneBy([], ['id' => 'DESC']);
        $sortNo = $group ? $group->getSortNo() + 1 : 1;

        $group = new Group();
        $group->setName($name);
        $group->setOptionNonMemberDisplay(false);
        $group->setSortNo($sortNo);
        $this->entityManager->persist($group);
        $this->entityManager->flush();

        return $group;
    }

    protected function enableOptionCategoryHidden($enable = true)
    {
        /** @var Config $config */
        $config = $this->entityManager->getRepository(Config::class)->get();
        $config->setOptionGroupCategoryHidden($enable);
        $this->entityManager->flush();
    }

    protected function disableOptionCategoryHidden()
    {
        $this->enableOptionCategoryHidden(false);
    }

    /**
     * @param $number
     * @param int $decimals
     * @param string $decPoint
     * @param string $thousandsSep
     * @return bool|string
     */
    protected function formatCurrency($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $locale = $this->eccubeConfig['locale'];
        $currency = $this->eccubeConfig['currency'];
        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($number, $currency);
    }

    protected function createCustomerFormData()
    {
        $faker = $this->getFaker();
        $email = $faker->safeEmail;
        $password = $faker->lexify('????????');
        $birth = $faker->dateTimeBetween;

        $form = [
            'name' => ['name01' => $faker->lastName, 'name02' => $faker->firstName],
            'kana' => ['kana01' => $faker->lastKanaName, 'kana02' => $faker->firstKanaName],
            'company_name' => $faker->company,
            'postal_code' => $faker->postcode,
            'address' => ['pref' => '5', 'addr01' => $faker->city, 'addr02' => $faker->streetAddress],
            'phone_number' => $faker->phoneNumber,
            'email' => $email,
            'password' => ['first' => $password, 'second' => $password],
            'birth' => $birth->format('Y').'-'.$birth->format('n').'-'.$birth->format('j'),
            'sex' => 1,
            'job' => 1,
            'status' => 1,
            'point' => 0,
            Constant::TOKEN_NAME => 'dummy',
        ];

        return $form;
    }

    protected function createProductFormData()
    {
        $faker = $this->getFaker();

        $price01 = $faker->randomNumber(5);
        if (mt_rand(0, 1)) {
            $price01 = number_format($price01);
        }

        $price02 = $faker->randomNumber(5);
        if (mt_rand(0, 1)) {
            $price02 = number_format($price02);
        }

        $form = [
            'class' => [
                'sale_type' => 1,
                'price01' => $price01,
                'price02' => $price02,
                'stock' => $faker->randomNumber(3),
                'stock_unlimited' => 0,
                'code' => $faker->word,
                'sale_limit' => null,
                'delivery_duration' => '',
            ],
            'name' => $faker->word,
            'product_image' => [],
            'description_detail' => $faker->realText,
            'description_list' => $faker->paragraph,
            'Category' => null,
            'Tag' => [1],
            'search_word' => $faker->word,
            'free_area' => $faker->realText,
            'Status' => 1,
            'note' => $faker->realText,
            'tags' => null,
            'images' => null,
            'add_images' => null,
            'delete_images' => null,
            Constant::TOKEN_NAME => 'dummy',
        ];

        return $form;
    }

    protected function createCategoryFormData()
    {
        $faker = $this->getFaker();

        $form = [
            'name' => $faker->word,
            Constant::TOKEN_NAME => 'dummy'
        ];

        return $form;
    }

    protected function createGroupFormData()
    {
        $faker = $this->getFaker();

        $form = [
            'name' => $faker->word,
            'backendName' => '',
            'optionNonMemberDisplay' => 1,
            Constant::TOKEN_NAME => 'dummy'
        ];

        return $form;
    }

    protected function createPageFormData()
    {
        $form = [
            'name' => 'テストページ',
            'url' => 'test',
            'file_name' => 'foo/bar/baz',
            'tpl_data' => 'contents',
            'author' => '',
            'description' => '',
            'keyword' => '',
            'meta_robots' => '',
            'meta_tags' => '',
        ];
    }
}
