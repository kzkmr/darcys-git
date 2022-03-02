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

$container->registerForAutoconfiguration(\Plugin\CustomerGroup\Service\Access\GateInterface::class)
    ->addTag(\Plugin\CustomerGroup\DependencyInjection\Compiler\GatePass::TAG);

$container->addCompilerPass(new \Plugin\CustomerGroup\DependencyInjection\Compiler\GatePass());
