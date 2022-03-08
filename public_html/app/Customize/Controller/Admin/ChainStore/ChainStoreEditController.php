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

namespace Customize\Controller\Admin\ChainStore;

use Eccube\Controller\AbstractController;
use Customize\Entity\Master\ChainStoreStatus;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Customize\Form\Type\Admin\ChainStoreType;
use Customize\Repository\ChainStoreRepository;
use Eccube\Util\StringUtil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChainStoreEditController extends AbstractController
{
    /**
     * @var ChainStoreRepository
     */
    protected $chainstoreRepository;

    public function __construct(
        ChainStoreRepository $chainstoreRepository
    ) {
        $this->chainstoreRepository = $chainstoreRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/chainstore/new", name="admin_chainstore_new", methods={"GET", "POST"})
     * @Route("/%eccube_admin_route%/chainstore/{id}/edit", requirements={"id" = "\d+"}, name="admin_chainstore_edit", methods={"GET", "POST"})
     * @Template("@admin/ChainStore/edit.twig")
     */
    public function index(Request $request, $id = null)
    {
        $this->entityManager->getFilters()->enable('incomplete_order_status_hidden');
        // 編集
        if ($id) {
            $ChainStore = $this->chainstoreRepository
                ->find($id);

            if (is_null($ChainStore)) {
                throw new NotFoundHttpException();
            }

            $oldStatusId = $ChainStore->getStatus()->getId();
        // 新規登録
        } else {
            $ChainStore = $this->chainstoreRepository->newChainStore();

            $oldStatusId = null;
        }

        // 販売店登録フォーム
        $builder = $this->formFactory
            ->createBuilder(ChainStoreType::class, $ChainStore);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            log_info('販売店登録開始', [$ChainStore->getId()]);

            // 退会ステータスに更新の場合、ダミーのアドレスに更新
            $newStatusId = $ChainStore->getStatus()->getId();
            if ($oldStatusId != $newStatusId && $newStatusId == ChainStoreStatus::WITHDRAWING) {
                $ChainStore->setEmail(StringUtil::random(60).'@dummy.dummy');
            }

            $this->entityManager->persist($ChainStore);
            $this->entityManager->flush();

            log_info('販売店登録完了', [$ChainStore->getId()]);

            $this->addSuccess('admin.common.save_complete', 'admin');

            return $this->redirectToRoute('admin_chainstore_edit', [
                'id' => $ChainStore->getId(),
                'ChainStore' => $ChainStore,
            ]);
        }

        return [
            'form' => $form->createView(),
            'ChainStore' => $ChainStore,
        ];
    }
}
