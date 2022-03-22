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

use Eccube\Common\Constant;
use Eccube\Repository\AbstractRepository;
use Plugin\Coupon4\Entity\Coupon;
use Plugin\Coupon4\Entity\CouponDetail;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * CouponRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CouponRepository extends AbstractRepository
{
    /**
     * CouponRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    /**
     * 有効なクーポンを1件取得する.
     *
     * @param $couponCd
     *
     * @return $result
     */
    public function findActiveCoupon($couponCd)
    {
        $currenDateTime = new \DateTime();

        // 時分秒を0に設定する
        $currenDateTime->setTime(0, 0, 0);

        $qb = $this->createQueryBuilder('c')->setMaxResults(1)->select('c')->Where('c.visible = true');

        // クーポンコード
        $qb->andWhere('c.coupon_cd = :coupon_cd')
            ->setParameter('coupon_cd', $couponCd);

        // クーポンコード有効
        $qb->andWhere('c.enable_flag = :enable_flag')
            ->setParameter('enable_flag', Constant::ENABLED);

        // 有効期間(FROM)
        $qb->andWhere('c.available_from_date <= :cur_date_time OR c.available_from_date IS NULL')
            ->setParameter('cur_date_time', $currenDateTime);

        // 有効期間(TO)
        $qb->andWhere(':cur_date_time <= c.available_to_date OR c.available_to_date IS NULL')
            ->setParameter('cur_date_time', $currenDateTime);

        // 実行
        $result = null;
        $results = $qb->getQuery()->getResult();
        if (!is_null($results) && count($results) > 0) {
            $result = $results[0];
        }

        return $result;
    }

    /**
     * 有効なクーポンを全取得する.
     *
     * @return array
     */
    public function findActiveCouponAll()
    {
        $currenDateTime = new \DateTime();

        // 時分秒を0に設定する
        $currenDateTime->setTime(0, 0, 0);

        $qb = $this->createQueryBuilder('c')->select('c')->Where('c.visible = true');

        // クーポンコード有効
        $qb->andWhere('c.enable_flag = :enable_flag')
            ->setParameter('enable_flag', Constant::ENABLED);

        // 有効期間(FROM)
        $qb->andWhere('c.available_from_date <= :cur_date_time OR c.available_from_date IS NULL')
            ->setParameter('cur_date_time', $currenDateTime);

        // 有効期間(TO)
        $qb->andWhere(':cur_date_time <= c.available_to_date OR c.available_to_date IS NULL')
            ->setParameter('cur_date_time', $currenDateTime);

        // 実行
        return $qb->getQuery()->getResult();
    }

    /**
     * 販売店の特別会員有効なクーポンを全取得する.
     *
     * @return array
     */
    public function findChainStoreActiveCouponAll($ChainStore)
    {
        $currenDateTime = new \DateTime();

        // 時分秒を0に設定する
        $currenDateTime->setTime(0, 0, 0);

        $qb = $this->createQueryBuilder('c')->select('c')->Where('c.visible = true');

        // クーポンコード有効
        $qb->andWhere('c.enable_flag = :enable_flag')
            ->setParameter('enable_flag', Constant::ENABLED);

        // 有効期間(FROM)
        $qb->andWhere('c.available_from_date <= :cur_date_time OR c.available_from_date IS NULL')
            ->setParameter('cur_date_time', $currenDateTime);

        // 有効期間(TO)
        $qb->andWhere(':cur_date_time <= c.available_to_date OR c.available_to_date IS NULL')
            ->setParameter('cur_date_time', $currenDateTime);

        // 販売店の特別会員
        $qb->andWhere('c.ChainStore = :ChainStore')
            ->setParameter('ChainStore', $ChainStore);

        // 実行
        return $qb->getQuery()->getResult();
    }

    /**
     * クーポン情報を有効/無効にする.
     *
     * @param Coupon $Coupon
     *
     * @return bool
     */
    public function enableCoupon(Coupon $Coupon)
    {
        $em = $this->getEntityManager();
        // クーポン情報を書き換える
        $Coupon->setEnableFlag(!$Coupon->getEnableFlag());
        // クーポン情報を登録する
        $em->persist($Coupon);
        $em->flush($Coupon);

        return true;
    }

    /**
     * クーポン情報を削除する.
     *
     * @param Coupon $Coupon
     *
     * @return bool
     */
    public function deleteCoupon(Coupon $Coupon)
    {
        $em = $this->getEntityManager();

        // クーポン情報を書き換える
        $Coupon->setVisible(false);
        // クーポン情報を登録する
        $em->persist($Coupon);
        $em->flush($Coupon);
        // クーポン詳細情報を取得する
        $details = $Coupon->getCouponDetails();
        /** @var CouponDetail $detail */
        foreach ($details as $detail) {
            // クーポン詳細情報を書き換える
            $detail->setVisible(false);
            $em->persist($detail);
            $em->flush($detail);
        }

        return true;
    }

    /**
     *  クーポンの発行枚数のチェック.
     *
     * @param string         $couponCd
     *
     * @return bool クーポンの枚数が一枚以上の時にtrueを返す
     */
    public function checkCouponUseTime($couponCd)
    {
        /** @var Coupon $Coupon */
        $Coupon = $this->findOneBy(['coupon_cd' => $couponCd]);
        if ($Coupon->getUnlimited() == 'Y') {
            // クーポンの発行枚数は購入完了時に減算される、一枚以上残っていれば利用できる
            return $Coupon->getCouponUseTime() >= 1;
        }else{
            return true;
        }
    }
}