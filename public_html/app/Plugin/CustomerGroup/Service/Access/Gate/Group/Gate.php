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

namespace Plugin\CustomerGroup\Service\Access\Gate\Group;


use Eccube\Entity\AbstractEntity;
use Eccube\Entity\Customer;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Security\Authorization\Voter\GroupVoter;
use Plugin\CustomerGroup\Service\Access\GateInterface;
use Plugin\CustomerGroup\Service\Access\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class Gate implements GateInterface
{
    /**
     * @param TokenInterface $token
     * @param AbstractEntity $entity
     * @return bool
     */
    public function pass(TokenInterface $token, AbstractEntity $entity): bool
    {
        if ($token instanceof UsernamePasswordToken) {
            /** @var Customer $customer */
            $customer = $token->getUser();
            return $customer instanceof Customer ? $customer->getGroups()->contains($entity) : false;
        }

        return false;
    }

    /**
     * @param $attribute
     * @param Request $request
     * @return bool
     */
    public function supports($attribute, Request $request): bool
    {
        return GroupVoter::VIEW === $attribute && $request->getEntity() instanceof Group;
    }
}
