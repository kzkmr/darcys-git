<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\MypageReceipt;

use Eccube\Event\TemplateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MypageReceiptEvent implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'Mypage/history.twig' => 'onRenderMypageHistory',
        ];
    }

    public function onRenderMypageHistory(TemplateEvent $event)
    {
        $event->addSnippet('@MypageReceipt/default/add_btn.twig');
    }
}
