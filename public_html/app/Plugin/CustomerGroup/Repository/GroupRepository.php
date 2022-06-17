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


use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Eccube\Doctrine\Query\Queries;
use Eccube\Repository\AbstractRepository;
use Plugin\CustomerGroup\Entity\Group;

class GroupRepository extends AbstractRepository
{
    /**
     * @var Queries
     */
    protected $queries;

    /**
     * GroupRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry, Queries $queries)
    {
        parent::__construct($registry, Group::class);
        $this->queries = $queries;
    }

    /**
     * @param array $searchData
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilderBySearchData(array $searchData): QueryBuilder
    {
        $qb = $this->createQueryBuilder('g')
            ->orderBy('g.sortNo', Criteria::ASC);

        return $this->queries->customize(QueryKey::GROUP_SEARCH, $qb, $searchData);
    }
}
