<?php
/**
 * Copyright(c) 2021 systemkd
 * Date: 2021/7/22
 */

namespace Plugin\KokokaraSelect\Doctrine;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Andx;
use Doctrine\ORM\QueryBuilder;
use Eccube\Doctrine\Query\QueryCustomizer;
use Eccube\Entity\OrderItem;
use Eccube\Repository\OrderItemRepository;
use Eccube\Repository\QueryKey;

class OrderSearchCustomizer implements QueryCustomizer
{

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * クエリをカスタマイズします。
     *
     * @param QueryBuilder $builder
     * @param array $params
     * @param string $queryKey
     */
    public function customize(QueryBuilder $builder, $params, $queryKey)
    {

        /** @var OrderItemRepository $orderItemRepository */
        $orderItemRepository = $this->entityManager->getRepository(OrderItem::class);

        $subQb = $orderItemRepository->createQueryBuilder('ks_sub_oi')
            ->select('ks_sub_oi.id')
            ->andWhere('ks_sub_oi.product_name like :buy_product_name');

        // セット商品用に追加
        /** @var Andx $dqlPart */
        $dqlPart = $builder->getDQLPart('where');
        $newPart = [];

        $dqlPartReset = false;
        foreach ($dqlPart->getParts() as $part) {
            // 購入商品名で絞り込みを行った場合
            if ($part == 'oi.product_name LIKE :buy_product_name') {

                $builder->leftJoin('oi.KsOrderItemEx', 'ksoiex');

                // 商品名検索調整
                $where = '(oi.product_name LIKE :buy_product_name or ksoiex.ParentOrderItem in (';
                $where .= $subQb->getDQL() . '))';
                $newPart[] = $where;

                $dqlPartReset = true;
            } else {
                $newPart[] = $part;
            }
        }

        if ($dqlPartReset) {
            $builder->resetDQLPart('where');
            foreach ($newPart as $item) {
                $builder->andWhere($item);
            }
        }

    }

    /**
     * カスタマイズ対象のキーを返します。
     *
     * @return string
     */
    public function getQueryKey()
    {
        return QueryKey::ORDER_SEARCH_ADMIN;
    }
}
