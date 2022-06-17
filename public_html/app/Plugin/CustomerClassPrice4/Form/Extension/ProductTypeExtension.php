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

namespace Plugin\CustomerClassPrice4\Form\Extension;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Product;
use Eccube\Form\Type\Admin\ProductType;
use Eccube\Form\Type\ToggleSwitchType;
use Plugin\CustomerClassPrice4\Repository\CustomerClassRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * @var CustomerClassRepository
     */
    private $customerClassRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        CustomerClassRepository $customerClassRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->customerClassRepository = $customerClassRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("plgCcpEnabledDiscount", ToggleSwitchType::class, [
                'label' => '特定会員価格対象',
                'eccube_form_options' => [
                    'auto_render' => true,
                ],
            ])
        ;

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
            $Product = $event->getData();

            if($Product instanceof Product && !$Product->getId()) {
                $Product->setPlgCcpEnabledDiscount(true);
            }
        });
    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return ProductType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
