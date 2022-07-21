<?php
/*
* Plugin Name : HiddenDeliveryDate
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\HiddenDeliveryDate;

use Eccube\Plugin\AbstractPluginManager;
use Eccube\Entity\Csv;
use Eccube\Entity\Master\CsvType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

class PluginManager extends AbstractPluginManager
{
    public function install(array $meta, ContainerInterface $container)
    {
    }

    public function uninstall(array $meta, ContainerInterface $container)
    {
    }

    public function enable(array $meta, ContainerInterface $container)
    {
        $this->addCsv($container);
    }

    public function disable(array $meta, ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $Csvs = $entityManager->getRepository(Csv::class)->findBy(['field_name' => 'Hiddendays']);
        foreach($Csvs as $Csv){
            $entityManager->remove($Csv);
        }
        $entityManager->flush();
    }

    private function addCsv($container)
    {
        $translator = $container->get('translator');
        $ymlPath = $container->getParameter('plugin_realdir') . '/HiddenDeliveryDate/Resource/locale/messages.'.$translator->getLocale().'.yaml';
        $messages = Yaml::parse(file_get_contents($ymlPath));

        $entityManager = $container->get('doctrine.orm.entity_manager');

        $now = new \DateTime();
        //CSV項目追加
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
        $Csv->setEntityName('Plugin\\HiddenDeliveryDate\\Entity\\Hiddenday');
        $Csv->setFieldName('Hiddendays');
        $Csv->setDispName($messages['hiddendeliverydate.common.hiddenday']);
        $Csv->setEnabled(false);
        $Csv->setSortNo($sort_no + 1);
        $Csv->setCreateDate($now);
        $Csv->setUpdateDate($now);
        $entityManager->persist($Csv);

        $entityManager->flush();
    }

}
