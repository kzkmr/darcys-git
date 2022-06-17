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


use Eccube\Entity\Product;
use Plugin\CustomerGroup\Security\Authorization\Voter\ProductVoter;
use Plugin\CustomerGroup\Service\Access\GateInterface;
use Plugin\CustomerGroup\Service\Access\Request;

abstract class AbstractGate implements GateInterface
{
    public function supports($attribute, Request $request): bool
    {
        return ProductVoter::VIEW === $attribute && $request->getEntity() instanceof Product;
    }
}
