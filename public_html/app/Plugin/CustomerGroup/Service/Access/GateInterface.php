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

namespace Plugin\CustomerGroup\Service\Access;


use Eccube\Entity\AbstractEntity;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

interface GateInterface
{
    public function pass(TokenInterface $token, AbstractEntity $entity): bool;

    public function supports($attribute, Request $request): bool;
}
