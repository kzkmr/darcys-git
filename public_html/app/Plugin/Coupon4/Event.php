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

namespace Plugin\Coupon4;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Order;
use Eccube\Event\TemplateEvent;
use Eccube\Entity\OrderItem;
use Customize\Repository\CustomerCouponRepository;
use Eccube\Repository\OrderRepository;
use Plugin\Coupon4\Service\CouponService;
use Plugin\Coupon4\Entity\Coupon;
use Plugin\Coupon4\Entity\CouponOrder;
use Plugin\Coupon4\Repository\CouponOrderRepository;
use Plugin\Coupon4\Repository\CouponRepository;
use Eccube\Entity\Master\OrderItemType;
use Eccube\Entity\Master\TaxDisplayType;
use Eccube\Entity\Master\TaxType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class Event.
 */
class Event implements EventSubscriberInterface
{
    /**
     * @var CouponOrderRepository
     */
    private $couponOrderRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CouponRepository
     */
    private $couponRepository;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var CustomerCouponRepository
     */
    private $customerCouponRepository;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var CouponService
     */
    private $couponService;

    protected $container;

    protected $router;

    /**
     * Event constructor.
     *
     * @param CouponOrderRepository $couponOrderRepository
     * @param EntityManagerInterface $entityManager
     * @param CouponService $couponService
     * @param CouponRepository $couponRepository
     * @param OrderRepository $orderRepository
     * @param CustomerCouponRepository $customerCouponRepository
     * @param \Twig_Environment $twig
     */
    public function __construct(CouponOrderRepository $couponOrderRepository, 
                                EntityManagerInterface $entityManager, 
                                CouponService $couponService,
                                CouponRepository $couponRepository, 
                                OrderRepository $orderRepository, 
                                CustomerCouponRepository $customerCouponRepository, 
                                \Twig_Environment $twig,
                                ContainerInterface $container)
    {
        $this->couponOrderRepository = $couponOrderRepository;
        $this->entityManager = $entityManager;
        $this->couponService = $couponService;
        $this->couponRepository = $couponRepository;
        $this->orderRepository = $orderRepository;
        $this->customerCouponRepository = $customerCouponRepository;
        $this->twig = $twig;
        $this->container = $container;
        $this->router = $this->container->get('router');
    }

    /**
     * Todo: admin.order.delete.complete has been deleted.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopping/index.twig' => 'index',
            'Shopping/confirm.twig' => 'confirm',
            'Mypage/history.twig' => 'onRenderMypageHistory',
            '@admin/Order/edit.twig' => 'onRenderAdminOrderEdit',
        ];
    }

    /**
     * @param TemplateEvent $event
     */
    public function index(TemplateEvent $event)
    {
        $parameters = $event->getParameters();
        // 登録がない、レンダリングをしない
        /** @var Order $Order */
        $Order = $parameters['Order'];

        /** @var Customer $customer */
        $Customer = $parameters['Customer'];

        $CustomerCouponList = null;

        $parameters['RefreshPage'] = "N";

        if(is_object($Customer)){
            if(!is_object($Customer->getChainStore())){
                //個人クーポン情報取得
                $CustomerCouponList = $this->customerCouponRepository->findActiveCouponList($Customer);

                $couponCd = null;
                $maxdiscount = 0;

                if(is_array($CustomerCouponList)){
                    foreach($CustomerCouponList as $CustomerCoupon){
                        $Coupon = $CustomerCoupon->getCoupon();
                        $discount = 0;

                        //計算
                        $couponProducts = $this->couponService->existsCouponProduct($Coupon, $Order);

                        if(sizeof($couponProducts) != 0){
                            // 値引き額を取得
                            $discount = $this->couponService->recalcOrder($Coupon, $couponProducts);
                        }

                        $Coupon->setOrderDiscountPrice($discount);

                        if($maxdiscount < $discount && $discount != 0){
                            $maxdiscount = $discount;
                            $couponCd = $Coupon->getCouponCd();
                        }
                    }

                    if($Order->getUseCoupon() == null){
                        if($couponCd != null){
                            $this->applyCoupon($Order, $Customer, $couponCd);

                            $CouponOrder = $this->couponOrderRepository->getCouponOrder($Order->getPreOrderId());
                            $this->addCouponDiscountItem($Order, $CouponOrder);
                            //$Order = $this->orderRepository->findOneBy(["id" => $Order->getId()]);
                            //$parameters['Order'] = $Order;
                            //$url = $this->router->generate('shopping');
                            //$response = new RedirectResponse($url);
                            //$event->setResponse($response);
                            //$parameters['RefreshPage'] = "Y";
                        }
                    }
                }
            }else{
                $this->couponService->removeCouponOrder($Order);
            }
        }

        $parameters['CustomerCouponList'] = $CustomerCouponList;
        $event->setParameters($parameters);
        return $this->confirm($event);
    }

    /**
     * @param TemplateEvent $event
     */
    public function confirm(TemplateEvent $event)
    {
        $parameters = $event->getParameters();
        // 登録がない、レンダリングをしない
        /** @var Order $Order */
        $Order = $parameters['Order'];

        /** @var Customer $customer */
        $Customer = $parameters['Customer'];

        // クーポンが未入力でクーポン情報が存在すればクーポン情報を削除
        $CouponOrder = $this->couponOrderRepository->getCouponOrder($Order->getPreOrderId());

        $parameters['CouponOrder'] = $CouponOrder;
        $event->setParameters($parameters);

        if (strpos($event->getView(), 'index.twig') !== false) {
            $event->addSnippet('@Coupon4/default/coupon_shopping_item.twig');
        } else {
            $event->addSnippet('@Coupon4/default/coupon_shopping_item_confirm.twig');
        }
    }

    /**
     * Hook point add coupon information to mypage history.
     *
     * @param TemplateEvent $event
     */
    public function onRenderMypageHistory(TemplateEvent $event)
    {
        log_info('Coupon trigger onRenderMypageHistory start');
        $parameters = $event->getParameters();
        if (is_null($parameters['Order'])) {
            return;
        }
        $Order = $parameters['Order'];
        // クーポン受注情報を取得する
        $CouponOrder = $this->couponOrderRepository->findOneBy([
            'order_id' => $Order->getId(),
        ]);
        if (is_null($CouponOrder)) {
            return;
        }

        // set parameter for twig files
        $parameters['coupon_cd'] = $CouponOrder->getCouponCd();
        $parameters['coupon_name'] = $CouponOrder->getCouponName();
        $event->setParameters($parameters);
        $event->addSnippet('@Coupon4/default/mypage_history_coupon.twig');
        log_info('Coupon trigger onRenderMypageHistory finish');
    }

    /**
     * [order/{id}/edit]表示の時のEvent Fork.
     * クーポン関連項目を追加する.
     *
     * @param TemplateEvent $event
     */
    public function onRenderAdminOrderEdit(TemplateEvent $event)
    {
        log_info('Coupon trigger onRenderAdminOrderEdit start');
        $parameters = $event->getParameters();
        if (is_null($parameters['Order'])) {
            return;
        }
        $Order = $parameters['Order'];
        // クーポン受注情報を取得する
        $CouponOrder = $this->couponOrderRepository->findOneBy(['order_id' => $Order->getId()]);
        if (is_null($CouponOrder)) {
            return;
        }
        // set parameter for twig files
        $parameters['coupon_cd'] = $CouponOrder->getCouponCd();
        $parameters['coupon_name'] = $CouponOrder->getCouponName();
        $parameters['coupon_change_status'] = $CouponOrder->getOrderChangeStatus();
        $event->setParameters($parameters);

        // add twig
        $event->addSnippet('@Coupon4/admin/order_edit_coupon.twig');

        log_info('Coupon trigger onRenderAdminOrderEdit finish');
    }

    private function applyCoupon(Order $Order, $Customer, $couponCd)
    {
        // サービスの取得
        /** @var CouponService $service */
        $service = $this->couponService;
        
        // クーポンコードを取得する
        $CouponOrder = $this->couponOrderRepository->getCouponOrder($Order->getPreOrderId());
        if ($CouponOrder) {
            return;
        }

        // ---------------------------------
        // クーポンコード入力項目追加
        // ----------------------------------
        // クーポン情報を取得
        $Coupon = $this->couponRepository->findActiveCoupon($couponCd);
        if ($Coupon) {
            $Order->setUseCoupon("Y");

            $couponProducts = $service->existsCouponProduct($Coupon, $Order);
            // 値引き額を取得
            $discount = $service->recalcOrder($Coupon, $couponProducts);
            // クーポン情報を登録
            $service->saveCouponOrder($Order, $Coupon, $couponCd, $Customer, $discount);

            $this->entityManager->flush();
        }
    }

    /**
     * 明細追加処理. --> CouponProcessor.php
     *
     * 値引額の場合の計算方法
     * クーポンで設定した価格で、クーポン値引の明細を生成する(税込価格、税率0%、課税)
     * 税込1080円の商品に、1000円のクーポンを使用すると、980円の支払いになるイメージ
     *
     * 明細ごとに税込の値引額を集計し、クーポン値引の明細を生成する(税込価格、税率0%、課税)
     * 軽減税率適用により税率が混在する場合もあるため、税込価格、税率0%で明細を生成する
     * 税込1080円の商品に、10%OFFのクーポンを使用すると、100円の値引きになり、980円の支払いになるイメージ
     *
     * @see https://github.com/EC-CUBE/coupon-plugin/pull/77
     *
     * @param CouponOrder $CouponOrder
     */
    private function addCouponDiscountItem($Order, CouponOrder $CouponOrder)
    {
        $Coupon = $this->couponRepository->find($CouponOrder->getCouponId());

        $taxDisplayType = TaxDisplayType::INCLUDED; // 税込
        $taxType = TaxType::NON_TAXABLE; // 不課税
        $tax = 0;
        $taxRate = 0;
        $taxRuleId = null;
        $roundingType = null;
        $DiscountType = $this->entityManager->find(OrderItemType::class, OrderItemType::DISCOUNT);
        $TaxInclude = $this->entityManager->find(TaxDisplayType::class, $taxDisplayType);
        $Taxation = $this->entityManager->find(TaxType::class, $taxType);

        $OrderItem = new OrderItem();
        $OrderItem->setProductName($CouponOrder->getCouponName())
            ->setPrice($CouponOrder->getDiscount() * -1)
            ->setQuantity(1)
            ->setTax($tax)
            ->setTaxRate($taxRate)
            ->setTaxRuleId($taxRuleId)
            ->setRoundingType($roundingType)
            ->setOrderItemType($DiscountType)
            ->setTaxDisplayType($TaxInclude)
            ->setTaxType($Taxation)
            ->setOrder($Order)
            ->setProcessorName(CouponProcessor::class);

        $Order->addItem($OrderItem);

        $paymentTotal = $Order->getPaymentTotal() - $CouponOrder->getDiscount();

        $Order->setPaymentTotal($paymentTotal);
    }
}
