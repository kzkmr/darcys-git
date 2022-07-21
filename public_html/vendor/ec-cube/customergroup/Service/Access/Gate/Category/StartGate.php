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

namespace Plugin\CustomerGroup\Service\Access\Gate\Category;


use Eccube\Entity\AbstractEntity;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class StartGate extends AbstractGate
{

    public function pass(TokenInterface $token, AbstractEntity $entity): bool
    {
        if ($this->hasGroups($entity)) {
            return $token instanceof UsernamePasswordToken;
        }

        return true;
    }
}
