<?php
/**
 * Copyright(c) 2020 SYSTEM_KD
 * Date: 2020/05/26
 */

namespace Plugin\KokokaraSelect\EventSubscriber;


use Eccube\Entity\Customer;
use Eccube\Entity\Order;
use Eccube\Entity\OrderItem;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Eccube\Service\CartService;
use Eccube\Service\PurchaseFlow\PurchaseContext;
use Eccube\Service\PurchaseFlow\PurchaseFlow;
use Plugin\KokokaraSelect\Config\ConfigSetting;
use Plugin\KokokaraSelect\Entity\KsSelectItem;
use Plugin\KokokaraSelect\Entity\KsSelectItemGroup;
use Plugin\KokokaraSelect\Service\KsCartHelper;
use Plugin\KokokaraSelect\Service\KsOrderItemService;
use Plugin\KokokaraSelect\Service\KsSelectItemGroupService;
use Plugin\KokokaraSelect\Service\KsSelectItemService;
use Plugin\KokokaraSelect\Service\KsService;
use Plugin\KokokaraSelect\Service\PlgConfigService\ConfigService;
use Plugin\KokokaraSelect\Service\TwigRenderService\EventSubscriber\TwigRenderTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MypageEventSubscriber implements EventSubscriberInterface
{

    use TwigRenderTrait;

    /** @var KsSelectItemService */
    protected $ksSelectItemService;

    /** @var KsSelectItemGroupService */
    protected $ksSelectItemGroupService;

    /** @var CartService */
    protected $cartService;

    /** @var KsCartHelper */
    protected $ksCartHelper;

    /** @var PurchaseFlow */
    protected $purchaseFlow;

    /** @var Session */
    protected $session;

    /** @var KsService */
    protected $ksService;

    /** @var KsOrderItemService */
    protected $ksOrderItemService;

    /** @var ConfigService */
    protected $configService;

    public function __construct(
        KsSelectItemService $ksSelectItemService,
        KsSelectItemGroupService $ksSelectItemGroupService,
        CartService $cartService,
        KsCartHelper $ksCartHelper,
        PurchaseFlow $cartPurchaseFlow,
        SessionInterface $session,
        KsService $ksService,
        KsOrderItemService $ksOrderItemService,
        ConfigService $configService
    )
    {
        $this->ksSelectItemService = $ksSelectItemService;
        $this->ksSelectItemGroupService = $ksSelectItemGroupService;
        $this->cartService = $cartService;
        $this->ksCartHelper = $ksCartHelper;
        $this->purchaseFlow = $cartPurchaseFlow;
        $this->session = $session;
        $this->ksService = $ksService;
        $this->ksOrderItemService = $ksOrderItemService;
        $this->configService = $configService;
    }

    /**
     * ????????????????????????????????????
     *
     * @param TemplateEvent $event
     */
    public function onTemplateMypageHistory(TemplateEvent $event)
    {

        if ($this->configService->isKeyBool(ConfigSetting::SETTING_KEY_SELECT_ITEM_VIEW_HISTORY)) {

            $this->initRenderService($event);

            $eachChild = $this->twigRenderService
                ->eachChildBuilder()
                ->findThis()
                ->find('.ec-imageGrid__content')
                ->targetFindAndIndexKey('#kokokara_select_item_', "kokokaraSelectIndex")
                ->setInsertModeAppend();

            $this->twigRenderService
                ->eachBuilder()
                ->find('.ec-orderDelivery__item')
                ->setEachIndexKey('kokokaraSelectIndex')
                ->each($eachChild);

            $this->addTwigRenderSnippet('@KokokaraSelect/default/Mypage/history_ex.twig');
        }
    }

    /**
     * ??????????????????????????????
     *
     * @param EventArgs $event
     */
    public function onFrontMypageMypageOrderComplete(EventArgs $event)
    {
        /** @var Order $order */
        $order = $event->getArgument('Order');

        /** @var Customer $customer */
        $customer = $event->getArgument('Customer');

        $selectItemData = [];
        $parentQuantityList = [];

        $groupIndexMax = 0;
        $groupIndexSeq = [];

        /** @var OrderItem $orderItem */
        foreach ($order->getOrderItems() as $orderItem) {

            if (!$orderItem->isProduct()
                && !$this->ksOrderItemService->isKsOrderItem($orderItem)) continue;

            if ($this->ksService->isKsProduct($orderItem)) {
                // ??????????????????
                $parentQuantityList[$orderItem->getProductClass()->getId()] = $orderItem->getQuantity();
            }

            $ksOrderItemEx = $orderItem->getKsOrderItemEx();

            // ????????????????????????????????????
            if ($ksOrderItemEx) {

                // ???????????????????????????Group, Item??????????????????????????????
                $ksSelectItemGroupId = $ksOrderItemEx->getKsSelectItemGroupId();
                $ksSelectItemId = $ksOrderItemEx->getKsSelectItemId();

                $shippingId = $ksOrderItemEx->getOrderItem()->getShipping()->getId();
                $gid = $ksOrderItemEx->getGroupId();

                if (isset($groupIndexSeq[$shippingId . '-' . $gid])) {
                    $groupIndex = $groupIndexSeq[$shippingId . '-' . $gid];
                } else {
                    $groupIndex = $groupIndexMax;
                    $groupIndexSeq[$shippingId . '-' . $gid] = $groupIndexMax;
                    $groupIndexMax += 1;
                }

                // ??????ProductClass ??????
                $parentProductClass = $ksOrderItemEx->getParentOrderItem()->getProductClass();

                /** @var KsSelectItemGroup $ksSelectItemGroup */
                $ksSelectItemGroup = $ksOrderItemEx->getKsSelectItemGroup();

                if (!$ksSelectItemGroup) {
                    // ?????????????????????????????????????????????
                    log_info('[KokokaraSelect]??????????????????????????????????????????????????????', [
                        'ks_select_item_group_id' => $ksSelectItemGroupId,
                        'ks_select_item_id' => $ksSelectItemId,
                    ]);
                    continue;
                }

                /** @var KsSelectItem $ksSelectItem */
                $ksSelectItem = $ksOrderItemEx->getKsSelectItem();

                if (!$ksSelectItem) {
                    // ????????????????????????
                    // ???ProductClass?????????????????????
                    $targetProductClass = $ksOrderItemEx->getOrderItem()->getKsTmpProductClass();

                    // ????????????????????????????????????
                    log_info('[KokokaraSelect]?????????????????????????????????', [
                        'ks_select_item_group_id' => $ksSelectItemGroupId,
                        'ks_select_item_id' => $ksOrderItemEx->getKsSelectItemId(),
                        'product_class_id' => $targetProductClass->getId(),
                    ]);
                    continue;
                }

                $selectItemData[$parentProductClass->getId()][$groupIndex][] = [
                    'KsSelectItem' => $ksSelectItem,
                    'KsSelectItemGroup' => $ksSelectItemGroup,
                    'quantity' => $orderItem->getQuantity(),
                ];
            }
        }

        // ?????????????????????????????????????????????
        $this->ksCartHelper->setKsCartSelectItemGroupByOrder($this->cartService->getCarts(), $selectItemData);

        // ????????????????????????
        $optimizeList = $this->ksCartHelper->optimizeData($this->cartService->getCarts(), $parentQuantityList);

        foreach ($optimizeList as $productClassId => $quantity) {

            if ($quantity == 0) {
                // ??????
                $this->cartService->removeProduct($productClassId);
                $this->session->getFlashBag()->add('eccube.front.request.error', 'kokokara_select.cart.item.validate.item');
            } else {
                // ??????????????????
                $this->cartService->addProduct($productClassId, -1 * $quantity);
            }

            // ???????????????????????????????????????????????????
            foreach ($this->cartService->getCarts() as $Cart) {
                $this->purchaseFlow->validate($Cart, new PurchaseContext($Cart, $customer));
            }
            $this->cartService->save();
        }

        $this->cartService->save();
    }

    public static function getSubscribedEvents()
    {
        return [
            'Mypage/history.twig' => ['onTemplateMypageHistory'],
            EccubeEvents::FRONT_MYPAGE_MYPAGE_ORDER_COMPLETE => ['onFrontMypageMypageOrderComplete'],
        ];
    }
}
