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

namespace Plugin\CustomerGroupEntry\Form\DataTransformer;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Plugin\CustomerGroup\Entity\Group;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class GroupsToIdTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform($groups)
    {
        if ($groups->count() > 0) {
            /** @var Group $group */
            $group = $groups->first();
            return $group->getId();
        } else {
            /** @var Group $group */
            $group = $this->entityManager->getRepository(Group::class)
                ->findOneBy(['optionEntry' => true]);

            return $group ? $group->getId() : null;
        }
    }

    public function reverseTransform($id)
    {
        if (!$id) {
            return new ArrayCollection();
        }

        $group = $this->entityManager
            ->getRepository(Group::class)
            ->find($id);

        if(null === $group) {
            throw new TransformationFailedException();
        }

        return new ArrayCollection([$group]);
    }
}
