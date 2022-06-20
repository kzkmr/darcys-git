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

namespace Plugin\MypageReceipt\Controller\Admin;

use Plugin\MypageReceipt\Form\Type\Admin\MypageReceiptConfigType;
use Plugin\MypageReceipt\Repository\MypageReceiptConfigRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfigController.
 */
class ConfigController extends \Eccube\Controller\AbstractController
{
    /**
     * @Route("/%eccube_admin_route%/mypage_receipt/config", name="mypage_receipt_admin_config")
     * @Template("@MypageReceipt/admin/config.twig")
     *
     * @param Request $request
     * @param MypageReceiptConfigRepository $configRepository
     *
     * @return array
     */
    public function index(Request $request, MypageReceiptConfigRepository $configRepository)
    {
        $Config = $configRepository->get();
        $form = $this->createForm(MypageReceiptConfigType::class, $Config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Config = $form->getData();
            $this->entityManager->persist($Config);
            $this->entityManager->flush($Config);

            log_info('MypageReceipt', ['status' => 'Success']);
            $this->addSuccess('登録しました。', 'admin');

            return $this->redirectToRoute('mypage_receipt_admin_config');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
