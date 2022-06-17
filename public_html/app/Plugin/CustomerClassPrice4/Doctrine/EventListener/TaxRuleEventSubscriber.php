<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Doctrine\EventListener;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Eccube\Service\TaxRuleService;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;

class TaxRuleEventSubscriber implements EventSubscriber
{
    /**
     * @var TaxRuleService
     */
    private $taxRuleService;

    public function __construct(TaxRuleService $taxRuleService)
    {
        $this->taxRuleService = $taxRuleService;
    }

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            Events::postLoad
        ];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof CustomerClassPrice) {
            $entity->setPriceIncTax($this->taxRuleService->getPriceIncTax($entity->getPrice(),
                $entity->getProductClass()->getProduct(), $entity->getProductClass()));
        }
    }
}
