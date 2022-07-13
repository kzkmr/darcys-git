<?php
/*
* Plugin Name : DeliveryPlus4
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\DeliveryPlus4\Controller\Admin;

use Eccube\Controller\AbstractController;
use Plugin\DeliveryPlus4\Form\Type\Admin\ConfigType;
use Plugin\DeliveryPlus4\Repository\ConfigRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ConfigController extends AbstractController
{
    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * ConfigController constructor.
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @Route("/%eccube_admin_route%/plugin/delivery_plus/config", name="delivery_plus4_admin_config")
     * @Template("@DeliveryPlus4/admin/Setting/config.twig")
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $form = $this->formFactory
            ->createBuilder(ConfigType::class)
            ->getForm();

        $Configs = $this->configRepository->findAll();

        foreach($Configs as $config) {
            if(is_null($config->getValue()) || is_array($config->getValue())) continue;
            $form[$config->getName()]->setData($config->getValue());
        }

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                //設定内容を一度クリア
                foreach($Configs as $config){
                    $this->entityManager->remove($config);
                }
                $this->entityManager->flush();

                //設定登録
                $Values = $form->getData();
                foreach($Values as $name => $value){
                    $Config = new \Plugin\DeliveryPlus4\Entity\DeliveryPlusConfig();
                    $Config->setName($name);
                    $Config->setValue($value);
                    $this->entityManager->persist($Config);
                }
                $this->entityManager->flush();
                $this->addSuccess('deliveryplus.admin.save.complete', 'admin');
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
