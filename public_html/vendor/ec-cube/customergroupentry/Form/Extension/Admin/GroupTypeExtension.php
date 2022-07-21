<?php
/**
 * This file is part of CustomerGroupEntry
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroupEntry\Form\Extension\Admin;


use Eccube\Form\Type\ToggleSwitchType;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Form\Type\Admin\GroupType;
use Plugin\CustomerGroup\Repository\GroupRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GroupTypeExtension extends AbstractTypeExtension
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
            ->add('optionEntry', ToggleSwitchType::class, [
                'label' => '会員登録時に会員グループ登録',
                'eccube_form_options' => [
                    'auto_render' => true
                ]
            ]);

        $builder
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                /** @var Group $data */
                $data = $event->getData();

                if ($data->isOptionEntry()) {
                    $qb = $this->groupRepository->createQueryBuilder('g');
                    $groups = $qb
                        ->where('g.optionEntry = :optionEntry')
                        ->andWhere($qb->expr()->not('g.id = :id'))
                        ->setParameter('optionEntry', true)
                        ->setParameter('id', $data->getId())
                        ->getQuery()
                        ->getResult();
                    foreach ($groups as $group) {
                        $message = trans('customer_group_entry.admin.group.option_entry_error', ['%name%' => $group->getName()]);
                        $form->get('optionEntry')->addError(new FormError($message));
                    }
                }
            });
    }

    /**
     * @return string
     */
    public function getExtendedType(): string
    {
        return GroupType::class;
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        yield GroupType::class;
    }
}
