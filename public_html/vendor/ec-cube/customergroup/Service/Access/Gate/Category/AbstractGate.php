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


use Eccube\Entity\Category;
use Plugin\CustomerGroup\Security\Authorization\Voter\CategoryVoter;
use Plugin\CustomerGroup\Service\Access\GateInterface;
use Plugin\CustomerGroup\Service\Access\Request;

abstract class AbstractGate implements GateInterface
{
    /**
     * 親カテゴリにグループが登録されているか
     *
     * @param Category $entity
     * @return bool
     */
    protected function hasGroups(Category $entity): bool
    {
        // 小カテゴリだったら親カテゴリを探す
        if (null !== $entity->getParent()) {
            $parents = $entity->getParents();
            $entity = array_shift($parents);
        }

        return $entity->hasGroups() > 0;
    }

    public function supports($attribute, Request $request): bool
    {
        return CategoryVoter::VIEW === $attribute && $request->getEntity() instanceof Category;
    }
}
