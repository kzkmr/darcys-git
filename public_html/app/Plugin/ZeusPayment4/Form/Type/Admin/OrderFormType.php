<?php

namespace Plugin\ZeusPayment4\Form\Type\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/*
 * ゼウス決済検索画面フォーム定義
 */
class OrderFormType extends AbstractType
{
    private $app;

    public function __construct(\Eccube\Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // 注文番号・オーダーNo
        $builder->add('multi', TextType::class, array(
            'label' => '注文番号・ゼウスオーダーNo',
            'required' => false
        ))
            ->add('order_id', TextType::class, array(
            'required' => false
        ))
            ->add('zeus_order_id', TextType::class, array(
            'required' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'zeus_payment_order';
    }
}
