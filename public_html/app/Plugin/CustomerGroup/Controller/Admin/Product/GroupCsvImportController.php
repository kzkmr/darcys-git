<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\Controller\Admin\Product;


use Eccube\Entity\Product;
use Eccube\Form\Type\Admin\CsvImportType;
use Eccube\Util\CacheUtil;
use Eccube\Util\StringUtil;
use Plugin\CustomerGroup\Controller\Admin\AbstractCsvImportController;
use Plugin\CustomerGroup\Entity\Group;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GroupCsvImportController
 * @package Plugin\CustomerGroup\Controller\Admin\Product
 *
 * @Route("/%eccube_admin_route%/product")
 */
class GroupCsvImportController extends AbstractCsvImportController
{
    /**
     * @param Request $request
     * @param CacheUtil $cacheUtil
     * @return array|GroupCsvImportController|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\DBAL\ConnectionException
     *
     * @Route("/group_csv_upload", name="admin_product_group_csv_upload")
     * @Template("@CustomerGroup/admin/Product/Group/upload.twig")
     */
    public function upload(Request $request, CacheUtil $cacheUtil)
    {
        $form = $this->createForm(CsvImportType::class);

        $headers = $this->getCsvHeader();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $formFile */
            $formFile = $form->get('import_file')->getData();
            if ($formFile->isValid()) {
                $data = $this->getImportData($formFile);
                if (false === $data) {
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
                $this->entityManager->getConnection()->beginTransaction();

                // CSVファイルの登録処理
                foreach ($data as $row) {
                    $line = $data->key() + 1;
                    if ($headerSize != count($row)) {
                        $this->addErrorMessage(trans('admin.common.csv_invalid_format_line', ['%line%' => $line]));
                        return $this->renderWithError($form, $headers);
                    }

                    if (!isset($row[$headerByKey['product_id']]) || StringUtil::isBlank($row[$headerByKey['product_id']])) {
                        $this->addErrorMessage(trans('admin.common.csv_invalid_required', ['%line%' => $line, '%name%' => $headerByKey['product_id']]));
                        return $this->renderWithError($form, $headers);
                    }

                    if (!isset($row[$headerByKey['group_id']]) || StringUtil::isBlank($row[$headerByKey['group_id']])) {
                        $this->addErrorMessage(trans('admin.common.csv_invalid_required', ['%line%' => $line, '%name%' => $headerByKey['group_id']]));
                        return $this->renderWithError($form, $headers);
                    }

                    /** @var Product $product */
                    $product = $this->entityManager->getRepository(Product::class)
                        ->find($row[$headerByKey['product_id']]);

                    if (null === $product) {
                        $this->addErrorMessage(trans('admin.common.csv_invalid_not_found', ['%line%' => $line, '%name%' => $headerByKey['product_id']]));
                        return $this->renderWithError($form, $headers);
                    }

                    $group = $this->entityManager->getRepository(Group::class)
                        ->find($row[$headerByKey['group_id']]);

                    if (null === $group) {
                        $this->addErrorMessage(trans('admin.common.csv_invalid_not_found', ['%line%' => $line, '%name%' => $headerByKey['group_id']]));
                        return $this->renderWithError($form, $headers);
                    }

                    if ($row[$headerByKey['delete_flag']] === "D") {
                        $product->removeGroup($group);
                    } else {
                        $product->addGroup($group);
                    }
                    $this->entityManager->persist($product);

                }

                $this->entityManager->flush();
                $this->entityManager->getConnection()->commit();

                $message = 'admin.common.csv_upload_complete';
                $this->session->getFlashBag()->add('eccube.admin.success', $message);

                $cacheUtil->clearDoctrineCache();

                return $this->redirectToRoute('admin_product_group_csv_upload');
            }
        }

        return [
            'form' => $form->createView(),
            'headers' => $headers,
            'errors' => $this->errors
        ];
    }

    /**
     * @return StreamedResponse
     *
     * @Route("/group_csv_export", name="admin_product_group_csv_export")
     */
    public function export()
    {
        set_time_limit(0);

        $this->entityManager->getConfiguration()->setSQLLogger(null);

        $response = new StreamedResponse();
        $response->setCallback(function () {
            $file = new \SplFileObject('php://output', 'w');

            $file->fputcsv(array_map(function ($value) {
                return mb_convert_encoding($value, 'SJIS-win', mb_internal_encoding());
            }, array_keys($this->getCsvHeader())));

            $query = $this->entityManager->getRepository(Product::class)
                ->createQueryBuilder('p')->getQuery();

            /** @var Product $row */
            foreach ($query->iterate() as list($row)) {
                if ($row->hasGroups()) {
                    /** @var Group $group */
                    foreach ($row->getGroups() as $group) {
                        $column = [
                            $row->getId(),
                            $row,
                            $group->getId()
                        ];

                        $file->fputcsv(array_map(function ($value) {
                            return mb_convert_encoding($value, 'SJIS-win', mb_internal_encoding());
                        }, $column));
                    }
                } else {
                    $column = [
                        $row->getId(),
                        $row,
                        null
                    ];

                    $file->fputcsv(array_map(function ($value) {
                        return mb_convert_encoding($value, "SJIS-win", mb_internal_encoding());
                    }, $column));
                }
            }

            $this->entityManager->clear();
            flush();
        });

        $now = new \DateTime();
        $filename = 'product_group_' . $now->format('YmdHis') . '.csv';
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename=' . $filename);
        $response->send();

        return $response;
    }

    /**
     * @return array[]
     */
    protected function getCsvHeader()
    {
        return [
            trans('商品ID') => [
                'id' => 'product_id',
                'description' => '商品IDを指定してください。',
                'required' => true
            ],
            trans('商品名') => [
                'id' => 'product_name',
                'description' => '無視されます。',
                'required' => false,
            ],
            trans('会員グループID') => [
                'id' => 'group_id',
                'description' => '会員グループIDを指定してください。',
                'required' => true
            ],
            trans('削除フラグ') => [
                'id' => 'delete_flag',
                'description' => 'Dを指定すると削除されます。',
                'required' => false
            ]
        ];
    }
}
