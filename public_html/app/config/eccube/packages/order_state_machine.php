<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Eccube\Entity\Master\OrderStatus as Status;
use Eccube\Service\OrderStateMachineContext;

const MAKESHOP = 10;        //出荷作成済み

$container->loadFromExtension('framework', [
    'workflows' => [
        'order' => [
            'type' => 'state_machine',
            'marking_store' => [
                'type' => 'single_state',
                'arguments' => 'status',
            ],
            'supports' => [
                OrderStateMachineContext::class,
            ],
            'initial_place' => (string) Status::NEW,
            'places' => [
                (string) Status::NEW,
                (string) Status::CANCEL,
                (string) Status::IN_PROGRESS,
                (string) Status::DELIVERED,
                (string) Status::PAID,
                (string) Status::PENDING,
                (string) Status::PROCESSING,
                (string) Status::RETURNED,
                (string) MAKESHOP,       
            ],
            'transitions' => [
                'pay' => [
                    'from' => [(string) Status::NEW],
                    'to' => (string) Status::PAID,
                ],
                'makeship' => [
                    'from' => [(string) Status::NEW, (string) Status::PAID, (string) Status::IN_PROGRESS],
                    'to' => (string) MAKESHOP,
                ],
                'packing' => [
                    'from' => [(string) Status::NEW, (string) Status::PAID, (string) MAKESHOP],
                    'to' => (string) Status::IN_PROGRESS,
                ],
                'cancel' => [
                    'from' => [(string) Status::NEW, (string) Status::IN_PROGRESS, (string) Status::PAID, (string) MAKESHOP],
                    'to' => (string) Status::CANCEL,
                ],
                'back_to_in_progress' => [
                    'from' => [(string) Status::CANCEL, (string) MAKESHOP],
                    'to' => (string) Status::IN_PROGRESS,
                ],
                'ship' => [
                    'from' => [(string) Status::NEW, (string) Status::PAID, (string) Status::IN_PROGRESS, (string) MAKESHOP],
                    'to' => [(string) Status::DELIVERED],
                ],
                'return' => [
                    'from' => [(string) Status::DELIVERED, (string) MAKESHOP],
                    'to' => (string) Status::RETURNED,
                ],
                'cancel_return' => [
                    'from' => [(string) Status::RETURNED, (string) MAKESHOP],
                    'to' => (string) Status::DELIVERED,
                ],
            ],
        ],
    ],
]);
