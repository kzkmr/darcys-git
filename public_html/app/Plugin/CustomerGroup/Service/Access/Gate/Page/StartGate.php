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

namespace Plugin\CustomerGroup\Service\Access\Gate\Page;


use Eccube\Entity\AbstractEntity;
use Eccube\Entity\Customer;
use Eccube\Entity\Page;
use Plugin\CustomerGroup\Security\Authorization\Voter\PageVoter;
use Plugin\CustomerGroup\Service\Access\GateInterface;
use Plugin\CustomerGroup\Service\Access\Request;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class StartGate implements GateInterface
{
    public function pass(TokenInterface $token, AbstractEntity $entity): bool
    {
        if ($entity->hasGroups() > 0) {
            if ($token instanceof AnonymousToken) {
                return false;
            }

            if ($token instanceof UsernamePasswordToken) {
                /** @var Customer $customer */
                $customer = $token->getUser();
                return $customer->getGroupPages()->contains($entity);
            }
        }

        return true;
    }

    public function supports($attribute, Request $request): bool
    {
        return PageVoter::VIEW === $attribute && $request->getEntity() instanceof Page;
    }

}
