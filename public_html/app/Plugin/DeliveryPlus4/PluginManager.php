<?php
/*
* Plugin Name : DeliveryPlus4
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\DeliveryPlus4;

use Eccube\Plugin\AbstractPluginManager;
use Eccube\Entity\Master\CsvType;
use Eccube\Entity\Csv;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

class PluginManager extends AbstractPluginManager
{
    public function install(array $meta, ContainerInterface $container)
    {
        $file = new Filesystem();
        try {
            $file->copy($container->getParameter('plugin_realdir'). '/DeliveryPlus4/Resource/template/default/Product/weight_size.twig', $container->getParameter('eccube_theme_front_dir'). '/Product/weight_size.twig', true);
            $file->copy($container->getParameter('plugin_realdir'). '/DeliveryPlus4/Resource/template/default/Cart/weight_size.twig', $container->getParameter('eccube_theme_front_dir'). '/Cart/weight_size.twig', true);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function uninstall(array $meta, ContainerInterface $container)
    {
        if(file_exists($container->getParameter('eccube_theme_front_dir'). '/Product/weight_size.twig'))
                unlink($container->getParameter('eccube_theme_front_dir'). '/Product/weight_size.twig');
        if(file_exists($container->getParameter('eccube_theme_front_dir'). '/Cart/weight_size.twig'))
                unlink($container->getParameter('eccube_theme_front_dir'). '/Cart/weight_size.twig');
    }

    public function enable(array $meta, ContainerInterface $container)
    {
        $this->addCsv($container);
    }

    public function disable(array $meta, ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');
        $Csv = $entityManager->getRepository(Csv::class)->findOneBy(['field_name' => 'deliveryplus_weight']);
        if($Csv){
            $entityManager->remove($Csv);
        }

        $Csv = $entityManager->getRepository(Csv::class)->findOneBy(['field_name' => 'deliveryplus_size']);
        if($Csv){
            $entityManager->remove($Csv);
        }
        $entityManager->flush();
    }



    private function addCsv($container)
    {
        $translator = $container->get('translator');
        $ymlPath = $container->getParameter('plugin_realdir') . '/DeliveryPlus4/Resource/locale/messages.'.$translator->getLocale().'.yaml';
        if(!file_exists($ymlPath))$ymlPath = $container->getParameter('plugin_realdir') . '/DeliveryPlus4/Resource/locale/messages.ja.yaml';
        $messages = Yaml::parse(file_get_contents($ymlPath));

        $entityManager = $container->get('doctrine.orm.entity_manager');
        $now = new \DateTime();
        $Csv = new Csv();
        $CsvType = $entityManager->getRepository(CsvType::class)->find(CsvType::CSV_TYPE_PRODUCT);
        $sort_no = $entityManager->createQueryBuilder()
            ->select('MAX(c.sort_no)')
            ->from('Eccube\Entity\Csv','c')
            ->where('c.CsvType = :csvType')
            ->setParameter(':csvType',$CsvType)
            ->getQuery()
            ->getSingleScalarResult();
        if (!$sort_no) {
            $sort_no = 0;
        }

        $Csv = new Csv();
        $Csv->setCsvType($CsvType);
        $Csv->setEntityName('Eccube\\Entity\\ProductClass');
        $Csv->setFieldName('deliveryplus_weight');
        $Csv->setDispName($messages['deliveryplus.common.1']);
        $Csv->setEnabled(false);
        $Csv->setSortNo(++$sort_no);
        $Csv->setCreateDate($now);
        $Csv->setUpdateDate($now);
        $entityManager->persist($Csv);

        $Csv = new Csv();
        $Csv->setCsvType($CsvType);
        $Csv->setEntityName('Eccube\\Entity\\ProductClass');
        $Csv->setFieldName('deliveryplus_size');
        $Csv->setDispName($messages['deliveryplus.common.2']);
        $Csv->setEnabled(false);
        $Csv->setSortNo(++$sort_no);
        $Csv->setCreateDate($now);
        $Csv->setUpdateDate($now);
        $entityManager->persist($Csv);

        $entityManager->flush();
    }

}
