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

namespace Plugin\CustomerGroup;


use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\CustomerGroup\Entity\Config;
use Plugin\CustomerGroup\Entity\Group;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager
{
    public function enable(array $meta, ContainerInterface $container)
    {
        $this->createConfig($container);
    }

    public function update(array $meta, ContainerInterface $container)
    {
        $this->createConfig($container);
        $this->updateSortNo($container);
    }

    public function createConfig(ContainerInterface $container)
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $config = $entityManager->find(Config::class, 1);
        if (!$config) {
            $config = new Config();
            $config->setOptionGroupProductHidden(true);
            $config->setOptionGroupCategoryHidden(false);
            $entityManager->persist($config);
            $entityManager->flush();
        }
    }

    public function updateSortNo(ContainerInterface $container)
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $group = $entityManager->getRepository(Group::class)->findOneBy([
            'sortNo' => null
        ]);

        if ($group) {
            $groups = $entityManager->getRepository(Group::class)->findBy([], ['id' => 'ASC']);
            /** @var Group $group */
            foreach($groups as $key => $group) {
                $group->setSortNo($key + 1);
                $entityManager->persist($group);
            }
            $entityManager->flush();
        }
    }
}
