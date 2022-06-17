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
use Eccube\Entity\ProductClass;
use Eccube\Form\Type\Admin\ProductClassEditType;
use Eccube\Form\Type\PriceType;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Plugin\CustomerClassPrice4\Repository\CustomerClassPriceRepository;
use Plugin\CustomerClassPrice4\Repository\CustomerClassRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ProductClassEditTypeExtension extends AbstractTypeExtension
{
    /**
     * @var CustomerClassRepository
     */
    private $customerClassRepository;

    /**
     * @var CustomerClassPriceRepository
     */
    private $customerClassPriceRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        CustomerClassRepository $customerClassRepository,
        CustomerClassPriceRepository $customerClassPriceRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->customerClassRepository = $customerClassRepository;
        $this->customerClassPriceRepository = $customerClassPriceRepository;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $customerClasses = $this->customerClassRepository->findAll();

        foreach($customerClasses as $customerClass) {
            $builder->add('customer_class_' . $customerClass->getId(), PriceType::class, [
                'label' => $customerClass->getName(),
                'required' => false,
                'mapped' => false,
                'eccube_form_options' => [
                    'auto_render' => true
                ]
            ]);
        }

        $builder
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event){
                $form = $event->getForm();
                $data = $event->getData();

                if($data instanceof ProductClass) {
                    $customerClasses = $this->customerClassRepository->findAll();
                    foreach($customerClasses as $customerClass) {
                        if($customerClass instanceof CustomerClass) {
                            foreach($data->getPlgCcpCustomerClassPrices() as $customerClassPrice) {
                                $form->get('customer_class_' . $customerClassPrice->getCustomerClass()->getId())->setData($customerClassPrice->getPrice());
                            }
                        }
                    }
                }
            });

        $builder
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($customerClasses) {
                $form = $event->getForm();
                $data = $event->getData();

                if ($data instanceof ProductClass) {
                    $customerClasses = $this->customerClassRepository->findAll();
                    foreach ($customerClasses as $customerClass) {
                        $price = $form->get("customer_class_" . $customerClass->getId())->getData();

                        $customerClassPrice = $this->customerClassPriceRepository->findOneBy([
                            "customerClass" => $customerClass,
                            "productClass" => $data
                        ]);

                        if (!$customerClassPrice) {
                            $customerClassPrice = new CustomerClassPrice();
                            $customerClassPrice->setCustomerClass($customerClass);
                            $customerClassPrice->setProductClass($data);
                        }
                        $customerClassPrice->setPrice($price);

                        $data->addPlgCcpCustomerClassPrice($customerClassPrice);
                    }

                    $event->setData($data);
                }
            });
    }

    /**
     * @inheritDoc
     */
    public function getExtendedType()
    {
        // TODO: Implement getExtendedType() method.
        return ProductClassEditType::class;

    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductClassEditType::class];
    }
}
