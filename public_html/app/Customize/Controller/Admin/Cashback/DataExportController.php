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

namespace Customize\Controller\Admin\Cashback;

use Eccube\Common\Constant;
use Eccube\Controller\AbstractController;
use Eccube\Entity\BaseInfo;
use Eccube\Entity\ExportCsvRow;
use Eccube\Entity\Master\CsvType;
use Eccube\Entity\Master\OrderStatus;
use Eccube\Entity\OrderPdf;
use Eccube\Entity\Shipping;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Customize\Entity\BankTransferInfo;
use Customize\Service\CashbackService;
use Customize\Repository\CashbackSummaryRepository;
use Customize\Repository\DealerSummaryRepository;
use Customize\Repository\BankTransferInfoRepository;
use Customize\Repository\Master\BankBranchRepository;
use Customize\Form\Type\Admin\SearchDataExportChainStoreType;
use Customize\Form\Type\Admin\SearchDataExportDealerType;
use Eccube\Form\Type\Admin\OrderPdfType;
use Eccube\Form\Type\Admin\SearchOrderType;
use Eccube\Repository\CustomerRepository;
use Eccube\Repository\ShippingRepository;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\MailTemplateRepository;
use Eccube\Repository\Master\OrderStatusRepository;
use Eccube\Repository\Master\PageMaxRepository;
use Eccube\Repository\Master\ProductStatusRepository;
use Eccube\Repository\Master\SexRepository;
use Eccube\Repository\OrderPdfRepository;
use Eccube\Repository\OrderRepository;
use Eccube\Repository\PaymentRepository;
use Eccube\Repository\ProductStockRepository;
use Eccube\Service\CsvExportService;
use Eccube\Service\MailService;
use Eccube\Service\OrderPdfService;
use Eccube\Service\OrderStateMachine;
use Eccube\Service\PurchaseFlow\PurchaseFlow;
use Eccube\Util\FormUtil;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DataExportController extends AbstractController
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
     * @var ShippingRepository
     */
    protected $shippingRepository;

    /**
     * @var PageMaxRepository
     */
    protected $pageMaxRepository;

    /**
     * @var ProductStatusRepository
     */
    protected $productStatusRepository;

    /**
     * @var BankBranchRepository
     */
    protected $bankBranchRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

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
     * @var MailTemplateRepository
     */
    protected $mailTemplateRepository;
    
    /**
     * @var BaseInfo
     */
    protected $BaseInfo;

    /**
     * @var CashbackSummaryRepository
     */
    protected $cashbackSummaryRepository;

    /**
     * @var DealerSummaryRepository
     */
    protected $dealerSummaryRepository;

    /**
     * @var CashbackService
     */
    protected $cashbackService;

    /**
     * @var BankTransferInfoRepository
     */
    protected $bankTransferInfoRepository;

    /**
     * OrderController constructor.
     *
     * @param PurchaseFlow $orderPurchaseFlow
     * @param CsvExportService $csvExportService
     * @param CustomerRepository $customerRepository
     * @param PaymentRepository $paymentRepository
     * @param SexRepository $sexRepository
     * @param OrderStatusRepository $orderStatusRepository
     * @param ShippingRepository $shippingRepository
     * @param PageMaxRepository $pageMaxRepository
     * @param ProductStatusRepository $productStatusRepository
     * @param ProductStockRepository $productStockRepository
     * @param OrderRepository $orderRepository
     * @param OrderPdfRepository $orderPdfRepository
     * @param ValidatorInterface $validator
     * @param OrderStateMachine $orderStateMachine
     * @param MailService $mailService
     * @param BaseInfoRepository $baseInfoRepository
     * @param MailTemplateRepository $mailTemplateRepository
     * @param BankBranchRepository $bankBranchRepository
     * @param CashbackSummaryRepository $cashbackSummaryRepository
     * @param DealerSummaryRepository $dealerSummaryRepository
     * @param CashbackService $cashbackService
     * @param BankTransferInfoRepository $bankTransferInfoRepository
     */
    public function __construct(
        PurchaseFlow $orderPurchaseFlow,
        CsvExportService $csvExportService,
        CustomerRepository $customerRepository,
        PaymentRepository $paymentRepository,
        SexRepository $sexRepository,
        OrderStatusRepository $orderStatusRepository,
        ShippingRepository $shippingRepository,
        PageMaxRepository $pageMaxRepository,
        ProductStatusRepository $productStatusRepository,
        ProductStockRepository $productStockRepository,
        OrderRepository $orderRepository,
        OrderPdfRepository $orderPdfRepository,
        ValidatorInterface $validator,
        OrderStateMachine $orderStateMachine,
        MailService $mailService,
        BaseInfoRepository $baseInfoRepository,
        MailTemplateRepository $mailTemplateRepository,
        BankBranchRepository $bankBranchRepository,
        CashbackSummaryRepository $cashbackSummaryRepository,
        DealerSummaryRepository $dealerSummaryRepository,
        CashbackService $cashbackService,
        BankTransferInfoRepository $bankTransferInfoRepository
    ) {
        $this->purchaseFlow = $orderPurchaseFlow;
        $this->csvExportService = $csvExportService;
        $this->customerRepository = $customerRepository;
        $this->paymentRepository = $paymentRepository;
        $this->sexRepository = $sexRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->shippingRepository = $shippingRepository;
        $this->pageMaxRepository = $pageMaxRepository;
        $this->productStatusRepository = $productStatusRepository;
        $this->productStockRepository = $productStockRepository;
        $this->orderRepository = $orderRepository;
        $this->orderPdfRepository = $orderPdfRepository;
        $this->validator = $validator;
        $this->orderStateMachine = $orderStateMachine;
        $this->mailService = $mailService;
        $this->BaseInfo = $baseInfoRepository->get();
        $this->mailTemplateRepository = $mailTemplateRepository;
        $this->bankBranchRepository = $bankBranchRepository;
        $this->cashbackSummaryRepository = $cashbackSummaryRepository;
        $this->dealerSummaryRepository = $dealerSummaryRepository;
        $this->cashbackService = $cashbackService;
        $this->bankTransferInfoRepository = $bankTransferInfoRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/dataexport/chainstore", name="admin_dataexport_chainstore")
     * @Route("/%eccube_admin_route%/dataexport/chainstore/page/{page_no}", requirements={"page_no" = "\d+"}, name="admin_dataexport_chainstore_page")
     * @Template("@admin/Cashback/dataexport_chainstore.twig")
     */
    public function index_chainstore(Request $request, $page_no = null, PaginatorInterface $paginator)
    {
        $session = $this->session;
        $builder = $this->formFactory->createBuilder(SearchDataExportChainStoreType::class);

        $searchForm = $builder->getForm();

        $pageMaxis = $this->pageMaxRepository->findAll();
        $pageCount = $session->get('eccube.admin.customer.search.page_count', $this->eccubeConfig['eccube_default_page_count']);
        $pageCountParam = $request->get('page_count');
        if ($pageCountParam && is_numeric($pageCountParam)) {
            foreach ($pageMaxis as $pageMax) {
                if ($pageCountParam == $pageMax->getName()) {
                    $pageCount = $pageMax->getName();
                    $session->set('eccube.admin.customer.search.page_count', $pageCount);
                    break;
                }
            }
        }

        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);
            if ($searchForm->isValid()) {
                if(isset($_POST['search'])){
                    $searchData = $searchForm->getData();
                    $page_no = 1;
    
                    $session->set('eccube.admin.customer.search', FormUtil::getViewData($searchForm));
                    $session->set('eccube.admin.customer.search.page_no', $page_no);
                }else if(isset($_POST['output'])){
                    //CSV Output
                    $searchData = $searchForm->getData();
                    return $this->exportChainStoreOutputCSV($request, $searchData);
                }else if(isset($_POST['margin_csv'])){
                    //Margin CSV Output
                    $searchData = $searchForm->getData();
                    return $this->exportChainStoreMarginCSV($request, $searchData);
                }else if(isset($_POST['save_transfer_date'])){
                    $searchData = $searchForm->getData();
                    $transferDate = $this->bankTransferInfoRepository->findOneBy(["referenceYm" => $searchData["data_ym"]]);
                    
                    if(is_object($transferDate)){
                        //Update
                        $transferDate->setTransferDate($searchData["transfer_ym"]);
                        $this->bankTransferInfoRepository->save($transferDate);
                        $this->entityManager->flush();
                    }else{
                        //Insert
                        $bankTransferInfo = new BankTransferInfo();
                        $bankTransferInfo->setReferenceYm($searchData["data_ym"]);
                        $bankTransferInfo->setTransferDate($searchData["transfer_ym"]);
                        $this->entityManager->persist($bankTransferInfo);
                        $this->entityManager->flush();
                    }

                    $page_no = 1;
                    $session->set('eccube.admin.customer.search', FormUtil::getViewData($searchForm));
                    $session->set('eccube.admin.customer.search.page_no', $page_no);
                }
            } else {
                return [
                    'searchForm' => $searchForm->createView(),
                    'pagination' => [],
                    'pageMaxis' => $pageMaxis,
                    'page_no' => $page_no,
                    'page_count' => $pageCount,
                    'has_errors' => true,
                ];
            }
        } else {
            if (null !== $page_no || $request->get('resume')) {
                if ($page_no) {
                    $session->set('eccube.admin.customer.search.page_no', (int) $page_no);
                } else {
                    $page_no = $session->get('eccube.admin.customer.search.page_no', 1);
                }
                $viewData = $session->get('eccube.admin.customer.search', []);
            } else {
                $page_no = 1;
                $viewData = FormUtil::getViewData($searchForm);
                $session->set('eccube.admin.customer.search', $viewData);
                $session->set('eccube.admin.customer.search.page_no', $page_no);
            }
            $searchData = FormUtil::submitAndGetData($searchForm, $viewData);
        }

        $result = $this->cashbackSummaryRepository->getQueryBuilderBySearchData($searchData);


        $defaultTransferDate = strtotime("+1 months", strtotime(date("Y/m/15")));
        $transferDate = $this->bankTransferInfoRepository->findOneBy(["referenceYm" => $searchData["data_ym"]]);
        
        if(is_object($transferDate)){
            if($transferDate->getTransferDate() != null && $transferDate->getTransferDate() != ""){
                $defaultTransferDate = strtotime($transferDate->getTransferDate());
            }else{
                $defaultTransferDate = "";
            }
        }

        $payYM = "";
        if($defaultTransferDate != ""){
            $payYM = date('Y/m/d', $defaultTransferDate);
        }

        $pagination = $paginator->paginate(
            $result,
            $page_no,
            $pageCount
        );

        return [
            'searchForm' => $searchForm->createView(),
            'searchData' => $searchData,
            'pagination' => $pagination,
            'pageMaxis' => $pageMaxis,
            'page_no' => $page_no,
            'page_count' => $pageCount,
            'has_errors' => false,
            'paymentYM' => $payYM,
        ];
    }


    /**
     * @Route("/%eccube_admin_route%/dataexport/dealer", name="admin_dataexport_dealer")
     * @Route("/%eccube_admin_route%/dataexport/dealer/page/{page_no}", requirements={"page_no" = "\d+"}, name="admin_dataexport_dealer_page")
     * @Template("@admin/Cashback/dataexport_dealer.twig")
     */
    public function index_dealer(Request $request, $page_no = null, PaginatorInterface $paginator)
    {
        $session = $this->session;
        $builder = $this->formFactory->createBuilder(SearchDataExportDealerType::class);

        $searchForm = $builder->getForm();

        $pageMaxis = $this->pageMaxRepository->findAll();
        $pageCount = $session->get('eccube.admin.customer.search.page_count', $this->eccubeConfig['eccube_default_page_count']);
        $pageCountParam = $request->get('page_count');
        if ($pageCountParam && is_numeric($pageCountParam)) {
            foreach ($pageMaxis as $pageMax) {
                if ($pageCountParam == $pageMax->getName()) {
                    $pageCount = $pageMax->getName();
                    $session->set('eccube.admin.customer.search.page_count', $pageCount);
                    break;
                }
            }
        }

        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);
            if ($searchForm->isValid()) {
                if(isset($_POST['search'])){
                    $searchData = $searchForm->getData();
                    $page_no = 1;
    
                    $session->set('eccube.admin.customer.search', FormUtil::getViewData($searchForm));
                    $session->set('eccube.admin.customer.search.page_no', $page_no);
                }else if(isset($_POST['output'])){
                    //Output csv
                    $searchData = $searchForm->getData();
                    return $this->exportDealerOutputCSV($request, $searchData);
                }else if(isset($_POST['margin_csv'])){
                    //dealer margin csv
                    $searchData = $searchForm->getData();
                    return $this->exportDealerMarginCSV($request, $searchData);
                }
            } else {
                return [
                    'searchForm' => $searchForm->createView(),
                    'pagination' => [],
                    'pageMaxis' => $pageMaxis,
                    'page_no' => $page_no,
                    'page_count' => $pageCount,
                    'has_errors' => true,
                ];
            }
        } else {
            if (null !== $page_no || $request->get('resume')) {
                if ($page_no) {
                    $session->set('eccube.admin.customer.search.page_no', (int) $page_no);
                } else {
                    $page_no = $session->get('eccube.admin.customer.search.page_no', 1);
                }
                $viewData = $session->get('eccube.admin.customer.search', []);
            } else {
                $page_no = 1;
                $viewData = FormUtil::getViewData($searchForm);
                $session->set('eccube.admin.customer.search', $viewData);
                $session->set('eccube.admin.customer.search.page_no', $page_no);
            }
            $searchData = FormUtil::submitAndGetData($searchForm, $viewData);
        }

        $result = $this->dealerSummaryRepository->getQueryBuilderBySearchData($searchData);

        $pagination = $paginator->paginate(
            $result,
            $page_no,
            $pageCount
        );

        return [
            'searchForm' => $searchForm->createView(),
            'searchData' => $searchData,
            'pagination' => $pagination,
            'pageMaxis' => $pageMaxis,
            'page_no' => $page_no,
            'page_count' => $pageCount,
            'has_errors' => false,
        ];
    }

    /**
     * ChainStore Output CSVの出力.
     *
     * @Route("/%eccube_admin_route%/dataexport/chainstore/csv", name="admin_dataexport_chainstore_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportChainStoreOutputCSV(Request $request, $searchData)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $result = null;
        $selYM = "";

        if ('POST' === $request->getMethod()) {
            if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
                $selYM = $searchData['data_ym'];
            }
            // データ検索用のクエリビルダを取得.
            $result = $this->cashbackSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('データを選択してください');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM) {

            // データ行の出力.
            //1.ヘッダレコード
            $header = [];
            $header[] = "対象月";                //対象月
            $header[] = "契約区分";              //契約区分
            $header[] = "販売店名";              //販売店名
            $header[] = "証券番号";              //証券番号
            $header[] = "マージン";              //マージン
            $header[] = "前月繰り越しマージン";  //前月繰り越しマージン
            $header[] = "仕入れ金額";            //仕入れ金額
            $header[] = "請求金額";              //請求金額
            $header[] = "マージン残高";          //マージン残高
            $header[] = "繰り越しマージン";      //繰り越しマージン

            $this->csvExportService->fopen();
            $this->csvExportService->fputcsv($header);

            // 2.データレコード
            foreach($result as $row){
                $ChainStore = null;
                $ContractTypeName = "";
                $ChainStoreName = "未登録";
                $StockNumber = "";

                if($row->getChainStore()){
                    $ChainStore = $row->getChainStore();
                    $ChainStoreName = $ChainStore->getCompanyName();
                    $StockNumber = $ChainStore->getStockNumber();

                    if($ChainStore->getContractType()){
                        $ContractType = $ChainStore->getContractType();
                        $ContractTypeName = $ContractType->getName();
                    }
                }
                $data = [];
                $data[] = $row->getReferenceYm();                 //対象月
                $data[] = $ContractTypeName;                      //契約区分
                $data[] = $ChainStoreName;                        //販売店名
                $data[] = $StockNumber;                           //証券番号
                $data[] = $row->getMarginPrice();                 //マージン
                $data[] = $row->getPreviousMarginPrice();         //前月繰り越しマージン
                $data[] = $row->getPurchaseAmount();              //仕入れ金額
                $data[] = $row->getRequestAmount();               //請求金額
                $data[] = $row->getMarginBalance();               //マージン残高
                $data[] = $row->getCarriedForward();              //繰り越しマージン

                $this->csvExportService->fputcsv($data);
            }

            $this->csvExportService->fclose();
        });

        $now = new \DateTime();
        $filename = 'chainstore_csv_'.$now->format('YmdHis').'.csv';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
        $response->headers->set('location', $filename);
        $response->send();

        log_info('Cashback ファイル名', [$filename]);

        return $response;
    }


    /**
     * ChainStore Margin CSVの出力.
     *
     * @Route("/%eccube_admin_route%/dataexport/chainstore/margin_csv", name="admin_dataexport_chainstore_margin_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportChainStoreMarginCSV(Request $request, $searchData)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $result = null;
        $selYM = "";
        $payYM = "";

        if ('POST' === $request->getMethod()) {
            if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
                $selYM = $searchData['data_ym'];
            }

            $defaultTransferDate = strtotime("+1 months", strtotime(date("Y/m/15")));
            $transferDate = $this->bankTransferInfoRepository->findOneBy(["referenceYm" => $searchData["data_ym"]]);
            
            if(is_object($transferDate)){
                $defaultTransferDate = strtotime($transferDate->getTransferDate());
            }
    
            $payYM = date('md', $defaultTransferDate);

            // データ検索用のクエリビルダを取得.
            $result = $this->cashbackSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('データを選択してください');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM, $payYM) {
            //$payYM = date('md', strtotime("+1 months", strtotime(date("Y/m/d"))));

            // データ行の出力.
            //1.ヘッダレコード(120バイト・全て半角文字、以下各レコード共通)
            $header = "1";                  //データ区分-1：ヘッダレコード
            $header .= "21";                //種別コード-21：総合  11または71：給与    12または72：賞与
            $header .= "0";                 //コード区分-文字コード種類 0：JIS
            $header .= "3658564000";        //委託者コード
            $header .= $this->mb_str_pad($this->convert_to_l("ﾀﾞｼ-ｽﾞﾌｱｸﾄﾘ-"),40," ",STR_PAD_RIGHT);          //振込元の委託者名
            $header .= str_pad($payYM,4," ",STR_PAD_RIGHT);                     //振込指定日
            $header .= "0000";              //当組合金融機関番号
            $header .= $this->mb_str_pad($this->convert_to_l("テスト"),15," ",STR_PAD_RIGHT);          //当組合名称
            $header .= "000";               //当組合支店コード番号
            $header .= $this->mb_str_pad($this->convert_to_l("テスト"),15," ",STR_PAD_RIGHT);          //当組合支店名称
            $header .= "1";                 //預金種目(依頼人)-振込依頼人の科目 1：普通、2：当座、4：貯蓄
            $header .= str_pad("1234567",7,"0",STR_PAD_LEFT);                   //口座番号(依頼人) 振込依頼人の口座番号
            $header .= str_pad("",17," ",STR_PAD_RIGHT);                        //ダミー 未使用
            print_r($header."\r\n");

            // 2.データレコード
            $totalAmount = 0;
            foreach($result as $row){
                $ChainStore = null;
                $Customer = null;
                $ContractTypeName = "";
                $ChainStoreName = "未登録";
                $StockNumber = "";
                $Bank = null;
                $BankCode = "";
                $BankNameKa = "";
                $BankCode = "";
                $BranchId = "";
                $BranchCode = "";
                $BranchNameKa = "";
                $BankAccountType = null;
                $BankAccount = "";
                $BankHolder = "";

                if($row->getChainStore()){
                    $ChainStore = $row->getChainStore();
                    $ChainStoreName = $ChainStore->getCompanyName();
                    $StockNumber = $ChainStore->getStockNumber();
                    $Bank = $ChainStore->getBank();
                    $BranchId = $ChainStore->getBankBranch();
                    $BankAccountType = $ChainStore->getBankAccountType();
                    $BankAccount = $ChainStore->getBankAccount();
                    $BankHolder = $ChainStore->getBankHolder();

                    $Customer = $this->customerRepository->findOneBy(['ChainStore' => $ChainStore]);
                    if(!is_object($Customer)){
                        continue;
                    }

                    $Bank = $this->bankBranchRepository->findOneBy(['id' => $BranchId]);
                    if(is_object($Bank)){
                        $BankCode = $Bank->getBankCode();
                        $BranchCode = $Bank->getBranchCode();
                        $BankNameKa = $this->convert_to_l($Bank->getBankNameKa());
                        $BranchNameKa = $this->convert_to_l($Bank->getBranchNameKa());
                    }else{
                        //Skip
                        continue;
                    }

                    if($ChainStore->getContractType()){
                        $ContractType = $ChainStore->getContractType();
                        $ContractTypeName = $ContractType->getName();
                    }

                    if($row->getMarginBalance() < 2000){
                        //Skip
                        continue;
                    }
                }else{
                    //Skip
                    continue;
                }

                $row->setExportCnt( ($row->getExportCnt() + 1) );
                $this->cashbackSummaryRepository->save($row);
                $this->entityManager->flush();

                /*
                $summaryList = $this->cashbackSummaryRepository->findOneBy(['id' => $row->getId()]);
                if($summaryList != null){
                    foreach($summaryList as $summary){
                        $summary->setExportCnt( ($summary->getExportCnt() + 1) );
                        $this->cashbackSummaryRepository->save($summary);
                        $this->entityManager->flush();
                    }
                }
                */

                $data = "2";                  //データ区分-レコード種別 - 2：データレコード
                $data .= $BankCode;           //金融機関 - 振込先金融機関コード 
                $data .= $this->mb_str_pad($BankNameKa ,15," ",STR_PAD_RIGHT);      //振込先金融機関名称
                $data .= $BranchCode;         //被仕向支店番号 - 振込先営業店コード
                $data .= $this->mb_str_pad($BranchNameKa,15," ",STR_PAD_RIGHT);     //被仕向支店名 - 振込先営業店名称
                $data .= $this->mb_str_pad("",4," ",STR_PAD_LEFT);                  //手形交換所番号
                $data .= $BankAccountType->getId();                                 //預金種目 1：普通、2：当座、4：貯蓄
                $data .= $this->mb_str_pad($BankAccount,7,"0",STR_PAD_LEFT);;       //振込先の口座番号
                $data .= $this->mb_str_pad($this->convert_to_l($BankHolder),30," ",STR_PAD_RIGHT);       //受取人名(カナ)
                $data .= $this->mb_str_pad(intval($row->getMarginBalance()),10,"0",STR_PAD_LEFT);           //マージン残高 - ご依頼金額
                $data .= " ";      //新規コード
                $data .= $this->mb_str_pad($Customer->getId() ,10," ",STR_PAD_RIGHT);               //顧客 コード1(カナ)
                $data .= $this->mb_str_pad("",10," ",STR_PAD_RIGHT);                //顧客 コード2(カナ)
                $data .= " ";      //振込区分 - 未使用
                $data .= " ";      //識別表示
                $data .= $this->mb_str_pad("",7," ",STR_PAD_RIGHT);                          //ダミー 未使用

                $totalAmount = $totalAmount + $row->getMarginBalance();

                print_r($data."\r\n");
            }

            //トレーラーレコード Trailer record
            $trailer = "8";                  //データ区分-レコード種別 - 8：トレーラレコード
            $trailer .= $this->mb_str_pad(count($result),6,"0",STR_PAD_LEFT);                 //合計件数 - データレコード件数の合計
            $trailer .= $this->mb_str_pad(intval($totalAmount),12,"0",STR_PAD_LEFT);          //合計金額 - データレコードの振込金額の合計
            $trailer .= $this->mb_str_pad("",101," ",STR_PAD_RIGHT);                          //ダミー 未使用
            print_r($trailer."\r\n");

            //4.エンドレコード
            $footer = "9";                  //データ区分-レコード種別 - 9：エンドレコード
            $footer .= $this->mb_str_pad("",119," ",STR_PAD_RIGHT);                  //ダミー 未使用
            print_r($footer);
        });

        $now = new \DateTime();
        $filename = 'chainstore_margin_csv_'.$now->format('YmdHis').'.txt';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
        $response->headers->set('location', $filename);
        $response->send();

        log_info('ChainStore Margin csv ファイル名', [$filename]);

        return $response;
    }


    /**
     * Dealer Output CSVの出力.
     *
     * @Route("/%eccube_admin_route%/dataexport/dealer/csv", name="admin_dataexport_dealer_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportDealerOutputCSV(Request $request, $searchData)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $result = null;
        $selYM = "";

        if ('POST' === $request->getMethod()) {
            if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
                $selYM = $searchData['data_ym'];
            }
            // データ検索用のクエリビルダを取得.
            $result = $this->dealerSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('データを選択してください');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM) {

            // データ行の出力.
            //1.ヘッダレコード
            $header = [];
            $header[] = "対象月";                //対象月
            $header[] = "契約区分";              //契約区分
            $header[] = "ディーラー";            //ディーラー
            $header[] = "販売店名";              //販売店名
            $header[] = "証券番号";              //証券番号
            $header[] = "公式サイト受注金額";    //公式サイト受注金額
            $header[] = "通販売上マージン";      //通販売上マージン
            $header[] = "仕入れサイト受注金額";  //仕入れサイト受注金額
            $header[] = "店舗売上マージン";      //店舗売上マージン
            $header[] = "マージン合算";          //マージン合算

            $this->csvExportService->fopen();
            $this->csvExportService->fputcsv($header);

            // 2.データレコード
            foreach($result as $row){
                $ChainStore = null;
                $ContractTypeID = "";
                $ContractTypeName = "";
                $ChainStoreName = "未登録";
                $StockNumber = "";
                $DealerCode = "";

                if($row->getChainStore()){
                    $ChainStore = $row->getChainStore();
                    $ChainStoreName = $ChainStore->getCompanyName();
                    $StockNumber = $ChainStore->getStockNumber();
                    $DealerCode = $ChainStore->getDealerCode();

                    if($ChainStore->getContractType()){
                        $ContractType = $ChainStore->getContractType();
                        $ContractTypeID = $ContractType->getId();
                        $ContractTypeName = $ContractType->getName();
                    }
                }

                $row->setExportCnt( ($row->getExportCnt() + 1) );
                $this->dealerSummaryRepository->save($row);
                $this->entityManager->flush();

                $data = [];
                $data[] = $row->getReferenceYm();                 //対象月
                $data[] = $ContractTypeID;                        //契約区分
                $data[] = $DealerCode;                            //ディーラー
                $data[] = $ChainStoreName;                        //販売店名
                $data[] = $StockNumber;                           //証券番号
                $data[] = $row->getSalesTotal();                  //公式サイト受注金額
                $data[] = $row->getSalesMargin();                 //通販売上マージン
                $data[] = $row->getSelfTotal();                   //仕入れサイト受注金額
                $data[] = $row->getChainTotal();                  //店舗売上マージン
                $data[] = $row->getMarginTotal();                 //マージン合算

                $this->csvExportService->fputcsv($data);
            }

            $this->csvExportService->fclose();
        });

        $now = new \DateTime();
        $filename = 'dealer_csv_'.$now->format('YmdHis').'.csv';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
        $response->headers->set('location', $filename);
        $response->send();

        log_info('dealer csv ファイル名', [$filename]);

        return $response;
    }

    /**
     * Dealer Margin CSVの出力.
     *
     * @Route("/%eccube_admin_route%/dataexport/dealer/margin_csv", name="admin_dataexport_dealer_margin_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportDealerMarginCSV(Request $request, $searchData)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $result = null;
        $selYM = "";

        if ('POST' === $request->getMethod()) {
            if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
                $selYM = $searchData['data_ym'];
            }
            // データ検索用のクエリビルダを取得.
            $result = $this->dealerSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('データを選択してください');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM) {

            // データ行の出力.
            //1.ヘッダレコード
            $header = [];
            //$header[] = "対象月";                //対象月
            //$header[] = "契約区分";              //契約区分
            $header[] = "ディーラー";            //ディーラー
            $header[] = "販売店名";              //販売店名
            $header[] = "証券番号";              //証券番号
            //$header[] = "公式サイト受注金額";    //公式サイト受注金額
            //$header[] = "通販売上マージン";      //通販売上マージン
            //$header[] = "仕入れサイト受注金額";  //仕入れサイト受注金額
            //$header[] = "店舗売上マージン";      //店舗売上マージン
            $header[] = "マージン合算";          //マージン合算

            $this->csvExportService->fopen();
            $this->csvExportService->fputcsv($header);

            // 2.データレコード
            foreach($result as $row){
                $ChainStore = null;
                $ContractTypeName = "";
                $ChainStoreName = "未登録";
                $StockNumber = "";
                $DealerCode = "";

                if($row->getChainStore()){
                    $ChainStore = $row->getChainStore();
                    $ChainStoreName = $ChainStore->getCompanyName();
                    $StockNumber = $ChainStore->getStockNumber();
                    $DealerCode = $ChainStore->getDealerCode();

                    if($ChainStore->getContractType()){
                        $ContractType = $ChainStore->getContractType();
                        $ContractTypeName = $ContractType->getName();
                    }
                }

                $row->setExportCnt( ($row->getExportCnt() + 1) );
                $this->dealerSummaryRepository->save($row);
                $this->entityManager->flush();

                $data = [];
                //$data[] = $row->getReferenceYm();                 //対象月
                //$data[] = $ContractTypeName;                      //契約区分
                $data[] = $DealerCode;                            //ディーラー
                $data[] = $ChainStoreName;                        //販売店名
                $data[] = $StockNumber;                           //証券番号
                //$data[] = $row->getSalesTotal();                  //公式サイト受注金額
                //$data[] = $row->getSalesMargin();                 //通販売上マージン
                //$data[] = $row->getSelfTotal();                   //仕入れサイト受注金額
                //$data[] = $row->getChainTotal();                  //店舗売上マージン
                $data[] = $row->getMarginTotal();                 //マージン合算

                $this->csvExportService->fputcsv($data);
            }

            $this->csvExportService->fclose();
        });

        $now = new \DateTime();
        $filename = 'dealer_margin_csv_'.$now->format('YmdHis').'.csv';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
        $response->headers->set('location', $filename);
        $response->send();

        log_info('dealer margin csv ファイル名', [$filename]);

        return $response;
    }

    public function convert_to_l($str){
        return str_replace("　", " ", mb_convert_kana($str, "akV"));
    }

    public function mb_str_pad($input, $pad_len, $pad_str=' ', $pad_type=STR_PAD_RIGHT, $encoding=null)
    {
        if (!$encoding || strtolower($encoding) == 'auto') {
            $encoding = mb_internal_encoding();
        }

        $input_len   = mb_strlen($input, $encoding);
        $pad_str_len = mb_strlen($pad_str, $encoding);
        $target_len  = $pad_len - $input_len;

        if (!$input_len || !$pad_str_len || $target_len <= 0) {

            return mb_substr($input, 0, $pad_len ,"utf-8");
        }

        if ($pad_type === STR_PAD_BOTH) {
            $target_len /= 2;
        }

        $repeat = str_repeat($pad_str, ceil($target_len / $pad_str_len));

        if ($pad_type === STR_PAD_BOTH || $pad_type === STR_PAD_LEFT) {
            $left = mb_substr($repeat, 0, floor($target_len), $encoding);
        } else {
            $left = '';
        }

        if ($pad_type === STR_PAD_BOTH || $pad_type === STR_PAD_RIGHT) {
            $right = mb_substr($repeat, 0, ceil($target_len), $encoding);
        } else {
            $right = '';
        }

        $result = $left.$input.$right;

        return mb_substr($result, 0, $pad_len ,"utf-8");
    }
}
