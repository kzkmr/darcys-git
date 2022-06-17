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

namespace Plugin\Coupon4\Repository;

use Eccube\Repository\AbstractRepository;
use Plugin\Coupon4\Entity\CouponOrder;
use Eccube\Entity\Order;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * CouponOrderRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CouponOrderRepository extends AbstractRepository
{
    /**
     * CouponOrderRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CouponOrder::class);
    }

    /**
     * クーポン受注情報を保存する.
     *
     * @param CouponOrder $CouponOrder
     */
    public function save($CouponOrder)
    {
        $em = $this->getEntityManager();
        $em->persist($CouponOrder);
        $em->flush($CouponOrder);
    }

    /**
     * 会員または非会員が既にクーポンを利用しているか検索
     * 会員の場合、会員IDで非会員の場合、メールアドレスで検索.
     *
     * @param string $couponCd
     * @param string $param
     *
     * @return array
     */
    public function findUseCoupon($couponCd, $param)
    {
        $userId = null;
        $email = null;

        if (is_numeric($param)) {
            $userId = $param;
        } else {
            $email = $param;
        }

        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.coupon_cd = :coupon_cd')
            ->andWhere('c.order_date IS NOT NULL')
            ->andWhere('c.user_id = :user_id OR c.email = :email')
            ->setParameter('coupon_cd', $couponCd)
            ->setParameter('user_id', $userId)
            ->setParameter('email', $email);
        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

    /**
     * クーポン受注情報を取得する.
     *
     * @param string $preOrderId
     *
     * @return CouponOrder
     */
    public function getCouponOrder($preOrderId)
    {
        $CouponOrder = $this->findOneBy([
                'pre_order_id' => $preOrderId,
            ]);

        return $CouponOrder;
    }
}
