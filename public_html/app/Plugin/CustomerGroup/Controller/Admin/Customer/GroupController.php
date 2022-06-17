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

namespace Plugin\CustomerGroup\Controller\Admin\Customer;


use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Eccube\Controller\AbstractController;
use Eccube\Util\CacheUtil;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Form\Type\Admin\GroupType;
use Plugin\CustomerGroup\Repository\GroupRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GroupController
 * @package Plugin\CustomerGroup\Controller\Admin
 *
 * @Route("/%eccube_admin_route%/customer")
 * @IsGranted("ROLE_ADMIN")
 */
class GroupController extends AbstractController
{
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    public function __construct(
        GroupRepository $groupRepository
    )
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return Response
     *
     * @Route("/group", name="admin_customer_group")
     */
    public function index(): Response
    {
        $groups = $this->groupRepository->getQueryBuilderBySearchData([])
            ->getQuery()
            ->getResult();

        return $this->render(
            '@CustomerGroup/admin/Customer/Group/index.twig',
            [
                'groups' => $groups
            ]
        );
    }

    /**
     * @param Request $request
     * @param CacheUtil $cacheUtil
     * @return Response
     * @throws \Exception
     *
     * @Route("/group/new", name="admin_customer_group_new")
     */
    public function new(Request $request, CacheUtil $cacheUtil): Response
    {
        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($group);
            $this->entityManager->flush();
            $this->addSuccess('admin.common.save_complete', 'admin');

            $cacheUtil->clearDoctrineCache();

            return $this->redirectToRoute('admin_customer_group_edit', ['id' => $group->getId()]);
        }

        return $this->render(
            '@CustomerGroup/admin/Customer/Group/edit.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @param Group $group
     * @param CacheUtil $cacheUtil
     * @return Response
     * @throws \Exception
     *
     * @Route("/group/{id}/edit", requirements={"id" = "\d+"}, name="admin_customer_group_edit")
     */
    public function edit(Request $request, Group $group, CacheUtil $cacheUtil): Response
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($group);
            $this->entityManager->flush();
            $this->addSuccess('admin.common.save_complete', 'admin');

            $cacheUtil->clearDoctrineCache();

            return $this->redirectToRoute("admin_customer_group_edit", ["id" => $group->getId()]);
        }

        return $this->render(
            '@CustomerGroup/admin/Customer/Group/edit.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param Group $group
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/group/{id}/delete", requirements={"id" = "\d+"}, name="admin_customer_group_delete", methods={"DELETE"})
     */
    public function delete(Group $group): Response
    {
        $this->isTokenValid();

        try {
            $this->entityManager->remove($group);
            $this->entityManager->flush();

            $this->addSuccess('admin.common.delete_complete', 'admin');
        } catch (ForeignKeyConstraintViolationException $exception) {
            $message = trans('admin.common.delete_error_foreign_key', ['%name%' => $group->getName()]);
            $this->addError($message, 'admin');
        } catch (\Exception $exception) {
            $message = trans('admin.common.delete_error');
            $this->addError($message, 'admin');
        }

        return $this->redirectToRoute('admin_customer_group');
    }

    /**
     * @param Request $request
     *
     * @Route("/group/sort", name="admin_customer_group_sort", methods={"PUT"})
     */
    public function sort(Request $request, CacheUtil $cacheUtil)
    {
        if (false === $request->isXmlHttpRequest()) {
            return $this->json(["message" => trans('admin.common.move_error')], 500);
        }

        if (false === $this->isTokenValid()) {
            return $this->json(["message" => trans('admin.common.move_error')], 500);
        }

        parse_str($request->get('groups'), $data);

        $sortNo = [];
        foreach ($data['group'] as $id) {
            $group = $this->groupRepository->find($id);
            if ($group) {
                $sortNo[] = $group->getSortNo();
            }
        }

        sort($sortNo);

        foreach ($data['group'] as $pos => $id) {
            $group = $this->groupRepository->find($id);
            $group->setSortNo($sortNo[$pos]);
            $this->entityManager->persist($group);
        }
        $this->entityManager->flush();

        $cacheUtil->clearDoctrineCache();

        return $this->json($data['group'], 200);
    }
}
