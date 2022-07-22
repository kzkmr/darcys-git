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

namespace Customize\Controller\Admin\Order;

use Eccube\Controller\Admin\Order\OrderController as BaseOrderController;
use Eccube\Common\Constant;
use Eccube\Controller\AbstractController;
use Eccube\Entity\ExportCsvRow;
use Eccube\Entity\Master\CsvType;
use Eccube\Entity\Master\OrderStatus;
use Eccube\Entity\OrderPdf;
use Customize\Entity\Shipping;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Form\Type\Admin\OrderPdfType;
use Eccube\Form\Type\Admin\SearchOrderType;
use Eccube\Repository\CustomerRepository;
use Eccube\Entity\DeliveryTime;
use Eccube\Repository\DeliveryTimeRepository;
use Eccube\Repository\Master\OrderStatusRepository;
use Eccube\Repository\Master\PageMaxRepository;
use Eccube\Repository\Master\ProductStatusRepository;
use Eccube\Repository\Master\SexRepository;
use Eccube\Repository\OrderPdfRepository;
use Customize\Repository\OrderRepository;
use Eccube\Repository\OrderItemRepository;
use Eccube\Repository\PaymentRepository;
use Eccube\Repository\ProductStockRepository;
use Customize\Service\CsvExportService;
use Eccube\Service\MailService;
use Eccube\Service\OrderPdfService;
use Eccube\Service\OrderStateMachine;
use Eccube\Service\PurchaseFlow\PurchaseFlow;
use Eccube\Util\FormUtil;
use Knp\Component\Pager\PaginatorInterface;
use Plugin\KokokaraSelect\Repository\KsProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use \DateTime;

class OrderController extends BaseOrderController
{
    /**
     * @var PurchaseFlow
     */
    protected $purchaseFlow;

    /**
     * @var CsvExportService
     */
    protected $csvExportService;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;

    /**
     * @var SexRepository
     */
    protected $sexRepository;

    /**
     * @var OrderStatusRepository
     */
    protected $orderStatusRepository;

    /**
     * @var PageMaxRepository
     */
    protected $pageMaxRepository;

    /**
     * @var ProductStatusRepository
     */
    protected $productStatusRepository;

    /**
     * @var DeliveryTimeRepository
     */
    protected $deliveryTimeRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var OrderItemRepository
     */
    protected $orderItemRepository;
    
    /** @var OrderPdfRepository */
    protected $orderPdfRepository;

    /**
     * @var ProductStockRepository
     */
    protected $productStockRepository;

    /** @var OrderPdfService */
    protected $orderPdfService;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var OrderStateMachine
     */
    protected $orderStateMachine;

    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * @var KsProductRepository
     */
    protected $ksProductRepository;
    
    /**
     * OrderController constructor.
     *
     * @param PurchaseFlow $orderPurchaseFlow
     * @param CsvExportService $csvExportService
     * @param CustomerRepository $customerRepository
     * @param PaymentRepository $paymentRepository
     * @param SexRepository $sexRepository
     * @param OrderStatusRepository $orderStatusRepository
     * @param PageMaxRepository $pageMaxRepository
     * @param ProductStatusRepository $productStatusRepository
     * @param ProductStockRepository $productStockRepository
     * @param OrderRepository $orderRepository
     * @param OrderItemRepository $orderItemRepository
     * @param OrderPdfRepository $orderPdfRepository
     * @param ValidatorInterface $validator
     * @param OrderStateMachine $orderStateMachine ;
     * @param KsProductRepository $ksProductRepository
     */
    public function __construct(
        PurchaseFlow $orderPurchaseFlow,
        CsvExportService $csvExportService,
        CustomerRepository $customerRepository,
        PaymentRepository $paymentRepository,
        SexRepository $sexRepository,
        OrderStatusRepository $orderStatusRepository,
        PageMaxRepository $pageMaxRepository,
        ProductStatusRepository $productStatusRepository,
        ProductStockRepository $productStockRepository,
        DeliveryTimeRepository $deliveryTimeRepository,
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        OrderPdfRepository $orderPdfRepository,
        ValidatorInterface $validator,
        OrderStateMachine $orderStateMachine,
        MailService $mailService,
        KsProductRepository $ksProductRepository
    ) {
        $this->purchaseFlow = $orderPurchaseFlow;
        $this->csvExportService = $csvExportService;
        $this->customerRepository = $customerRepository;
        $this->paymentRepository = $paymentRepository;
        $this->sexRepository = $sexRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->pageMaxRepository = $pageMaxRepository;
        $this->productStatusRepository = $productStatusRepository;
        $this->productStockRepository = $productStockRepository;
        $this->deliveryTimeRepository = $deliveryTimeRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderPdfRepository = $orderPdfRepository;
        $this->validator = $validator;
        $this->orderStateMachine = $orderStateMachine;
        $this->mailService = $mailService;
        $this->ksProductRepository = $ksProductRepository;
    }

    /**
     * 受注一覧画面.
     *
     * - 検索条件, ページ番号, 表示件数はセッションに保持されます.
     * - クエリパラメータでresume=1が指定された場合、検索条件, ページ番号, 表示件数をセッションから復旧します.
     * - 各データの, セッションに保持するアクションは以下の通りです.
     *   - 検索ボタン押下時
     *      - 検索条件をセッションに保存します
     *      - ページ番号は1で初期化し、セッションに保存します。
     *   - 表示件数変更時
     *      - クエリパラメータpage_countをセッションに保存します。
     *      - ただし, mtb_page_maxと一致しない場合, eccube_default_page_countが保存されます.
     *   - ページング時
     *      - URLパラメータpage_noをセッションに保存します.
     *   - 初期表示
     *      - 検索条件は空配列, ページ番号は1で初期化し, セッションに保存します.
     *
     * @Route("/%eccube_admin_route%/order", name="admin_order", methods={"GET", "POST"})
     * @Route("/%eccube_admin_route%/order/page/{page_no}", requirements={"page_no" = "\d+"}, name="admin_order_page", methods={"GET", "POST"})
     * @Template("@admin/Order/index.twig")
     */
    public function index(Request $request, $page_no = null, PaginatorInterface $paginator)
    {
        $builder = $this->formFactory
            ->createBuilder(SearchOrderType::class);

        $event = new EventArgs(
            [
                'builder' => $builder,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::ADMIN_ORDER_INDEX_INITIALIZE, $event);

        $searchForm = $builder->getForm();

        /**
         * ページの表示件数は, 以下の順に優先される.
         * - リクエストパラメータ
         * - セッション
         * - デフォルト値
         * また, セッションに保存する際は mtb_page_maxと照合し, 一致した場合のみ保存する.
         **/
        $page_count = $this->session->get('eccube.admin.order.search.page_count',
            $this->eccubeConfig->get('eccube_default_page_count'));

        $page_count_param = (int) $request->get('page_count');
        $pageMaxis = $this->pageMaxRepository->findAll();

        if ($page_count_param) {
            foreach ($pageMaxis as $pageMax) {
                if ($page_count_param == $pageMax->getName()) {
                    $page_count = $pageMax->getName();
                    $this->session->set('eccube.admin.order.search.page_count', $page_count);
                    break;
                }
            }
        }

        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);

            if ($searchForm->isValid()) {
                /**
                 * 検索が実行された場合は, セッションに検索条件を保存する.
                 * ページ番号は最初のページ番号に初期化する.
                 */
                $page_no = 1;
                $searchData = $searchForm->getData();

                // 検索条件, ページ番号をセッションに保持.
                $this->session->set('eccube.admin.order.search', FormUtil::getViewData($searchForm));
                $this->session->set('eccube.admin.order.search.page_no', $page_no);
            } else {
                // 検索エラーの際は, 詳細検索枠を開いてエラー表示する.
                return [
                    'searchForm' => $searchForm->createView(),
                    'pagination' => [],
                    'pageMaxis' => $pageMaxis,
                    'page_no' => $page_no,
                    'page_count' => $page_count,
                    'has_errors' => true,
                ];
            }
        } else {
            if (null !== $page_no || $request->get('resume')) {
                /*
                 * ページ送りの場合または、他画面から戻ってきた場合は, セッションから検索条件を復旧する.
                 */
                if ($page_no) {
                    // ページ送りで遷移した場合.
                    $this->session->set('eccube.admin.order.search.page_no', (int) $page_no);
                } else {
                    // 他画面から遷移した場合.
                    $page_no = $this->session->get('eccube.admin.order.search.page_no', 1);
                }
                $viewData = $this->session->get('eccube.admin.order.search', []);
                $searchData = FormUtil::submitAndGetData($searchForm, $viewData);
            } else {
                /**
                 * 初期表示の場合.
                 */
                $page_no = 1;
                $viewData = [];

                if ($statusId = (int) $request->get('order_status_id')) {
                    $viewData = ['status' => [$statusId]];
                }

                $searchData = FormUtil::submitAndGetData($searchForm, $viewData);

                // セッション中の検索条件, ページ番号を初期化.
                $this->session->set('eccube.admin.order.search', $viewData);
                $this->session->set('eccube.admin.order.search.page_no', $page_no);
            }
        }

        $qb = $this->orderRepository->getQueryBuilderBySearchDataForAdminNew($searchData, false);

        $event = new EventArgs(
            [
                'qb' => $qb,
                'searchData' => $searchData,
            ],
            $request
        );

        $this->eventDispatcher->dispatch(EccubeEvents::ADMIN_ORDER_INDEX_SEARCH, $event);

        $pagination = $paginator->paginate(
            $qb,
            $page_no,
            $page_count
        );

        return [
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'pageMaxis' => $pageMaxis,
            'page_no' => $page_no,
            'page_count' => $page_count,
            'has_errors' => false,
            'OrderStatuses' => $this->orderStatusRepository->findBy([], ['sort_no' => 'ASC']),
        ];
    }


    /**
     * 受注CSVの出力.
     *
     * @Route("/%eccube_admin_route%/order/export/order", name="admin_order_export_order", methods={"GET"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportOrder(Request $request)
    {
        $filename = 'order_'.(new \DateTime())->format('YmdHis').'.csv';
        $response = $this->exportCsv($request, CsvType::CSV_TYPE_ORDER, $filename);
        log_info('受注CSV出力ファイル名', [$filename]);

        return $response;
    }

    /**
     * 配送CSVの出力.
     *
     * @Route("/%eccube_admin_route%/order/export/shipping", name="admin_order_export_shipping", methods={"GET"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportShipping(Request $request)
    {
        $filename = 'shipping_'.(new \DateTime())->format('YmdHis').'.csv';
        $response = $this->exportCsv($request, CsvType::CSV_TYPE_SHIPPING, $filename);
        log_info('配送CSV出力ファイル名', [$filename]);

        return $response;
    }

    /**
     * Submit Type CSV
     *
     * @Route("/%eccube_admin_route%/order/export/submit", name="admin_order_export_submit", methods={"POST"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportSubmit(Request $request)
    {
        $action = $request->request->get("action");
        $response = null;
        if($action == "cust_shipping1"){
            $response = $this->exportCustShipping1($request);
        }
        if($action == "cust_shipping2"){
            $response = $this->exportCustShipping2($request);
        }

        return $response;
    }

    /**
     * 出荷チェックデータ-1CSV
     *
     * @Route("/%eccube_admin_route%/order/export/cust_shipping1", name="admin_order_export_cust_shipping1", methods={"GET"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportCustShipping1(Request $request)
    {
        $filename = 'cust_shipping1_'.(new \DateTime())->format('YmdHis').'.csv';
        $response = $this->exportCustCsv($request, 8, $filename, true, true);
        log_info('出荷チェックデータ-1CSV出力ファイル名', [$filename]);

        return $response;
    }

    /**
     * 出荷チェックデータ-2CSV
     *
     * @Route("/%eccube_admin_route%/order/export/cust_shipping2", name="admin_order_export_cust_shipping2", methods={"GET"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportCustShipping2(Request $request)
    {
        $filename = 'cust_shipping2_'.(new \DateTime())->format('YmdHis').'.csv';
        $response = $this->exportCustCsv($request, 12, $filename, true, true);
        log_info('出荷チェックデータ-2CSV出力ファイル名', [$filename]);

        return $response;
    }

    /**
     * @param Request $request
     * @param $csvTypeId
     * @param string $fileName
     *
     * @return StreamedResponse
     */
    protected function exportCsv(Request $request, $csvTypeId, $fileName)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $csvTypeId) {
            // CSV種別を元に初期化.
            $this->csvExportService->initCsvType($csvTypeId);

            // ヘッダ行の出力.
            $this->csvExportService->exportHeader();

            // 受注データ検索用のクエリビルダを取得.
            $qb = $this->csvExportService
                ->getOrderQueryBuilder($request);

            // データ行の出力.
            $this->csvExportService->setExportQueryBuilder($qb);

            $this->csvExportService->exportData(function ($entity, $csvService) use ($request) {
                $Csvs = $csvService->getCsvs();

                $Order = $entity;
                $Customer = $Order->getCustomer();
                $OrderItems = $Order->getOrderItems();
                $ChainStore = null;
                if(is_object($Customer)){
                    $ChainStore = $Customer->getChainStore();
                }

                foreach ($OrderItems as $OrderItem) {
                    $ExportCsvRow = new ExportCsvRow();

                    // CSV出力項目と合致するデータを取得.
                    foreach ($Csvs as $Csv) {
                        // 受注データを検索.
                        $ExportCsvRow->setData($csvService->getData($Csv, $Order));

                        if ($ExportCsvRow->isDataNull()) {
                            // 受注データにない場合は, 受注明細を検索.
                            $ExportCsvRow->setData($csvService->getData($Csv, $OrderItem));
                        }
                        if ($ExportCsvRow->isDataNull() && $Shipping = $OrderItem->getShipping()) {
                            // 受注明細データにない場合は, 出荷を検索.
                            $ExportCsvRow->setData($csvService->getData($Csv, $Shipping));
                        }
                        if ($ExportCsvRow->isDataNull()) {
                            if(is_object($Customer)){
                                $ExportCsvRow->setData($csvService->getData($Csv, $Customer));
                            }
                        }
                        if ($ExportCsvRow->isDataNull()) {
                            if(is_object($ChainStore)){
                                $ExportCsvRow->setData($csvService->getData($Csv, $ChainStore));
                            }
                        }

                        $event = new EventArgs(
                            [
                                'csvService' => $csvService,
                                'Csv' => $Csv,
                                'OrderItem' => $OrderItem,
                                'ExportCsvRow' => $ExportCsvRow,
                            ],
                            $request
                        );
                        $this->eventDispatcher->dispatch(EccubeEvents::ADMIN_ORDER_CSV_EXPORT_ORDER, $event);

                        $ExportCsvRow->pushData();
                    }

                    //$row[] = number_format(memory_get_usage(true));
                    // 出力.
                    $csvService->fputcsv($ExportCsvRow->getRow());
                }
            });
        });

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$fileName);
        $response->send();

        return $response;
    }


    /**
     * @param Request $request
     * @param $csvTypeId
     * @param string $fileName
     *
     * @return StreamedResponse
     */
    protected function exportCustCsv(Request $request, $csvTypeId, $fileName, $chkCode, $changeStatus)
    {
        $ids = [];
        if($request->request->get("selids")){
            $tid = $request->request->get("selids");
            if($tid=="all"){
                $ids = ["all"];
            }else{
                $ids = explode(",", $tid);
            }
        }else{
            $ids = ["all"];
        }

        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $csvTypeId, $ids, $chkCode, $changeStatus) {
            // CSV種別を元に初期化.
            $this->csvExportService->initCsvType($csvTypeId);

            // ヘッダ行の出力.
            $this->csvExportService->exportHeader();

            // 受注データ検索用のクエリビルダを取得.
            $qb = $this->csvExportService
                ->getOrderQueryBuilder($request);

            // データ行の出力.
            $this->csvExportService->setExportQueryBuilder($qb);

            /*
            $orderStatus = null;
            if($changeStatus){
                $orderStatus = $this->orderStatusRepository->findOneBy(["id" => 10]);
            }
            */
            //$isChangedId = [];

            $this->csvExportService->exportData(function ($entity, $csvService) use ($request, $ids, $chkCode, $changeStatus) {
                $Csvs = $csvService->getCsvs();

                $Order = $entity;
                $Customer = $Order->getCustomer();
                $OrderItems = $Order->getOrderItems();
                $ChainStore = null;
                $shippingSubpoenaArray = [];

                if(is_object($Customer)){
                    $ChainStore = $Customer->getChainStore();
                }
        
                foreach ($OrderItems as $OrderItem) {
                    foreach ($ids as $id) {
                        $Shipping = $OrderItem->getShipping();
                        if(!is_object($Shipping)){
                            continue;
                        }
                        
                        if($Shipping->getId() == $id || $id == "all"){
                            if(!$OrderItem->getProductCode() && $chkCode){
                                continue;
                            }

                            $keyId = "SID-".$Shipping->getId();
                            //$NewOrderItem = $this->orderItemRepository->findOneBy(["id" => $OrderItem->getId()]);
                            
                            if (array_key_exists($keyId, $shippingSubpoenaArray)) {
                                // 同じID
                                $old_subpoena = $shippingSubpoenaArray[$keyId];
                                $quantity = 1;
                                $size = 1;
                                $skip = false;

                                if($OrderItem->getProductClass()){
                                    //$ksQuantity = $this->ksProductRepository->findOneBy(["Product" => $OrderItem->getProduct()]);
                                    $ksQuantity = $OrderItem->getKsProduct();

                                    if(is_object($ksQuantity)){
                                        if($OrderItem->isKsSelectItem()){
                                            $size = $ksQuantity->getQuantity();
                                            if(!$size){
                                                $size = 1;
                                            }
                                            $quantity = $OrderItem->getQuantity();
                                            //$subpoenaNum = ceil(( $size * $quantity ) / 80);
                                        }else{
                                            $skip = true;
                                        }
                                    }else{
                                        $size = $OrderItem->getProductClass()->getDeliveryplusSize();
                                        if(!$size){
                                            $size = 1;
                                        }
                                        $quantity = $OrderItem->getQuantity();
                                    }
                                }

                                if(!$skip){
                                    $subpoena = [
                                        "qty" => ($quantity * $size) + $old_subpoena["qty"],
                                        "debug" => $old_subpoena["debug"]."||".$quantity."x".$size
                                    ];
                                    $shippingSubpoenaArray[$keyId] = $subpoena;
                                }
                            }else{
                                //伝票数の計算
                                $subpoenaNum = 1;
                                $quantity = 1;
                                $size = 1;
                                $skip = false;

                                if($OrderItem->getProductClass()){
                                    //$ksQuantity = $this->ksProductRepository->findOneBy(["Product" => $OrderItem->getProduct()]);
                                    $ksQuantity = $OrderItem->getKsProduct();

                                    if(is_object($ksQuantity)){
                                        if($OrderItem->isKsSelectItem()){
                                            $size = $ksQuantity->getQuantity();
                                            if(!$size){
                                                $size = 1;
                                            }
                                            $quantity = $OrderItem->getQuantity();
                                            //$subpoenaNum = ceil(( $size * $quantity ) / 80);
                                        }else{
                                            $skip = true;
                                        }
                                    }else{
                                        $size = $OrderItem->getProductClass()->getDeliveryplusSize();
                                        if(!$size){
                                            $size = 1;
                                        }
                                        $quantity = $OrderItem->getQuantity();
                                    }
                                }

                                if(!$skip){
                                    $subpoena = [
                                        "qty" => ($quantity * $size),
                                        "debug" => $quantity."x".$size
                                    ];
                                    $shippingSubpoenaArray[$keyId] = $subpoena;
                                }
                            }
                        }
                    }
                }

                foreach ($OrderItems as $OrderItem) {
                    foreach ($ids as $id) {
                        $Shipping = $OrderItem->getShipping();
                        if(!is_object($Shipping)){
                            continue;
                        }
                        
                        if($Shipping->getId() == $id || $id == "all"){
                            if(!$OrderItem->getProductCode() && $chkCode){
                                continue;
                            }
                            
                            if($changeStatus){
                                if($Order->getOrderStatus()->getId() == "1" || 
                                        $Order->getOrderStatus()->getId() == "6"){
                                    //if(!in_array($Shipping->getId(),$isChangedId)){
                                        $orderStatus = $this->orderStatusRepository->findOneBy(["id" => 10]);
                                        $Order->setOrderStatus($orderStatus);
                                        $this->entityManager->persist($Order);
                                        $this->entityManager->flush();
                                        //$isChangedId[] = $Shipping->getId();
                                    //}
                                }
                            }
                            if(!empty($Shipping->getTimeId())){
                                $timeId = $Shipping->getTimeId();
                                $deliveryTime = $this->deliveryTimeRepository->findOneBy(['id' => $timeId]);
                                if(is_object($deliveryTime)){
                                    $Shipping->setTimeSortId($deliveryTime->getSortNo());
                                }else{
                                    $Shipping->setTimeSortId($timeId);
                                }
                            }
                            if(!empty($Shipping->getShippingDeliveryDate())){
                                $date = $Shipping->getShippingDeliveryDate();
                                $Shipping->setShippingDeliveryStringDate($date->format('Y/m/d'));
                            }
                            //if(!empty($Order->getTotal())){
                            //    $Order->setTotal( intval($Order->getTotal()) );
                            //}
                            if(!empty($Order->getPaymentTotal())){
                                $Order->setPaymentTotal( intval($Order->getPaymentTotal()) );
                            }
                            if(!empty($Order->getDeliveryFeeTotal())){
                                $Order->setDeliveryFeeTotal( intval($Order->getDeliveryFeeTotal()) );
                            }
                            if(!empty($Order->getDiscount())){
                                $Order->setDiscount( intval($Order->getDiscount()) );
                            }
                            if(!empty($OrderItem->getPrice())){
                                $OrderItem->setPrice( intval($OrderItem->getPrice()) );
                            }
                            //お名前(姓)(名)
                            if(!empty($Order->getName01()) || !empty($Order->getName02())){
                                $mergeName = $Order->getName01().$Order->getName02();
                                $Shipping->setMergeName($mergeName);
                            }
                            //お名前(セイ)(メイ)
                            if(!empty($Order->getKana01()) || !empty($Order->getKana02())){
                                $mergeNameKana = $Order->getKana01().$Order->getKana02();
                                $Shipping->setMergeNameKana($mergeNameKana);
                            }
                            //配送先_お名前(姓)(名)
                            if(!empty($Shipping->getName01()) || !empty($Shipping->getName02())){
                                $mergeName = $Shipping->getName01().$Shipping->getName02();
                                $Shipping->setMergeShippingName($mergeName);
                            }
                            //配送先_お名前(セイ)(メイ)
                            if(!empty($Shipping->getKana01()) || !empty($Shipping->getKana02())){
                                $mergeNameKana = $Shipping->getKana01().$Shipping->getKana02();
                                $Shipping->setMergeShippingNameKana($mergeNameKana);
                            }
                            if(is_object($ChainStore)){
                                //お名前（代表者）(姓)(名)
                                if(!empty($ChainStore->getName01()) || !empty($ChainStore->getName02())){
                                    $mergeName = $ChainStore->getName01().$ChainStore->getName02();
                                    $Shipping->setMergeChainStoreName($mergeName);
                                }
                                //お名前（代表者）(カナ)(姓)(名)
                                if(!empty($ChainStore->getKana01()) || !empty($ChainStore->getKana02())){
                                    $mergeNameKana = $ChainStore->getKana01().$ChainStore->getKana02();
                                    $Shipping->setMergeChainStoreKana($mergeNameKana);
                                }
                            }
                            //E-ASPROのギフトモード
                            $Shipping->setEAspro(1);

                            //伝票枚数
                            $keyId = "SID-".$Shipping->getId();

                            if (array_key_exists($keyId, $shippingSubpoenaArray)) {
                                $subpoena = $shippingSubpoenaArray[$keyId];
                                $subpoenaNum = ceil($subpoena["qty"] / 80);
                                $Shipping->setSubpoenaNum($subpoenaNum);
                            }else{
                                $Shipping->setSubpoenaNum(1);
                            }

                            $ExportCsvRow = new ExportCsvRow();

                            // CSV出力項目と合致するデータを取得.
                            foreach ($Csvs as $Csv) {
                                // 受注データを検索.
                                $ExportCsvRow->setData($csvService->getData($Csv, $Order));

                                if ($ExportCsvRow->isDataNull()) {
                                    // 受注データにない場合は, 受注明細を検索.
                                    $ExportCsvRow->setData($csvService->getData($Csv, $OrderItem));
                                }
                                if ($ExportCsvRow->isDataNull() && $Shipping = $OrderItem->getShipping()) {
                                    // 受注明細データにない場合は, 出荷を検索.
                                    $ExportCsvRow->setData($csvService->getData($Csv, $Shipping));
                                }
                                if ($ExportCsvRow->isDataNull()) {
                                    if(is_object($Customer)){
                                        $ExportCsvRow->setData($csvService->getData($Csv, $Customer));
                                    }
                                }
                                if ($ExportCsvRow->isDataNull()) {
                                    if(is_object($ChainStore)){
                                        $ExportCsvRow->setData($csvService->getData($Csv, $ChainStore));
                                    }
                                }

                                $ExportCsvRow->pushData();
                            }

                            //$row[] = number_format(memory_get_usage(true));
                            // 出力.
                            $csvService->fputcsv($ExportCsvRow->getRow());
                        }
                    }
                }
            });
        });

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$fileName);
        $response->send();

        return $response;
    }
}
