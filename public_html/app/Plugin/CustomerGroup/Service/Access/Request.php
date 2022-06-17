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

class Request
{
    /**
     * @var TokenInterface
     */
    private $token;

    /**
     * @var AbstractEntity
     */
    private $entity;

    public function getToken(): TokenInterface
    {
        return $this->token;
    }

    /**
     * @param TokenInterface $token
     * @return $this
     */
    public function setToken(TokenInterface $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return AbstractEntity
     */
    public function getEntity(): AbstractEntity
    {
        return $this->entity;
    }

    /**
     * @param AbstractEntity $entity
     * @return $this
     */
    public function setEntity(AbstractEntity $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

}
