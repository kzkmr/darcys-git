<?php

namespace Customize\Twig\Extension;

use Doctrine\Common\Collections;
use Doctrine\ORM\EntityManagerInterface;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Master\ProductStatus;
use Eccube\Entity\Product;
use Eccube\Entity\ProductClass;
use Customize\Repository\ProductRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TwigExtension extends \Twig_Extension
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * TwigExtension constructor.
     *
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EccubeConfig $eccubeConfig,
        ProductRepository $productRepository,
        TokenStorageInterface $tokenStorage
    ) {
        $this->entityManager = $entityManager;
        $this->eccubeConfig = $eccubeConfig;
        $this->productRepository = $productRepository;
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('CustomizeNewProduct', array($this, 'getCustomizeNewProduct')),
            new \Twig_SimpleFunction('CustomizeIceProduct', array($this, 'getCustomizeIceProduct')),
            new \Twig_SimpleFunction('CustomizeCoffeeProduct', array($this, 'getCustomizeCoffeeProduct')),
            new \Twig_SimpleFunction('CustomizeBreadProduct', array($this, 'getCustomizeBreadProduct')),
        );
    }

    /**
     * Name of this extension
     *
     * @return string
     */
    public function getName()
    {
        return 'CustomizeTwigExtension';
    }

    /**
     *
     * 新着商品を3件返す
     *
     * @return Products|null
     */
    public function getCustomizeNewProduct()
    {
        try {
            //検索条件の新着順を定義
            $searchData = array();
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select("plob")
                ->from("Eccube\\Entity\\Master\\ProductListOrderBy", "plob")
                ->where('plob.id = :id')
                ->setParameter('id', $this->eccubeConfig['eccube_product_order_newer'])
                ->getQuery();
            $searchData['orderby'] = $query->getOneOrNullResult();

            //商品情報を3件取得
            //$qb = $this->productRepository->getQueryBuilderBySearchData($searchData);
            $LoginTypeInfo = $this->getLoginTypeInfo();
            $qb = $this->productRepository->getQueryBuilderBySearchDataWithLoginTypeInfo($searchData, $LoginTypeInfo);
            $query = $qb->setMaxResults(3)->getQuery();
            $products = $query->getResult();
            return $products;

        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    /**
     *
     * アイスクリームの商品を返す
     *
     * @return Products|null
     */
    public function getCustomizeIceProduct()
    {
        try {
            //検索条件の新着順を定義
            $searchData = array();
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select("plob")
                ->from("Eccube\\Entity\\Master\\ProductListOrderBy", "plob")
                ->where('plob.id = :id')
                ->setParameter('id', $this->eccubeConfig['eccube_product_order_newer'])
                ->getQuery();
            $searchData['orderby'] = $query->getOneOrNullResult();

            //カテゴリの指定
            $cat_id = 1;
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select("ctg")
                ->from("Eccube\\Entity\\Category", "ctg")
                ->where('ctg.id = :id')
                ->setParameter('id', $cat_id)
                ->getQuery();
            $searchData['category_id'] = $query->getOneOrNullResult();

            //商品情報を全件取得
            //$qb = $this->productRepository->getQueryBuilderBySearchData($searchData);
            $LoginTypeInfo = $this->getLoginTypeInfo();
            $qb = $this->productRepository->getQueryBuilderBySearchDataWithLoginTypeInfo($searchData, $LoginTypeInfo);
            $query = $qb->getQuery();
            $products = $query->getResult();
            return $products;

        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    /**
     *
     * コーヒーの商品を返す
     *
     * @return Products|null
     */
    public function getCustomizeCoffeeProduct()
    {
        try {
            //検索条件の新着順を定義
            $searchData = array();
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select("plob")
                ->from("Eccube\\Entity\\Master\\ProductListOrderBy", "plob")
                ->where('plob.id = :id')
                ->setParameter('id', $this->eccubeConfig['eccube_product_order_newer'])
                ->getQuery();
            $searchData['orderby'] = $query->getOneOrNullResult();

            //カテゴリの指定
            $cat_id = 2;
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select("ctg")
                ->from("Eccube\\Entity\\Category", "ctg")
                ->where('ctg.id = :id')
                ->setParameter('id', $cat_id)
                ->getQuery();
            $searchData['category_id'] = $query->getOneOrNullResult();

            //商品情報を全件取得
            //$qb = $this->productRepository->getQueryBuilderBySearchData($searchData);
            $LoginTypeInfo = $this->getLoginTypeInfo();
            $qb = $this->productRepository->getQueryBuilderBySearchDataWithLoginTypeInfo($searchData, $LoginTypeInfo);
            $query = $qb->getQuery();
            $products = $query->getResult();
            return $products;

        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    /**
     *
     * ブレッドの商品を返す
     *
     * @return Products|null
     */
    public function getCustomizeBreadProduct()
    {
        try {
            //検索条件の新着順を定義
            $searchData = array();
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select("plob")
                ->from("Eccube\\Entity\\Master\\ProductListOrderBy", "plob")
                ->where('plob.id = :id')
                ->setParameter('id', $this->eccubeConfig['eccube_product_order_newer'])
                ->getQuery();
            $searchData['orderby'] = $query->getOneOrNullResult();

            //カテゴリの指定
            $cat_id = 5;
            $qb = $this->entityManager->createQueryBuilder();
            $query = $qb->select("ctg")
                ->from("Eccube\\Entity\\Category", "ctg")
                ->where('ctg.id = :id')
                ->setParameter('id', $cat_id)
                ->getQuery();
            $searchData['category_id'] = $query->getOneOrNullResult();

            //商品情報を全件取得
            //$qb = $this->productRepository->getQueryBuilderBySearchData($searchData);
            $LoginTypeInfo = $this->getLoginTypeInfo();
            $qb = $this->productRepository->getQueryBuilderBySearchDataWithLoginTypeInfo($searchData, $LoginTypeInfo);
            $query = $qb->getQuery();
            $products = $query->getResult();
            return $products;

        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    private function getLoginTypeInfo()
    {
        $LoginType = 1;         //Default is guest
        $Customer = $this->getCurrentUser();
        $ChainStore = null;
        $ContractType = null;

        if (is_object($Customer)) {
            $ChainStore = $Customer->getChainStore();

            if(is_object($ChainStore)){
                $LoginType = 3;         //ChainStore member
                $ContractType = $ChainStore->getContractType();
            }else{
                $LoginType = 2;         //Normal member
            }
        }else{
            $Customer = null;
        }

        return [
            'LoginType' => $LoginType,
            'Customer' => $Customer,
            'ChainStore' => $ChainStore,
            'ContractType' => $ContractType,
        ];
    }

    private function getCurrentUser()
    {
        if(!$this->tokenStorage){
            return null;
        }

        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        if (!$token->isAuthenticated()) {
            return null;
        }

        if(!$user = $token->getUser()){
            return null;
        }

        if(is_object($user)){
            return $user;
        }

        return null;
    }
}