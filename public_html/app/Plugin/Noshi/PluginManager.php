<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Noshi;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Eccube\Entity\Layout;
use Eccube\Entity\Page;
use Eccube\Entity\PageLayout;
use Eccube\Entity\Csv;
use Eccube\Entity\Master\CsvType;

use Eccube\Entity\Master\NoshiKind;
use Eccube\Entity\Master\NoshiTie;

use Eccube\Repository\PageRepository;
use Eccube\Common\EccubeConfig;
use Eccube\Util\EntityUtil;
use Plugin\Noshi\Entity\NoshiConfig;
use Plugin\Noshi\Repository\NoshiConfigRepository;

/**
 * Class PluginManager.
 */
class PluginManager extends AbstractPluginManager
{
    private $pages = [
        [
            'name' => 'のしの希望（新規）',
            'url' => 'noshi_new',
            'filename' => 'Noshi/Resource/template/default/noshi_edit',
        ],
        [
            'name' => 'のしの希望（編集）',
            'url' => 'noshi_edit',
            'filename' => 'Noshi/Resource/template/default/noshi_edit',
        ],
    ];
	
    /**
     * PluginManager constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param null $meta
     * @param Application|null $app
     * @param ContainerInterface $container
     *
     * @throws \Exception
     */
    public function install(array $meta, ContainerInterface $container)
    {
        $fs = new Filesystem();

        $dirEntity = sprintf('%s/src/Eccube/Entity/Master',
            $container->getParameter('kernel.project_dir'));

        $dirForm = sprintf('%s/src/Eccube/Form/Type/Master',
            $container->getParameter('kernel.project_dir'));

        $dirRepository = sprintf('%s/src/Eccube/Repository/Master',
            $container->getParameter('kernel.project_dir'));

        // メールテンプレート追加コードのテキストファイルをコピーする
		$dirUserData = sprintf('%s/html/user_data',
            $container->getParameter('kernel.project_dir'));

        try {

            $plgNoshiKind= sprintf('%s/app/Plugin/Noshi/Copy/Entity/NoshiKind',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiKind, $dirEntity. '/NoshiKind.php', true);

            $plgNoshiTie= sprintf('%s/app/Plugin/Noshi/Copy/Entity/NoshiTie',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiTie, $dirEntity. '/NoshiTie.php', true);


            $plgNoshiKindType = sprintf('%s/app/Plugin/Noshi/Copy/Form/NoshiKindType',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiKindType, $dirForm. '/NoshiKindType.php', true);

            $plgNoshiTieType = sprintf('%s/app/Plugin/Noshi/Copy/Form/NoshiTieType',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiTieType, $dirForm. '/NoshiTieType.php', true);			
			

            $plgNoshiKindRepository = sprintf('%s/app/Plugin/Noshi/Copy/Repository/NoshiKindRepository',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiKindRepository, $dirRepository. '/NoshiKindRepository.php', true);

            $plgNoshiTieRepository = sprintf('%s/app/Plugin/Noshi/Copy/Repository/NoshiTieRepository',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiTieRepository, $dirRepository. '/NoshiTieRepository.php', true);

            $plgNoshiCode= sprintf('%s/app/Plugin/Noshi/Copy/add_mailtemplate_noshi',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiCode, $dirUserData. '/add_mailtemplate_noshi.txt', true);

        } catch (\Exception $e) {
            return false;
        }

		$em = $container->get('doctrine.orm.entity_manager');
		$this->createNoshiKindData($em);
		$this->createNoshiTieData($em);

        $dir = sprintf('%s/app/Plugin/Noshi/Entity',
            $container->getParameter('kernel.project_dir'));
        try {
			// データベース作成後は削除（他のプラグインに影響があるため）
			$fs->remove($dir.'/NoshiKind.php');
			$fs->remove($dir.'/NoshiTie.php');
        } catch (\Exception $e) {
            return false;
        }

        $dirEntity = sprintf('%s/app/Plugin/Noshi/Entity',
            $container->getParameter('kernel.project_dir'));

        try {

            $plgNoshi= sprintf('%s/app/Plugin/Noshi/Copy/Entity/NoshiEnable',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshi, $dirEntity. '/Noshi.php', true);

        } catch (\Exception $e) {
            return false;
        }

	}

    /**
     * @param null|array $meta
     * @param ContainerInterface $container
     *
     * @throws \Exception
     */
    public function enable(array $meta = null, ContainerInterface $container)
    {
        $fs = new Filesystem();

        // プラグイン設定を追加
		$em = $container->get('doctrine.orm.entity_manager');
        $Config = $this->createConfig($em);

        $em = $container->get('doctrine.orm.entity_manager');
		
        // CSV出力項目設定を追加
        $CsvType = $Config->getCsvType();
        if (null === $CsvType) {
            $CsvType = $this->createCsvType($em);
            $this->createCsvData($em, $CsvType);

            $Config->setCsvType($CsvType);
            $em->flush($Config);
        }

        // ページを追加
        foreach ($this->pages as $pageInfo) {
            $entityManager = $container->get('doctrine')->getManager();
			$Page = $entityManager->getRepository(Page::class)->findOneBy(['url' => $pageInfo['url']]);
            if (null === $Page) {
                $this->createPage($em, $pageInfo['name'], $pageInfo['url'], $pageInfo['filename']);
            }
        }
    }

    /**
     * @param array|null $meta
     * @param ContainerInterface $container
     */
    public function disable(array $meta = null, ContainerInterface $container)
    {
        $em = $container->get('doctrine.orm.entity_manager');

        // ページを削除
        foreach ($this->pages as $pageInfo) {
            $this->removePage($em, $pageInfo['url']);
        }
    }

    /**
     * @param null $meta
     * @param Application|null $app
     * @param ContainerInterface $container
     *
     * @throws \Exception
     */
    public function uninstall(array $meta, ContainerInterface $container)
    {
        $fs = new Filesystem();

        $dirEntity = sprintf('%s/app/Plugin/Noshi/Entity',
            $container->getParameter('kernel.project_dir'));

        try {

            $plgNoshi= sprintf('%s/app/Plugin/Noshi/Copy/Entity/NoshiDisable',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshi, $dirEntity. '/Noshi.php', true);

        } catch (\Exception $e) {
            return false;
        }


        $dir = sprintf('%s/app/Plugin/Noshi/Entity',
            $container->getParameter('kernel.project_dir'));
        try {
            // 削除したファイルを一旦元に戻す。プラグインが削除できないため。
            $plgNoshiKind= sprintf('%s/app/Plugin/Noshi/Copy/Entity/PlgNoshiKind',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiKind, $dir. '/NoshiKind.php', true);
			
            $plgNoshiTie= sprintf('%s/app/Plugin/Noshi/Copy/Entity/PlgNoshiTie',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgNoshiTie, $dir. '/NoshiTie.php', true);
        } catch (\Exception $e) {
            return false;
        }

        $dirEntity = sprintf('%s/src/Eccube/Entity/Master',
            $container->getParameter('kernel.project_dir'));

        $dirForm = sprintf('%s/src/Eccube/Form/Type/Master',
            $container->getParameter('kernel.project_dir'));

        $dirRepository = sprintf('%s/src/Eccube/Repository/Master',
            $container->getParameter('kernel.project_dir'));

		$dirUserData = sprintf('%s/html/user_data',
            $container->getParameter('kernel.project_dir'));

        try {
            $fs->remove($dirEntity.'/NoshiKind.php');
            $fs->remove($dirEntity.'/NoshiTie.php');

            $fs->remove($dirForm.'/NoshiKindType.php');
            $fs->remove($dirForm.'/NoshiTieType.php');
			
            $fs->remove($dirRepository.'/NoshiKindRepository.php');
            $fs->remove($dirRepository.'/NoshiTieRepository.php');
			
            $fs->remove($dirUserData.'/add_mailtemplate_noshi.txt');

        } catch (\Exception $e) {
            return false;
        }

        $em = $container->get('doctrine.orm.entity_manager');

        // ページを削除
        foreach ($this->pages as $pageInfo) {
            $this->removePage($em, $pageInfo['url']);
        }

        $Config = $em->find(NoshiConfig::class, 1);
        if ($Config) {
            $CsvType = $Config->getCsvType();

            // CSV出力項目設定を削除
            $this->removeCsvData($em, $CsvType);

            $Config->setCsvType(null);
            $em->flush($Config);

            $em->remove($CsvType);
            $em->flush($CsvType);
        }
    }

    /**
     * @param array|null $meta
     * @param ContainerInterface $container
     */
    public function update(array $meta = null, ContainerInterface $container)
    {
    }

    protected function createNoshiKindData(EntityManagerInterface $em)
    {
        $Status = $em->find(NoshiKind::class, 1);
        if ($Status) {
            return;
        }

        $rank = 0;
        $NoshiKind = new NoshiKind();
        $NoshiKind->setId(1)
            ->setName('紅白蝶結び')
            ->setSortNo($rank);
        $em->persist($NoshiKind);
        $em->flush();

        $NoshiKind = new NoshiKind();
        ++$rank;
        $NoshiKind->setId(2)
            ->setName('紅白結びきり（5本）')
            ->setSortNo($rank);
        $em->persist($NoshiKind);
        $em->flush();

        $NoshiKind = new NoshiKind();
        ++$rank;
        $NoshiKind->setId(3)
            ->setName('紅白結びきり（10本）')
            ->setSortNo($rank);
        $em->persist($NoshiKind);
        $em->flush();

        $NoshiKind = new NoshiKind();
        ++$rank;
        $NoshiKind->setId(4)
            ->setName('黒白結びきり')
            ->setSortNo($rank);
        $em->persist($NoshiKind);
        $em->flush();

        $NoshiKind = new NoshiKind();
        ++$rank;
        $NoshiKind->setId(5)
            ->setName('黄白結びきり')
            ->setSortNo($rank);
        $em->persist($NoshiKind);
        $em->flush();
	}

    protected function createNoshiTieData(EntityManagerInterface $em)
    {
        $Status = $em->find(NoshiTie::class, 1);
        if ($Status) {
            return;
        }

        $rank = 0;
        $NoshiTie = new NoshiTie();
        $NoshiTie->setId(1)
            ->setName('寿')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(2)
            ->setName('御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(3)
            ->setName('御結婚御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(4)
            ->setName('内祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(5)
            ->setName('祝還暦')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(6)
            ->setName('御古希御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(7)
            ->setName('御喜寿御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(8)
            ->setName('御米寿御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(9)
            ->setName('御白寿御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(10)
            ->setName('銀婚式御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(11)
            ->setName('金婚式御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(12)
            ->setName('出産御祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(13)
            ->setName('出産内祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(14)
            ->setName('御開店祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(15)
            ->setName('御開業祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(16)
            ->setName('御新築祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(17)
            ->setName('御年賀')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(18)
            ->setName('御中元')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(19)
            ->setName('御歳暮')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(20)
            ->setName('御見舞')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(21)
            ->setName('御礼')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(22)
            ->setName('快気内祝')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(23)
            ->setName('御礼')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(24)
            ->setName('粗品')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(25)
            ->setName('御供')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(26)
            ->setName('御仏前')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(27)
            ->setName('御霊前')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(28)
            ->setName('志')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(29)
            ->setName('粗供養')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

        $NoshiTie = new NoshiTie();
        ++$rank;
        $NoshiTie->setId(30)
            ->setName('その他')
            ->setSortNo($rank);
        $em->persist($NoshiTie);
        $em->flush();

	}

    protected function createCsvType(EntityManagerInterface $em)
    {
        $result = $em->createQueryBuilder('ct')
            ->select('COALESCE(MAX(ct.id), 0) AS id, COALESCE(MAX(ct.sort_no), 0) AS sort_no')
            ->from(CsvType::class, 'ct')
            ->getQuery()
            ->getSingleResult();

        $result['id']++;
        $result['sort_no']++;

        $CsvType = new CsvType();
        $CsvType
            ->setId($result['id'])
            ->setName('のし希望CSV')
            ->setSortNo($result['sort_no']);
        $em->persist($CsvType);
        $em->flush($CsvType);

        return $CsvType;
    }

    protected function createPage(EntityManagerInterface $em, $name, $url, $filename)
    {
        $Page = new Page();
        $Page->setEditType(Page::EDIT_TYPE_DEFAULT);
        $Page->setName($name);
        $Page->setUrl($url);
        $Page->setFileName($filename);

        // DB登録
        $em->persist($Page);
        $em->flush($Page);
        $Layout = $em->find(Layout::class, Layout::DEFAULT_LAYOUT_UNDERLAYER_PAGE);
        $PageLayout = new PageLayout();
        $PageLayout->setPage($Page)
            ->setPageId($Page->getId())
            ->setLayout($Layout)
            ->setLayoutId($Layout->getId())
            ->setSortNo(0);
        $em->persist($PageLayout);
        $em->flush($PageLayout);
    }

    protected function removePage(EntityManagerInterface $em, $url)
    {
        $Page = $em->getRepository(Page::class)->findOneBy(['url' => $url]);

        if (!$Page) {
            return;
        }
        foreach ($Page->getPageLayouts() as $PageLayout) {
            $em->remove($PageLayout);
            $em->flush($PageLayout);
        }

        $em->remove($Page);
        $em->flush($Page);
    }

    protected function createCsvData(EntityManagerInterface $em, CsvType $CsvType)
    {
        $rank = 1;
        $Csv = new Csv();
        $Csv->setCsvType($CsvType)
            ->setEntityName('Plugin\Noshi\Entity\Noshi')
            ->setFieldName('order_id')
            ->setReferenceFieldName('name')
            ->setDispName('注文番号')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Plugin\Noshi\Entity\Noshi')
            ->setFieldName('product')
            ->setReferenceFieldName('name')
            ->setDispName('購入商品')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Plugin\Noshi\Entity\Noshi')
            ->setFieldName('NoshiKind')
            ->setReferenceFieldName('name')
            ->setDispName('のしの種類')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Plugin\Noshi\Entity\Noshi')
            ->setFieldName('NoshiTie')
            ->setReferenceFieldName('name')
            ->setDispName('表書き（上段）')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Plugin\Noshi\Entity\Noshi')
            ->setFieldName('noshi_sonota')
            ->setReferenceFieldName('name')
            ->setDispName('その他（表書き）')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Plugin\Noshi\Entity\Noshi')
            ->setFieldName('noshi_name')
            ->setReferenceFieldName('name')
            ->setDispName('お名前')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        return $CsvType;
    }

    protected function createConfig(EntityManagerInterface $em)
    {
        $Config = $em->find(NoshiConfig::class, 1);
        if ($Config) {
            return $Config;
        }
        $Config = new NoshiConfig();
        $Config->setNoshiEnable(true);
        $Config->setNoshiKind(true);
        $Config->setNoshiTie(true);
        $Config->setNoshiName(true);
        $Config->setComment('・同じ商品を複数購入され、それぞれ異なる熨斗を希望される場合は、熨斗の分の商品を選択し登録してください。
・カートの中を変更すると、登録した熨斗は削除されます。
・熨斗に関するご要望・補足等は、お問い合わせ欄にご入力ください。');

        $em->persist($Config);
        $em->flush($Config);

        return $Config;
    }

    protected function removeCsvData(EntityManagerInterface $em, CsvType $CsvType)
    {
        $CsvData = $em->getRepository(Csv::class)->findBy(['CsvType' => $CsvType]);
        foreach ($CsvData as $Csv) {
            $em->remove($Csv);
            $em->flush($Csv);
        }
    }
}
