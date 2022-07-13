<?php
/*
* Plugin Name : DeliveryPlus4
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\DeliveryPlus4;

use Eccube\Repository\ProductClassRepository;
use Eccube\Event\EccubeEvents;
use Eccube\Event\TemplateEvent;
use Eccube\Event\EventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;

class DeliveryPlusEvent implements EventSubscriberInterface
{
    private $entityManager;

    private $productClassRepository;

    public function __construct(
            EntityManagerInterface $entityManager,
            ProductClassRepository $productClassRepository
            )
    {
        $this->entityManager = $entityManager;
        $this->productClassRepository = $productClassRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            '@admin/Setting/Shop/delivery_edit.twig' => 'onTemplateAdminSettingShopDeliveryEdit',
            EccubeEvents::ADMIN_PRODUCT_COPY_COMPLETE => 'hookAdminProductCopyComplete',
            '@admin/Product/product.twig' => 'onTemplateAdminProductEdit',
            '@admin/Product/product_class.twig' => 'onTemplateAdminProductClassEdit',
            'Product/list.twig' => 'onTemplateProductList',
            'Product/detail.twig' => 'onTemplateProductDetail',
            'Shopping/index.twig' => 'onTemplateShoppingIndex',
            'csvimportproductext.admin.product.csv.import.product.descriptions' => 'hookAdminProductCsvImportProductDescriptions',
            'csvimportproductext.admin.product.csv.import.product.check'=> 'hookAdminProductCsvImportProductCheck',
            'csvimportproductext.admin.product.csv.import.product.process' => 'hookAdminProductCsvImportProductProcess',
        ];
    }

    public function onTemplateAdminSettingShopDeliveryEdit(TemplateEvent $event)
    {
        $twig = '@DeliveryPlus4/admin/Setting/Shop/delivery_condition.twig';
        $event->addSnippet($twig);
        $js = '@DeliveryPlus4/admin/Setting/Shop/delivery_condition.js';
        $event->addAsset($js);
    }

    public function hookAdminProductCopyComplete(EventArgs $event)
    {
        $Product = $event->getArgument('Product');
        $CopyProduct = $event->getArgument('CopyProduct');
        $orgProductClasses = $Product->getProductClasses();

        foreach ($orgProductClasses as $ProductClass) {
            $CopyProductClass = $this->productClassRepository->findOneBy(['Product'=> $CopyProduct, 'ClassCategory1' => $ProductClass->getClassCategory1(), 'ClassCategory2' => $ProductClass->getClassCategory2()]);
            if($CopyProductClass){
                $CopyProductClass->setDeliveryplusWeight($ProductClass->getDeliveryplusWeight());
                $CopyProductClass->setDeliveryplusSize($ProductClass->getDeliveryplusSize());
                $this->entityManager->persist($CopyProductClass);
            }
        }

        $this->entityManager->flush();
    }

    public function onTemplateAdminProductEdit(TemplateEvent $event)
    {
        $twig = '@DeliveryPlus4/admin/Product/product_weight_size.twig';
        $event->addSnippet($twig);
        $js = '@DeliveryPlus4/admin/Product/product_weight_size.js';
        $event->addAsset($js);
    }

    public function onTemplateAdminProductClassEdit(TemplateEvent $event)
    {
        $twig = '@DeliveryPlus4/admin/Product/product_class_weight_size.twig';
        $event->addSnippet($twig);
        $js = '@DeliveryPlus4/admin/Product/product_class_weight_size.js';
        $event->addAsset($js);
    }

    public function onTemplateProductDetail(TemplateEvent $event)
    {
        $parameters = $event->getParameters();
        $Product = $parameters['Product'];


        $class_categories[$Product->getId()]['__unselected']['#'] = [
            'weight' => '',
            'size' => '',
        ];
        foreach($Product->getProductClasses() as $ProductClass){
            if(!$ProductClass->isVisible())continue;

            $ClassCategory1 = $ProductClass->getClassCategory1();
            $ClassCategory2 = $ProductClass->getClassCategory2();
            if ($ClassCategory2 && !$ClassCategory2->isVisible()) {
                continue;
            }
            $class_category_id1 = $ClassCategory1 ? (string) $ClassCategory1->getId() : '__unselected2';
            $class_category_id2 = $ClassCategory2 ? (string) $ClassCategory2->getId() : '';
            $class_category_name2 = $ClassCategory2 ? $ClassCategory2->getName().($ProductClass->getStockFind() ? '' : trans('product.text.out_of_stock')) : '';

            $class_categories[$Product->getId()][$class_category_id1]['#'] = [
                'weight' => '',
                'size' => '',
            ];
            $class_categories[$Product->getId()][$class_category_id1]['#'.$class_category_id2] = [
                'weight' => number_format($ProductClass->getDeliveryplusWeight(),2),
                'size' => number_format($ProductClass->getDeliveryplusSize(),2),
            ];
        }

        $parameters['DeliveryPlusParams'] = $class_categories;
        $event->setParameters($parameters);

        $twig = '@DeliveryPlus4/default/Product/product_js.twig';
        $event->addSnippet($twig);
    }

    public function onTemplateProductList(TemplateEvent $event)
    {
        $parameters = $event->getParameters();
        $pagination = $parameters['pagination'];

        $class_categories = [];

        foreach($pagination as $Product){
            $class_categories[$Product->getId()]['__unselected']['#'] = [
                'weight' => '',
                'size' => '',
            ];
            foreach($Product->getProductClasses() as $ProductClass){
                if(!$ProductClass->isVisible())continue;

                $ClassCategory1 = $ProductClass->getClassCategory1();
                $ClassCategory2 = $ProductClass->getClassCategory2();
                if ($ClassCategory2 && !$ClassCategory2->isVisible()) {
                    continue;
                }
                $class_category_id1 = $ClassCategory1 ? (string) $ClassCategory1->getId() : '__unselected2';
                $class_category_id2 = $ClassCategory2 ? (string) $ClassCategory2->getId() : '';
                $class_category_name2 = $ClassCategory2 ? $ClassCategory2->getName().($ProductClass->getStockFind() ? '' : trans('product.text.out_of_stock')) : '';

                $class_categories[$Product->getId()][$class_category_id1]['#'] = [
                    'weight' => '',
                    'size' => '',
                ];
                $class_categories[$Product->getId()][$class_category_id1]['#'.$class_category_id2] = [
                    'weight' => number_format($ProductClass->getDeliveryplusWeight(),2),
                    'size' => number_format($ProductClass->getDeliveryplusSize(),2),
                ];
            }
        }

        $parameters['DeliveryPlusParams'] = $class_categories;
        $event->setParameters($parameters);

        $twig = '@DeliveryPlus4/default/Product/product_js.twig';
        $event->addSnippet($twig);
    }

    public function onTemplateShoppingIndex(TemplateEvent $event)
    {
        $parameters = $event->getParameters();
        $form = $parameters['form'];
        $cannot_order = false;
        foreach($form['Shippings'] as $Shipping){
            if(count($Shipping['Delivery']->vars['choices']) == 0)$cannot_order = true;
        }
        if($cannot_order){
            $twig = '@DeliveryPlus4/default/Shopping/cannot_order.twig';
            $event->addSnippet($twig);
        }
    }

    public function hookAdminProductCsvImportProductDescriptions(EventArgs $event)
    {
        $header = $event->getArgument('header');
        $key = $event->getArgument('key');
        if($key == trans('deliveryplus.common.1')){
            $header['description'] = trans('deliveryplus.admin.product.product_csv.weight_description');
            $header['required'] = false;
        }
        if($key == trans('deliveryplus.common.2')){
            $header['description'] = trans('deliveryplus.admin.product.product_csv.size_description');
            $header['required'] = false;
        }

        $event->setArgument('header',$header);
    }

    public function hookAdminProductCsvImportProductCheck(EventArgs $event)
    {
        $row = $event->getArgument('row');
        $data = $event->getArgument('data');
        $errors = $event->getArgument('errors');

        if(isset($row[trans('deliveryplus.common.1')])){
            if($row[trans('deliveryplus.common.1')] !== '' && !is_numeric($row[trans('deliveryplus.common.1')]) || $row[trans('deliveryplus.common.1')] < 0){
                $message = trans('admin.common.csv_invalid_greater_than_zero', [
                    '%line%' => $data->key() + 1,
                    '%name%' => trans('deliveryplus.common.1'),
                ]);
                $errors[] = $message;
            }
        }
        if(isset($row[trans('deliveryplus.common.2')])){
            if($row[trans('deliveryplus.common.2')] !== '' && !is_numeric($row[trans('deliveryplus.common.2')]) || $row[trans('deliveryplus.common.2')] < 0){
                $message = trans('admin.common.csv_invalid_greater_than_zero', [
                    '%line%' => $data->key() + 1,
                    '%name%' => trans('deliveryplus.common.2'),
                ]);
                $errors[] = $message;
            }
        }

        $event->setArgument('errors',$errors);
    }

    public function hookAdminProductCsvImportProductProcess(EventArgs $event)
    {
        $row = $event->getArgument('row');
        $data = $event->getArgument('data');
        $ProductClass = $event->getArgument('ProductClass');

        if(isset($row[trans('deliveryplus.common.1')])){
            if($row[trans('deliveryplus.common.1')] != ''){
                $ProductClass->setDeliveryplusWeight($row[trans('deliveryplus.common.1')]);
            }else{
                $ProductClass->setDeliveryplusWeight(NULL);
            }
        }
        if(isset($row[trans('deliveryplus.common.2')])){
            if($row[trans('deliveryplus.common.2')] != ''){
                $ProductClass->setDeliveryplusSize($row[trans('deliveryplus.common.2')]);
            }else{
                $ProductClass->setDeliveryplusSize(NULL);
            }
        }
    }
}
