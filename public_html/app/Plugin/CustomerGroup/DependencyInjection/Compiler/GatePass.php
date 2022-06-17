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

namespace Plugin\CustomerGroup\DependencyInjection\Compiler;


use Plugin\CustomerGroup\Service\Access\Context;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class GatePass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    const TAG = 'plugin.customer.group.gate';

    public function process(ContainerBuilder $container)
    {
        $context = $container->findDefinition(Context::class);

        foreach ($this->findAndSortTaggedServices(self::TAG, $container) as $id) {
            $context->addMethodCall('addGate', [new Reference($id)]);
        }
    }
}
