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


class Context
{
    /**
     * @var array
     */
    private $gates = [];

    /**
     * @param GateInterface $gate
     */
    public function addGate(GateInterface $gate)
    {
        $this->gates[] = $gate;
    }

    /**
     * @param Request $request
     * @param $attribute
     * @return bool
     */
    public function allow($attribute, Request $request): bool
    {
        /** @var GateInterface $gate */
        foreach ($this->gates as $gate) {
            if (false === $gate->supports($attribute, $request)) {
                continue;
            }

            if(false === $gate->pass($request->getToken(), $request->getEntity())) {
                return false;
            }
        }

        return true;
    }
}
