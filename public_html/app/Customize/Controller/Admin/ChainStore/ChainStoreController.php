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

namespace Customize\Controller\Admin\ChainStore;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\QueryBuilder;
use Eccube\Common\Constant;
use Eccube\Controller\AbstractController;
use Customize\Entity\Master\CsvType;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Customize\Form\Type\Admin\SearchChainStoreType;
use Eccube\Repository\CustomerRepository;
use Customize\Repository\ChainStoreRepository;
use Customize\Repository\Master\ApplicantContractTypeRepository;
use Customize\Repository\Master\BankRepository;
use Customize\Repository\Master\BankBranchRepository;
use Customize\Repository\Master\BankAccountTypeRepository;
use Customize\Repository\Master\RelatedChainStoreTypeRepository;
use Customize\Repository\Master\ChainStoreTradingAccountTypeRepository;
use Eccube\Repository\Master\PageMaxRepository;
use Eccube\Repository\Master\PrefRepository;
use Eccube\Repository\Master\SexRepository;
use Customize\Service\CsvExportService;
use Eccube\Service\MailService;
use Eccube\Util\FormUtil;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

class ChainStoreController extends AbstractController
{
    /**
     * @var CsvExportService
     */
    protected $csvExportService;

    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * @var PrefRepository
     */
    protected $prefRepository;

    /**
     * @var SexRepository
     */
    protected $sexRepository;

    /**
     * @var PageMaxRepository
     */
    protected $pageMaxRepository;

    /**
     * @var ChainStoreRepository
     */
    protected $chainstoreRepository;
    
    /**
     * @var ApplicantContractTypeRepository
     */
    protected $applicantContractTypeRepository;

    /**
     * @var BankRepository
     */
    protected $bankRepository;

    /**
     * @var BankBranchRepository
     */
    protected $bankBranchRepository;

    /**
     * @var BankAccountTypeRepository
     */
    protected $bankAccountTypeRepository;

    /**
     * @var ChainStoreTradingAccountTypeRepository
     */
    protected $chainStoreTradingAccountTypeRepository;

    /**
     * @var RelatedChainStoreTypeRepository
     */
    protected $relatedChainStoreTypeRepository;
    
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    public function __construct(
        PageMaxRepository $pageMaxRepository,
        ChainStoreRepository $chainstoreRepository,
        CustomerRepository $customerRepository,
        ApplicantContractTypeRepository $applicantContractTypeRepository,
        BankRepository $bankRepository,
        BankBranchRepository $bankBranchRepository,
        BankAccountTypeRepository $bankAccountTypeRepository,
        ChainStoreTradingAccountTypeRepository $chainStoreTradingAccountTypeRepository,
        RelatedChainStoreTypeRepository $relatedChainStoreTypeRepository,
        SexRepository $sexRepository,
        PrefRepository $prefRepository,
        MailService $mailService,
        CsvExportService $csvExportService
    ) {
        $this->pageMaxRepository = $pageMaxRepository;
        $this->chainstoreRepository = $chainstoreRepository;
        $this->customerRepository = $customerRepository;
        $this->applicantContractTypeRepository = $applicantContractTypeRepository;
        $this->bankRepository = $bankRepository;
        $this->bankBranchRepository = $bankBranchRepository;
        $this->bankAccountTypeRepository = $bankAccountTypeRepository;
        $this->chainStoreTradingAccountTypeRepository = $chainStoreTradingAccountTypeRepository;
        $this->relatedChainStoreTypeRepository = $relatedChainStoreTypeRepository;
        $this->sexRepository = $sexRepository;
        $this->prefRepository = $prefRepository;
        $this->mailService = $mailService;
        $this->csvExportService = $csvExportService;
    }

    /**
     * @Route("/%eccube_admin_route%/chainstore", name="admin_chainstore", methods={"GET", "POST"})
     * @Route("/%eccube_admin_route%/chainstore/page/{page_no}", requirements={"page_no" = "\d+"}, name="admin_chainstore_page", methods={"GET", "POST"})
     * @Template("@admin/ChainStore/index.twig")
     */
    public function index(Request $request, $page_no = null, PaginatorInterface $paginator)
    {
        $session = $this->session;
        $builder = $this->formFactory->createBuilder(SearchChainStoreType::class);

        $searchForm = $builder->getForm();

        $pageMaxis = $this->pageMaxRepository->findAll();
        $pageCount = $session->get('eccube.admin.chain_store.search.page_count', $this->eccubeConfig['eccube_default_page_count']);
        $pageCountParam = $request->get('page_count');
        if ($pageCountParam && is_numeric($pageCountParam)) {
            foreach ($pageMaxis as $pageMax) {
                if ($pageCountParam == $pageMax->getName()) {
                    $pageCount = $pageMax->getName();
                    $session->set('eccube.admin.chain_store.search.page_count', $pageCount);
                    break;
                }
            }
        }

        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);
            if ($searchForm->isValid()) {
                $searchData = $searchForm->getData();
                $page_no = 1;

                $session->set('eccube.admin.chain_store.search', FormUtil::getViewData($searchForm));
                $session->set('eccube.admin.chain_store.search.page_no', $page_no);
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
                    $session->set('eccube.admin.chain_store.search.page_no', (int) $page_no);
                } else {
                    $page_no = $session->get('eccube.admin.chain_store.search.page_no', 1);
                }
                $viewData = $session->get('eccube.admin.chain_store.search', []);
            } else {
                $page_no = 1;
                $viewData = FormUtil::getViewData($searchForm);
                $session->set('eccube.admin.chain_store.search', $viewData);
                $session->set('eccube.admin.chain_store.search.page_no', $page_no);
            }
            $searchData = FormUtil::submitAndGetData($searchForm, $viewData);
        }

        /** @var QueryBuilder $qb */
        $qb = $this->chainstoreRepository->getQueryBuilderBySearchData($searchData);

        $pagination = $paginator->paginate(
            $qb,
            $page_no,
            $pageCount
        );

        foreach($pagination as $ChainStore)
        {
            $Customers = $this->customerRepository->findBy(["ChainStore" => $ChainStore->getId()]);
            $ChainStore->setRelatedCustomer($Customers);
        }

        return [
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'pageMaxis' => $pageMaxis,
            'page_no' => $page_no,
            'page_count' => $pageCount,
            'has_errors' => false,
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/chainstore/{id}/resend", requirements={"id" = "\d+"}, name="admin_chainstore_resend", methods={"GET"})
     */
    public function resend(Request $request, $id)
    {
        $this->isTokenValid();

        $ChainStore = $this->chainstoreRepository
            ->find($id);

        if (is_null($ChainStore)) {
            throw new NotFoundHttpException();
        }

        $activateUrl = $this->generateUrl(
            'entry_activate',
            ['secret_key' => $ChainStore->getSecretKey()],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        // メール送信
        $this->mailService->sendAdminChainStoreConfirmMail($ChainStore, $activateUrl);

        $this->addSuccess('admin.common.send_complete', 'admin');

        return $this->redirectToRoute('admin_chain_store');
    }

    /**
     * @Route("/%eccube_admin_route%/chainstore/{id}/delete", requirements={"id" = "\d+"}, name="admin_chainstore_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id, TranslatorInterface $translator)
    {
        $this->isTokenValid();

        log_info('販売店削除開始', [$id]);

        $page_no = intval($this->session->get('eccube.admin.chain_store.search.page_no'));
        $page_no = $page_no ? $page_no : Constant::ENABLED;

        $ChainStore = $this->chainstoreRepository
            ->find($id);

        if (!$ChainStore) {
            $this->deleteMessage();

            return $this->redirect($this->generateUrl('admin_chainstore_page',
                    ['page_no' => $page_no]).'?resume='.Constant::ENABLED);
        }

        try {
            $this->entityManager->remove($ChainStore);
            $this->entityManager->flush();
            $this->addSuccess('admin.common.delete_complete', 'admin');
        } catch (ForeignKeyConstraintViolationException $e) {
            log_error('販売店削除失敗', [$e]);

            $message = trans('admin.common.delete_error_foreign_key', ['%name%' => $ChainStore->getName01().' '.$ChainStore->getName02()]);
            $this->addError($message, 'admin');
        }

        log_info('販売店削除完了', [$id]);

        return $this->redirect($this->generateUrl('admin_chainstore_page',
                ['page_no' => $page_no]).'?resume='.Constant::ENABLED);
    }

    /**
     * 販売店一覧1CSV
     *
     * @Route("/%eccube_admin_route%/chainstore/export1", name="admin_chainstore_export1", methods={"GET"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function export1(Request $request)
    {
        $filename = 'chainstore_export1_'.(new \DateTime())->format('YmdHis').'.csv';
        $response = $this->export($request, 7, $filename);
        log_info('販売店一覧1CSV出力ファイル名', [$filename]);

        return $response;
    }

    /**
     * 販売店一覧2CSV
     *
     * @Route("/%eccube_admin_route%/chainstore/export2", name="admin_chainstore_export2", methods={"GET"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function export2(Request $request)
    {
        $filename = 'chainstore_export2_'.(new \DateTime())->format('YmdHis').'.csv';
        $response = $this->export($request, 9, $filename);
        log_info('販売店一覧2CSV出力ファイル名', [$filename]);

        return $response;
    }
    
    /**
     * 販売店一覧3CSV
     *
     * @Route("/%eccube_admin_route%/chainstore/export3", name="admin_chainstore_export3", methods={"GET"})
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function export3(Request $request)
    {
        $filename = 'chainstore_export3_'.(new \DateTime())->format('YmdHis').'.csv';
        $response = $this->export($request, 10, $filename);
        log_info('販売店一覧3CSV出力ファイル名', [$filename]);

        return $response;
    }

    /**
     * @param Request $request
     * @param $csvTypeId
     * @param string $fileName
     *
     * @return StreamedResponse
     */
    protected function export(Request $request, $csvTypeId, $fileName)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($request,$csvTypeId) {
            // CSV種別を元に初期化.
            $this->csvExportService->initCsvType($csvTypeId);

            // ヘッダ行の出力.
            $this->csvExportService->exportHeader();

            // 販売店データ検索用のクエリビルダを取得.
            $qb = $this->csvExportService
                ->getChainStoreQueryBuilder($request);

            // データ行の出力.
            $this->csvExportService->setExportQueryBuilder($qb);
            $this->csvExportService->exportData(function ($entity, $csvService) use ($request) {
                $Csvs = $csvService->getCsvs();

                /** @var $ChainStore \Eccube\Entity\ChainStore */
                $ChainStore = $entity;
                $Customer = $this->customerRepository->findOneBy(["ChainStore" => $ChainStore->getId()]);
                $ChainStore->setRelatedCustomer($Customer);

                $BankBranch = null;

                if(!empty($ChainStore->getBankBranch())){
                    $BankBranch = $this->bankBranchRepository->findOneBy(["id" => $ChainStore->getBankBranch()]);
                }

                $ExportCsvRow = new \Eccube\Entity\ExportCsvRow();

                // CSV出力項目と合致するデータを取得.
                foreach ($Csvs as $Csv) {
                    // 会員データを検索.
                    $ExportCsvRow->setData($csvService->getData($Csv, $ChainStore));

                    if ($ExportCsvRow->isDataNull()) {
                        if(is_object($Customer)){
                            // 会員データにない場合は, 販売店明細を検索.
                            $ExportCsvRow->setData($csvService->getData($Csv, $Customer));
                        }
                    }
                    if ($ExportCsvRow->isDataNull()) {
                        if(is_object($BankBranch)){
                            // 会員データにない場合は, 支店を検索.
                            $ExportCsvRow->setData($csvService->getData($Csv, $BankBranch));
                        }
                    }

                    $ExportCsvRow->pushData();
                }

                //$row[] = number_format(memory_get_usage(true));
                // 出力.
                $csvService->fputcsv($ExportCsvRow->getRow());
            });
        });

        //$now = new \DateTime();
        //$filename = 'chain_store_'.$now->format('YmdHis').'.csv';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$fileName);

        $response->send();

        log_info('販売店CSVファイル名', [$fileName]);

        return $response;
    }

}
