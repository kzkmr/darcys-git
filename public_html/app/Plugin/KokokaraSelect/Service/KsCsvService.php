<?php
/**
 * Copyright(c) 2020 SYSTEM_KD
 * Date: 2020/07/24
 */

namespace Plugin\KokokaraSelect\Service;


use Eccube\Common\EccubeConfig;
use Eccube\Entity\ClassCategory;
use Eccube\Entity\Product;
use Eccube\Entity\ProductClass;
use Plugin\KokokaraSelect\Entity\KsProduct;
use Plugin\KokokaraSelect\Entity\KsProductOption;
use Plugin\KokokaraSelect\Entity\KsSelectItem;
use Plugin\KokokaraSelect\Entity\KsSelectItemGroup;
use Plugin\KokokaraSelect\Entity\KsSelectItemStock;
use Plugin\KokokaraSelect\Service\MultiCSVService\CsvEntityManagerService;
use Plugin\KokokaraSelect\Service\MultiCSVService\Entity\CsvCheckFunctionArgs;
use Plugin\KokokaraSelect\Service\MultiCSVService\Entity\CsvCheckResult;
use Plugin\KokokaraSelect\Service\MultiCSVService\Entity\CsvUpdateFunctionArgs;
use Plugin\KokokaraSelect\Service\MultiCSVService\MultiCsvService;

class KsCsvService
{

    /** @var MultiCsvService */
    protected $multiCSVService;

    /** @var CsvEntityManagerService */
    protected $csvEntityManagerService;

    /** @var KsService */
    protected $ksService;

    /** @var KsOrderService */
    protected $ksOrderService;

    /** @var KsSelectItemService */
    protected $ksSelectItemService;

    /** @var array */
    protected $ksProductFlg;

    /** @var array */
    protected $groupSettingFlg;

    /** @var EccubeConfig */
    protected $eccubeConfig;

    /** @var KsCsvHelper */
    protected $ksCsvHelper;

    protected $directSelect = false;

    public function __construct(
        MultiCsvService $multiCSVService,
        CsvEntityManagerService $csvEntityManagerService,
        KsService $ksService,
        KsOrderService $ksOrderService,
        KsSelectItemService $ksSelectItemService,
        EccubeConfig $eccubeConfig,
        KsCsvHelper $ksCsvHelper
    )
    {
        $this->multiCSVService = $multiCSVService;
        $this->csvEntityManagerService = $csvEntityManagerService;
        $this->ksService = $ksService;
        $this->ksOrderService = $ksOrderService;
        $this->ksSelectItemService = $ksSelectItemService;
        $this->eccubeConfig = $eccubeConfig;
        $this->ksCsvHelper = $ksCsvHelper;

        $this->ksProductFlg = [];
        $this->groupSettingFlg = [];
    }

    /**
     * ??????????????????????????????
     *
     * @param boolean $directSelect true:????????????
     * @return $this
     */
    public function setDirectSelect(bool $directSelect)
    {
        $this->directSelect = $directSelect;
        return $this;
    }

    /**
     * ??????ID????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkProductId(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        // ??????ID
        $value = $args->getColData();

        // ????????????
        $colName = $args->getColName();

        // ??????ID????????????
        if (!$this->multiCSVService->isNumber($value)) {
            $message = trans('admin.common.csv_invalid_not_found', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        // ??????????????????
        /** @var Product $product */
        $product = $this->csvEntityManagerService->findEntity(Product::class, $value);

        if (!$product) {
            $message = trans('admin.common.csv_invalid_not_found', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        // ???????????????????????????
        if ($product->hasProductClass()) {
            $message = trans('kokokara_select.csv.error.has_product_class', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        // ??????????????????
        if ($this->ksSelectItemService->isSetting($product)) {
            $message = trans('kokokara_select.csv.error.ks_product', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        // ????????????????????????
        if (!$this->ksService->isKsProduct($product)
            && $this->ksOrderService->isBuyIngProduct($product)) {
            $message = trans('kokokara_select.csv.error.buying', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkDescription(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        $value = $args->getColData();

        if (!empty($value)) {
            $max = $this->eccubeConfig['eccube_ltext_len'];
            $message = $this->ksCsvHelper->checkMaxLength($args, $max);
            if (!empty($message)) {
                $result->setMessage($message);

                return $result;
            }
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ?????????????????????????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkPriceView(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        // ?????????????????????????????????
        $value = $args->getColData();

        // ????????????
        $colName = $args->getColName();

        if (!$this->multiCSVService->isBlank($value)) {

            // ??????????????????
            if (!$this->multiCSVService->isNumber($value)) {
                $message = trans('admin.common.csv_invalid_greater_than_zero', ['%line%' => $args->getLine(), '%name%' => $colName]);
                $result->setMessage($message);

                return $result;
            }
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ??????????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkGroupNo(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        // ??????????????????
        $value = $args->getColData();

        // ????????????
        $colName = $args->getColName();

        // ??????????????????????????????
        if (!$this->multiCSVService->isNumber($value)) {
            $message = trans('kokokara_select.csv.error.number', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        if ($value <= 0) {
            $message = trans('kokokara_select.csv.error.number', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ???????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkGroupName(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        $value = $args->getColData();

        if (!empty($value)) {
            $max = $this->eccubeConfig['eccube_stext_len'];
            $message = $this->ksCsvHelper->checkMaxLength($args, $max);
            if (!empty($message)) {
                $result->setMessage($message);

                return $result;
            }
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ??????????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkGroupDescription(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        $value = $args->getColData();

        if (!empty($value)) {
            $max = $this->eccubeConfig['eccube_ltext_len'];
            $message = $this->ksCsvHelper->checkMaxLength($args, $max);
            if (!empty($message)) {
                $result->setMessage($message);

                return $result;
            }
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ??????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkQuantity(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        // ????????????
        $value = $args->getColData();

        // ????????????
        $colName = $args->getColName();

        $key = $this->ksCsvHelper->getGroupSettingKey($args->getRowData());

        // ?????????????????????
        if (!isset($this->groupSettingFlg[$key])
            || $this->groupSettingFlg[$key] == $args->getLine()) {

            if ($this->multiCSVService->isBlank($value)) {
                $message = trans('kokokara_select.csv.error.number', ['%line%' => $args->getLine(), '%name%' => $colName]);
                $result->setMessage($message);

                return $result;
            }

            if (!$this->multiCSVService->isNumber($value)) {
                $message = trans('admin.common.csv_invalid_not_found', ['%line%' => $args->getLine(), '%name%' => $colName]);
                $result->setMessage($message);

                return $result;
            }

            if ($value <= 0) {
                $message = trans('kokokara_select.csv.error.number', ['%line%' => $args->getLine(), '%name%' => $colName]);
                $result->setMessage($message);

                return $result;
            }
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkDirectSelectQuantity(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        $colName = $args->getColName();

        // ????????????
        $value = $args->getColData();

        if (!$this->multiCSVService->isNumber($value)) {
            $message = trans('kokokara_select.csv.error.number', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        if ($value <= 0) {
            $message = trans('kokokara_select.csv.error.number', ['%line%' => $args->getLine(), '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkSelectProductId(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        // ???
        $line = $args->getLine();

        // ????????????ID
        $value = $args->getColData();

        $rowData = $args->getRowData();

        // ????????????ID1
        $classCategoryId1 = $rowData['????????????1(ID)'];

        // ????????????ID2
        $classCategoryId2 = $rowData['????????????2(ID)'];

        $productClass = $this->ksCsvHelper->getProductClass($value, $classCategoryId1, $classCategoryId2);

        if (!$productClass) {
            // ????????????????????????
            $message = trans('kokokara_select.csv.error.select.product.none', ['%line%' => $line, '%name%' => $args->getColName()]);
            $result->setMessage($message);
            return $result;
        }

        // ???????????????????????????????????????
        if ($this->ksService->isKsProduct($productClass)) {
            $message = trans('kokokara_select.csv.error.select.ng.product', ['%line%' => $args->getLine(), '%name%' => '????????????']);
            $result->setMessage($message);
            return $result;
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ????????????ID????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkClassCategory(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        // ???
        $line = $args->getLine();

        // ????????????ID????????????
        $value = $args->getColData();

        if ($this->multiCSVService->isBlank($value)) {
            // ????????????OK
            $result->setSuccess(true);
            return $result;
        } else {

            // ??????????????????
            if (!$this->multiCSVService->isNumber($value)) {
                $message = trans('admin.common.csv_invalid_greater_than_zero', ['%line%' => $line, '%name%' => '????????????ID']);
                $result->setMessage($message);

                return $result;
            }

            // ??????????????????
            $classCategory = $this->csvEntityManagerService->findEntity(ClassCategory::class, $value);

            if (!$classCategory) {
                $message = trans('admin.common.csv_invalid_not_found', ['%line%' => $args->getLine(), '%name%' => '????????????']);
                $result->setMessage($message);

                return $result;
            }
        }

        $result->setSuccess(true);

        return $result;
    }

    /**
     * ???????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkStock(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        $line = $args->getLine();

        // ?????????
        $value = $args->getColData();

        $colName = $args->getColName();

        if ($this->multiCSVService->isBlank($value)) {
            // ????????????OK?????????
            // ????????????????????????????????????????????????????????????????????????
            $result->setSuccess(true);
            return $result;
        }

        // ??????????????????
        if (!$this->multiCSVService->isNumber($value)) {
            $message = trans('admin.common.csv_invalid_greater_than_zero', ['%line%' => $line, '%name%' => $colName]);
            $result->setMessage($message);

            return $result;
        }

        // ????????????????????????
        $rowData = $args->getRowData();

        // ??????ID
        $productId = $rowData['????????????ID'];

        // ????????????ID1
        $classCategoryId1 = $rowData['????????????1(ID)'];

        // ????????????ID2
        $classCategoryId2 = $rowData['????????????2(ID)'];

        $targetProductClass = $this->ksCsvHelper->getProductClass($productId, $classCategoryId1, $classCategoryId2);

        if (!$targetProductClass->isStockUnlimited()) {
            if ($targetProductClass->getStock() < $value) {
                // ??????????????????
                $message = trans('kokokara_select.csv.error.stock', ['%line%' => $line, '%name%' => $colName]);
                $result->setMessage($message);

                return $result;
            }
        }

        $result->setSuccess(true);

        return $result;
    }

    /**
     * ?????????????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkStockUnlimited(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        $line = $args->getLine();

        // ???????????????????????????
        $value = $args->getColData();

        $colName = $args->getColName();

        // ?????????????????????????????????
        $message = trans('admin.common.csv_invalid_greater_than_zero', ['%line%' => $line, '%name%' => $colName]);

        if ($this->multiCSVService->isBlank($value)) {
            $result->setMessage($message);
            return $result;
        }

        if ($this->multiCSVService->isNumber($value)
            && $value >= 0) {

            if ($value == "0") {
                // ????????????????????????????????????
                $rowData = $args->getRowData();
                $stock = $rowData['???????????????'];

                if ($this->multiCSVService->isBlank($stock)) {
                    // ??????????????????NG
                    $message = trans('admin.common.csv_invalid_greater_than_zero', ['%line%' => $line, '%name%' => '???????????????']);
                    $result->setMessage($message);
                    return $result;
                }
            }

            $result->setSuccess(true);

        } else {
            // ?????????????????????????????????
            $result->setMessage($message);
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ???????????????????????????
     *
     * @param CsvCheckFunctionArgs $args
     * @return CsvCheckResult
     */
    public function checkSelectOnly(CsvCheckFunctionArgs $args)
    {
        $result = new CsvCheckResult();

        $line = $args->getLine();

        // ?????????????????????
        $value = $args->getColData();

        $colName = $args->getColName();

        if (!$this->multiCSVService->isBlank($value)
            && !$this->multiCSVService->isNumber($value)) {

            $message = trans('admin.common.csv_invalid_greater_than_zero', ['%line%' => $line, '%name%' => $colName]);
            $result->setMessage($message);
            return $result;
        }

        $result->setSuccess(true);
        return $result;
    }

    /**
     * ???????????????Entity??????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateProductId(CsvUpdateFunctionArgs $args)
    {
        $rowData = $args->getRowData();

        // ??????ID
        $productId = $rowData['?????????ID'];
        $productClass = $this->ksCsvHelper->getProductClass($productId);

        /** @var Product $product */
        $product = $productClass->getProduct();

        if (!$this->ksService->isKsProduct($product)) {
            $ksProduct = new KsProduct();
            $ksProduct
                ->setQuantity(0)
                ->setProduct($product)
                ->setDirectSelect($this->directSelect);
            $this->csvEntityManagerService->update($ksProduct);

            $product
                ->setKsProduct($ksProduct);
        } else {

            if (!isset($this->ksProductFlg[$productId])) {
                // SortNo??????
                $sortNo = 1;

                $ksProduct = $product->getKsProduct();
                $ksProduct->setDirectSelect($this->directSelect);

                /** @var KsSelectItemGroup $ksSelectItemGroup */
                foreach ($ksProduct->getKsSelectItemGroups() as $ksSelectItemGroup) {
                    $ksSelectItemGroup->setSortNo($sortNo);
                    $sortNo += 1;
                }

                $this->csvEntityManagerService->update($ksProduct);
            }
        }

        if (!isset($this->ksProductFlg[$productId])) {
            $this->ksProductFlg[$productId] = $args->getLine();
        }

        $args->setEntity($productClass);
    }

    /**
     * ??????????????????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateDescription(CsvUpdateFunctionArgs $args)
    {
        $rowData = $args->getRowData();
        $value = $args->getColData();

        $productId = $rowData['?????????ID'];

        if (!isset($this->ksProductFlg[$productId])) {
            return;
        }

        if ($this->ksProductFlg[$productId] == $args->getLine()) {
            // ?????????
            /** @var ProductClass $productClass */
            $productClass = $args->getEntity();

            $ksProduct = $productClass->getProduct()->getKsProduct();
            $ksProduct->setDescription($value);

            $this->csvEntityManagerService->update($ksProduct);
        }
    }

    /**
     * ?????????????????????????????????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updatePriceView(CsvUpdateFunctionArgs $args)
    {
        $rowData = $args->getRowData();
        $value = $args->getColData();

        $productId = $rowData['?????????ID'];

        if (!isset($this->ksProductFlg[$productId])) {
            return;
        }

        if ($this->ksProductFlg[$productId] == $args->getLine()) {
            // ?????????
            /** @var ProductClass $productClass */
            $productClass = $args->getEntity();

            $ksProduct = $productClass->getProduct()->getKsProduct();

            if ($value) {
                if ($value == 1) {
                    $ksProduct->setPriceView(true);
                } else {
                    $ksProduct->setPriceView(false);
                }
            } else {
                $ksProduct->setPriceView(false);
            }

            $this->csvEntityManagerService->update($ksProduct);
        }
    }

    /**
     * ??????????????????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateGroupNo(CsvUpdateFunctionArgs $args)
    {
        $rowData = $args->getRowData();
        $value = $args->getColData();

        /** @var ProductClass $productClass */
        $productClass = $args->getEntity();
        $ksProduct = $productClass->getProduct()->getKsProduct();

        $ksSelectItemGroup = $ksProduct->getKsSelectItemGroupBySortNo($value);

        if (!$ksSelectItemGroup) {
            // ????????????????????????
            $ksSelectItemGroup = new KsSelectItemGroup();
            $ksSelectItemGroup
                ->setKsProduct($ksProduct)
                ->setSortNo($value);

            $ksProduct->addKsSelectItemGroup($ksSelectItemGroup);

            $args->setEntity($productClass);
        }
    }

    /**
     * ????????????????????????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateGroupInfo(CsvUpdateFunctionArgs $args)
    {
        $rowData = $args->getRowData();
        $value = $args->getColData();

        $groupNo = $rowData['??????????????????'];

        $groupDescription = $rowData['??????????????????'];

        if (isset($rowData['????????????'])) {
            $groupQuantity = $rowData['????????????'];
        } else {
            // ?????????????????????
            $groupQuantity = 0;
        }

        /** @var ProductClass $productClass */
        $productClass = $args->getEntity();

        $key = $this->ksCsvHelper->getGroupSettingKey($rowData);

        if (isset($this->groupSettingFlg[$key])) {
            return;
        }

        $ksProduct = $productClass->getProduct()->getKsProduct();

        $ksSelectItemGroup = $ksProduct->getKsSelectItemGroupBySortNo($groupNo);

        if ($ksSelectItemGroup) {
            $ksSelectItemGroup
                ->setGroupName($value)
                ->setDescription($groupDescription)
                ->setQuantity($groupQuantity);

            // ??????
            $this->ksSelectItemService
                ->deleteRelationKsCartItem($ksSelectItemGroup->getKsSelectItems());

            // ?????????????????????
            /** @var KsSelectItem $ksSelectItem */
            foreach ($ksSelectItemGroup->getKsSelectItems() as $ksSelectItem) {

                $this->csvEntityManagerService->remove($ksSelectItem);
                $ksSelectItemGroup->removeKsSelectItem($ksSelectItem);
            }

            $this->csvEntityManagerService->update($ksSelectItemGroup);
        }

        if (empty($this->groupSettingFlg)) {
            $ksProduct->setQuantity(0);
        }

        // ??????????????????
        $ksProduct->setQuantity(($ksProduct->getQuantity() + $groupQuantity));

        $this->groupSettingFlg[$key] = $args->getLine();
    }


    /**
     * ?????????????????????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateStockUnlimited(CsvUpdateFunctionArgs $args)
    {
        $rowData = $args->getRowData();
        $value = $args->getColData();

        // KsSelectItem??????
        $productClass = $this->ksCsvHelper->getProductClass($rowData['?????????ID']);
        $ksSelectItem = $this->getKsSelectItem($productClass, $rowData);

        // ????????????
        if ($value == 0) {
            // ???????????????
            $stock = $rowData['???????????????'];

            // ????????????
            $ksSelectItem->setStock($stock);
            $ksSelectItem->setStockUnlimited(false);

            $ksSelectItemStock = $ksSelectItem->setKsSelectItemStock();
            $ksSelectItemStock->setStock($stock);

        } else {
            // ???????????????

            // ????????????
            $ksSelectItem
                ->setStock(null)
                ->setStockUnlimited(true);

            // ??????????????????????????????
            /** @var KsSelectItemStock $ksSelectItemStock */
            $ksSelectItemStock = $ksSelectItem->setKsSelectItemStock();
            $ksSelectItemStock->setStock(null);
        }

        $this->csvEntityManagerService->update($ksSelectItem);

        $args->setEntity($productClass);
    }

    private function getKsSelectItem(ProductClass $productClass, $rowData)
    {
        $ksProduct = $productClass->getProduct()->getKsProduct();

        $ksSelectItemGroup = $ksProduct->getKsSelectItemGroupBySortNo($rowData['??????????????????']);

        // ??????ID
        $productId = $rowData['????????????ID'];

        // ????????????ID1
        $classCategoryId1 = $rowData['????????????1(ID)'];

        // ????????????ID2
        $classCategoryId2 = $rowData['????????????2(ID)'];

        $targetProductClass = $this->ksCsvHelper->getProductClass($productId, $classCategoryId1, $classCategoryId2);
        $ksSelectItem = $this->ksCsvHelper->getKsSelectItem($ksSelectItemGroup, $targetProductClass->getId());

        if (!$ksSelectItem) {
            $ksSelectItem = new KsSelectItem();
            $ksSelectItem
                ->setProductClass($targetProductClass)
                ->setKsSelectItemGroup($ksSelectItemGroup)
                ->setSortNo(($ksSelectItemGroup->getKsSelectItems()->count() + 1));

            $ksSelectItemGroup->addKsSelectItem($ksSelectItem);
        }

        return $ksSelectItem;
    }

    /**
     * ??????????????????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateDirectSelectQuantity(CsvUpdateFunctionArgs $args)
    {
        $rowData = $args->getRowData();
        $value = $args->getColData();

        // KsSelectItem??????
        $productClass = $this->ksCsvHelper->getProductClass($rowData['?????????ID']);
        $ksSelectItem = $this->getKsSelectItem($productClass, $rowData);

        // ??????????????????
        $ksSelectItem->setQuantity($value);
        $this->csvEntityManagerService->update($ksSelectItem);

        // ????????????????????????
        $ksSelectItemGroup = $ksSelectItem->getKsSelectItemGroup();
        $quantity = $ksSelectItemGroup->getQuantity();
        $ksSelectItemGroup->setQuantity($quantity + $value);
        $this->csvEntityManagerService->update($ksSelectItemGroup);

        // ???????????????
        $ksProduct = $ksSelectItemGroup->getKsProduct();
        $ksProduct->setQuantity($ksProduct->getQuantity() + $value);

        $args->setEntity($productClass);
    }

    /**
     * ????????????????????????
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateSelectOnly(CsvUpdateFunctionArgs $args)
    {

        $rowData = $args->getRowData();
        $value = $args->getColData();

        // ??????ID
        $productId = $rowData['????????????ID'];

        // ????????????ID1
        $classCategoryId1 = $rowData['????????????1(ID)'];

        // ????????????ID2
        $classCategoryId2 = $rowData['????????????2(ID)'];

        $targetProductClass = $this->ksCsvHelper->getProductClass($productId, $classCategoryId1, $classCategoryId2);

        if ($targetProductClass) {

            $product = $targetProductClass->getProduct();
            $productOption = $product->getKsProductOption();
            if (!$productOption) {
                $productOption = new KsProductOption();
                $productOption
                    ->setProduct($product);
            }

            if ($value) {
                $productOption->setSelectOnly(true);
            } else {
                $productOption->setSelectOnly(false);
            }

            $this->csvEntityManagerService->update($productOption);

            $product->setKsProductOption($productOption);
        }
    }

    /**
     * ????????????Skip
     *
     * @param CsvUpdateFunctionArgs $args
     */
    public function updateSkip(CsvUpdateFunctionArgs $args)
    {
        return;
    }

    /**
     * CSV???????????????????????????
     */
    public function afterUpdate()
    {
        $checkData = [];
        foreach ($this->groupSettingFlg as $key => $item) {
            $data = explode('-', $key);
            $checkData[$data[0]][$data[1]] = true;
        }

        foreach ($checkData as $productId => $item) {

            /** @var Product $product */
            $product = $this->csvEntityManagerService->findEntity(Product::class, $productId);

            $ksProduct = $product->getKsProduct();

            $index = 1;
            /** @var KsSelectItemGroup $ksSelectItemGroup */
            foreach ($ksProduct->getKsSelectItemGroups() as $ksSelectItemGroup) {

                $sortNo = $ksSelectItemGroup->getSortNo();
                if (!isset($item[$sortNo])) {
                    // ??????
                    $this->ksSelectItemService
                        ->deleteRelationKsCartItem($ksSelectItemGroup->getKsSelectItems());

                    $this->csvEntityManagerService->remove($ksSelectItemGroup);
                } else {
                    // ?????????????????????
                    $ksSelectItemGroup->setSortNo($index);
                    $this->csvEntityManagerService->update($ksSelectItemGroup);
                    $index += 1;
                }
            }
        }
    }
}
