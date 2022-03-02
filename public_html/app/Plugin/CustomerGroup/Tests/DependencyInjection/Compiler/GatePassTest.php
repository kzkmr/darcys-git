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

namespace Plugin\CustomerGroup\Tests\DependencyInjection\Compiler;


use Eccube\Entity\AbstractEntity;
use PHPUnit\Framework\TestCase;
use Plugin\CustomerGroup\DependencyInjection\Compiler\GatePass;
use Plugin\CustomerGroup\Service\Access\Context;
use Plugin\CustomerGroup\Service\Access\GateInterface;
use Plugin\CustomerGroup\Service\Access\Request;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class GatePassTest extends TestCase
{
    public function testTestGateが追加されるか()
    {
        $container = new ContainerBuilder();
        $container->register(Context::class)
            ->setPublic(true);

        $container->register(TestGate::class)
            ->addTag(GatePass::TAG);

        $container->addCompilerPass(new GatePass());
        $container->compile();

        $context = $container->get(Context::class);
        $object = new \ReflectionObject($context);
        $prop = $object->getProperty('gates');
        $prop->setAccessible(true);
        $gates = $prop->getValue($context);

        self::assertCount(1, $gates);
    }

}

class TestGate implements GateInterface
{
    public function pass(TokenInterface $token, AbstractEntity $entity): bool
    {
        return true;
    }

    public function supports($attribute, Request $request): bool
    {
        return true;
    }
}
