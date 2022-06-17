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

namespace Plugin\CustomerGroup\Form\Extension\Admin;


use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Eccube\Entity\Category;
use Eccube\Form\Type\Admin\CategoryType;
use Plugin\CustomerGroup\Entity\Group;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CategoryTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groups', EntityType::class, [
                'label' => '閲覧可能な会員グループ',
                'class' => Group::class,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'eccube_form_options' => [
                    'auto_render' => true,
                ],
                'choice_label' => function (Group $group) {
                    return $group->getName() . '[管理名:' . $group->getBackendName() . ']';
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.sortNo', Criteria::ASC);
                }
            ]);

        $builder
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                /** @var Category $data */
                $data = $event->getData();

                // 親カテゴリ以外は会員グループを表示しない
                if ($data && null !== $data->getId() && null !== $data->getParent()) {
                    $event->getForm()->remove('groups');
                }
            });
    }

    /**
     * @return string
     */
    public function getExtendedType(): string
    {
        return CategoryType::class;
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        yield CategoryType::class;
    }
}
