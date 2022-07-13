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

namespace Plugin\CustomerGroup\Repository\QueryCustomizer\Admin;


use Doctrine\ORM\QueryBuilder;
use Eccube\Doctrine\Query\QueryCustomizer;
use Eccube\Repository\QueryKey;
use Eccube\Util\StringUtil;

class SearchOrderCustomizer implements QueryCustomizer
{

    public function customize(QueryBuilder $builder, $params, $queryKey)
    {
        if (isset($params['groups']) && StringUtil::isNotBlank($params['groups'])) {
            $builder
                ->innerJoin('o.groups', 'g')
                ->andWhere($builder->expr()->in('g.id', ':groups'))
                ->setParameter('groups', $params['groups']);
        }
    }

    public function getQueryKey()
    {
        return QueryKey::ORDER_SEARCH_ADMIN;
    }
}
