<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Noshi\Controller\Admin;

use Plugin\Noshi\Form\Type\Admin\NoshiConfigType;
use Plugin\Noshi\Repository\NoshiConfigRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfigController.
 */
class ConfigController extends \Eccube\Controller\AbstractController
{
    /**
     * @Route("/%eccube_admin_route%/noshi/config", name="noshi_admin_config")
     * @Template("@Noshi/admin/config.twig")
     *
     * @param Request $request
     * @param NoshiConfigRepository $configRepository
     *
     * @return array
     */
    public function index(Request $request, NoshiConfigRepository $configRepository)
    {
        $Config = $configRepository->get();
        $form = $this->createForm(NoshiConfigType::class, $Config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Config = $form->getData();
            $this->entityManager->persist($Config);
            $this->entityManager->flush($Config);

            log_info('Noshi config', ['status' => 'Success']);
            $this->addSuccess('登録しました。', 'admin');

            return $this->redirectToRoute('noshi_admin_config');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
