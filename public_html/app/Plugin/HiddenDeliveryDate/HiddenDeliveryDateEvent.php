<?php
/*
* Plugin Name : HiddenDeliveryDate
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\HiddenDeliveryDate;

use Eccube\Event\EccubeEvents;
use Eccube\Event\TemplateEvent;
use Eccube\Event\EventArgs;
use Plugin\HiddenDeliveryDate\Entity\Hiddenday;
use Plugin\HiddenDeliveryDate\Service\ShoppingService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;

class HiddenDeliveryDateEvent implements EventSubscriberInterface
{
    private $entityManager;
    private $shoppingService;

    public function __construct(
            EntityManagerInterface $entityManager,
            ShoppingService $shoppingService
            )
    {
        $this->entityManager = $entityManager;
        $this->shoppingService = $shoppingService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            EccubeEvents::ADMIN_PRODUCT_COPY_COMPLETE => 'hookAdminProductCopyComplete',
            EccubeEvents::ADMIN_PRODUCT_CSV_EXPORT => 'hookAdminProductCsvExport',
            '@admin/Product/index.twig' => 'onTemplateAdminProduct',
            '@admin/Product/product.twig' => 'onTemplateAdminProductEdit',
            'deliverydate.getformdeliverydates' => 'hookGetDeliveryDates',
            'csvimportproductext.admin.product.csv.import.product.descriptions' => 'hookAdminProductCsvImportProductDescriptions',
            'csvimportproductext.admin.product.csv.import.product.check'=> 'hookAdminProductCsvImportProductCheck',
            'csvimportproductext.admin.product.csv.import.product.process' => 'hookAdminProductCsvImportProductProcess',
        ];
    }

    public function hookAdminProductCopyComplete(EventArgs $event)
    {
        $Product = $event->getArgument('Product');
        $CopyProduct = $event->getArgument('CopyProduct');

        $Hiddendays = $Product->getHiddendays();
        if(count($Hiddendays) > 0){
            foreach($Hiddendays as $Hiddenday){
                $newHiddenday = new Hiddenday();
                $newHiddenday->setProduct($CopyProduct)
                             ->setDate($Hiddenday->getDate());
                $CopyProduct->addHiddenday($newHiddenday);
                $this->entityManager->persist($newHiddenday);
            }
        }

        $this->entityManager->flush();
    }

    public function hookAdminProductCsvExport(EventArgs $event)
    {
        $ExportCsvRow = $event->getArgument('ExportCsvRow');
        if ($ExportCsvRow->isDataNull()) {
            $ProductClass = $event->getArgument('ProductClass');
            $Product = $ProductClass->getProduct();
            $Csv = $event->getArgument('Csv');

            $csvEntityName = str_replace('\\\\', '\\', $Csv->getEntityName());
            if($csvEntityName == 'Plugin\HiddenDeliveryDate\Entity\Hiddenday'){
                $ret = [];
                foreach($Product->getHiddendays() as $Hiddenday){
                    $ret[] = $Hiddenday->getDate()->format('Y/m/d');
                }
                $ExportCsvRow->setData(implode(',',$ret));
            }
        }
    }

    public function onTemplateAdminProduct(TemplateEvent $event)
    {
        $twig = '@HiddenDeliveryDate/admin/Product/product_menu.twig';
        $event->addSnippet($twig);
        $js = '@HiddenDeliveryDate/admin/Product/product_menu.js';
        $event->addAsset($js);
    }

    public function onTemplateAdminProductEdit(TemplateEvent $event)
    {
        $twig = '@HiddenDeliveryDate/admin/Product/product_edit_button.twig';
        $event->addSnippet($twig);
        $js = '@HiddenDeliveryDate/admin/Product/product_edit_button.js';
        $event->addAsset($js);
    }

    public function hookGetDeliveryDates(EventArgs $event)
    {
        $deliveryDates = $event->getArgument('deliveryDates');
        $Shipping = $event->getArgument('Shipping');

        $deliveryDates = $this->shoppingService->getHiddenDeliveryDates($deliveryDates, $Shipping);
        $event->setArgument('deliveryDates', $deliveryDates);
    }

    public function hookAdminProductCsvImportProductDescriptions(EventArgs $event)
    {
        $header = $event->getArgument('header');
        $key = $event->getArgument('key');
        if($key == trans('hiddendeliverydate.common.hiddenday')){
            $header['description'] = trans('hiddendeliverydate.admin.product.product_csv.hidden_delivery_date_description');
            $header['required'] = false;
        }

        $event->setArgument('header',$header);
    }

    public function hookAdminProductCsvImportProductCheck(EventArgs $event)
    {
        $row = $event->getArgument('row');
        $data = $event->getArgument('data');
        $errors = $event->getArgument('errors');

        if(isset($row[trans('hiddendeliverydate.common.hiddenday')]) && strlen($row[trans('hiddendeliverydate.common.hiddenday')]) > 0){
            $hiddendays = explode(',',$row[trans('hiddendeliverydate.common.hiddenday')]);
            $format_str = '%Y/%m/%d';
            foreach($hiddendays as $hiddenday){
                $is_date_str = strptime($hiddenday, $format_str);
                if(!$is_date_str){
                    $message = trans('admin.common.csv_invalid_date_format', [
                        '%line%' => $data->key() + 1,
                        '%name%' => trans('hiddendeliverydate.common.hiddenday'),
                        ]);
                    $errors[] = $message;
                }
                list($year, $month, $day) = explode("/", $hiddenday);
                if (!checkdate($month, $day, $year)) {
                    $message = trans('admin.common.csv_invalid_not_found_target', [
                        '%line%' => $data->key() + 1,
                        '%name%' => trans('hiddendeliverydate.common.hiddenday'),
                        '%target_name%' => $hiddenday,
                        ]);
                    $errors[] = $message;
                }
            }
        }

        $event->setArgument('errors',$errors);
    }

    public function hookAdminProductCsvImportProductProcess(EventArgs $event)
    {
        $row = $event->getArgument('row');
        $ProductClass = $event->getArgument('ProductClass');
        $Product = $ProductClass->getProduct();

        if(isset($row[trans('hiddendeliverydate.common.hiddenday')])){
            foreach($Product->getHiddendays() as $Hiddenday){
                $Product->removeHiddenday($Hiddenday);
                $this->entityManager->remove($Hiddenday);
            }
            if($row[trans('hiddendeliverydate.common.hiddenday')] != ''){
                $hiddendays = explode(',',$row[trans('hiddendeliverydate.common.hiddenday')]);
                foreach($hiddendays as $hiddenday){
                    $hiddenDate = new \DateTime($hiddenday , new \DateTimeZone('UTC'));
                    $Hiddenday = new Hiddenday();
                    $Hiddenday->setDate($hiddenDate)
                              ->setProduct($Product);
                    $Product->addHiddenday($Hiddenday);
                    $this->entityManager->persist($Hiddenday);
                }
            }
        }
    }
}
