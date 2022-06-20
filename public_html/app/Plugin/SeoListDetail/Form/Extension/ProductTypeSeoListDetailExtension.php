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

namespace Plugin\SeoListDetail\Form\Extension;

use Eccube\Form\Type\Admin\ProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductTypeSeoListDetailExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('itoben_seo_title', TextType::class, [
                'required' => false,
            ])
            ->add('itoben_seo_author', TextType::class, [
                'required' => false,
            ])
            ->add('itoben_seo_description', TextType::class, [
                'required' => false,
            ])
            ->add('itoben_seo_keyword', TextType::class, [
                'required' => false,
            ])
            ->add('itoben_seo_meta_robots', TextType::class, [
                'required' => false,
            ])
            ->add('itoben_seo_meta_tags', TextareaType::class, [
                'required' => false,
            ])
			;
    }

    public function getExtendedType()
    {
        return ProductType::class;
    }

	/**
	 * Return the class of the type being extended.
	 */
	public static function getExtendedTypes(): iterable
	{
		return [ProductType::class];
	}
}
