<?php
/**
 * Copyright(c) 2020 SYSTEM_KD
 * Date: 2020/09/06
 */

namespace Plugin\KokokaraSelect\Doctrine\EventListener;


use Eccube\Entity\Master\ProductStatus;
use Eccube\Request\Context;
use Plugin\KokokaraSelect\Entity\KsSelectItem;
use Plugin\KokokaraSelect\Entity\KsSelectItemGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class KsSelectItemGroupEventListener
{

    /** @var Context */
    protected $context;

    /** @var ContainerInterface */
    protected $container;

    /** @var SessionInterface */
    protected $session;

    public function __construct(
        Context            $context,
        ContainerInterface $container,
        SessionInterface   $session
    )
    {
        $this->context = $context;
        $this->container = $container;
        $this->session = $session;
    }

    /**
     * 固定選択商品のグループ数量を取得する際、公開商品のみを対象とするよう調整
     *
     * @param KsSelectItemGroup $ksSelectItemGroup
     */
    public function postLoad(KsSelectItemGroup $ksSelectItemGroup)
    {

        $ksProduct = $ksSelectItemGroup->getKsProduct();

        /** @var Request $request */
        $request = $this->container->get('request_stack')->getMasterRequest();
        $route = $request->attributes->get('_route');

        // 商品一覧は除外する
        if($route == 'product_list') {
            return;
        }

        if ($this->context->isAdmin()
            && $ksProduct && $ksProduct->isDirectSelect()) {

            // 再集計
            $groupQuantity = 0;

            // 選択数量を再計算
            /** @var KsSelectItem $ksSelectItem */
            foreach ($ksSelectItemGroup->getKsSelectItems() as $ksSelectItem) {

                if ($route === 'admin_product_kokokara_select_setting'
                    || $route === 'admin_product_product_edit') {
                    // 商品一覧と選択商品設定のみ非公開を考慮しない
                    $groupQuantity += $ksSelectItem->getQuantity();
                } else {
                    $targetProduct = $ksSelectItem->getProductClass()->getProduct();
                    if ($targetProduct->getStatus()->getId() == ProductStatus::DISPLAY_SHOW) {
                        $groupQuantity += $ksSelectItem->getQuantity();
                    }
                }

            }

            $ksSelectItemGroup->setQuantity($groupQuantity);

            return;
        }

        if (!$this->session->has('_security_admin')
            && $ksProduct && $ksProduct->isDirectSelect()) {

            $groupQuantity = 0;

            // 選択数量を再計算
            /** @var KsSelectItem $ksSelectItem */
            foreach ($ksSelectItemGroup->getKsSelectItems() as $ksSelectItem) {
                $targetProduct = $ksSelectItem->getProductClass()->getProduct();

                if(!$targetProduct) {
                    // エラー制御
                    continue;
                }

                if ($targetProduct->getStatus()->getId() == ProductStatus::DISPLAY_SHOW) {
                    $groupQuantity += $ksSelectItem->getQuantity();
                }
            }

            $ksSelectItemGroup->setQuantity($groupQuantity);
        }
    }

}
