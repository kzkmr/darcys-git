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

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Eccube\Controller\ProductController as BaseProductController;
use Eccube\Entity\BaseInfo;
use Eccube\Entity\Master\ProductStatus;
use Eccube\Entity\Product;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Form\Type\AddCartType;
use Eccube\Form\Type\Master\ProductListMaxType;
use Eccube\Form\Type\Master\ProductListOrderByType;
use Eccube\Form\Type\SearchProductType;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\CustomerFavoriteProductRepository;
use Eccube\Repository\Master\ProductListMaxRepository;
use Customize\Repository\ProductRepository;
use Customize\Repository\Master\ContractTypeRepository;
use Eccube\Service\CartService;
use Eccube\Service\PurchaseFlow\PurchaseContext;
use Eccube\Service\PurchaseFlow\PurchaseFlow;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CustomProductController extends BaseProductController
{
    /**
     * @var PurchaseFlow
     */
    protected $purchaseFlow;

    /**
     * @var CustomerFavoriteProductRepository
     */
    protected $customerFavoriteProductRepository;

    /**
     * @var CartService
     */
    protected $cartService;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var BaseInfo
     */
    protected $BaseInfo;

    /**
     * @var AuthenticationUtils
     */
    protected $helper;

    /**
     * @var ProductListMaxRepository
     */
    protected $productListMaxRepository;

    /**
     * @var ContractTypeRepository
     */
    protected $contractTypeRepository;

    private $title = '';

    /**
     * ProductController constructor.
     *
     * @param PurchaseFlow $cartPurchaseFlow
     * @param CustomerFavoriteProductRepository $customerFavoriteProductRepository
     * @param CartService $cartService
     * @param ProductRepository $productRepository
     * @param BaseInfoRepository $baseInfoRepository
     * @param AuthenticationUtils $helper
     * @param ProductListMaxRepository $productListMaxRepository
     */
    public function __construct(
        PurchaseFlow $cartPurchaseFlow,
        CustomerFavoriteProductRepository $customerFavoriteProductRepository,
        CartService $cartService,
        ProductRepository $productRepository,
        BaseInfoRepository $baseInfoRepository,
        AuthenticationUtils $helper,
        ProductListMaxRepository $productListMaxRepository,
        ContractTypeRepository $contractTypeRepository
    ) {
        $this->purchaseFlow = $cartPurchaseFlow;
        $this->customerFavoriteProductRepository = $customerFavoriteProductRepository;
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
        $this->BaseInfo = $baseInfoRepository->get();
        $this->helper = $helper;
        $this->productListMaxRepository = $productListMaxRepository;
        $this->contractTypeRepository = $contractTypeRepository;
    }

    /**
     * 商品一覧画面.
     *
     * @Route("/products/list", name="product_list", methods={"GET"})
     * @Template("Product/list.twig")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        // Doctrine SQLFilter
        if ($this->BaseInfo->isOptionNostockHidden()) {
            $this->entityManager->getFilters()->enable('option_nostock_hidden');
        }

        // handleRequestは空のqueryの場合は無視するため
        if ($request->getMethod() === 'GET') {
            $request->query->set('pageno', $request->query->get('pageno', ''));
        }

        // searchForm
        /* @var $builder \Symfony\Component\Form\FormBuilderInterface */
        $builder = $this->formFactory->createNamedBuilder('', SearchProductType::class);

        if ($request->getMethod() === 'GET') {
            $builder->setMethod('GET');
        }

        $event = new EventArgs(
            [
                'builder' => $builder,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_PRODUCT_INDEX_INITIALIZE, $event);

        /* @var $searchForm \Symfony\Component\Form\FormInterface */
        $searchForm = $builder->getForm();

        $searchForm->handleRequest($request);

        // paginator
        $searchData = $searchForm->getData();
        $LoginTypeInfo = $this->getLoginTypeInfo();
        $qb = $this->productRepository->getQueryBuilderBySearchDataWithLoginTypeInfo($searchData, $LoginTypeInfo);
        $ContractTypeAll = $this->contractTypeRepository->findAll();

        $event = new EventArgs(
            [
                'searchData' => $searchData,
                'qb' => $qb,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_PRODUCT_INDEX_SEARCH, $event);
        $searchData = $event->getArgument('searchData');

        $query = $qb->getQuery()
            ->useResultCache(true, $this->eccubeConfig['eccube_result_cache_lifetime_short']);

        /** @var SlidingPagination $pagination */
        $pagination = $paginator->paginate(
            $query,
            !empty($searchData['pageno']) ? $searchData['pageno'] : 1,
            !empty($searchData['disp_number']) ? $searchData['disp_number']->getId() : $this->productListMaxRepository->findOneBy([], ['sort_no' => 'ASC'])->getId()
        );

        $ids = [];
        foreach ($pagination as $Product) {
            $ids[] = $Product->getId();
        }
        $ProductsAndClassCategories = $this->productRepository->findProductsWithSortedClassCategoriesWithLoginTypeInfo($ids, 'p.id', $LoginTypeInfo);

        // addCart form
        $forms = [];
        foreach ($pagination as $Product) {
            /* @var $builder \Symfony\Component\Form\FormBuilderInterface */
            $Product->setHiddenClassCategory($ContractTypeAll);

            $builder = $this->formFactory->createNamedBuilder(
                '',
                AddCartType::class,
                null,
                [
                    'product' => $ProductsAndClassCategories[$Product->getId()],
                    'allow_extra_fields' => true,
                ]
            );
            $addCartForm = $builder->getForm();

            $forms[$Product->getId()] = $addCartForm->createView();
        }

        // 表示件数
        $builder = $this->formFactory->createNamedBuilder(
            'disp_number',
            ProductListMaxType::class,
            null,
            [
                'required' => false,
                'allow_extra_fields' => true,
            ]
        );
        if ($request->getMethod() === 'GET') {
            $builder->setMethod('GET');
        }

        $event = new EventArgs(
            [
                'builder' => $builder,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_PRODUCT_INDEX_DISP, $event);

        $dispNumberForm = $builder->getForm();

        $dispNumberForm->handleRequest($request);

        // ソート順
        $builder = $this->formFactory->createNamedBuilder(
            'orderby',
            ProductListOrderByType::class,
            null,
            [
                'required' => false,
                'allow_extra_fields' => true,
            ]
        );
        if ($request->getMethod() === 'GET') {
            $builder->setMethod('GET');
        }

        $event = new EventArgs(
            [
                'builder' => $builder,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_PRODUCT_INDEX_ORDER, $event);

        $orderByForm = $builder->getForm();

        $orderByForm->handleRequest($request);

        $Category = $searchForm->get('category_id')->getData();

        return [
            'subtitle' => $this->getPageTitle($searchData),
            'pagination' => $pagination,
            'search_form' => $searchForm->createView(),
            'disp_number_form' => $dispNumberForm->createView(),
            'order_by_form' => $orderByForm->createView(),
            'forms' => $forms,
            'Category' => $Category
        ];
    }

    /**
     * 商品詳細画面.
     *
     * @Route("/products/detail/{id}", name="product_detail", methods={"GET"}, requirements={"id" = "\d+"})
     * @Template("Product/detail.twig")
     * @ParamConverter("Product", options={"repository_method" = "findWithSortedClassCategories"})
     *
     * @param Request $request
     * @param Product $Product
     *
     * @return array
     */
    public function detail(Request $request, Product $Product)
    {
        if (!$this->checkVisibility($Product)) {
            throw new NotFoundHttpException();
        }

        $LoginTypeInfo = $this->getLoginTypeInfo();
        $LoginType = $LoginTypeInfo["LoginType"];
        $Customer = $LoginTypeInfo["Customer"];
        $ChainStore = $LoginTypeInfo["ChainStore"];
        $ContractType = $LoginTypeInfo["ContractType"];
        $ContractTypeList = $this->contractTypeRepository->findBy(['is_hidden' => 'N']);
        $ContractTypeAll = $this->contractTypeRepository->findAll();

        $Product->setLoginTypeInfo($LoginTypeInfo, $ContractTypeList);
        $Product->setHiddenClassCategory($ContractTypeAll);

        if(is_object($ContractType)){
            if($ContractType->getShowProduct() != "Y"){
                throw new NotFoundHttpException();
            }
        }

        $builder = $this->formFactory->createNamedBuilder(
            '',
            AddCartType::class,
            null,
            [
                'product' => $Product,
                'id_add_product_id' => false,
            ]
        );

        $event = new EventArgs(
            [
                'builder' => $builder,
                'Product' => $Product,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_PRODUCT_DETAIL_INITIALIZE, $event);

        $is_favorite = false;
        if ($this->isGranted('ROLE_USER')) {
            $Customer = $this->getUser();
            $is_favorite = $this->customerFavoriteProductRepository->isFavorite($Customer, $Product);
        }

        return [
            'title' => $this->title,
            'subtitle' => $Product->getName(),
            'form' => $builder->getForm()->createView(),
            'Product' => $Product,
            'is_favorite' => $is_favorite
        ];
    }

    private function getLoginTypeInfo()
    {
        $LoginType = 1;         //Default is guest
        $Customer = null;
        $ChainStore = null;
        $ContractType = null;

        if ($this->isGranted('IS_AUTHENTICATED_FULLY') || $this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $Customer = $this->getUser();
            $ChainStore = $Customer->getChainStore();

            if(is_object($ChainStore)){
                $LoginType = 3;         //ChainStore member
                $ContractType = $ChainStore->getContractType();
            }else{
                $LoginType = 2;         //Normal member
            }
        }

        return [
            'LoginType' => $LoginType,
            'Customer' => $Customer,
            'ChainStore' => $ChainStore,
            'ContractType' => $ContractType,
        ];
    }
}
