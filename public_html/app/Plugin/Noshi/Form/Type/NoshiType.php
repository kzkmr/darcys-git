<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Noshi\Form\Type;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Common\EccubeConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Eccube\Form\DataTransformer;

use Symfony\Component\Validator\Constraints as Assert; //new Assert\Length(['max' => 10]),
use Eccube\Form\Type\Master\NoshiKindType;
use Eccube\Form\Type\Master\NoshiTieType;

/**
 * Class NoshiType.
 */
class NoshiType extends AbstractType
{
    /**
     * @var EccubeConfig
     */
    private $eccubeConfig;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * NoshiType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EccubeConfig $eccubeConfig, EntityManagerInterface $entityManager)
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->entityManager = $entityManager;
    }

    /**
     * Build config type form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NoshiKind', NoshiKindType::class, [
                'required' => false,
            ])
            ->add('NoshiTie', NoshiTieType::class, [
                'required' => false,
            ])
            ->add('noshi_sonota', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length(['max' => 10]),
                ],
            ])
            ->add('noshi_name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length(['max' => 10]),
                ],
            ])
            ->add('product', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
			->add('order_id', HiddenType::class)
            ->add('fixed', HiddenType::class)
            ->add('visible', HiddenType::class)
			;
    }

    /**
     *  {@inheritdoc}
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Plugin\Noshi\Entity\Noshi',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_noshi';
    }
}
