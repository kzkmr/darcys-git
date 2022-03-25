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

namespace Customize\Form\Extension\Shopping;

use Eccube\Form\Type\Shopping\OrderType;
use Doctrine\Common\Collections\ArrayCollection;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Customer;
use Eccube\Entity\Delivery;
use Eccube\Entity\Order;
use Eccube\Entity\Payment;
use Eccube\Form\Type\AddressType;
use Eccube\Form\Type\KanaType;
use Eccube\Form\Type\Master\JobType;
use Eccube\Form\Type\Master\SexType;
use Eccube\Form\Type\NameType;
use Eccube\Form\Type\PhoneNumberType;
use Eccube\Form\Type\PostalType;
use Eccube\Form\Type\RepeatedEmailType;
use Eccube\Form\Type\RepeatedPasswordType;
use Eccube\Request\Context;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\DeliveryRepository;
use Eccube\Repository\OrderRepository;
use Eccube\Repository\PaymentRepository;
use Customize\Form\Type\Front\ChainStoreType;
use Customize\Repository\Master\ContractTypeRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Security;

class OrderTypeExtension extends AbstractTypeExtension
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var DeliveryRepository
     */
    protected $deliveryRepository;

    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;

    /**
     * @var BaseInfoRepository
     */
    protected $baseInfoRepository;

    /**
     * @var Context
     */
    protected $requestContext;

    private $security;

    /**
     * @var ContractTypeRepository
     */
    protected $contractTypeRepository;

    /**
     * OrderType constructor.
     *
     * @param OrderRepository $orderRepository
     * @param DeliveryRepository $deliveryRepository
     * @param PaymentRepository $paymentRepository
     * @param BaseInfoRepository $baseInfoRepository
     * @param Context $requestContext
     */
    public function __construct(
        OrderRepository $orderRepository,
        DeliveryRepository $deliveryRepository,
        PaymentRepository $paymentRepository,
        BaseInfoRepository $baseInfoRepository,
        Context $requestContext,
        Security $security,
        ContractTypeRepository $contractTypeRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->paymentRepository = $paymentRepository;
        $this->baseInfoRepository = $baseInfoRepository;
        $this->requestContext = $requestContext;
        $this->security = $security;
        $this->contractTypeRepository = $contractTypeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // 支払い方法のプルダウンを生成
        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            /** @var Order $Order */
            $Order = $event->getData();
            if (null === $Order || !$Order->getId()) {
                return;
            }
            $form = $event->getForm();

            $Deliveries = $this->getDeliveries($Order);
            $Payments = $this->getPayments($Deliveries);
            // @see https://github.com/EC-CUBE/ec-cube/issues/4881
            $charge = $Order->getPayment() ? $Order->getPayment()->getCharge() : 0;
            $Payments = $this->filterPayments($Payments, $Order->getPaymentTotal() - $charge);

            //https://github.com/EC-CUBE/ec-cube/issues/4208
            $Payments = $this->getPaymentListByContractType($Payments);
            if(count($Payments) == 1){
                $Payment =$Payments[0];

                if($Order->getPayment()){
                    if($Order->getPayment()->getId() != $Payment->getId()){
                        $Order->setPayment($Payment);
                        if ($Payment && $Payment->getMethod()) {
                            $Order->setPaymentMethod($Payment->getMethod());
                        }

                        $PaymentField = $form->get('Payment');
                        $PaymentFieldOptions = $PaymentField->getConfig()->getOptions();
                        $PaymentFieldOptions['data'] = $Payment;
                        $form->add('Payment', EntityType::class, $PaymentFieldOptions);
                    }
                }
            }

            //$form = $event->getForm();
            //$this->addPaymentForm($form, $Payments, $Order->getPayment());
        });

        // 支払い方法のプルダウンを生成(Submit時)
        // 配送方法の選択によって使用できる支払い方法がかわるため, フォームを再生成する.
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            /** @var Order $Order */
            $Order = $event->getForm()->getData();
            $data = $event->getData();
            $form = $event->getForm();
            
            $Deliveries = [];
            if (!empty($data['Shippings'])) {
                foreach ($data['Shippings'] as $Shipping) {
                    if (!empty($Shipping['Delivery'])) {
                        $Delivery = $this->deliveryRepository->find($Shipping['Delivery']);
                        if ($Delivery) {
                            $Deliveries[] = $Delivery;
                        }
                    }
                }
            }

            $Payments = $this->getPayments($Deliveries);
            // @see https://github.com/EC-CUBE/ec-cube/issues/4881
            $charge = $Order->getPayment() ? $Order->getPayment()->getCharge() : 0;
            $Payments = $this->filterPayments($Payments, $Order->getPaymentTotal() - $charge);

            //https://github.com/EC-CUBE/ec-cube/issues/4208
            $Payments = $this->getPaymentListByContractType($Payments);
            if(count($Payments) == 1){
                $Payment =$Payments[0];
                if($Order->getPayment()){
                    if($Order->getPayment()->getId() != $Payment->getId()){
                        $Order->setPayment($Payment);
                        if ($Payment && $Payment->getMethod()) {
                            $Order->setPaymentMethod($Payment->getMethod());
                        }

                        $PaymentField = $form->get('Payment');
                        $PaymentFieldOptions = $PaymentField->getConfig()->getOptions();
                        $PaymentFieldOptions['data'] = $Payment;
                        $form->add('Payment', EntityType::class, $PaymentFieldOptions);
                    }
                }
            }

            //$form = $event->getForm();
            //$this->addPaymentForm($form, $Payments);
        });

    }

    private function getPaymentListByContractType($Payments){
        $PaymentList = null;
        $user = $this->security->getUser();
        
        //一般会員
        $NormalContractType = $this->contractTypeRepository->findOneBy(['id' => 4]);

        if($user){
            $ChainStore = $user->getChainStore();
            if($ChainStore){
                $ContractType = $ChainStore->getContractType();
                $PaymentList = $this->mergePayment($Payments, explode(",", $ContractType->getPaymentLimit()));
            }else{
                $PaymentList = $this->mergePayment($Payments, explode(",", $NormalContractType->getPaymentLimit()));
            }
        }else{
            $PaymentList = $this->mergePayment($Payments, explode(",", $NormalContractType->getPaymentLimit()));
        }

        return $PaymentList;
    }

    private function mergePayment($Payments, $paymentListId){
        $PaymentsList = [];
        foreach ($Payments as $Payment) {
            foreach ($paymentListId as $paymentId) {
                if($Payment->getId() == $paymentId){
                    $PaymentsList[] = $Payment;
                }
            }
        }

        return $PaymentsList;
    }

    /**
     * 出荷に紐づく配送方法を取得する.
     *
     * @param Order $Order
     *
     * @return Delivery[]
     */
    private function getDeliveries(Order $Order)
    {
        $Deliveries = [];
        foreach ($Order->getShippings() as $Shipping) {
            $Delivery = $Shipping->getDelivery();
            if ($Delivery->isVisible()) {
                $Deliveries[] = $Shipping->getDelivery();
            }
        }

        return array_unique($Deliveries);
    }

    /**
     * 配送方法に紐づく支払い方法を取得する
     * 各配送方法に共通する支払い方法のみ返す.
     *
     * @param Delivery[] $Deliveries
     *
     * @return ArrayCollection
     */
    private function getPayments($Deliveries)
    {
        $PaymentsByDeliveries = [];
        foreach ($Deliveries as $Delivery) {
            $PaymentOptions = $Delivery->getPaymentOptions();
            foreach ($PaymentOptions as $PaymentOption) {
                /** @var Payment $Payment */
                $Payment = $PaymentOption->getPayment();
                if ($Payment->isVisible()) {
                    $PaymentsByDeliveries[$Delivery->getId()][] = $Payment;
                }
            }
        }

        if (empty($PaymentsByDeliveries)) {
            return new ArrayCollection();
        }

        $i = 0;
        $PaymentsIntersected = [];
        foreach ($PaymentsByDeliveries as $Payments) {
            if ($i === 0) {
                $PaymentsIntersected = $Payments;
            } else {
                $PaymentsIntersected = array_intersect($PaymentsIntersected, $Payments);
            }
            $i++;
        }

        return new ArrayCollection($PaymentsIntersected);
    }

    /**
     * 支払い方法の利用条件でフィルタをかける.
     *
     * @param ArrayCollection $Payments
     * @param $total
     *
     * @return Payment[]
     */
    private function filterPayments(ArrayCollection $Payments, $total)
    {
        $PaymentArrays = $Payments->filter(function (Payment $Payment) use ($total) {
            $charge = $Payment->getCharge();
            $min = $Payment->getRuleMin();
            $max = $Payment->getRuleMax();

            if (null !== $min && ($total + $charge) < $min) {
                return false;
            }

            if (null !== $max && ($total + $charge) > $max) {
                return false;
            }

            return true;
        })->toArray();
        usort($PaymentArrays, function (Payment $a, Payment $b) {
            return $a->getSortNo() < $b->getSortNo() ? 1 : -1;
        });

        return $PaymentArrays;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return OrderType::class;
    }

    public function getExtendedTypes()
    {
        return [OrderType::class];
    }
}
