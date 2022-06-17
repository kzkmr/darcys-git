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

namespace Plugin\CustomerGroup\Form\Type\Admin;


use Eccube\Form\Type\ToggleSwitchType;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Repository\GroupRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class GroupType extends AbstractType
{
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255])
                ]
            ])
            ->add('backendName', TextType::class, [
                'constraints' => [
                    new Length(['max' => 255])
                ]
            ])
            ->add('optionNonMemberDisplay', ToggleSwitchType::class);

        $builder
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                /** @var Group $data */
                $data = $event->getData();

                if ($form->isValid() && null === $data->getId()) {
                    $group = $this->groupRepository->findOneBy([], ['sortNo' => 'DESC']);
                    if ($group) {
                        $data->setSortNo($group->getSortNo() + 1);
                    } else {
                        $data->setSortNo(1);
                    }
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Group::class
        ]);
    }
}
