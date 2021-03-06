<?php
/**
 * Copyright(c) 2020 SYSTEM_KD
 * Date: 2020/05/03
 */

namespace Plugin\KokokaraSelect\Controller;


use Eccube\Controller\AbstractController;
use Eccube\Entity\BaseInfo;
use Eccube\Entity\CartItem;
use Eccube\Entity\Customer;
use Eccube\Entity\Master\ProductStatus;
use Eccube\Entity\Product;
use Eccube\Entity\ProductClass;
use Eccube\Form\Type\AddCartType;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\CustomerFavoriteProductRepository;
use Eccube\Repository\ProductClassRepository;
use Eccube\Service\CartService;
use Eccube\Service\PurchaseFlow\PurchaseContext;
use Eccube\Service\PurchaseFlow\PurchaseFlow;
use Eccube\Service\PurchaseFlow\PurchaseFlowResult;
use Plugin\KokokaraSelect\Config\ConfigSetting;
use Plugin\KokokaraSelect\Service\KsCartHelper;
use Plugin\KokokaraSelect\Service\KsService;
use Plugin\KokokaraSelect\Service\PlgConfigService\ConfigService;
use Plugin\KokokaraSelect\Service\PluginLinkService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class KokokaraSelectController extends AbstractController
{

    /**
     * @var ProductClassRepository
     */
    protected $productClassRepository;

    /** @var CartService */
    protected $cartService;

    /** @var KsCartHelper */
    protected $ksCartHelper;

    /** @var PurchaseFlow */
    protected $purchaseFlow;

    /** @var KsService */
    protected $ksService;

    /** @var ConfigService */
    protected $configService;

    /** @var PluginLinkService */
    protected $pluginLinkService;

    /** @var BaseInfo */
    protected $BaseInfo;

    /** @var CustomerFavoriteProductRepository */
    protected $customerFavoriteProductRepository;

    public function __construct(
        ProductClassRepository            $productClassRepository,
        CartService                       $cartService,
        KsCartHelper                      $ksCartHelper,
        PurchaseFlow                      $cartPurchaseFlow,
        KsService                         $ksService,
        ConfigService                     $configService,
        PluginLinkService                 $pluginLinkService,
        BaseInfoRepository                $baseInfoRepository,
        CustomerFavoriteProductRepository $customerFavoriteProductRepository
    )
    {
        $this->productClassRepository = $productClassRepository;
        $this->cartService = $cartService;
        $this->ksCartHelper = $ksCartHelper;
        $this->purchaseFlow = $cartPurchaseFlow;
        $this->ksService = $ksService;
        $this->configService = $configService;
        $this->pluginLinkService = $pluginLinkService;
        $this->BaseInfo = $baseInfoRepository->get();
        $this->customerFavoriteProductRepository = $customerFavoriteProductRepository;
    }

    /**
     * @Route("/products/select/list/{id}/new", name="kokokara_select_list", methods={"GET"}, requirements={"id" = "\d+"})
     * @Route("/products/select/list/{id}/edit/{editId}", name="kokokara_select_list_edit", methods={"GET"}, requirements={"id" = "\d+", "eidtId" = "\d+"})
     * @Template("KokokaraSelect/Resource/template/default/Product/list.twig")
     *
     * @param Request $request
     * @param Product $product
     * @param string $editId
     * @return string[]
     */
    public function index(Request $request, Product $product, $editId = null)
    {

        if (!$this->checkVisibility($product)) {
            throw new NotFoundHttpException();
        }

        // ???????????????CartKey????????????
        if (!$this->ksCartHelper->checkKsCartKey($this->cartService->getCarts(), $product, $editId)) {
            throw new NotFoundHttpException();
        }

        $builder = $this->formFactory->createNamedBuilder(
            '',
            AddCartType::class,
            null,
            [
                'product' => $product,
                'id_add_product_id' => false,
                'kokokara_select' => true,
                'ks_cart_edit_id' => $editId
            ]
        );

        $form = $builder->getForm();

        // ??????????????????????????????????????????
        $defaultGroupName = $this->configService->getKeyString(ConfigSetting::SETTING_KEY_GROUP_DEFAULT_NAME);

        // ?????????????????????????????????
        $tabExActive = $this->pluginLinkService->isActivePlugin('TagEx2');

        // Base ????????????????????????????????????
        $nonStockHidden = $this->BaseInfo->isOptionNostockHidden();

        // ???????????????
        $is_favorite = false;
        if ($this->isGranted('ROLE_USER')) {
            /** @var Customer $Customer */
            $Customer = $this->getUser();
            $is_favorite = $this->customerFavoriteProductRepository->isFavorite($Customer, $product);
        }

        return [
            'subtitle' => $product->getName(),
            'Product' => $product,
            'form' => $form->createView(),
            'editId' => $editId,
            'DefaultGroupName' => $defaultGroupName,
            'TabExActive' => $tabExActive,
            'NonStockHidden' => $nonStockHidden,
            'is_favorite' => $is_favorite,
        ];
    }

    /**
     * ??????????????????
     *
     * @Route("/products/select/add_cart/{id}", name="product_select_add_cart", methods={"POST", "GET"}, requirements={"id" = "\d+"})
     *
     * @param Request $request
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addCart(Request $request, Product $product)
    {

        // ?????????????????????????????????
        $errorMessages = [];
        if (!$this->checkVisibility($product)) {
            throw new NotFoundHttpException();
        }

        $builder = $this->formFactory->createNamedBuilder(
            '',
            AddCartType::class,
            null,
            [
                'product' => $product,
                'id_add_product_id' => false,
                'kokokara_select' => true,
            ]
        );

        /* @var $form \Symfony\Component\Form\FormInterface */
        $form = $builder->getForm();
        $form->handleRequest($request);

        if (!$form->isValid()) {
            throw new NotFoundHttpException();
        }

        /** @var CartItem $addCartData */
        $addCartData = $form->getData();

        log_info(
            '[KokokaraSelect]???????????????????????????????????????',
            [
                'product_id' => $product->getId(),
                'product_class_id' => $addCartData['product_class_id'],
                'quantity' => $addCartData['quantity'],
                'selectItems' => $addCartData['selectItems'],
            ]
        );

        // ?????????????????????????????????????????????
        $ksCartKey = $this->ksCartHelper->getKsCartKeyForce($form->get('ksCartKey')->getData());

        if (!$ksCartKey) {
            // ???????????????
            $this->cartService->addProduct($addCartData['product_class_id'], $addCartData['quantity']);
        }

        // CartItem????????????????????????
        $activeKsCartKey = $this->ksCartHelper->setKsCartSelectItemGroup($this->cartService->getCarts(), $ksCartKey, $form);
        $this->ksService->setActiveKsCartKey($activeKsCartKey);

        // ??????????????????
        $Carts = $this->cartService->getCarts();
        foreach ($Carts as $Cart) {
            // ????????????????????????????????????
            $Cart->setPreOrderId(null);

            $result = $this->purchaseFlow->validate($Cart, new PurchaseContext($Cart, $this->getUser()));
            // ???????????????????????????????????????????????????????????????????????????.
            if ($result->hasError()) {
                $this->cartService->removeProduct($addCartData['product_class_id']);
                foreach ($result->getErrors() as $error) {
                    $errorMessages[] = $error->getMessage();
                }
            }
            foreach ($result->getWarning() as $warning) {
                $errorMessages[] = $warning->getMessage();
            }
        }

        $selectItemGroupCount = 0;
        // ??????????????????????????????????????????????????????????????????
        if (count($errorMessages) > 0 && !$ksCartKey) {
            $selectItemGroupCount = $this->ksCartHelper->removeKsCartSelectItemGroup($Carts, $activeKsCartKey);
        }

        $this->cartService->save();

        if (count($errorMessages) > 0 && !$ksCartKey) {
            if ($selectItemGroupCount === 0) {
                // Group???????????????0?????????????????????
                $this->cartService->removeProduct($addCartData['product_class_id']);
            } else if ($selectItemGroupCount > 0) {
                foreach ($this->cartService->getCarts() as $Cart) {
                    foreach ($Cart->getCartItems() as $cartItem) {
                        if ($cartItem->getProductClass()->getId() == $addCartData['product_class_id']) {
                            if ($cartItem->getQuantity() > $selectItemGroupCount) {
                                // ????????????????????????????????????
                                $this->cartService->addProduct($addCartData['product_class_id'], -1);
                            }
                        }
                    }
                }
            }

            // ???????????????
            foreach ($this->cartService->getCarts() as $Cart) {
                $this->purchaseFlow->validate($Cart, new PurchaseContext($Cart, $this->getUser()));
            }
            $this->cartService->save();
        }

        $this->ksService->setActiveKsCartKey(null);

        log_info(
            '[KokokaraSelect]???????????????????????????????????????',
            [
                'product_id' => $product->getId(),
                'product_class_id' => $addCartData['product_class_id'],
                'quantity' => $addCartData['quantity'],
                'selectItems' => $addCartData['selectItems'],
            ]
        );

        if ($request->isXmlHttpRequest()) {
            // ajax??????????????????????????????????????????json??????????????????

            // ?????????
            $done = null;
            $messages = [];

            if (empty($errorMessages)) {
                // ???????????????????????????????????????
                $done = true;
                array_push($messages, trans('front.product.add_cart_complete'));
            } else {
                // ????????????????????????????????????
                $done = false;
                $messages = $errorMessages;
            }

            return $this->json(['done' => $done, 'messages' => $messages]);
        } else {
            // ajax???????????????????????????????????????????????????????????????????????????
            foreach ($errorMessages as $errorMessage) {
                $this->addRequestError($errorMessage);
            }

            return $this->redirectToRoute('cart');
        }

    }

    /**
     * @Route("/products/select/list/{id}/delete/{editId}", name="kokokara_select_list_delete", methods={"PUT"}, requirements={"id" = "\d+", "eidtId" = "\d+"})
     *
     * @param Request $request
     * @param ProductClass $productClass
     * @param null $editId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCartSelectItemGroup(Request $request, ProductClass $productClass, $editId)
    {

        log_info('[KokokaraSelect]?????????????????????????????????', ['product_class_id' => $productClass->getId(), 'editId' => $editId]);

        $product = $productClass->getProduct();

        if (!$this->checkVisibility($product)) {
            log_info('???????????????????????????????????????????????????redirect', ['product_class_id' => $productClass->getId()]);

            return $this->redirectToRoute('cart');
        }

        // Key????????????
        if (!$this->ksCartHelper->checkKsCartKey($this->cartService->getCarts(), $product, $editId)) {
            log_info('????????????????????????ID', ['editId' => $editId]);
            throw new NotFoundHttpException();
        }

        // ???????????????????????????
        $Carts = $this->cartService->getCarts();
        $ksCartKey = $this->ksCartHelper->getKsCartKeyForce($editId);

        $selectItemGroupCount = $this->ksCartHelper->removeKsCartSelectItemGroup($Carts, $ksCartKey);

        if ($selectItemGroupCount == 0) {
            // Group???????????????0?????????????????????
            $this->cartService->removeProduct($productClass);
        } else {
            $this->cartService->addProduct($productClass, -1);
        }

        // ???????????????????????????????????????????????????
        $Carts = $this->cartService->getCarts();
        $this->execPurchaseFlow($Carts);

        log_info('[KokokaraSelect]?????????????????????????????????', ['product_class_id' => $productClass->getId(), 'editId' => $editId]);

        return $this->redirectToRoute('cart');
    }

    /**
     * ??????????????????????????????????????????
     *
     * @param Product $Product
     *
     * @return boolean ????????????????????????true
     */
    private function checkVisibility(Product $Product)
    {
        $is_admin = $this->session->has('_security_admin');

        // ??????????????????????????????????????????????????????????????????????????????????????????.
        if (!$is_admin) {
            // ??????????????????????????????????????????????????????.
            if ($Product->getStatus()->getId() !== ProductStatus::DISPLAY_SHOW) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $Carts
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function execPurchaseFlow($Carts)
    {
        /** @var PurchaseFlowResult[] $flowResults */
        $flowResults = array_map(function ($Cart) {
            $purchaseContext = new PurchaseContext($Cart, $this->getUser());

            return $this->purchaseFlow->validate($Cart, $purchaseContext);
        }, $Carts);

        // ????????????????????????????????????????????????????????????????????????????????????
        $hasError = false;
        foreach ($flowResults as $result) {
            if ($result->hasError()) {
                $hasError = true;
                foreach ($result->getErrors() as $error) {
                    $this->addRequestError($error->getMessage());
                }
            }
        }
        if ($hasError) {
            $this->cartService->clear();

            return $this->redirectToRoute('cart');
        }

        $this->cartService->save();

        foreach ($flowResults as $index => $result) {
            foreach ($result->getWarning() as $warning) {
                if ($Carts[$index]->getItems()->count() > 0) {
                    $cart_key = $Carts[$index]->getCartKey();
                    $this->addRequestError($warning->getMessage(), "front.cart.${cart_key}");
                } else {
                    // ???????????????????????????????????????????????????????????????????????????
                    $this->addRequestError($warning->getMessage());
                }
            }
        }
    }
}
