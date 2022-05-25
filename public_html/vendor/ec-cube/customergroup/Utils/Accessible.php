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

namespace Plugin\CustomerGroup\Utils;


use Eccube\Entity\AbstractEntity;
use Plugin\CustomerGroup\Service\Access\Context;
use Plugin\CustomerGroup\Service\Access\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class Accessible
{
    /**
     * @var Context
     */
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param $attribute
     * @param AbstractEntity $entity
     * @param TokenInterface $token
     * @return bool
     */
    public function can($attribute, AbstractEntity $entity, TokenInterface $token): bool
    {
        $request = new Request();
        $request
            ->setToken($token)
            ->setEntity($entity);

        return $this->context->allow($attribute, $request);
    }
}
