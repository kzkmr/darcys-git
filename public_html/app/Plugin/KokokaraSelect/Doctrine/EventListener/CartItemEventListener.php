<?php
/**
 * Copyright(c) 2020 SYSTEM_KD
 * Date: 2020/05/26
 */

namespace Plugin\KokokaraSelect\Doctrine\EventListener;


use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\CartItem;
use Plugin\KokokaraSelect\Entity\KsCartSelectItem;
use Plugin\KokokaraSelect\Entity\KsCartSelectItemGroup;

class CartItemEventListener
{

    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function postLoad(CartItem $entity)
    {
        // 読み込みを実施してキャッシュへ焼き付け
        /** @var KsCartSelectItemGroup $ksCartSelectItemGroup */
        foreach ($entity->getKsCartSelectItemGroups() as $ksCartSelectItemGroup) {
            /** @var KsCartSelectItem $item */
            foreach ($ksCartSelectItemGroup->getKsCartSelectItems() as $item) {
                $item->getKsSelectItem();
            }
        }
    }

    public function preRemove(CartItem $entity)
    {
        /** @var KsCartSelectItemGroup $ksCartSelectItemGroup */
        foreach ($entity->getKsCartSelectItemGroups() as $ksCartSelectItemGroup) {
            $this->entityManager->remove($ksCartSelectItemGroup);
        }
    }
}
