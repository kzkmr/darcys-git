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

use Eccube\Form\Type\Admin\MemberType;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Master\Authority;
use Eccube\Entity\Master\Work;
use Eccube\Entity\Member;
use Eccube\Form\Validator\Email;
use Eccube\Form\Type\RepeatedPasswordType;
use Eccube\Form\Type\ToggleSwitchType;
use Eccube\Repository\MemberRepository;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class MemberTypeExtension extends AbstractTypeExtension
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var MemberRepository
     */
    protected $memberRepository;

    /**
     * MemberType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     * @param MemberRepository $memberRepository
     */
    public function __construct(
        EccubeConfig $eccubeConfig,
        MemberRepository $memberRepository
    ) {
        $this->eccubeConfig = $eccubeConfig;
        $this->memberRepository = $memberRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Email(['strict' => $this->eccubeConfig['eccube_rfc_email_check']]),
                ],
                'attr' => [
                    'placeholder' => 'common.mail_address_sample',
                ],
            ]);


    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return MemberType::class;
    }

    public function getExtendedTypes()
    {
        return [MemberType::class];
    }
}
