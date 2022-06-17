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

namespace Plugin\CustomerGroup\Service\Access\Gate\Product;


use Eccube\Entity\AbstractEntity;
use Plugin\CustomerGroup\Entity\Group;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class StartGate extends AbstractGate
{
    public function pass(TokenInterface $token, AbstractEntity $entity): bool
    {
        if ($entity->hasGroups() > 0) {
            if ($token instanceof AnonymousToken) {
                $groups = $entity->getGroups()->filter(function (Group $group) {
                    return $group->isOptionNonMemberDisplay();
                });
                return $groups->count() > 0;
            }
        }

        return true;
    }
}
