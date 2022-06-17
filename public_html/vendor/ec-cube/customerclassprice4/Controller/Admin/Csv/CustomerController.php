<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Controller\Admin\Csv;


use Eccube\Entity\Customer;
use Eccube\Form\Type\Admin\CsvImportType;
use Eccube\Repository\CustomerRepository;
use Eccube\Util\CacheUtil;
use Eccube\Util\StringUtil;
use Plugin\CustomerClassPrice4\Repository\CustomerClassRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CustomerController
 * @package Plugin\CustomerClassPrice4\Controller\Admin\Csv
 */
class CustomerController extends AbstractCsvImportController
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var CustomerClassRepository
     */
    private $customerClassRepository;

    public function __construct(
        CustomerRepository $customerRepository,
        CustomerClassRepository $customerClassRepository
    )
    {
        parent::__construct();

        $this->customerRepository = $customerRepository;
        $this->customerClassRepository = $customerClassRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/customer_class_price4/csv/customer/import", name="customer_class_price_admin_csv_customer_import")
     * @Template("@CustomerClassPrice4/admin/csv/customer/import.twig")
     *
     * @param Request $request
     * @param CacheUtil $cacheUtil
     * @return array
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function import(Request $request, CacheUtil $cacheUtil)
    {
        $headers = $this->getCsvHeader();

        $form = $this->createForm(CsvImportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formFile = $form['import_file']->getData();
            if (!empty($formFile)) {
                $data = $this->getImportData($formFile);
                if ($data === false) {
                    $this->addErrorMessage(trans('admin.common.csv_invalid_format'));

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
                    $this->addErrorMessage(trans('admin.common.csv_invalid_format'));

                    return $this->renderWithError($form, $headers, false);
                }

                $size = count($data);

                if ($size < 1) {
                    $this->addErrorMessage(trans('admin.common.csv_invalid_no_data'));

                    return $this->renderWithError($form, $headers, false);
                }

                $headerSize = count($columnHeaders);
                $headerByKey = array_flip(array_map($getId, $headers));

                $this->entityManager->getConfiguration()->setSQLLogger(null);
                $this->entityManager->getConnection()->beginTransaction();;

                foreach ($data as $row) {
                    $line = $data->key() + 1;
                    if ($headerSize != count($row)) {
                        $this->addErrorMessage(trans('admin.common.csv_invalid_format_line', ['%line%' => $line]));

                        return $this->renderWithError($form, $headers);
                    }

                    if (preg_match('/^\d+$/', $row[$headerByKey['id']])) {
                        /** @var Customer $Customer */
                        $Customer = $this->customerRepository->find($row[$headerByKey['id']]);
                        if (null === $Customer) {
                            $this->addErrorMessage(trans('admin.common.csv_invalid_not_found', ['%line%' => $line, '%name%' => $headerByKey['id']]));

                            return $this->renderWithError($form, $headers);
                        }
                    } else {
                        $this->addErrorMessage(trans('admin.common.csv_invalid_not_found', ['%line%' => $line, '%name%' => $headerByKey['id']]));

                        return $this->renderWithError($form, $headers);
                    }

                    if (isset($row[$headerByKey['plg_ccp_customer_class_id']])) {
                        if (StringUtil::isNotBlank($row[$headerByKey['plg_ccp_customer_class_id']])) {
                            $CustomerClass = $this->customerClassRepository->find($row[$headerByKey['plg_ccp_customer_class_id']]);
                            if ($CustomerClass) {
                                $Customer->setPlgCcpCustomerClass($CustomerClass);
                            } else {
                                $this->addErrorMessage(trans('admin.common.csv_invalid_not_found', ['%line%' => $line, '%name%' => $headerByKey['plg_ccp_customer_class_id']]));

                                return $this->renderWithError($form, $headers);
                            }
                        } else {
                            $Customer->setPlgCcpCustomerClass(null);
                        }
                    }

                    $this->entityManager->persist($Customer);
                }

                $this->entityManager->flush();
                $this->entityManager->getConnection()->commit();

                $message = 'admin.common.csv_upload_complete';
                $this->session->getFlashBag()->add('eccube.admin.success', $message);

                $cacheUtil->clearDoctrineCache();

                return $this->redirectToRoute('customer_class_price_admin_csv_customer_import');
            }
        }

        return [
            'form' => $form->createView(),
            'headers' => $headers,
            'errors' => $this->getErrorMessages()
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/customer_class_price4/csv/customer/export", name="customer_class_price_admin_csv_customer_export")
     *
     * @return StreamedResponse
     * @throws \Exception
     */
    public function export()
    {
        set_time_limit(0);

        $em = $this->entityManager;
        $em->getConfiguration()->setSQLLogger(null);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($em) {
            $file = new \SplFileObject('php://output', 'w');

            // ヘッダー設定
            $file->fputcsv(array_map(function ($value) {
                return mb_convert_encoding($value, "SJIS-win", mb_internal_encoding());
            }, array_keys($this->getCsvHeader())));

            $query = $em->getRepository(Customer::class)
                ->createQueryBuilder('c')->getQuery();

            /** @var Customer $row */
            foreach ($query->iterate() as list($row)) {
                $column = [
                    $row->getId(),
                    $row->getName01() . $row->getName02(),
                    $row->getPlgCcpCustomerClass() ? $row->getPlgCcpCustomerClass()->getId() : null
                ];


                $file->fputcsv(array_map(function ($value) {
                    return mb_convert_encoding($value, "SJIS-win", mb_internal_encoding());
                }, $column));
            }

            $em->clear();

            flush();
        });

        $now = new \DateTime();
        $filename = "customer_" . $now->format("YmdHis") . ".csv";
        $response->headers->set("Content-Type", "application/octet-stream");
        $response->headers->set("Content-Disposition", "attachment; filename=" . $filename);

        $response->send();

        return $response;
    }

    private function getCsvHeader()
    {
        return [
            trans('plugin.customer_class_price.admin.customer.id_col') => [
                'id' => 'id',
                'description' => 'ダウンロードしたIDは変更しないでください。',
                'required' => true,
            ],
            trans('plugin.customer_class_price.admin.customer.name_col') => [
                'id' => 'customer_name',
                'description' => '無視されます。',
                'required' => false,
            ],
            trans('plugin.customer_class_price.admin.customer.customer_class_id_col') => [
                'id' => 'plg_ccp_customer_class_id',
                'description' => '会員種別IDは半角数字で指定してください。会員種別を削除したい場合は空にしてください。',
                'required' => false,
            ],
        ];
    }
}
