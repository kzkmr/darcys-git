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

namespace Plugin\CustomerClassPrice4\Form\Type\Admin;


use Doctrine\ORM\EntityManagerInterface;
use Eccube\Form\DataTransformer\EntityToIdTransformer;
use Eccube\Form\Type\PriceType;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CustomerClassPriceType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', PriceType::class, [
                'label' => false,
                'required' => false
            ])
            ->add(
                $builder->create('customerClass', HiddenType::class, [
                    'constraints' => [
                        new NotBlank()
                    ]
                ])->addModelTransformer(new EntityToIdTransformer($this->entityManager, CustomerClass::class))
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerClassPrice::class
        ]);
    }
}
