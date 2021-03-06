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

namespace Plugin\Noshi\Repository;

use Eccube\Repository\AbstractRepository;
use Eccube\Util\StringUtil;
use Plugin\Noshi\Entity\Noshi;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

/**
 * NoshiRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoshiRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Noshi::class);
    }

    /**
     * 検索条件での検索を行う。
     *
     * @param array $searchData
     *
     * @return QueryBuilder
     */
    public function getQueryBuilderBySearchData($searchData)
    {
        // 完了していない注文データもdtb_orderに登録されるので、完了したデータだけを抽出する。
		$qb = $this->createQueryBuilder('n')
			->innerJoin('Eccube\Entity\Order', 'o', 'WITH', 'o.id = n.order_id')
			->where('o.order_date >= o.create_date');

        // order_id //スペース除去
        if (isset($searchData['order_id']) && StringUtil::isNotBlank($searchData['order_id'])) {
            $id = preg_match('/^\d{0,10}$/', $searchData['order_id'])  ? $searchData['order_id'] : null;
            if ($id && $id > '2147483647' && $this->isPostgreSQL()) {
                $id = null;
            }
            $qb
                ->andWhere('n.order_id = :order_id')
                ->setParameter('order_id', $id);
        }

        // Order By
        $qb->addOrderBy('n.id', 'DESC');

        return $qb;
    }

    /**
     * 登録
     *
     * @param $Noshi
     */
    public function save($Noshi)
    {
        $em = $this->getEntityManager();
        $em->persist($Noshi);
        $em->flush($Noshi);
    }

    /**
     * 削除
     *
     * @param Noshi $Noshi
     *
     * @throws ForeignKeyConstraintViolationException 外部キー制約違反の場合
     * @throws DriverException SQLiteの場合, 外部キー制約違反が発生すると, DriverExceptionをthrowします.
     */
    public function delete($Noshi)
    {
        $em = $this->getEntityManager();
        $em->remove($Noshi);
        $em->flush($Noshi);
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilderAll()
    {
        $qb = $this->createQueryBuilder('n');
        $qb->orderBy('n.sort_no', 'DESC');

        return $qb;
    }

    /**
     * @return Noshi[]|ArrayCollection
     */
    public function getList()
    {
        // second level cacheを効かせるためfindByで取得
        $Results = $this->findBy(['visible' => true], ['sort_no' => 'DESC', 'id' => 'DESC']);

        $Noshis = new ArrayCollection($Results);

        return $Noshis;
    }
}
