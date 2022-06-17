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

namespace Plugin\CustomerGroupEntry\Form\Extension;


use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Eccube\Entity\Customer;
use Eccube\Form\Type\Front\EntryType;
use Plugin\CustomerGroup\Entity\Group;
use Plugin\CustomerGroup\Repository\GroupRepository;
use Plugin\CustomerGroupEntry\Form\DataTransformer\GroupsToIdTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Security;

class EntryTypeExtension extends AbstractTypeExtension
{
    /**
     * @var GroupsToIdTransformer
     */
    private $groupTransformer;

    /**
     * @var Security
     */
    private $security;

    /**
     * @var GroupRepository
     */
    private $groupRepository;

    public function __construct(
        GroupsToIdTransformer $groupTransformer,
        Security $security,
        GroupRepository $groupRepository
    )
    {
        $this->groupTransformer = $groupTransformer;
        $this->security = $security;
        $this->groupRepository = $groupRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();
        if ($user instanceof Customer) {
            return;
        }

        $group = $this->groupRepository->findOneBy(['optionEntry' => true]);
        if ($group) {
            $builder->add('groups', HiddenType::class);
        } else {
            $builder
                ->add('groups', EntityType::class, [
                    'class' => Group::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            ->orderBy('g.sortNo', Criteria::ASC);
                    }
                ]);
        }
        $builder->get('groups')->addModelTransformer($this->groupTransformer);

        $builder
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                /** @var Customer $data */
                $data = $event->getData();

                if ($form->isValid() && $form->has('groups')) {
                    $groups = $form->get('groups')->getData();
                    foreach ($groups as $group) {
                        $data->addGroup($group);
                    }
                }
            });
    }

    /**
     * @return string
     */
    public function getExtendedType(): string
    {
        return EntryType::class;
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        yield EntryType::class;
    }
}
