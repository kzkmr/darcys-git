<?php
/*
* Plugin Name : HiddenDeliveryDate
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\HiddenDeliveryDate\Controller\Admin;

use Plugin\HiddenDeliveryDate\Entity\Hiddenday;
use Plugin\HiddenDeliveryDate\Repository\HiddendayRepository;
use Plugin\HiddenDeliveryDate\Form\Type\Admin\HiddendayType;
use Plugin\HiddenDeliveryDate\Form\Type\Admin\HiddendaySearchType;
use Eccube\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class HiddendayController extends \Eccube\Controller\AbstractController
{
    private $hiddendayRepository;
    private $productRepository;

    public function __construct(
            HiddendayRepository $hiddendayRepository,
            ProductRepository $productRepository
            )
    {
        $this->hiddendayRepository = $hiddendayRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/setting/hiddendeliverydate/hiddenday/{id}",requirements={"id" = "\d+"}, name="admin_setting_hiddendeliverydate_hiddenday")
     * @Template("@HiddenDeliveryDate/admin/Setting/Shop/hiddenday.twig")
     */
    public function index(Request $request, $id = null)
    {

        $form = $this->formFactory
            ->createBuilder(HiddendaySearchType::class)
            ->getForm();

        $Product = null;
        if(!is_null($id)){
            $Product = $this->productRepository->find($id);
        }

        $hiddendayForm = null;

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $arrChoice[Hiddenday::SUNDAY] = trans('hiddendeliverydate.common.sunday');
            $arrChoice[Hiddenday::MONDAY] = trans('hiddendeliverydate.common.monday');
            $arrChoice[Hiddenday::TUESDAY] = trans('hiddendeliverydate.common.tuesday');
            $arrChoice[Hiddenday::WEDNESDAY] = trans('hiddendeliverydate.common.wednesday');
            $arrChoice[Hiddenday::THURSDAY] = trans('hiddendeliverydate.common.thursday');
            $arrChoice[Hiddenday::FRIDAY] = trans('hiddendeliverydate.common.friday');
            $arrChoice[Hiddenday::SATURDAY] = trans('hiddendeliverydate.common.saturday');
            $month = $form->get('month')->getData();

            if(strlen($month) > 0){
                $end = new \DateTime(($month.'/01'));
                $end->modify('last day of this months');
                $end->modify('+1 day');
                $period = new \DatePeriod (
                    new \DateTime($month . '/01' ),
                    new \DateInterval('P1D'),
                    $end
                );

                $Hiddendays = new \Doctrine\Common\Collections\ArrayCollection();
                foreach ($period as $day) {
                    $Hiddenday = $this->hiddendayRepository->getHiddenday($day, $Product);
                    if($Hiddenday){
                        $Hiddenday->setAdd(true);
                    }else{
                        $Hiddenday = new Hiddenday();
                        $Hiddenday->setAdd(false);
                    }
                    $Hiddenday->setDate($day->format('Y/m/d'));

                    $Hiddendays->add($Hiddenday);
                }

                $builder = $this->formFactory->createBuilder();

                $builder
                    ->add('check_day', Type\ChoiceType::class, [
                        'choices' => array_flip($arrChoice),
                        'expanded' => true,
                        'multiple'=> true,
                        'mapped' => false,
                        'required' => false,
                    ])
                    ->add('hiddendays', Type\CollectionType::class, [
                        'entry_type' => HiddendayType::class,
                        'allow_add' => true,
                        'allow_delete' => true,
                        'data' => $Hiddendays,
                    ]);

                $hiddendayForm = $builder->getForm()->createView();
            }
        }

        return [
            'form' => $form->createView(),
            'hiddendayForm' => $hiddendayForm,
            'Product' => $Product,
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/setting/hiddendeliverydate/hiddenday/edit/{id}", requirements={"id" = "\d+"}, name="admin_setting_hiddendeliverydate_hiddenday_edit")
     */
    public function edit(Request $request, $id = null)
    {
        $Product = null;
        if(!is_null($id)){
            $Product = $this->productRepository->find($id);
        }

        $builder = $this->formFactory->createBuilder();

        $builder
            ->add('hiddendays', Type\CollectionType::class, [
                'entry_type' => HiddendayType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ]);

        $form = $builder->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            foreach ($form->get('hiddendays') as $formData) {
                $data = $formData->getData();
                $day = new \DateTime($data->getDate(), new \DateTimeZone('UTC'));
                $Hiddenday = $this->hiddendayRepository->getHiddenday($day, $Product);
                if ($data->getAdd()) {
                    if ($formData->isValid()) {
                        if(!$Hiddenday){
                            $Hiddenday = $data;
                            $Hiddenday->setDate($day);
                            if(!is_null($Product)){
                                $Hiddenday->setProduct($Product);
                            }
                        }
                        $this->entityManager->persist($Hiddenday);
                    }
                }else{
                    if($Hiddenday){
                        $this->entityManager->remove($Hiddenday);
                    }
                }
            }

            $this->entityManager->flush();
        }

        $this->addSuccess('admin.hiddendeliverydate.hiddenday.save.complete', 'admin');
        return $this->redirectToRoute('admin_setting_hiddendeliverydate_hiddenday',['id' => $id]);
    }
}