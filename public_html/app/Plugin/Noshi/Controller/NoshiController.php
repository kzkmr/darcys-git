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

namespace Plugin\Noshi\Controller;

use Eccube\Controller\AbstractController;
use Eccube\Repository\Master\PageMaxRepository;
use Eccube\Entity\OrderItem;
use Eccube\Repository\OrderItemRepository;
use Plugin\Noshi\Entity\Noshi;
use Plugin\Noshi\Entity\NoshiConfig;
use Plugin\Noshi\Form\Type\NoshiType;
use Plugin\Noshi\Form\Type\Admin\NoshiSearchType;
use Plugin\Noshi\Repository\NoshiRepository;
use Plugin\Noshi\Repository\NoshiConfigRepository;
use Eccube\Util\CacheUtil;
use Eccube\Util\FormUtil;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Eccube\Service\CsvExportService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class NoshiController.
 */
class NoshiController extends AbstractController
{
    /**
     * @var CsvExportService
     */
    protected $csvExportService;

    /**
     * @var PageMaxRepository
     */
    protected $pageMaxRepository;

    /**
     * @var OrdeItemrRepository
     */
    protected $orderItemRepository;

    /**
     * @var NoshiRepository
     */
    private $noshiRepository;

    /**
     * @var NoshiConfigRepository
     */
    private $noshiConfigRepository;

    /**
     * NoshiController constructor.
     *
     * @param NoshiRepository $noshiRepository
     */
    public function __construct(CsvExportService $csvExportService, PageMaxRepository $pageMaxRepository, OrderItemRepository $orderItemRepository, NoshiRepository $noshiRepository, NoshiConfigRepository $noshiConfigRepository)
    {
        $this->csvExportService = $csvExportService;
        $this->pageMaxRepository = $pageMaxRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->noshiRepository = $noshiRepository;
        $this->noshiConfigRepository = $noshiConfigRepository;
    }

    /**
     * 一覧を表示する。
     *
     * @param Request     $request
     *
     * @return array
     * @Route("/%eccube_admin_route%/order/noshi", name="admin_order_noshi")
     * @Route("/%eccube_admin_route%/order/noshi/page/{page_no}", requirements={"page_no" = "\d+"}, name="admin_order_noshi_page")
     * @Template("@Noshi/admin/index.twig")
     */
    public function index(Request $request, $page_no = 1, PaginatorInterface $paginator)
    {
        $CsvType = $this->noshiConfigRepository
            ->get()
            ->getCsvType();
        $builder = $this->formFactory->createBuilder(NoshiSearchType::class);
        $searchForm = $builder->getForm();

        $pageMaxis = $this->pageMaxRepository->findAll();
        $pageCount = $this->session->get(
            'noshi.admin.noshi.search.page_count',
            $this->eccubeConfig['eccube_default_page_count']
        );
        $pageCountParam = $request->get('page_count');
        if ($pageCountParam && is_numeric($pageCountParam)) {
            foreach ($pageMaxis as $pageMax) {
                if ($pageCountParam == $pageMax->getName()) {
                    $pageCount = $pageMax->getName();
                    $this->session->set('noshi.admin.noshi.search.page_count', $pageCount);
                    break;
                }
            }
        }

        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);
            if ($searchForm->isValid()) {
                $searchData = $searchForm->getData();
                $page_no = 1;

                $this->session->set('noshi.admin.noshi.search', FormUtil::getViewData($searchForm));
                $this->session->set('noshi.admin.noshi.search.page_no', $page_no);
            } else {
                return [
                    'searchForm' => $searchForm->createView(),
                    'pagination' => [],
                    'pageMaxis' => $pageMaxis,
                    'page_no' => $page_no,
                    'page_count' => $pageCount,
                    'CsvType' => $CsvType,
                    'has_errors' => true,
                ];
            }
        } else {
            if (null !== $page_no || $request->get('resume')) {
                if ($page_no) {
                    $this->session->set('noshi.admin.noshi.search.page_no', (int) $page_no);
                } else {
                    $page_no = $this->session->get('noshi.admin.noshi.search.page_no', 1);
                }
                $viewData = $this->session->get('noshi.admin.noshi.search', []);
            } else {
                $page_no = 1;
                $viewData = FormUtil::getViewData($searchForm);
                $this->session->set('noshi.admin.noshi.search', $viewData);
                $this->session->set('noshi.admin.noshi.search.page_no', $page_no);
            }
            $searchData = FormUtil::submitAndGetData($searchForm, $viewData);
        }

        $qb = $this->noshiRepository->getQueryBuilderBySearchData($searchData);

        $pagination = $paginator->paginate(
            $qb,
            $page_no,
            $pageCount
        );

        return [
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'pageMaxis' => $pageMaxis,
            'page_no' => $page_no,
            'page_count' => $pageCount,
            'CsvType' => $CsvType,
            'has_errors' => false,
        ];
    }

    /**
     * 登録・編集する。
     *
     * @Route("/noshi/new", name="noshi_new")
     * @Route("/noshi/{fixed}/edit", requirements={"fixed" = "\d+"}, name="noshi_edit")
     * @Template("@Noshi/default/noshi_edit.twig")
     */
    public function edit(Request $request, Noshi $Noshi = null, CacheUtil $cacheUtil)
    {
		// URLパラメータ取得
		$order_id = $request->query->get('order');
		
        if (is_null($Noshi)) {
            $Noshi = $this->noshiRepository->findOneBy([], ['sort_no' => 'DESC']);
            $sortNo = 1;
            if ($Noshi) {
                $sortNo = $Noshi->getSortNo() + 1;
            }
			
            $date = date("His").$order_id;
			
			$Noshi = new \Plugin\Noshi\Entity\Noshi();
            $Noshi
				->setOrderId($order_id)
                ->setSortNo($sortNo)
                ->setFixed($date)
                ->setVisible(true);
        }
		
		$OrderItem = $this->orderItemRepository->findBy(['Order' => $order_id]);

        $builder = $this->formFactory
            ->createBuilder(NoshiType::class, $Noshi);

        $form = $builder->getForm();
		
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->noshiRepository->save($Noshi);

            // キャッシュの削除
            $cacheUtil->clearDoctrineCache();

            return $this->redirectToRoute('shopping', ['id' => $Noshi->getId()]);
        }

        return [
            'form' => $form->createView(),
            'Noshi' => $Noshi,
            'OrderItem' => $OrderItem,
        ];
    }

    /**
     * 管理画面編集
     *
     * @Route("%eccube_admin_route%/order/noshi/{id}/edit", requirements={"id" = "\d+"}, name="noshi_admin_edit")
     * @Template("@Noshi/admin/edit.twig")
     */
    public function editAdmin(Request $request, Noshi $Noshi = null, CacheUtil $cacheUtil)
    {
		
		$builder = $this->formFactory
            ->createBuilder(NoshiType::class, $Noshi);

        $form = $builder->getForm();
		
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->noshiRepository->save($Noshi);

            // キャッシュの削除
            $cacheUtil->clearDoctrineCache();

            $this->addSuccess('admin.common.save_complete', 'admin');
			return $this->redirectToRoute('noshi_admin_edit', ['id' => $Noshi->getId()]);
        }

        return [
            'form' => $form->createView(),
            'Noshi' => $Noshi,
        ];
    }

    /**
     * フロントページで、指定したデータを削除する。
     *
     * @param Request     $request
     * @param Noshi $Noshi
     *
     * @throws \Exception
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/noshi/{fixed}/delete", requirements={"fixed" = "\d+"}, name="noshi_delete")
     */
    public function delete(Request $request, Noshi $Noshi, CacheUtil $cacheUtil)
    {
        try {
            $this->noshiRepository->delete($Noshi);

            // キャッシュの削除
            $cacheUtil->clearDoctrineCache();

        } catch (\Exception $e) {
        }

        $sortNo = 1;
        $Noshis = $this->noshiRepository
            ->findBy([], ['sort_no' => 'ASC']);

        foreach ($Noshis as $Noshi) {
                $Noshi->setSortNo($sortNo);
                $sortNo++;
        }
        $this->entityManager->flush();

        return $this->redirectToRoute('shopping');
    }

    /**
     * 管理画面で、指定したデータを削除する。
     *
     * @Method("DELETE")
     * @Route("%eccube_admin_route%/order/noshi/{id}/delete", name="admin_noshi_delete")
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function deleteAdmin(Noshi $Noshi)
    {
        $this->isTokenValid();

        $this->entityManager->remove($Noshi);
        $this->entityManager->flush($Noshi);
        $this->addSuccess('admin.common.delete_complete', 'admin');

        return $this->redirect($this->generateUrl('admin_order_noshi'));
    }

    /**
     * @Route("/noshi/{id}/visibility", requirements={"id" = "\d+"}, name="noshi_visibility", methods={"PUT"})
     */
    public function visibility(Request $request, Noshi $Noshi)
    {
        $this->isTokenValid();

        // 表示・非表示を切り替える
        if ($Noshi->isVisible()) {
            $message = trans('admin.common.to_hide_complete', ['%name%' => $Noshi->getId()]);
            $Noshi->setVisible(false);
        } else {
            $message = trans('admin.common.to_show_complete', ['%name%' => $Noshi->getId()]);
            $Noshi->setVisible(true);
        }
        $this->entityManager->persist($Noshi);

        $this->entityManager->flush();

        $this->addSuccess($message, 'admin');

        return $this->redirectToRoute('admin_content_noshi');
    }

    /**
     * @Route("/noshi/sort_no/move", name="noshi_sort_no_move", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function moveSortNo(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException();
        }

        if ($this->isTokenValid()) {
            $sortNos = $request->request->all();
            foreach ($sortNos as $noshiId => $sortNo) {
                $Noshi = $this->noshiRepository->find($noshiId);
                $Noshi->setSortNo($sortNo);
                $this->entityManager->persist($Noshi);
            }
            $this->entityManager->flush();
        }

        return $this->json('OK', 200);
    }

    /**
     * CSVの出力.
     *
     * @Route("%eccube_admin_route%/order/noshi/export", name="admin_noshi_export")
     *
     * @param Request $request
     *
     * @return StreamedResponse
     */
    public function download(Request $request)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);
        $response = new StreamedResponse();
        $response->setCallback(function () use ($request) {
            /** @var NoshiConfig $Config */
            $Config = $this->noshiConfigRepository->get();
            $csvType = $Config->getCsvType();

            /* @var $csvService CsvExportService */
            $csvService = $this->csvExportService;

            /* @var $repo NoshiRepository */
            $repo = $this->noshiRepository;

            // CSV種別を元に初期化.
            $csvService->initCsvType($csvType);

            // ヘッダ行の出力.
            $csvService->exportHeader();

            $session = $request->getSession();
            $searchForm = $this->createForm(NoshiSearchType::class);

            $viewData = $session->get('eccube.admin.product.search', []);
            $searchData = FormUtil::submitAndGetData($searchForm, $viewData);

            $qb = $repo->getQueryBuilderBySearchData($searchData);

            // データ行の出力.
            $csvService->setExportQueryBuilder($qb);
            $csvService->exportData(function ($entity, CsvExportService $csvService) {
                $arrCsv = $csvService->getCsvs();

                $row = [];
                // CSV出力項目と合致するデータを取得.
                foreach ($arrCsv as $csv) {
                    // 受注データを検索.
                    $data = $csvService->getData($csv, $entity);
                    $row[] = $data;
                }
                // 出力.
                $csvService->fputcsv($row);
            });
        });

        $now = new \DateTime();
        $filename = 'noshi_'.$now->format('YmdHis').'.csv';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
        $response->send();

        log_info('のし希望CSV出力ファイル名', [$filename]);

        return $response;
    }
}
