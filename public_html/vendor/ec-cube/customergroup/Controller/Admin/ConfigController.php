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

namespace Plugin\CustomerGroup\Controller\Admin;


use Eccube\Controller\AbstractController;
use Plugin\CustomerGroup\Form\Type\Admin\ConfigType;
use Plugin\CustomerGroup\Traits\ConfigTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConfigController
 * @package Plugin\CustomerGroup\Controller\Admin
 *
 * @Route("/%eccube_admin_route%/customer_group")
 * @IsGranted("ROLE_ADMIN")
 */
class ConfigController extends AbstractController
{
    use ConfigTrait;

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/config", name="admin_customer_group_config")
     */
    public function index(Request $request): Response
    {
        $config = $this->getConfig();
        $form = $this->createForm(ConfigType::class, $config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addSuccess('admin.common.save_complete', 'admin');

            return $this->redirectToRoute('admin_customer_group_config');
        }

        return $this->render(
            '@CustomerGroup/admin/config.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
