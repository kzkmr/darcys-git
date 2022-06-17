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
use Customize\Repository\Master\ContractTypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SearchDataExportChainStoreType extends AbstractType
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
     * @var ContractTypeRepository
     */
    protected $contractTypeRepository;

    /**
     * SearchCashbackType constructor.
     *
     * @param EccubeConfig $eccubeConfig
     * @param CustomerStatusRepository $customerStatusRepository
     * @param MailTemplateRepository $mailTemplateRepository
     * @param CashbackSummaryRepository $cashbackSummaryRepository
     * @param ContractTypeRepository $contractTypeRepository
     */
    public function __construct(
        EccubeConfig $eccubeConfig,
        CustomerStatusRepository $customerStatusRepository,
        MailTemplateRepository $mailTemplateRepository,
        CashbackSummaryRepository $cashbackSummaryRepository,
        ContractTypeRepository $contractTypeRepository
    ) {
        $this->eccubeConfig = $eccubeConfig;
        $this->customerStatusRepository = $customerStatusRepository;
        $this->mailTemplateRepository = $mailTemplateRepository;
        $this->cashbackSummaryRepository = $cashbackSummaryRepository;
        $this->contractTypeRepository = $contractTypeRepository;
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

        $contract_list = $this->contractTypeRepository->findBy(["is_hidden"=>"N"]);
        $contractval = [];
        $contractname = [];
        foreach($contract_list as $item){
            array_push($contractval, $item['id']);
            array_push($contractname, $item['name']);
        }

        $builder
            // 販売店ID・会社名・お名前・ディーラーコード・証券番号
            ->add('multi', TextType::class, [
                'label' => 'admin.chainstore.multi_search_label',
                'required' => false,
                'constraints' => [
                    new Assert\Length(['max' => $this->eccubeConfig['eccube_stext_len']]),
                ],
            ])
            ->add('data_ym', ChoiceType::class, [
                'label' => 'admin.dataexport.data_ym',
                'placeholder' => 'admin.common.select',
                'required' => true,
                'choices' => array_combine($datename, $dateval),
                'data' => (count($dateval)>0?$dateval[0]:''),
            ])
            ->add('contract_type', ChoiceType::class, [
                'label' => 'admin.chainstore.chain_store_contract_type',
                'placeholder' => 'admin.common.select',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
                'choices' => array_combine($contractname, $contractval),
                'data' => [$contractval[0], $contractval[1]],
            ])
            ->add('cb_is_read', ChoiceType::class, [
                'label' => 'admin.customer.cb_is_read',
                'placeholder' => 'admin.common.select',
                'required' => false,
                'choices' => array_combine($isread_name, $isread_val),
            ])
            ->add('transfer_ym', TextType::class, [
                'label' => 'admin.dataexport.transfer_ym',
                'required' => false,
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
