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


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\ProductClass;
use Eccube\Form\Type\Admin\ProductClassType;
use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Plugin\CustomerClassPrice4\Entity\CustomerClassPrice;
use Plugin\CustomerClassPrice4\Form\Type\Admin\CustomerClassPriceType;
use Plugin\CustomerClassPrice4\Repository\CustomerClassRepository;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ProductClassTypeExtension extends AbstractTypeExtension
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
    )
    {
        $this->customerClassRepository = $customerClassRepository;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CustomerClassPrices', CollectionType::class, [
                'entry_type' => CustomerClassPriceType::class,
                'mapped' => false
            ]);

        $builder
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event){
                $form = $event->getForm();
                $data = $event->getData();

                if($data instanceof ProductClass) {
                    $customerClasses = $this->customerClassRepository->findAll();

                    $customerClassPrices = new ArrayCollection();
                    foreach($customerClasses as $customerClass) {
                        if($customerClass instanceof CustomerClass) {
                            foreach($data->getPlgCcpCustomerClassPrices() as $customerClassPrice) {
                                if($customerClassPrice->getCustomerClass() === $customerClass) {
                                    $customerClassPrices->add($customerClassPrice);
                                    continue 2;
                                }
                            }

                            $customerClassPrice = new CustomerClassPrice();
                            $customerClassPrice->setCustomerClass($customerClass);
                            $customerClassPrices->add($customerClassPrice);
                        }
                    }

                    $form->get('CustomerClassPrices')->setData($customerClassPrices);
                }
            });

        $builder
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event){
                $form = $event->getForm();
                $data = $event->getData();

                if($data instanceof ProductClass) {
                    $customerClassPricesData = $form->get('CustomerClassPrices')->getData();
                    foreach($customerClassPricesData as $customerClassPriceData) {
                        if(!$customerClassPriceData->getId()) {
                            $customerClassPrice = new CustomerClassPrice();
                        }else{
                            $customerClassPrice = $customerClassPriceData;
                        }

                        $customerClassPrice->setPrice($customerClassPriceData->getPrice());
                        $customerClassPrice->setCustomerClass($customerClassPriceData->getCustomerClass());
                        $customerClassPrice->setProductClass($data);

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
        return ProductClassType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductClassType::class];
    }
}
