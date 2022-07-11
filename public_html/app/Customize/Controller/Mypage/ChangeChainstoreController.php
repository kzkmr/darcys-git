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

namespace Customize\Controller\Mypage;

use Eccube\Controller\AbstractController;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Customize\Form\Type\Front\ChainStoreType;
use Customize\Repository\ChainStoreRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class ChangeChainstoreController extends AbstractController
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var ChainStoreRepository
     */
    protected $chainstoreRepository;

    /**
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    public function __construct(
        ChainStoreRepository $chainstoreRepository,
        EncoderFactoryInterface $encoderFactory,
        TokenStorageInterface $tokenStorage
    ) {
        $this->chainstoreRepository = $chainstoreRepository;
        $this->encoderFactory = $encoderFactory;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * 販売店情報編集画面.
     *
     * @Route("/mypage/change_chainstore", name="mypage_change_chainstore", methods={"GET", "POST"})
     * @Template("Mypage/change_chainstore.twig")
     */
    public function index(Request $request)
    {
        $Customer = $this->getUser();
        $ChainStore = $Customer->getChainStore();

        if(!is_object($ChainStore)){
            return $this->redirectToRoute('mypage_login');
        }

        $LoginChainStore = clone $ChainStore;
        $this->entityManager->detach($LoginChainStore);

        $ChainStore->setPoint( $Customer->getPoint() );

        /* @var $builder \Symfony\Component\Form\FormBuilderInterface */
        $builder = $this->formFactory->createBuilder(ChainStoreType::class, $ChainStore);

        /* @var $form \Symfony\Component\Form\FormInterface */
        $form = $builder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            log_info('販売店編集開始');

            $this->entityManager->flush();

            log_info('販売店編集完了');

            return $this->redirect($this->generateUrl('mypage_change_chainstore_complete'));
        }

        $this->tokenStorage->getToken()->setUser($Customer);

        return [
            'form' => $form->createView(),
            'EntryChainStore' => $ChainStore,
            'ChainstoreType' => $ChainStore->getContractType()
        ];
    }

    /**
     * 販売店情報編集完了画面.
     *
     * @Route("/mypage/change_chainstore_complete", name="mypage_change_chainstore_complete", methods={"GET"})
     * @Template("Mypage/change_chainstore_complete.twig")
     */
    public function complete(Request $request)
    {
        $Customer = $this->getUser();
        $ChainStore = $Customer->getChainStore();
        
        if(!is_object($ChainStore)){
            return $this->redirectToRoute('mypage_login');
        }

        return [
            
        ];
    }
}
