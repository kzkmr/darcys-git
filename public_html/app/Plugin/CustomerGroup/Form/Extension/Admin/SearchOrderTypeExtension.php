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


use Eccube\Form\Type\Admin\SearchOrderType;
use Plugin\CustomerGroup\Entity\Group;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class SearchOrderTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groups', EntityType::class, [
                'label' => '会員グループ',
                'class' => Group::class,
                'required' => false,
                'placeholder' => 'common.select__unspecified',
                'eccube_form_options' => [
                    'auto_render' => true
                ]
            ]);
    }

    public function getExtendedType(): string
    {
        return SearchOrderType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        yield SearchOrderType::class;
    }
}
