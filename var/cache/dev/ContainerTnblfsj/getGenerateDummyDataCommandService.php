<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'Eccube\Command\GenerateDummyDataCommand' shared autowired service.

include_once $this->targetDirs[3].'/vendor/symfony/console/Command/Command.php';
include_once $this->targetDirs[3].'/src/Eccube/Command/GenerateDummyDataCommand.php';

$this->services['Eccube\\Command\\GenerateDummyDataCommand'] = $instance = new \Eccube\Command\GenerateDummyDataCommand(${($_ = isset($this->services['Eccube\\Tests\\Fixture\\Generator']) ? $this->services['Eccube\\Tests\\Fixture\\Generator'] : $this->load('getGeneratorService.php')) && false ?: '_'}, ${($_ = isset($this->services['doctrine.orm.default_entity_manager']) ? $this->services['doctrine.orm.default_entity_manager'] : $this->getDoctrine_Orm_DefaultEntityManagerService()) && false ?: '_'}, ${($_ = isset($this->services['Eccube\\Repository\\DeliveryRepository']) ? $this->services['Eccube\\Repository\\DeliveryRepository'] : $this->load('getDeliveryRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['Eccube\\Repository\\ProductRepository']) ? $this->services['Eccube\\Repository\\ProductRepository'] : $this->getProductRepositoryService()) && false ?: '_'});

$instance->setName('eccube:fixtures:generate');

return $instance;
