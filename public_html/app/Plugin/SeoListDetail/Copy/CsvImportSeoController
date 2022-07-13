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

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Eccube\Common\Constant;
use Eccube\Controller\Admin\AbstractCsvImportController;
use Eccube\Entity\BaseInfo;
use Eccube\Entity\Category;
use Eccube\Entity\Product;
use Eccube\Entity\ProductCategory;
use Eccube\Entity\ProductClass;
use Eccube\Entity\ProductImage;
use Eccube\Entity\ProductStock;
use Eccube\Entity\ProductTag;
use Eccube\Form\Type\Admin\CsvImportType;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\CategoryRepository;
use Eccube\Repository\ClassCategoryRepository;
use Eccube\Repository\DeliveryDurationRepository;
use Eccube\Repository\Master\ProductStatusRepository;
use Eccube\Repository\Master\SaleTypeRepository;
use Eccube\Repository\ProductRepository;
use Eccube\Repository\TagRepository;
use Eccube\Service\CsvImportService;
use Eccube\Util\CacheUtil;
use Eccube\Util\StringUtil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CsvImportSeoController extends AbstractCsvImportController
{
    /**
     * @var DeliveryDurationRepository
     */
    protected $deliveryDurationRepository;

    /**
     * @var SaleTypeRepository
     */
    protected $saleTypeRepository;

    /**
     * @var TagRepository
     */
    protected $tagRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var ClassCategoryRepository
     */
    protected $classCategoryRepository;

    /**
     * @var ProductStatusRepository
     */
    protected $productStatusRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var BaseInfo
     */
    protected $BaseInfo;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    private $errors = [];

    /**
     * CsvImportController constructor.
     *
     * @param DeliveryDurationRepository $deliveryDurationRepository
     * @param SaleTypeRepository $saleTypeRepository
     * @param TagRepository $tagRepository
     * @param CategoryRepository $categoryRepository
     * @param ClassCategoryRepository $classCategoryRepository
     * @param ProductStatusRepository $productStatusRepository
     * @param ProductRepository $productRepository
     * @param BaseInfoRepository $baseInfoRepository
     * @param ValidatorInterface $validator
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __construct(
        DeliveryDurationRepository $deliveryDurationRepository,
        SaleTypeRepository $saleTypeRepository,
        TagRepository $tagRepository,
        CategoryRepository $categoryRepository,
        ClassCategoryRepository $classCategoryRepository,
        ProductStatusRepository $productStatusRepository,
        ProductRepository $productRepository,
        BaseInfoRepository $baseInfoRepository,
        ValidatorInterface $validator
    ) {
        $this->deliveryDurationRepository = $deliveryDurationRepository;
        $this->saleTypeRepository = $saleTypeRepository;
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
        $this->classCategoryRepository = $classCategoryRepository;
        $this->productStatusRepository = $productStatusRepository;
        $this->productRepository = $productRepository;
        $this->BaseInfo = $baseInfoRepository->get();
        $this->validator = $validator;
    }

    /**
     * 商品登録CSVアップロード
     *
     * @Route("/%eccube_admin_route%/product/product_csv_upload_seo", name="admin_product_csv_import_seo")
     * @Template("@admin/Product/csv_product_seo.twig")
     */
    public function csvProduct(Request $request, CacheUtil $cacheUtil)
    {
        $form = $this->formFactory->createBuilder(CsvImportType::class)->getForm();
        $headers = $this->getProductCsvHeader();
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $formFile = $form['import_file']->getData();
                if (!empty($formFile)) {
                    log_info('商品CSV登録開始');
                    $data = $this->getImportData($formFile);
                    if ($data === false) {
                        $this->addErrors(trans('admin.common.csv_invalid_format'));

                        return $this->renderWithError($form, $headers, false);
                    }
                    $getId = function ($item) {
                        return $item['id'];
                    };
                    $requireHeader = array_keys(array_map($getId, array_filter($headers, function ($value) {
                        return $value['required'];
                    })));

                    $columnHeaders = $data->getColumnHeaders();

                    if (count(array_diff($requireHeader, $columnHeaders)) > 0) {
                        $this->addErrors(trans('admin.common.csv_invalid_format'));

                        return $this->renderWithError($form, $headers, false);
                    }

                    $size = count($data);

                    if ($size < 1) {
                        $this->addErrors(trans('admin.common.csv_invalid_no_data'));

                        return $this->renderWithError($form, $headers, false);
                    }

                    $headerSize = count($columnHeaders);
                    $headerByKey = array_flip(array_map($getId, $headers));
                    $deleteImages = [];

                    $this->entityManager->getConfiguration()->setSQLLogger(null);
                    $this->entityManager->getConnection()->beginTransaction();
                    // CSVファイルの登録処理
                    foreach ($data as $row) {
                        $line = $data->key() + 1;
                        if ($headerSize != count($row)) {
                            $message = trans('admin.common.csv_invalid_format_line', ['%line%' => $line]);
                            $this->addErrors($message);

                            return $this->renderWithError($form, $headers);
                        }

                        if (!isset($row[$headerByKey['id']]) || StringUtil::isBlank($row[$headerByKey['id']])) {
                            $Product = new Product();
                            $this->entityManager->persist($Product);
                        } else {
                            if (preg_match('/^\d+$/', $row[$headerByKey['id']])) {
                                $Product = $this->productRepository->find($row[$headerByKey['id']]);
                                if (!$Product) {
                                    $message = trans('admin.common.csv_invalid_not_found', ['%line%' => $line, '%name%' => $headerByKey['id']]);
                                    $this->addErrors($message);

                                    return $this->renderWithError($form, $headers);
                                }
                            } else {
                                $message = trans('admin.common.csv_invalid_not_found', ['%line%' => $line, '%name%' => $headerByKey['id']]);
                                $this->addErrors($message);

                                return $this->renderWithError($form, $headers);
                            }
                        }

                        if (isset($row[$headerByKey['itoben_seo_title']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_title']])) {
                            $Product->setItobenSeoTitle(StringUtil::trimAll($row[$headerByKey['itoben_seo_title']]));
                        } else {
                            $Product->setItobenSeoTitle(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_author']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_author']])) {
                            $Product->setItobenSeoAuthor(StringUtil::trimAll($row[$headerByKey['itoben_seo_author']]));
                        } else {
                            $Product->setItobenSeoAuthor(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_description']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_description']])) {
                            $Product->setItobenSeoDescription(StringUtil::trimAll($row[$headerByKey['itoben_seo_description']]));
                        } else {
                            $Product->setItobenSeoDescription(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_keyword']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_keyword']])) {
                            $Product->setItobenSeoKeyword(StringUtil::trimAll($row[$headerByKey['itoben_seo_keyword']]));
                        } else {
                            $Product->setItobenSeoKeyword(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_meta_robots']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_meta_robots']])) {
                            $Product->setItobenSeoMetaRobots(StringUtil::trimAll($row[$headerByKey['itoben_seo_meta_robots']]));
                        } else {
                            $Product->setItobenSeoMetaRobots(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_meta_tags']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_meta_tags']])) {
                            $Product->setItobenSeoMetaTags(StringUtil::trimAll($row[$headerByKey['itoben_seo_meta_tags']]));
                        } else {
                            $Product->setItobenSeoMetaTags(null);
                        }

                        $this->entityManager->flush();


                        if ($this->hasErrors()) {
                            return $this->renderWithError($form, $headers);
                        }
                        $this->entityManager->persist($Product);
                    }
                    $this->entityManager->flush();
                    $this->entityManager->getConnection()->commit();

                    log_info('商品CSV登録完了');
                    $message = 'admin.common.csv_upload_complete';
                    $this->session->getFlashBag()->add('eccube.admin.success', $message);

                    $cacheUtil->clearDoctrineCache();
                }
            }
        }

        return $this->renderWithError($form, $headers);
    }

    /**
     * カテゴリ登録CSVアップロード
     *
     * @Route("/%eccube_admin_route%/product/category_csv_upload_seo", name="admin_product_category_csv_import_seo")
     * @Template("@admin/Product/csv_category_seo.twig")
     */
    public function csvCategory(Request $request, CacheUtil $cacheUtil)
    {
        $form = $this->formFactory->createBuilder(CsvImportType::class)->getForm();

        $headers = $this->getCategoryCsvHeader();
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $formFile = $form['import_file']->getData();
                if (!empty($formFile)) {
                    log_info('カテゴリCSV登録開始');
                    $data = $this->getImportData($formFile);
                    if ($data === false) {
                        $this->addErrors(trans('admin.common.csv_invalid_format'));

                        return $this->renderWithError($form, $headers, false);
                    }

                    $getId = function ($item) {
                        return $item['id'];
                    };
                    $requireHeader = array_keys(array_map($getId, array_filter($headers, function ($value) {
                        return $value['required'];
                    })));

                    $headerByKey = array_flip(array_map($getId, $headers));

                    $columnHeaders = $data->getColumnHeaders();
                    if (count(array_diff($requireHeader, $columnHeaders)) > 0) {
                        $this->addErrors(trans('admin.common.csv_invalid_format'));

                        return $this->renderWithError($form, $headers, false);
                    }

                    $size = count($data);
                    if ($size < 1) {
                        $this->addErrors(trans('admin.common.csv_invalid_no_data'));

                        return $this->renderWithError($form, $headers, false);
                    }
                    $this->entityManager->getConfiguration()->setSQLLogger(null);
                    $this->entityManager->getConnection()->beginTransaction();
                    // CSVファイルの登録処理
                    foreach ($data as $row) {
                        /** @var $Category Category */
                        $Category = new Category();
                        if (isset($row[$headerByKey['id']]) && strlen($row[$headerByKey['id']]) > 0) {
                            if (!preg_match('/^\d+$/', $row[$headerByKey['id']])) {
                                $this->addErrors(($data->key() + 1).'行目のカテゴリIDが存在しません。');

                                return $this->renderWithError($form, $headers);
                            }
                            $Category = $this->categoryRepository->find($row[$headerByKey['id']]);
                            if (!$Category) {
                                $this->addErrors(($data->key() + 1).'行目のカテゴリIDが存在しません。');

                                return $this->renderWithError($form, $headers);
                            }
                        }
						
                        if (!isset($row[$headerByKey['category_name']]) || StringUtil::isBlank($row[$headerByKey['category_name']])) {
                            $this->addErrors(($data->key() + 1).'行目のカテゴリ名が設定されていません。');

                            return $this->renderWithError($form, $headers);
                        } else {
                            $Category->setName(StringUtil::trimAll($row[$headerByKey['category_name']]));
                        }

                        if (isset($row[$headerByKey['itoben_seo_title']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_title']])) {
                            $Category->setItobenSeoTitle(StringUtil::trimAll($row[$headerByKey['itoben_seo_title']]));
                        } else {
                            $Category->setItobenSeoTitle(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_author']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_author']])) {
                            $Category->setItobenSeoAuthor(StringUtil::trimAll($row[$headerByKey['itoben_seo_author']]));
                        } else {
                            $Category->setItobenSeoAuthor(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_description']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_description']])) {
                            $Category->setItobenSeoDescription(StringUtil::trimAll($row[$headerByKey['itoben_seo_description']]));
                        } else {
                            $Category->setItobenSeoDescription(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_keyword']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_keyword']])) {
                            $Category->setItobenSeoKeyword(StringUtil::trimAll($row[$headerByKey['itoben_seo_keyword']]));
                        } else {
                            $Category->setItobenSeoKeyword(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_meta_robots']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_meta_robots']])) {
                            $Category->setItobenSeoMetaRobots(StringUtil::trimAll($row[$headerByKey['itoben_seo_meta_robots']]));
                        } else {
                            $Category->setItobenSeoMetaRobots(null);
                        }
                        if (isset($row[$headerByKey['itoben_seo_meta_tags']]) && StringUtil::isNotBlank($row[$headerByKey['itoben_seo_meta_tags']])) {
                            $Category->setItobenSeoMetaTags(StringUtil::trimAll($row[$headerByKey['itoben_seo_meta_tags']]));
                        } else {
                            $Category->setItobenSeoMetaTags(null);
                        }

                        if ($this->hasErrors()) {
                            return $this->renderWithError($form, $headers);
                        }
                        $this->entityManager->persist($Category);
                        $this->categoryRepository->save($Category);
                    }

                    $this->entityManager->getConnection()->commit();
                    log_info('カテゴリCSV登録完了');
                    $message = 'admin.common.csv_upload_complete';
                    $this->session->getFlashBag()->add('eccube.admin.success', $message);

                    $cacheUtil->clearDoctrineCache();
                }
            }
        }

        return $this->renderWithError($form, $headers);
    }

    /**
     * アップロード用CSV雛形ファイルダウンロード
     *
     * @Route("/%eccube_admin_route%/product/csv_template_seo/{type}", requirements={"type" = "\w+"}, name="admin_product_csv_template_seo")
     */
    public function csvTemplate(Request $request, $type)
    {
        if ($type == 'product') {
            $headers = $this->getProductCsvHeader();
            $filename = 'product_seo.csv';
        } elseif ($type == 'category') {
            $headers = $this->getCategoryCsvHeader();
            $filename = 'category_seo.csv';
        } else {
            throw new NotFoundHttpException();
        }

        return $this->sendTemplateResponse($request, array_keys($headers), $filename);
    }

    /**
     * 登録、更新時のエラー画面表示
     *
     * @param FormInterface $form
     * @param array $headers
     * @param bool $rollback
     *
     * @return array
     *
     * @throws \Doctrine\DBAL\ConnectionException
     */
    protected function renderWithError($form, $headers, $rollback = true)
    {
        if ($this->hasErrors()) {
            if ($rollback) {
                $this->entityManager->getConnection()->rollback();
            }
        }

        $this->removeUploadedFile();

        return [
            'form' => $form->createView(),
            'headers' => $headers,
            'errors' => $this->errors,
        ];
    }

    /**
     * 登録、更新時のエラー画面表示
     */
    protected function addErrors($message)
    {
        $this->errors[] = $message;
    }

    /**
     * @return array
     */
    protected function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return boolean
     */
    protected function hasErrors()
    {
        return count($this->getErrors()) > 0;
    }

    /**
     * 商品登録CSVヘッダー定義
     *
     * @return array
     */
    private function getProductCsvHeader()
    {
        return [
            trans('admin.product.product_csv.product_id_col') => [
                'id' => 'id',
                'description' => 'plg_seo_csv.product_id_description',
                'required' => true,
            ],
            trans('title') => [
                'id' => 'itoben_seo_title',
                'description' => '',
                'required' => false,
            ],
            trans('author') => [
                'id' => 'itoben_seo_author',
                'description' => '',
                'required' => false,
            ],
            trans('description') => [
                'id' => 'itoben_seo_description',
                'description' => '',
                'required' => false,
            ],
            trans('keyword') => [
                'id' => 'itoben_seo_keyword',
                'description' => '',
                'required' => false,
            ],
            trans('meta_robots') => [
                'id' => 'itoben_seo_meta_robots',
                'description' => '',
                'required' => false,
            ],
            trans('meta_tags') => [
                'id' => 'itoben_seo_meta_tags',
                'description' => '',
                'required' => false,
            ],
        ];
    }

    /**
     * カテゴリCSVヘッダー定義
     */
    private function getCategoryCsvHeader()
    {
        return [
            trans('admin.product.category_csv.category_id_col') => [
                'id' => 'id',
                'description' => 'plg_seo_csv.category_id_description',
                'required' => true,
            ],
            trans('admin.product.category_csv.category_name_col') => [
                'id' => 'category_name',
                'description' => 'admin.product.category_csv.category_name_description',
                'required' => true,
            ],
            trans('title') => [
                'id' => 'itoben_seo_title',
                'description' => '',
                'required' => false,
            ],
            trans('author') => [
                'id' => 'itoben_seo_author',
                'description' => '',
                'required' => false,
            ],
            trans('description') => [
                'id' => 'itoben_seo_description',
                'description' => '',
                'required' => false,
            ],
            trans('keyword') => [
                'id' => 'itoben_seo_keyword',
                'description' => '',
                'required' => false,
            ],
            trans('meta_robots') => [
                'id' => 'itoben_seo_meta_robots',
                'description' => '',
                'required' => false,
            ],
            trans('meta_tags') => [
                'id' => 'itoben_seo_meta_tags',
                'description' => '',
                'required' => false,
            ],
        ];
    }

}
