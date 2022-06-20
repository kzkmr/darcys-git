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

namespace Plugin\Noshi;

use Eccube\Entity\Order;
use Eccube\Event\TemplateEvent;
use Eccube\Repository\Master\ProductStatusRepository;
use Plugin\Noshi\Repository\NoshiConfigRepository;
use Plugin\Noshi\Repository\NoshiRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NoshiEvent implements EventSubscriberInterface
{
    /**
     * @var NoshiConfigRepository
     */
    protected $noshiConfigRepository;

    /**
     * @var NoshiRepository
     */
    protected $noshiRepository;

    /**
     * Noshi constructor.
     *
     * @param NoshiConfigRepository $noshiConfigRepository
     * @param NoshiRepository $noshiRepository
     */
    public function __construct(
        NoshiConfigRepository $noshiConfigRepository,
        NoshiRepository $noshiRepository
    ) {
        $this->noshiConfigRepository = $noshiConfigRepository;
        $this->noshiRepository = $noshiRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopping/index.twig' => 'index',
            'Shopping/confirm.twig' => 'confirm',
            'Mypage/history.twig' => 'history',
			'@admin/Order/edit.twig' => 'onAdminOrderEdit',
        ];
    }

    /**
     * @param TemplateEvent $event
     */
    public function index(TemplateEvent $event)
    {
        $event->addSnippet('Noshi/Resource/template/default/shopping_index.twig');

        $ConfigNoshi = $this->noshiConfigRepository->get();

        /** @var Order $Order */
        $Order = $event->getParameter('Order');

        $Noshis = $this->noshiRepository->findBy(['order_id' => $Order]);

        $parameters = $event->getParameters();
        $parameters['Noshis'] = $Noshis;
        $parameters['ConfigNoshi'] = $ConfigNoshi;
        $event->setParameters($parameters);
    }

    public function confirm(TemplateEvent $event)
    {
        $event->addSnippet('Noshi/Resource/template/default/shopping_confirm.twig');

        $ConfigNoshi = $this->noshiConfigRepository->get();

        /** @var Order $Order */
        $Order = $event->getParameter('Order');

        $Noshis = $this->noshiRepository->findBy(['order_id' => $Order]);

        $parameters = $event->getParameters();
        $parameters['Noshis'] = $Noshis;
        $parameters['ConfigNoshi'] = $ConfigNoshi;
        $event->setParameters($parameters);
    }

    public function history(TemplateEvent $event)
    {
        $event->addSnippet('Noshi/Resource/template/default/mypage_history.twig');

        $ConfigNoshi = $this->noshiConfigRepository->get();

        /** @var Order $Order */
        $Order = $event->getParameter('Order');

        $Noshis = $this->noshiRepository->findBy(['order_id' => $Order]);

        $parameters = $event->getParameters();
        $parameters['Noshis'] = $Noshis;
        $parameters['ConfigNoshi'] = $ConfigNoshi;
        $event->setParameters($parameters);
    }
    public function onAdminOrderEdit(TemplateEvent $event)
    {
        $event->addSnippet('Noshi/Resource/template/admin/admin_order_edit.twig');

        $ConfigNoshi = $this->noshiConfigRepository->get();

        /** @var Order $Order */
        $Order = $event->getParameter('Order');

        $Noshis = $this->noshiRepository->findBy(['order_id' => $Order]);

        $parameters = $event->getParameters();
        $parameters['Noshis'] = $Noshis;
        $parameters['ConfigNoshi'] = $ConfigNoshi;
        $event->setParameters($parameters);
    }
}
