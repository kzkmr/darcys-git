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

namespace Customize\Form\Type\Admin;

use Eccube\Common\EccubeConfig;
use Eccube\Entity\Master\CustomerStatus;
use Eccube\Form\Type\Master\CustomerStatusType;
use Eccube\Form\Type\Master\PrefType;
use Eccube\Form\Type\PriceType;
use Eccube\Form\Type\Master\SexType;
use Eccube\Form\Type\Master\MailTemplateType;
use Eccube\Repository\Master\CustomerStatusRepository;
use Eccube\Repository\MailTemplateRepository;
use Customize\Repository\CashbackSummaryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SearchCashbackType extends AbstractType
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var CustomerStatusRepository
     */
    protected $customerStatusRepository;

    /**
     * @var MailTemplateRepository
     */
    protected $mailTemplateRepository;

    /**
     * @var CashbackSummaryRepository
     */
    protected $cashbackSummaryRepository;

    /**
     * SearchCashbackType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     * @param CustomerStatusRepository $customerStatusRepository
     * @param MailTemplateRepository $mailTemplateRepository
     * @param CashbackSummaryRepository $cashbackSummaryRepository
     */
    public function __construct(
        EccubeConfig $eccubeConfig,
        CustomerStatusRepository $customerStatusRepository,
        MailTemplateRepository $mailTemplateRepository,
        CashbackSummaryRepository $cashbackSummaryRepository
    ) {
        $this->eccubeConfig = $eccubeConfig;
        $this->customerStatusRepository = $customerStatusRepository;
        $this->mailTemplateRepository = $mailTemplateRepository;
        $this->cashbackSummaryRepository = $cashbackSummaryRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $months = range(1, 12);
        $isread_name = array("未作成", "出力済");
        $isread_val = array("N", "Y");
        $date_list = $this->cashbackSummaryRepository->getListDateByAll();
        $dateval = [];
        $datename = [];
        foreach($date_list as $item){
            array_push($dateval, $item['dateVal']);
            array_push($datename, $item['dateName']);
        }

        $builder
            // 会員ID・メールアドレス・名前・名前(フリガナ)
            ->add('multi', TextType::class, [
                'label' => 'admin.customer.multi_search_label',
                'required' => false,
                'constraints' => [
                    new Assert\Length(['max' => $this->eccubeConfig['eccube_stext_len']]),
                ],
            ])
            ->add('cashback_ym', ChoiceType::class, [
                'label' => 'admin.cashback.cashback_ym',
                'placeholder' => 'admin.common.select',
                'required' => true,
                'choices' => array_combine($datename, $dateval),
                'data' => (count($dateval)>0?$dateval[0]:''),
            ])
            ->add('cb_is_read', ChoiceType::class, [
                'label' => 'admin.customer.cb_is_read',
                'placeholder' => 'admin.common.select',
                'required' => false,
                'choices' => array_combine($isread_name, $isread_val),
            ])
            ->add('sex', SexType::class, [
                'label' => 'admin.common.gender',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('birth_month', ChoiceType::class, [
                'label' => 'admin.customer.birth_month',
                'placeholder' => 'admin.common.select',
                'required' => false,
                'choices' => array_combine($months, $months),
            ])
            ->add('birth_start', BirthdayType::class, [
                'label' => 'admin.common.birth_day__start',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => ['year' => '----', 'month' => '--', 'day' => '--'],
                'attr' => [
                    'class' => 'datetimepicker-input',
                    'data-target' => '#'.$this->getBlockPrefix().'_birth_start',
                    'data-toggle' => 'datetimepicker',
                ],
            ])
            ->add('birth_end', BirthdayType::class, [
                'label' => 'admin.common.birth_day__end',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'placeholder' => ['year' => '----', 'month' => '--', 'day' => '--'],
                'attr' => [
                    'class' => 'datetimepicker-input',
                    'data-target' => '#'.$this->getBlockPrefix().'_birth_end',
                    'data-toggle' => 'datetimepicker',
                ],
            ])
            ->add('pref', PrefType::class, [
                'label' => 'admin.common.pref',
                'required' => false,
            ])
            ->add('phone_number', TextType::class, [
                'label' => 'admin.common.phone_number',
                'required' => false,
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => "/^[\d-]+$/u",
                        'message' => 'form_error.graph_and_hyphen_only',
                    ]),
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'admin_search_cashback';
    }
}
