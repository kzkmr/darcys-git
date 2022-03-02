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

namespace Plugin\CustomerClassPrice4;

use Eccube\Entity\Master\RoundingType;
use Eccube\Entity\Order;
use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Plugin\CustomerClassPrice4\Entity\Config;
use Eccube\Entity\Customer;
use Eccube\Entity\Csv;
use Eccube\Entity\Master\CsvType;


class PluginManager extends AbstractPluginManager
{
    public function enable(array $meta, ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $Config = $entityManager->find(Config::class, 1);

        if (!$Config) {
            $RoundingType = $entityManager
                ->getRepository(RoundingType::class)
                ->find(1);

            $Config = new Config();
            $Config->setRoundingType($RoundingType);
            $entityManager->persist($Config);
            $entityManager->flush();
        }

        $csvType = $entityManager->find(CsvType::class, CsvType::CSV_TYPE_CUSTOMER);
        $entityName = str_replace('\\', '\\\\', Customer::class);
        $CustomerClassField = $this->getCustomerClassField($container, $csvType, $entityName);
        if (!$CustomerClassField) {
            $this->saveCustomerClassField($container, $csvType, $entityName);
        }

        $csvType = $entityManager->find(CsvType::class, CsvType::CSV_TYPE_ORDER);
        $entityName = str_replace('\\', '\\\\', Order::class);
        $CustomerClassField = $this->getCustomerClassField($container, $csvType, $entityName);
        if (!$CustomerClassField) {
            $this->saveCustomerClassField($container, $csvType, $entityName);
        }
    }

    public function update(array $meta, ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $csvType = $entityManager->find(CsvType::class, CsvType::CSV_TYPE_CUSTOMER);
        $entityName = str_replace('\\', '\\\\', Customer::class);
        $CustomerClassField = $this->getCustomerClassField($container, $csvType, $entityName);
        if (!$CustomerClassField) {
            $this->saveCustomerClassField($container, $csvType, $entityName);
        }

        $csvType = $entityManager->find(CsvType::class, CsvType::CSV_TYPE_ORDER);
        $entityName = str_replace('\\', '\\\\', Order::class);
        $CustomerClassField = $this->getCustomerClassField($container, $csvType, $entityName);
        if (!$CustomerClassField) {
            $this->saveCustomerClassField($container, $csvType, $entityName);
        }
    }

    public function disable(array $meta, ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $csvType = $entityManager->find(CsvType::class, CsvType::CSV_TYPE_CUSTOMER);
        $entityName = str_replace('\\', '\\\\', Customer::class);
        $CustomerClassField = $this->getCustomerClassField($container, $csvType, $entityName);
        if ($CustomerClassField) {
            $entityManager->remove($CustomerClassField);
            $entityManager->flush();
        }

        $csvType = $entityManager->find(CsvType::class, CsvType::CSV_TYPE_ORDER);
        $entityName = str_replace('\\', '\\\\', Order::class);
        $CustomerClassField = $this->getCustomerClassField($container, $csvType, $entityName);
        if ($CustomerClassField) {
            $entityManager->remove($CustomerClassField);
            $entityManager->flush();
        }
    }

    private function getCustomerClassField(ContainerInterface $container, CsvType $csvType, string $entityName)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');
        return $entityManager
            ->getRepository(Csv::class)
            ->findOneBy([
                'CsvType' => $csvType,
                'entity_name' => $entityName,
                'field_name' => 'plgCcpCustomerClass',
                'reference_field_name' => 'name',
            ]);
    }

    private function saveCustomerClassField(ContainerInterface $container, CsvType $csvType, string $entityName)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $Csv = new Csv();
        $Csv->setCsvType($csvType);
        $Csv->setEntityName($entityName);
        $Csv->setFieldName('plgCcpCustomerClass');
        $Csv->setReferenceFieldName('name');
        $Csv->setDispName("会員種別");
        $Csv->setSortNo(9999);
        $Csv->setEnabled(true);
        $entityManager->persist($Csv);
        $entityManager->flush();
    }
}
