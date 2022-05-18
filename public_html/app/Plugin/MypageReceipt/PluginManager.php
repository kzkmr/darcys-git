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

namespace Plugin\MypageReceipt;

use Eccube\Application;
use Eccube\Entity\Page;
use Eccube\Entity\PageLayout;
use Eccube\Entity\Layout;
use Eccube\Entity\Master\DeviceType;
use Eccube\Plugin\AbstractPluginManager;
use Eccube\Repository\LayoutRepository;
use Eccube\Repository\PageRepository;
use Eccube\Repository\Master\DeviceTypeRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Plugin\MypageReceipt\Entity\MypageReceiptConfig;
use Plugin\MypageReceipt\Repository\MypageReceiptConfigRepository;

use Doctrine\ORM\EntityManagerInterface;

use Eccube\Common\EccubeConfig;
use Eccube\Util\EntityUtil;

/**
 * Class PluginManager.
 */
class PluginManager extends AbstractPluginManager
{
    /**
     * @var array
     */
    private $urls = [
        'mypage_receipt' => 'MYページ/領収書／購入明細書',
    ];

    /**
     * @param null|array $meta
     * @param ContainerInterface $container
     *
     * @throws \Exception
     */
    public function enable(array $meta = null, ContainerInterface $container)
    {
        // プラグイン設定を追加
		$em = $container->get('doctrine.orm.entity_manager');
        $Config = $this->createConfig($em);

        // ページを追加
        foreach ($this->urls as $url => $name) {
            $entityManager = $container->get('doctrine')->getManager();
			$Page = $entityManager->getRepository(Page::class)->findOneBy(['url' => $url]);
            if (null === $Page) {
                $this->createPage($em, $name, $url);
            }
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
        // ページを削除
        $this->removePageLayout($container);
    }

    public function update(array $meta = null, ContainerInterface $container)
    {
        // ページのfile_nameを更新
		$em = $container->get('doctrine.orm.entity_manager');
        foreach ($this->urls as $url => $name) {
			$entityManager = $container->get('doctrine')->getManager();
			$Page = $entityManager->getRepository(Page::class)->findOneBy(['url' => $url]);
            if ($Page) {
                $this->updatePage($em, $name, $url);
            }
        }
    }
	
    protected function createPage(EntityManagerInterface $em, $name, $url)
    {
        $Page = new Page();
        $Page->setEditType(Page::EDIT_TYPE_DEFAULT);
        $Page->setName($name);
        $Page->setUrl($url);
        $Page->setFileName('MypageReceipt/Resource/template/default/receipt');
        $Page->setMetaRobots('noindex');

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

	/**
     * removePageLayout.
     */
   private function removePageLayout(ContainerInterface $container)
    {
        // ページ情報の削除
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine')->getManager();
        $Page =  $entityManager->getRepository(Page::class)->findOneBy(['url' => 'mypage_receipt']);
        if ($Page) {
            $Layout = $entityManager->getRepository(Layout::class)->find(Layout::DEFAULT_LAYOUT_UNDERLAYER_PAGE);
            $PageLayout = $entityManager->getRepository(PageLayout::class)->findOneBy(['Page' => $Page, 'Layout' => $Layout]);
            // Pageの削除
            $entityManager->remove($PageLayout);
            $entityManager->remove($Page);
            $entityManager->flush();
        }
    }

    protected function createConfig(EntityManagerInterface $em)
    {
        $Config = $em->find(MypageReceiptConfig::class, 1);
        if ($Config) {
            return $Config;
        }
        $Config = new MypageReceiptConfig();
        $Config->setMypageReceiptEnable(0);

        $em->persist($Config);
        $em->flush($Config);

        return $Config;
    }

    /**
     * updatePage.
     */
    protected function updatePage(EntityManagerInterface $em, $name, $url)
    {
        $Page = $em->getRepository(Page::class)->findOneBy(['url' => $url]);
        $Page->setFileName('MypageReceipt/Resource/template/default/receipt');
    }
}
