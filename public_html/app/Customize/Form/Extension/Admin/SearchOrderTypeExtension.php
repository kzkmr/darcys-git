<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Form\Extension\Admin;

use Eccube\Form\Type\Admin\SearchOrderType;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Shipping;
use Eccube\Form\Type\Master\OrderStatusType;
use Eccube\Form\Type\Master\PaymentType;
use Eccube\Form\Type\PriceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Eccube\Repository\Master\SaleTypeRepository;
use Eccube\Entity\Master\SaleType;
use Customize\Repository\Master\ContractTypeRepository;
use Customize\Entity\Master\ContractType;

class SearchOrderTypeExtension extends AbstractTypeExtension
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var ContractTypeRepository
     */
    protected $contractTypeRepository;

    /**
     * @var SaleTypeRepository
     */
    protected $saleTypeRepository;

    public function __construct(EccubeConfig $eccubeConfig,
                                ContractTypeRepository $contractTypeRepository,
                                SaleTypeRepository $saleTypeRepository)
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->contractTypeRepository = $contractTypeRepository;
        $this->saleTypeRepository = $saleTypeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $contractType = $this->contractTypeRepository->findBy([], ['sort_no' => 'ASC']);
        $saleType = $this->saleTypeRepository->findBy([], ['sort_no' => 'ASC']);

        $builder
            ->add('storechain_member', EntityType::class, [
                'label' => 'admin.label.storechain_member',
                'expanded' => true,
                'multiple' => true,
                'class' => ContractType::class,
                'choices' => $contractType
            ])
            ->add('class_sale_type', EntityType::class, [
                'required' => false,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => '全ての販売種別',
                'label' => 'admin.product.sale_type',
                'class' => SaleType::class,
                'choices' => $saleType
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return SearchOrderType::class;
    }

    public function getExtendedTypes()
    {
        return [SearchOrderType::class];
    }
}
