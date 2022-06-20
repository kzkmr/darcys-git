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

namespace Plugin\SeoListDetail;

use Eccube\Event\TemplateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SeoListDetailEvent implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
			'@admin/Product/product.twig' => 'onAdminProduct',
			'@admin/Product/category.twig' => 'onAdminCategory',
        ];
    }

    public function onAdminProduct(TemplateEvent $event)
    {
        $event->addSnippet('@SeoListDetail/admin/add_product.twig');
    }
	
    public function onAdminCategory(TemplateEvent $event)
    {
        $event->addSnippet('@SeoListDetail/admin/add_category.twig');
    }
}
