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

namespace Plugin\CustomerGroup\Repository;


use Eccube\Common\EccubeConfig;
use Eccube\Doctrine\Query\Queries;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CategoryRepository extends \Eccube\Repository\CategoryRepository
{
    /**
     * @var Queries
     */
    private $queries;

    public function __construct(
        RegistryInterface $registry,
        EccubeConfig $eccubeConfig,
        Queries $queries
    )
    {
        parent::__construct($registry, $eccubeConfig);

        $this->queries = $queries;
    }

    /**
     * @param $searchData
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilderBySearchData($searchData)
    {
        $qb = $this->createQueryBuilder('c1')
            ->select('c1, c2, c3, c4, c5')
            ->leftJoin('c1.Children', 'c2')
            ->leftJoin('c2.Children', 'c3')
            ->leftJoin('c3.Children', 'c4')
            ->leftJoin('c4.Children', 'c5')
            ->orderBy('c1.sort_no', 'DESC')
            ->addOrderBy('c2.sort_no', 'DESC')
            ->addOrderBy('c3.sort_no', 'DESC')
            ->addOrderBy('c4.sort_no', 'DESC')
            ->addOrderBy('c5.sort_no', 'DESC');

        if ($searchData['parent']) {
            $qb->where('c1.Parent = :Parent')->setParameter('Parent', $searchData['parent']);
        } else {
            $qb->where('c1.Parent IS NULL');
        }

        return $this->queries->customize(QueryKey::CATEGORY_SEARCH, $qb, $searchData);
    }
}
