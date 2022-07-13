<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eccube\Controller\Admin\Product;

use Eccube\Controller\AbstractController;
use Eccube\Entity\Category;
use Eccube\Entity\Master\CsvType;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Form\Type\Admin\CategoryType;
use Eccube\Repository\CategoryRepository;
use Eccube\Service\CsvExportService;
use Eccube\Util\CacheUtil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CategorySeoController extends AbstractController
{
    /**
     * @var CsvExportService
     */
    protected $csvExportService;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param CsvExportService $csvExportService
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CsvExportService $csvExportService,
        CategoryRepository $categoryRepository
    ) {
        $this->csvExportService = $csvExportService;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/product/category_seo", name="admin_product_category_seo")
     * @Route("/%eccube_admin_route%/product/category_seo/{parent_id}", requirements={"parent_id" = "\d+"}, name="admin_product_category_seo_show")
     * @Route("/%eccube_admin_route%/product/category_seo/{id}/edit", requirements={"id" = "\d+"}, name="admin_product_category_seo_edit")
     * @Template("@admin/Product/category_seo.twig")
     */
    public function index(Request $request, $parent_id = null, $id = null, CacheUtil $cacheUtil)
    {
        if ($parent_id) {
            /** @var Category $Parent */
            $Parent = $this->categoryRepository->find($parent_id);
            if (!$Parent) {
                throw new NotFoundHttpException();
            }
        } else {
            $Parent = null;
        }
        if ($id) {
            $TargetCategory = $this->categoryRepository->find($id);
            if (!$TargetCategory) {
                throw new NotFoundHttpException();
            }
            $Parent = $TargetCategory->getParent();
        } else {
            $TargetCategory = new \Eccube\Entity\Category();
            $TargetCategory->setParent($Parent);
            if ($Parent) {
                $TargetCategory->setHierarchy($Parent->getHierarchy() + 1);
            } else {
                $TargetCategory->setHierarchy(1);
            }
        }

        $Categories = $this->categoryRepository->getList($Parent);

        // ツリー表示のため、ルートからのカテゴリを取得
        $TopCategories = $this->categoryRepository->getList(null);

        $builder = $this->formFactory
            ->createBuilder(CategoryType::class, $TargetCategory);

        $event = new EventArgs(
            [
                'builder' => $builder,
                'Parent' => $Parent,
                'TargetCategory' => $TargetCategory,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::ADMIN_PRODUCT_CATEGORY_INDEX_INITIALIZE, $event);

        $form = $builder->getForm();

        $forms = [];
        foreach ($Categories as $Category) {
            $forms[$Category->getId()] = $this->formFactory
                ->createNamed('category_'.$Category->getId(), CategoryType::class, $Category);
        }

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    if ($this->eccubeConfig['eccube_category_nest_level'] < $TargetCategory->getHierarchy()) {
                        throw new BadRequestHttpException();
                    }
                    log_info('カテゴリ登録開始', [$id]);
    
                    $this->categoryRepository->save($TargetCategory);
    
                    log_info('カテゴリ登録完了', [$id]);
    
                    $event = new EventArgs(
                        [
                            'form' => $form,
                            'Parent' => $Parent,
                            'TargetCategory' => $TargetCategory,
                        ],
                        $request
                    );
                    $this->eventDispatcher->dispatch(EccubeEvents::ADMIN_PRODUCT_CATEGORY_INDEX_COMPLETE, $event);
    
                    $this->addSuccess('admin.common.save_complete', 'admin');
    
                    $cacheUtil->clearDoctrineCache();
    
                    if ($Parent) {
                        return $this->redirectToRoute('admin_product_category_seo_show', ['parent_id' => $Parent->getId()]);
                    } else {
                        return $this->redirectToRoute('admin_product_category_seo');
                    }
                }
            }

            foreach ($forms as $editForm) {
                $editForm->handleRequest($request);
                if ($editForm->isSubmitted() && $editForm->isValid()) {
                    $this->categoryRepository->save($editForm->getData());

                    $event = new EventArgs(
                        [
                            'form' => $form,
                            'Parent' => $Parent,
                            'TargetCategory' => $editForm->getData(),
                        ],
                        $request
                    );

                    $this->eventDispatcher->dispatch(EccubeEvents::ADMIN_PRODUCT_CATEGORY_INDEX_COMPLETE, $event);

                    $this->addSuccess('admin.common.save_complete', 'admin');

                    $cacheUtil->clearDoctrineCache();

                    if ($Parent) {
                        return $this->redirectToRoute('admin_product_category_seo_show', ['parent_id' => $Parent->getId()]);
                    } else {
                        return $this->redirectToRoute('admin_product_category_seo');
                    }
                }
            }
        }

        $formViews = [];
        foreach ($forms as $key => $value) {
            $formViews[$key] = $value->createView();
        }

        $Ids = [];
        if ($Parent && $Parent->getParents()) {
            foreach ($Parent->getParents() as $item) {
                $Ids[] = $item['id'];
            }
        }
        $Ids[] = intval($parent_id);

        return [
            'form' => $form->createView(),
            'Parent' => $Parent,
            'Ids' => $Ids,
            'Categories' => $Categories,
            'TopCategories' => $TopCategories,
            'TargetCategory' => $TargetCategory,
            'forms' => $formViews,
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/product/category_seo/{id}/delete", requirements={"id" = "\d+"}, name="admin_product_category_seo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id, CacheUtil $cacheUtil)
    {
        $this->isTokenValid();

        $TargetCategory = $this->categoryRepository->find($id);
        if (!$TargetCategory) {
            $this->deleteMessage();

            return $this->redirectToRoute('admin_product_category_seo');
        }
        $Parent = $TargetCategory->getParent();

        log_info('カテゴリ削除開始', [$id]);

        try {
            $this->categoryRepository->delete($TargetCategory);

            $event = new EventArgs(
                [
                    'Parent' => $Parent,
                    'TargetCategory' => $TargetCategory,
                ], $request
            );
            $this->eventDispatcher->dispatch(EccubeEvents::ADMIN_PRODUCT_CATEGORY_DELETE_COMPLETE, $event);

            $this->addSuccess('admin.common.delete_complete', 'admin');

            log_info('カテゴリ削除完了', [$id]);

            $cacheUtil->clearDoctrineCache();
        } catch (\Exception $e) {
            log_info('カテゴリ削除エラー', [$id, $e]);

            $message = trans('admin.common.delete_error_foreign_key', ['%name%' => $TargetCategory->getName()]);
            $this->addError($message, 'admin');
        }

        if ($Parent) {
            return $this->redirectToRoute('admin_product_category_seo_show', ['parent_id' => $Parent->getId()]);
        } else {
            return $this->redirectToRoute('admin_product_category_seo');
        }
    }

    /**
     * @Route("/%eccube_admin_route%/product/category_seo/sort_no/move", name="admin_product_category_seo_sort_no_move", methods={"POST"})
     */
    public function moveSortNo(Request $request, CacheUtil $cacheUtil)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException();
        }

        if ($this->isTokenValid()) {
            $sortNos = $request->request->all();
            foreach ($sortNos as $categoryId => $sortNo) {
                /* @var $Category \Eccube\Entity\Category */
                $Category = $this->categoryRepository
                    ->find($categoryId);
                $Category->setSortNo($sortNo);
                $this->entityManager->persist($Category);
            }
            $this->entityManager->flush();

            $cacheUtil->clearDoctrineCache();

            return new Response('Successful');
        }
    }

}
