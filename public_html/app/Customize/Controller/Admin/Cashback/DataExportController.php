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
     * ChainStore Output CSV?????????.
     *
     * @Route("/%eccube_admin_route%/dataexport/chainstore/csv", name="admin_dataexport_chainstore_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportChainStoreOutputCSV(Request $request, $searchData)
    {
        // ????????????????????????????????????.
        set_time_limit(0);

        // sql logger??????????????????.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $result = null;
        $selYM = "";

        if ('POST' === $request->getMethod()) {
            if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
                $selYM = $searchData['data_ym'];
            }
            // ????????????????????????????????????????????????.
            $result = $this->cashbackSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('????????????????????????????????????');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM) {

            // ?????????????????????.
            //1.?????????????????????
            $header = [];
            $header[] = "?????????";                //?????????
            $header[] = "????????????";              //????????????
            $header[] = "????????????";              //????????????
            $header[] = "????????????";              //????????????
            $header[] = "????????????";              //????????????
            $header[] = "??????????????????????????????";  //??????????????????????????????
            $header[] = "???????????????";            //???????????????
            $header[] = "????????????";              //????????????
            $header[] = "??????????????????";          //??????????????????
            $header[] = "????????????????????????";      //????????????????????????

            $this->csvExportService->fopen();
            $this->csvExportService->fputcsv($header);

            // 2.?????????????????????
            foreach($result as $row){
                $ChainStore = null;
                $ContractTypeName = "";
                $ChainStoreName = "?????????";
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
                $data[] = $row->getReferenceYm();                 //?????????
                $data[] = $ContractTypeName;                      //????????????
                $data[] = $ChainStoreName;                        //????????????
                $data[] = $StockNumber;                           //????????????
                $data[] = $row->getMarginPrice();                 //????????????
                $data[] = $row->getPreviousMarginPrice();         //??????????????????????????????
                $data[] = $row->getPurchaseAmount();              //???????????????
                $data[] = $row->getRequestAmount();               //????????????
                $data[] = $row->getMarginBalance();               //??????????????????
                $data[] = $row->getCarriedForward();              //????????????????????????

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

        log_info('Cashback ???????????????', [$filename]);

        return $response;
    }


    /**
     * ChainStore Margin CSV?????????.
     *
     * @Route("/%eccube_admin_route%/dataexport/chainstore/margin_csv", name="admin_dataexport_chainstore_margin_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportChainStoreMarginCSV(Request $request, $searchData)
    {
        // ????????????????????????????????????.
        set_time_limit(0);

        // sql logger??????????????????.
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

            // ????????????????????????????????????????????????.
            $result = $this->cashbackSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('????????????????????????????????????');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM, $payYM) {
            //$payYM = date('md', strtotime("+1 months", strtotime(date("Y/m/d"))));

            // ?????????????????????.
            //1.?????????????????????(120????????????????????????????????????????????????????????????)
            $header = "1";                  //???????????????-1????????????????????????
            $header .= "21";                //???????????????-21?????????  11?????????71?????????    12?????????72?????????
            $header .= "0";                 //???????????????-????????????????????? 0???JIS
            $header .= "3658564000";        //??????????????????
            $header .= $this->mb_str_pad($this->convert_to_l("?????????-?????????????????????-"),40," ",STR_PAD_RIGHT);          //????????????????????????
            $header .= str_pad($payYM,4," ",STR_PAD_RIGHT);                     //???????????????
            $header .= "0000";              //???????????????????????????
            $header .= $this->mb_str_pad($this->convert_to_l("?????????"),15," ",STR_PAD_RIGHT);          //???????????????
            $header .= "000";               //??????????????????????????????
            $header .= $this->mb_str_pad($this->convert_to_l("?????????"),15," ",STR_PAD_RIGHT);          //?????????????????????
            $header .= "1";                 //????????????(?????????)-???????????????????????? 1????????????2????????????4?????????
            $header .= str_pad("1234567",7,"0",STR_PAD_LEFT);                   //????????????(?????????) ??????????????????????????????
            $header .= str_pad("",17," ",STR_PAD_RIGHT);                        //????????? ?????????
            print_r($header."\r\n");

            // 2.?????????????????????
            $totalAmount = 0;
            foreach($result as $row){
                $ChainStore = null;
                $Customer = null;
                $ContractTypeName = "";
                $ChainStoreName = "?????????";
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

                $data = "2";                  //???????????????-?????????????????? - 2????????????????????????
                $data .= $BankCode;           //???????????? - ?????????????????????????????? 
                $data .= $this->mb_str_pad($BankNameKa ,15," ",STR_PAD_RIGHT);      //???????????????????????????
                $data .= $BranchCode;         //????????????????????? - ???????????????????????????
                $data .= $this->mb_str_pad($BranchNameKa,15," ",STR_PAD_RIGHT);     //?????????????????? - ????????????????????????
                $data .= $this->mb_str_pad("",4," ",STR_PAD_LEFT);                  //?????????????????????
                $data .= $BankAccountType->getId();                                 //???????????? 1????????????2????????????4?????????
                $data .= $this->mb_str_pad($BankAccount,7,"0",STR_PAD_LEFT);;       //????????????????????????
                $data .= $this->mb_str_pad($this->convert_to_l($BankHolder),30," ",STR_PAD_RIGHT);       //????????????(??????)
                $data .= $this->mb_str_pad(intval($row->getMarginBalance()),10,"0",STR_PAD_LEFT);           //?????????????????? - ???????????????
                $data .= " ";      //???????????????
                $data .= $this->mb_str_pad($Customer->getId() ,10," ",STR_PAD_RIGHT);               //?????? ?????????1(??????)
                $data .= $this->mb_str_pad("",10," ",STR_PAD_RIGHT);                //?????? ?????????2(??????)
                $data .= " ";      //???????????? - ?????????
                $data .= " ";      //????????????
                $data .= $this->mb_str_pad("",7," ",STR_PAD_RIGHT);                          //????????? ?????????

                $totalAmount = $totalAmount + $row->getMarginBalance();

                print_r($data."\r\n");
            }

            //??????????????????????????? Trailer record
            $trailer = "8";                  //???????????????-?????????????????? - 8???????????????????????????
            $trailer .= $this->mb_str_pad(count($result),6,"0",STR_PAD_LEFT);                 //???????????? - ????????????????????????????????????
            $trailer .= $this->mb_str_pad(intval($totalAmount),12,"0",STR_PAD_LEFT);          //???????????? - ?????????????????????????????????????????????
            $trailer .= $this->mb_str_pad("",101," ",STR_PAD_RIGHT);                          //????????? ?????????
            print_r($trailer."\r\n");

            //4.?????????????????????
            $footer = "9";                  //???????????????-?????????????????? - 9????????????????????????
            $footer .= $this->mb_str_pad("",119," ",STR_PAD_RIGHT);                  //????????? ?????????
            print_r($footer);
        });

        $now = new \DateTime();
        $filename = 'chainstore_margin_csv_'.$now->format('YmdHis').'.txt';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
        $response->headers->set('location', $filename);
        $response->send();

        log_info('ChainStore Margin csv ???????????????', [$filename]);

        return $response;
    }


    /**
     * Dealer Output CSV?????????.
     *
     * @Route("/%eccube_admin_route%/dataexport/dealer/csv", name="admin_dataexport_dealer_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportDealerOutputCSV(Request $request, $searchData)
    {
        // ????????????????????????????????????.
        set_time_limit(0);

        // sql logger??????????????????.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $result = null;
        $selYM = "";

        if ('POST' === $request->getMethod()) {
            if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
                $selYM = $searchData['data_ym'];
            }
            // ????????????????????????????????????????????????.
            $result = $this->dealerSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('????????????????????????????????????');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM) {

            // ?????????????????????.
            //1.?????????????????????
            $header = [];
            $header[] = "?????????";                //?????????
            $header[] = "????????????";              //????????????
            $header[] = "???????????????";            //???????????????
            $header[] = "????????????";              //????????????
            $header[] = "????????????";              //????????????
            $header[] = "???????????????????????????";    //???????????????????????????
            $header[] = "????????????????????????";      //????????????????????????
            $header[] = "??????????????????????????????";  //??????????????????????????????
            $header[] = "????????????????????????";      //????????????????????????
            $header[] = "??????????????????";          //??????????????????

            $this->csvExportService->fopen();
            $this->csvExportService->fputcsv($header);

            // 2.?????????????????????
            foreach($result as $row){
                $ChainStore = null;
                $ContractTypeID = "";
                $ContractTypeName = "";
                $ChainStoreName = "?????????";
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
                $data[] = $row->getReferenceYm();                 //?????????
                $data[] = $ContractTypeID;                        //????????????
                $data[] = $DealerCode;                            //???????????????
                $data[] = $ChainStoreName;                        //????????????
                $data[] = $StockNumber;                           //????????????
                $data[] = $row->getSalesTotal();                  //???????????????????????????
                $data[] = $row->getSalesMargin();                 //????????????????????????
                $data[] = $row->getSelfTotal();                   //??????????????????????????????
                $data[] = $row->getChainTotal();                  //????????????????????????
                $data[] = $row->getMarginTotal();                 //??????????????????

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

        log_info('dealer csv ???????????????', [$filename]);

        return $response;
    }

    /**
     * Dealer Margin CSV?????????.
     *
     * @Route("/%eccube_admin_route%/dataexport/dealer/margin_csv", name="admin_dataexport_dealer_margin_csv")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function exportDealerMarginCSV(Request $request, $searchData)
    {
        // ????????????????????????????????????.
        set_time_limit(0);

        // sql logger??????????????????.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $result = null;
        $selYM = "";

        if ('POST' === $request->getMethod()) {
            if (!empty($searchData['data_ym']) && $searchData['data_ym']) {
                $selYM = $searchData['data_ym'];
            }
            // ????????????????????????????????????????????????.
            $result = $this->dealerSummaryRepository->getResultBySearchData($searchData);
        }else{
            $this->addError('????????????????????????????????????');
            return $this->redirectToRoute('admin_dataexport_chainstore');
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request, $result, $selYM) {

            // ?????????????????????.
            //1.?????????????????????
            $header = [];
            //$header[] = "?????????";                //?????????
            //$header[] = "????????????";              //????????????
            $header[] = "???????????????";            //???????????????
            $header[] = "????????????";              //????????????
            $header[] = "????????????";              //????????????
            //$header[] = "???????????????????????????";    //???????????????????????????
            //$header[] = "????????????????????????";      //????????????????????????
            //$header[] = "??????????????????????????????";  //??????????????????????????????
            //$header[] = "????????????????????????";      //????????????????????????
            $header[] = "??????????????????";          //??????????????????

            $this->csvExportService->fopen();
            $this->csvExportService->fputcsv($header);

            // 2.?????????????????????
            foreach($result as $row){
                $ChainStore = null;
                $ContractTypeName = "";
                $ChainStoreName = "?????????";
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
                //$data[] = $row->getReferenceYm();                 //?????????
                //$data[] = $ContractTypeName;                      //????????????
                $data[] = $DealerCode;                            //???????????????
                $data[] = $ChainStoreName;                        //????????????
                $data[] = $StockNumber;                           //????????????
                //$data[] = $row->getSalesTotal();                  //???????????????????????????
                //$data[] = $row->getSalesMargin();                 //????????????????????????
                //$data[] = $row->getSelfTotal();                   //??????????????????????????????
                //$data[] = $row->getChainTotal();                  //????????????????????????
                $data[] = $row->getMarginTotal();                 //??????????????????

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

        log_info('dealer margin csv ???????????????', [$filename]);

        return $response;
    }

    public function convert_to_l($str){
        return str_replace("???", " ", mb_convert_kana($str, "akV"));
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
