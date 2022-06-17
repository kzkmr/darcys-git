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

namespace Plugin\CustomerClassPrice4\Controller\Admin;

use Eccube\Controller\AbstractController;
use Plugin\CustomerClassPrice4\Repository\CustomerClassRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Form\Type\Admin\CustomerClassType;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

class CustomerClassController extends AbstractController
{
    /**
     * @var CustomerClassRepository
     */
    protected $customerClassRepository;

    /**
     * ConfigController constructor.
     *
     * @param ConfigRepository $configRepository
     */
    public function __construct(CustomerClassRepository $customerClassRepository)
    {
        $this->customerClassRepository = $customerClassRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/customer_class_price4/customer/class", name="plg_ccp_customer_class_admin")
     * @Template("@CustomerClassPrice4/admin/customer_class.twig")
     */
    public function index(Request $request)
    {
        $CustomerClasses = $this->customerClassRepository->findAll();

        return [
            'CustomerClasses' => $CustomerClasses,
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/customer_class_price4/customer/class/new", name="plg_ccp_customer_class_new")
     * @Template("@CustomerClassPrice4/admin/customer_class_edit.twig")
     */
    public function create(Request $request)
    {
        $CustomerClass = new CustomerClass();
        $form = $this->createForm(CustomerClassType::class, $CustomerClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Config = $form->getData();
            $this->entityManager->persist($CustomerClass);
            $this->entityManager->flush($CustomerClass);
            $this->addSuccess('保存しました。', 'admin');

            return $this->redirectToRoute('plg_ccp_customer_class_admin');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/customer_class_price4/customer/class/{id}/edit", requirements={"id" = "\d+"}, name="plg_ccp_customer_class_edit")
     * @Template("@CustomerClassPrice4/admin/customer_class_edit.twig")
     */
    public function edit(Request $request, CustomerClass $CustomerClass)
    {
        $form = $this->createForm(CustomerClassType::class, $CustomerClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Config = $form->getData();
            $this->entityManager->persist($CustomerClass);
            $this->entityManager->flush($CustomerClass);
            $this->addSuccess('保存しました。', 'admin');

            return $this->redirectToRoute('plg_ccp_customer_class_admin');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/customer_class_price4/customer/class/{id}/delete", requirements={"id" = "\d+"}, name="plg_ccp_customer_class_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CustomerClass $CustomerClass)
    {
        $this->isTokenValid();

        try {
            $this->entityManager->remove($CustomerClass);
            $this->entityManager->flush($CustomerClass);

            $this->addSuccess('会員種別を削除しました。', 'admin');
        } catch (ForeignKeyConstraintViolationException $e) {
            $message = trans('admin.common.delete_error_foreign_key', ['%name%' => $CustomerClass->getName()]);
            $this->addError($message, 'admin');
        } catch (\Exception $e) {
            $message = trans('admin.common.delete_error');
            $this->addError($message, 'admin');
        }

        return $this->redirectToRoute('plg_ccp_customer_class_admin');
    }
}
