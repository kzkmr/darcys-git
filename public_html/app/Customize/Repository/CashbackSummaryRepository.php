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

namespace Customize\Repository;

use \DatePeriod;
use \DateTime;
use \DateInterval;
use Customize\Entity\CashbackSummary;
use Eccube\Repository\AbstractRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Eccube\Doctrine\Query\Queries;
use Eccube\Util\StringUtil;

/**
 * CashbackSummaryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CashbackSummaryRepository extends AbstractRepository
{
    /**
     * @var Queries
     */
    protected $queries;

    /**
     * OrderRepository constructor.
     *
     * @param RegistryInterface $registry
     * @param Queries $queries
     */
    public function __construct(RegistryInterface $registry, Queries $queries)
    {
        parent::__construct($registry, CashbackSummary::class);
        $this->queries = $queries;
    }


    public function getQueryBuilderBySearchData($searchData)
    {
        $qb = $this->createQueryBuilder('c')
            ->join('c.ChainStore', 'cs');

        if (isset($searchData['multi']) && StringUtil::isNotBlank($searchData['multi'])) {
            //スペース除去
            $clean_key_multi = preg_replace('/\s+|[　]+/u', '', $searchData['multi']);
            $id = preg_match('/^\d{0,10}$/', $clean_key_multi) ? $clean_key_multi : null;
            if ($id && $id > '2147483647' && $this->isPostgreSQL()) {
                $id = null;
            }
            //販売店ID・会社名・お名前・ディーラーコード・証券番号
            $qb
                ->andWhere('cs.id = :chainstore_id OR CONCAT(cs.name01, cs.name02) LIKE :name OR CONCAT(cs.kana01, cs.kana02) LIKE :kana OR cs.dealer_code LIKE :dealer_code OR cs.stock_number LIKE :stock_number OR cs.company_name LIKE :company_name OR cs.company_name_kana LIKE :company_name_kana')
                ->setParameter('chainstore_id', $id)
                ->setParameter('name', '%'.$clean_key_multi.'%')
                ->setParameter('kana', '%'.$clean_key_multi.'%')
                ->setParameter('dealer_code', '%'.$clean_key_multi.'%')
                ->setParameter('stock_number', '%'.$clean_key_multi.'%')
                ->setParameter('company_name', '%'.$clean_key_multi.'%')
                ->setParameter('company_name_kana', '%'.$clean_key_multi.'%');
        }

        if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
            $qb
            ->andWhere('c.referenceYm = :reference_ym')
            ->setParameter('reference_ym', $searchData['data_ym']);
        }

        if (!empty($searchData['contract_type']) && $searchData['contract_type']) {
            $qb
            ->andWhere($qb->expr()->in('cs.ContractType', ':contract_type'))
            ->setParameter('contract_type', $searchData['contract_type']);
        }

        if (!empty($searchData['cb_is_read']) && $searchData['cb_is_read']) {
            if($searchData['cb_is_read'] == "Y"){
                $qb
                ->andWhere('c.exportCnt >= 1');
            }else{
                $qb
                ->andWhere('c.exportCnt <= 0');
            }
        }

        $qb->andWhere("cs.Status = 2");
        // Order By 
        $qb->addOrderBy('c.id', 'ASC');

        return $qb;
    }

    public function getResultBySearchData($searchData){
        $result = $this->getQueryBuilderBySearchData($searchData);
        $result = $result->getQuery()->getResult();

        return $result;
    }

    public function getListDateByAll()
    {
        $result = $this->createQueryBuilder('o')
            ->select("DISTINCT o.referenceYm AS dateVal, CONCAT(REPLACE(o.referenceYm, '-', '年'), '月')  AS dateName")
            ->orderBy("o.referenceYm",  "DESC")
            ->getQuery();

        $result = $result->getResult();

        return $result;
    }

    /**
     * @param  \Customize\Entity\ChainStore $ChainStore
     *
     * @return Result
     */
    public function getDateList(\Customize\Entity\ChainStore $ChainStore)
    {
        $result = $this->createQueryBuilder('o')
            ->select("DISTINCT o.referenceYm AS dateVal, CONCAT(REPLACE(o.referenceYm, '-', '年'), '月')  AS dateName")
            ->where('o.ChainStore = :ChainStore')
            ->orderBy("o.referenceYm",  "DESC")
            ->setParameter('ChainStore', $ChainStore)
            ->getQuery();

        $result = $result->getResult();

        return $result;
    }


    /** 
     * @param  String selectedYM --OK
     *
     * @return QueryBuilder 
     */
    public function deleteByYM($selectedYM)
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->delete('Customize\Entity\CashbackSummary', 's')
            ->where("s.referenceYm = :selectedYM  ")
            ->setParameter('selectedYM', $selectedYM)
            ->getQuery();
        
        $result = $qb->execute();

        return $result;
    }
}
