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

use Eccube\Repository\OrderRepository;
use Eccube\Repository\AbstractRepository;
use Doctrine\ORM\EntityManagerInterface;
use Eccube\Common\EccubeConfig;
use Eccube\Doctrine\Query\Queries;
use Customize\Entity\ChainStore;
use Customize\Entity\Master\ChainStoreStatus;
use Eccube\Entity\Master\OrderStatus;
use Eccube\Util\StringUtil;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * ChainStoreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChainStoreRepository extends AbstractRepository
{
    /**
     * @var Queries
     */
    protected $queries;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    /**
     * ChainStoreRepository constructor.
     *
     * @param RegistryInterface $registry
     * @param Queries $queries
     * @param EntityManagerInterface $entityManager
     * @param OrderRepository $orderRepository
     * @param EncoderFactoryInterface $encoderFactory
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(
        RegistryInterface $registry,
        Queries $queries,
        EntityManagerInterface $entityManager,
        OrderRepository $orderRepository,
        EncoderFactoryInterface $encoderFactory,
        EccubeConfig $eccubeConfig
    ) {
        parent::__construct($registry, ChainStore::class);

        $this->queries = $queries;
        $this->entityManager = $entityManager;
        $this->orderRepository = $orderRepository;
        $this->encoderFactory = $encoderFactory;
        $this->eccubeConfig = $eccubeConfig;
    }

    public function newChainStore()
    {
        $ChainStoreStatus = $this->getEntityManager()
            ->find(ChainStoreStatus::class, ChainStoreStatus::PROVISIONAL);

        $ChainStore = new \Customize\Entity\ChainStore();
        $ChainStore
            ->setStatus($ChainStoreStatus);

        return $ChainStore;
    }

    public function getQueryBySearchData($searchData)
    {
        $qb = $this->createQueryBuilder('c')
        ->select('c');

        if (isset($searchData['multi']) && StringUtil::isNotBlank($searchData['multi'])) {
            //スペース除去
            $clean_key_multi = preg_replace('/\s+|[　]+/u', '', $searchData['multi']);
            $id = preg_match('/^\d{0,10}$/', $clean_key_multi) ? $clean_key_multi : null;
            if ($id && $id > '2147483647' && $this->isPostgreSQL()) {
                $id = null;
            }
            $qb
                ->andWhere('c.id = :chain_store_id OR CONCAT(c.name01, c.name02) LIKE :name OR CONCAT(c.kana01, c.kana02) LIKE :kana OR c.company_name LIKE :company_name OR c.company_name_kana LIKE :company_name_kana OR c.stock_number LIKE :stock_number OR c.dealer_code LIKE :dealer_code ')
                ->setParameter('chain_store_id', $id)
                ->setParameter('name', '%'.$clean_key_multi.'%')
                ->setParameter('kana', '%'.$clean_key_multi.'%')
                ->setParameter('company_name', '%'.$clean_key_multi.'%')
                ->setParameter('company_name_kana', '%'.$clean_key_multi.'%')
                ->setParameter('stock_number', '%'.$clean_key_multi.'%')
                ->setParameter('dealer_code', '%'.$clean_key_multi.'%');
        }

        // create_date
        if (!empty($searchData['create_datetime_start']) && $searchData['create_datetime_start']) {
            $date = $searchData['create_datetime_start'];
            $qb
                ->andWhere('c.create_date >= :create_date_start')
                ->setParameter('create_date_start', $date);
        } elseif (!empty($searchData['create_date_start']) && $searchData['create_date_start']) {
            $qb
                ->andWhere('c.create_date >= :create_date_start')
                ->setParameter('create_date_start', $searchData['create_date_start']);
        }

        if (!empty($searchData['create_datetime_end']) && $searchData['create_datetime_end']) {
            $date = $searchData['create_datetime_end'];
            $qb
                ->andWhere('c.create_date < :create_date_end')
                ->setParameter('create_date_end', $date);
        } elseif (!empty($searchData['create_date_end']) && $searchData['create_date_end']) {
            $date = clone $searchData['create_date_end'];
            $date->modify('+1 days');
            $qb
                ->andWhere('c.create_date < :create_date_end')
                ->setParameter('create_date_end', $date);
        }

        // update_date
        if (!empty($searchData['update_datetime_start']) && $searchData['update_datetime_start']) {
            $date = $searchData['update_datetime_start'];
            $qb
                ->andWhere('c.update_date >= :update_date_start')
                ->setParameter('update_date_start', $date);
        } elseif (!empty($searchData['update_date_start']) && $searchData['update_date_start']) {
            $qb
                ->andWhere('c.update_date >= :update_date_start')
                ->setParameter('update_date_start', $searchData['update_date_start']);
        }

        if (!empty($searchData['update_datetime_end']) && $searchData['update_datetime_end']) {
            $date = $searchData['update_datetime_end'];
            $qb
                ->andWhere('c.update_date < :update_date_end')
                ->setParameter('update_date_end', $date);
        } elseif (!empty($searchData['update_date_end']) && $searchData['update_date_end']) {
            $date = clone $searchData['update_date_end'];
            $date->modify('+1 days');
            $qb
                ->andWhere('c.update_date < :update_date_end')
                ->setParameter('update_date_end', $date);
        }

        // contract_type
        if (!empty($searchData['contract_type']) && count($searchData['contract_type']) > 0) {
            $qb
                ->andWhere($qb->expr()->in('c.ContractType', ':contract_type'))
                ->setParameter('contract_type', $searchData['contract_type']);
        }

        // status
        if (!empty($searchData['chain_store_status']) && count($searchData['chain_store_status']) > 0) {
            $qb
                ->andWhere($qb->expr()->in('c.Status', ':statuses'))
                ->setParameter('statuses', $searchData['chain_store_status']);
        }

        // Order By
        $qb = $qb->addOrderBy('c.update_date', 'DESC');
        return $qb;
    }

    public function getQueryBuilderBySearchData($searchData)
    {
        $qb = $this->getQueryBySearchData($searchData);
        return $qb->getQuery()->getResult();
    }

    public function getResultBySearchKeyword($keyword){
        $searchData = ["multi" => $keyword];
        $qb = $this->getQueryBySearchData($searchData);
        return $qb->getQuery()->getResult();
    }

    public function getResultByMainSearchKeyword($keyword){
        $searchData = ["multi" => $keyword, "contract_type" => [1,2]];
        $qb = $this->getQueryBySearchData($searchData);
        return $qb->getQuery()->getResult();
    }

    /**
     * ユニークなシークレットキーを返す.
     *
     * @return string
     */
    public function getUniqueSecretKey()
    {
        do {
            $key = StringUtil::random(32);
            $ChainStore = $this->findOneBy(['secret_key' => $key]);
        } while ($ChainStore);

        return $key;
    }

    /**
     * ユニークなパスワードリセットキーを返す
     *
     * @return string
     */
    public function getUniqueResetKey()
    {
        do {
            $key = StringUtil::random(32);
            $ChainStore = $this->findOneBy(['reset_key' => $key]);
        } while ($ChainStore);

        return $key;
    }

    /**
     * 仮販売店をシークレットキーで検索する.
     *
     * @param $secretKey
     *
     * @return ChainStore|null 見つからない場合はnullを返す.
     */
    public function getProvisionalChainStoreBySecretKey($secretKey)
    {
        return $this->findOneBy([
            'secret_key' => $secretKey,
            'Status' => ChainStoreStatus::PROVISIONAL,
        ]);
    }

    /**
     * 本販売店をemailで検索する.
     *
     * @param $email
     *
     * @return ChainStore|null 見つからない場合はnullを返す.
     */
    public function getRegularChainStoreByEmail($email)
    {
        return $this->findOneBy([
            'email' => $email,
            'Status' => ChainStoreStatus::REGULAR,
        ]);
    }

    /**
     * 本販売店をリセットキー、またはリセットキーとメールアドレスで検索する.
     *
     * @param $resetKey
     * @param $email
     *
     * @return ChainStore|null 見つからない場合はnullを返す.
     */
    public function getRegularChainStoreByResetKey($resetKey, $email = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.reset_key = :reset_key AND c.Status = :status AND c.reset_expire >= :reset_expire')
            ->setParameter('reset_key', $resetKey)
            ->setParameter('status', ChainStoreStatus::REGULAR)
            ->setParameter('reset_expire', new \DateTime());

        if ($email) {
            $qb
                ->andWhere('c.email = :email')
                ->setParameter('email', $email);
        }

        return $qb->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * リセット用パスワードを生成する.
     *
     * @return string
     */
    public function getResetPassword()
    {
        return StringUtil::random(8);
    }

    /**
     * 仮販売店, 本販売店の販売店を返す.
     * Eccube\Entity\ChainStoreのUniqueEntityバリデーションで使用しています.
     *
     * @param array $criteria
     *
     * @return ChainStore[]
     */
    public function getNonWithdrawingChainStores(array $criteria = [])
    {
        $criteria['Status'] = [
            ChainStoreStatus::PROVISIONAL,
            ChainStoreStatus::REGULAR,
        ];

        return $this->findBy($criteria);
    }
}
