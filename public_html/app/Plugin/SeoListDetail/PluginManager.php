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

namespace Plugin\SeoListDetail;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Eccube\Entity\Csv;
use Eccube\Entity\Master\CsvType;
use Eccube\Repository\Master\CsvTypeRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class PluginManager.
 */
class PluginManager extends AbstractPluginManager
{

    public function install(array $meta, ContainerInterface $container)
    {
        $fs = new Filesystem();

        $dirController = sprintf('%s/src/Eccube/Controller/Admin/Product',
            $container->getParameter('kernel.project_dir'));

        $dirForm = sprintf('%s/src/Eccube/Form/Type/Admin',
            $container->getParameter('kernel.project_dir'));

        $dirResource = sprintf('%s/src/Eccube/Resource/template/admin/Product',
            $container->getParameter('kernel.project_dir'));

        try {
            $plgController= sprintf('%s/app/Plugin/SeoListDetail/Copy/CategorySeoController',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgController, $dirController. '/CategorySeoController.php', true);

            $plgCsvController= sprintf('%s/app/Plugin/SeoListDetail/Copy/CsvImportSeoController',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgCsvController, $dirController. '/CsvImportSeoController.php', true);

            $plgForm= sprintf('%s/app/Plugin/SeoListDetail/Copy/CategorySeoType',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgForm, $dirForm. '/CategorySeoType.php', true);

            $plgTwig= sprintf('%s/app/Plugin/SeoListDetail/Copy/category_seo',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgTwig, $dirResource. '/category_seo.twig', true);

            $plgCsvCaterory= sprintf('%s/app/Plugin/SeoListDetail/Copy/csv_category_seo',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgCsvCaterory, $dirResource. '/csv_category_seo.twig', true);

            $plgCsvProduct= sprintf('%s/app/Plugin/SeoListDetail/Copy/csv_product_seo',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgCsvProduct, $dirResource. '/csv_product_seo.twig', true);

        } catch (\Exception $e) {
            return false;
        }

	}

    public function enable(array $meta, ContainerInterface $container)
    {
		$this->copyDefaultFrame($container);
		
		$em = $container->get('doctrine.orm.entity_manager');
		$this->createCsvData($em);
		
		// ▼4.1.1→4.1.2対応
        $fs = new Filesystem();

        $dirController = sprintf('%s/src/Eccube/Controller/Admin/Product',
            $container->getParameter('kernel.project_dir'));
        try {
            $plgController= sprintf('%s/app/Plugin/SeoListDetail/Copy/CategorySeoController',
                $container->getParameter('kernel.project_dir'));
            $fs->copy($plgController, $dirController. '/CategorySeoController.php', true);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function disable(array $meta = null, ContainerInterface $container)
    {
        $this->removeDefaultFrame($container);
    }

    public function uninstall(array $meta, ContainerInterface $container)
    {
		$em = $container->get('doctrine.orm.entity_manager');
		$this->removeCsvData($em);

        $fs = new Filesystem();
		
        $dirController = sprintf('%s/src/Eccube/Controller/Admin/Product',
            $container->getParameter('kernel.project_dir'));

        $dirForm = sprintf('%s/src/Eccube/Form/Type/Admin',
            $container->getParameter('kernel.project_dir'));

        $dirResource = sprintf('%s/src/Eccube/Resource/template/admin/Product',
            $container->getParameter('kernel.project_dir'));

        try {

            $fs->remove($dirController.'/CategorySeoController.php');
            $fs->remove($dirController.'/CsvImportSeoController.php');
            $fs->remove($dirForm.'/CategorySeoType.php');
            $fs->remove($dirResource.'/category_seo.twig');
            $fs->remove($dirResource.'/csv_category_seo.twig');
            $fs->remove($dirResource.'/csv_product_seo.twig');

        } catch (\Exception $e) {
            return false;
        }
    }

    public function update(array $meta = null, ContainerInterface $container)
    {
        $fs = new Filesystem();
        $dir = sprintf('%s/app/Plugin/SeoListDetail/Form/Extension',
            $container->getParameter('kernel.project_dir'));
        try {
            $fs->remove($dir.'/CategoryTypeExtension.php');
            $fs->remove($dir.'/ProductTypeExtension.php');
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function createCsvData(EntityManagerInterface $em)
    {
        $CsvData = $em->getRepository(Csv::class)->findBy(['field_name' => 'itoben_seo_title']);
        foreach ($CsvData as $Csv) {
			if ($Csv) {
				return;
			}
        }

		$CsvType = $em->find(CsvType::class, CsvType::CSV_TYPE_PRODUCT);
		
		$rank = 41;
		
        $Csv = new Csv();
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Product')
            ->setFieldName('itoben_seo_title')
            ->setReferenceFieldName('')
            ->setDispName('title')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Product')
            ->setFieldName('itoben_seo_author')
            ->setReferenceFieldName('')
            ->setDispName('author')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Product')
            ->setFieldName('itoben_seo_description')
            ->setReferenceFieldName('')
            ->setDispName('description')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Product')
            ->setFieldName('itoben_seo_keyword')
            ->setReferenceFieldName('')
            ->setDispName('keyword')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Product')
            ->setFieldName('itoben_seo_meta_robots')
            ->setReferenceFieldName('')
            ->setDispName('meta_robots')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Product')
            ->setFieldName('itoben_seo_meta_tags')
            ->setReferenceFieldName('')
            ->setDispName('meta_tags')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();


        $CsvType = $em->find(CsvType::class, CsvType::CSV_TYPE_CATEGORY);
		
		$rank = 10;
		
        $Csv = new Csv();
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Category')
            ->setFieldName('itoben_seo_title')
            ->setReferenceFieldName('')
            ->setDispName('title')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Category')
            ->setFieldName('itoben_seo_author')
            ->setReferenceFieldName('')
            ->setDispName('author')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Category')
            ->setFieldName('itoben_seo_description')
            ->setReferenceFieldName('')
            ->setDispName('description')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Category')
            ->setFieldName('itoben_seo_keyword')
            ->setReferenceFieldName('')
            ->setDispName('keyword')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Category')
            ->setFieldName('itoben_seo_meta_robots')
            ->setReferenceFieldName('')
            ->setDispName('meta_robots')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();

        $Csv = new Csv();
        ++$rank;
        $Csv->setCsvType($CsvType)
            ->setEntityName('Eccube\\Entity\\Category')
            ->setFieldName('itoben_seo_meta_tags')
            ->setReferenceFieldName('')
            ->setDispName('meta_tags')
            ->setSortNo($rank);
        $em->persist($Csv);
        $em->flush();
	}

    protected function removeCsvData(EntityManagerInterface $em)
    {
        $CsvData = $em->getRepository(Csv::class)->findBy(['field_name' => 'itoben_seo_title']);
        foreach ($CsvData as $Csv) {
            $em->remove($Csv);
            $em->flush($Csv);
        }
        $CsvData = $em->getRepository(Csv::class)->findBy(['field_name' => 'itoben_seo_author']);
        foreach ($CsvData as $Csv) {
            $em->remove($Csv);
            $em->flush($Csv);
        }
        $CsvData = $em->getRepository(Csv::class)->findBy(['field_name' => 'itoben_seo_description']);
        foreach ($CsvData as $Csv) {
            $em->remove($Csv);
            $em->flush($Csv);
        }
        $CsvData = $em->getRepository(Csv::class)->findBy(['field_name' => 'itoben_seo_keyword']);
        foreach ($CsvData as $Csv) {
            $em->remove($Csv);
            $em->flush($Csv);
        }
        $CsvData = $em->getRepository(Csv::class)->findBy(['field_name' => 'itoben_seo_meta_robots']);
        foreach ($CsvData as $Csv) {
            $em->remove($Csv);
            $em->flush($Csv);
        }
        $CsvData = $em->getRepository(Csv::class)->findBy(['field_name' => 'itoben_seo_meta_tags']);
        foreach ($CsvData as $Csv) {
            $em->remove($Csv);
            $em->flush($Csv);
        }
    }

    private function copyDefaultFrame(ContainerInterface $container)
    {
		$templateDir = $container->getParameter('eccube_theme_front_dir');		
		
        $dirResource = sprintf('%s/src/Eccube/Resource/template/default',
            $container->getParameter('kernel.project_dir'));

		$fs = new Filesystem();
		
		if ($fs->exists($templateDir.'/default_frame.twig')) {
			$fs->copy($templateDir.'/default_frame.twig', $templateDir.'/default_frame_backupSEO.twig');
			$fs->remove($templateDir.'/default_frame.twig');
			$plgDefaultFrame= sprintf('%s/app/Plugin/SeoListDetail/Copy/default_frame.twig',
				$container->getParameter('kernel.project_dir'));
			$fs->copy($plgDefaultFrame, $templateDir.'/default_frame.twig', true);
		} else {
			$fs->copy($dirResource.'/default_frame.twig', $dirResource.'/default_frame_backupSEO.twig');
			$fs->remove($dirResource.'/default_frame.twig');
			$plgDefaultFrame= sprintf('%s/app/Plugin/SeoListDetail/Copy/default_frame.twig',
				$container->getParameter('kernel.project_dir'));
			$fs->copy($plgDefaultFrame, $dirResource.'/default_frame.twig', true);
		}
    }

    private function removeDefaultFrame(ContainerInterface $container)
    {
		$templateDir = $container->getParameter('eccube_theme_front_dir');		
		
        $dirResource = sprintf('%s/src/Eccube/Resource/template/default',
            $container->getParameter('kernel.project_dir'));

		$fs = new Filesystem();
		
		if ($fs->exists($templateDir.'/default_frame_backupSEO.twig')) {
			$fs->remove($templateDir.'/default_frame.twig');
			$fs->copy($templateDir.'/default_frame_backupSEO.twig', $templateDir.'/default_frame.twig');
			$fs->remove($templateDir.'/default_frame_backupSEO.twig');
		} else {
			$fs->remove($dirResource.'/default_frame.twig');
			$fs->copy($dirResource.'/default_frame_backupSEO.twig', $dirResource.'/default_frame.twig');
			$fs->remove($dirResource.'/default_frame_backupSEO.twig');
		}
    }
	
}
