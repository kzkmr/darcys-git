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

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Eccube\Controller\EntryController as BaseEntryController;
use Eccube\Entity\BaseInfo;
use Customize\Entity\Master\ChainStoreStatus;
use Eccube\Entity\Master\CustomerStatus;
use Eccube\Entity\Master\Work;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Form\Type\Front\EntryType;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\CustomerRepository;
use Eccube\Repository\MemberRepository;
use Customize\Repository\ChainStoreRepository;
use Customize\Repository\Master\ContractTypeRepository;
use Eccube\Repository\Master\CustomerStatusRepository;
use Customize\Repository\Master\BankRepository;
use Customize\Repository\Master\BankBranchRepository;
use Customize\Repository\Master\BankAccountTypeRepository;
use Customize\Repository\Master\ChainStoreStatusRepository;
use Customize\Repository\PreChainStoreRepository;
use Eccube\Repository\PageRepository;
use Eccube\Service\CartService;
use Customize\Service\MailService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CustomEntryController extends BaseEntryController
{
    /**
     * @var CustomerStatusRepository
     */
    protected $customerStatusRepository;

    /**
     * @var ValidatorInterface
     */
    protected $recursiveValidator;

    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * @var BaseInfo
     */
    protected $BaseInfo;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var MemberRepository
     */
    protected $memberRepository;

    /**
     * @var ChainStoreRepository
     */
    protected $chainStoreRepository;
    
    /**
     * @var ChainStoreStatusRepository
     */
    protected $chainStoreStatusRepository;

    /**
     * @var BankRepository
     */
    protected $bankRepository;

    /**
     * @var BankBranchRepository
     */
    protected $bankBranchRepository;

    /**
     * @var BankAccountTypeRepository
     */
    protected $bankAccountTypeRepository;
    
    /**
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var \Eccube\Service\CartService
     */
    protected $cartService;

    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * @var ContractTypeRepository
     */
    protected $contractTypeRepository;

    /**
     * @var PreChainStoreRepository
     */
    protected $preChainStoreRepository;
    
    private $chainstore_type;

    /**
     * EntryController constructor.
     *
     * @param CartService $cartService
     * @param CustomerStatusRepository $customerStatusRepository
     * @param MailService $mailService
     * @param BaseInfoRepository $baseInfoRepository
     * @param CustomerRepository $customerRepository
     * @param MemberRepository $memberRepository
     * @param ChainStoreRepository $chainStoreRepository
     * @param ChainStoreStatusRepository $chainStoreStatusRepository
     * @param EncoderFactoryInterface $encoderFactory
     * @param ValidatorInterface $validatorInterface
     * @param TokenStorageInterface $tokenStorage
     * @param ContractTypeRepository $contractTypeRepository
     * @param PreChainStoreRepository $preChainStoreRepository
     */
    public function __construct(
        CartService $cartService,
        CustomerStatusRepository $customerStatusRepository,
        MailService $mailService,
        BaseInfoRepository $baseInfoRepository,
        CustomerRepository $customerRepository,
        MemberRepository $memberRepository,
        ChainStoreRepository $chainStoreRepository,
        ChainStoreStatusRepository $chainStoreStatusRepository,
        BankRepository $bankRepository,
        BankBranchRepository $bankBranchRepository,
        BankAccountTypeRepository $bankAccountTypeRepository,
        EncoderFactoryInterface $encoderFactory,
        ValidatorInterface $validatorInterface,
        TokenStorageInterface $tokenStorage,
        PageRepository $pageRepository,
        ContractTypeRepository $contractTypeRepository,
        PreChainStoreRepository $preChainStoreRepository
    ) {
        $this->customerStatusRepository = $customerStatusRepository;
        $this->mailService = $mailService;
        $this->BaseInfo = $baseInfoRepository->get();
        $this->customerRepository = $customerRepository;
        $this->memberRepository = $memberRepository;
        $this->chainStoreRepository = $chainStoreRepository;
        $this->chainStoreStatusRepository = $chainStoreStatusRepository;
        $this->bankRepository = $bankRepository;
        $this->bankBranchRepository = $bankBranchRepository;
        $this->bankAccountTypeRepository = $bankAccountTypeRepository;
        $this->encoderFactory = $encoderFactory;
        $this->recursiveValidator = $validatorInterface;
        $this->tokenStorage = $tokenStorage;
        $this->cartService = $cartService;
        $this->pageRepository = $pageRepository;
        $this->contractTypeRepository = $contractTypeRepository;
        $this->preChainStoreRepository = $preChainStoreRepository;
    }

    /**
     * ??????????????????.
     *
     * @Route("/entry", name="entry", methods={"GET", "POST"})
     * @Route("/entry", name="entry_confirm", methods={"GET", "POST"})
     * @Template("Entry/index.twig")
     */
    public function index(Request $request)
    {
        if ($this->isGranted('ROLE_USER')) {
            log_info('???????????????????????????????????????????????????');

            return $this->redirectToRoute('mypage');
        }

        $ChainstoreType = null;
        $ChainStoreTypeErr = false;
        $ChainstoreTypeMode = "";
        $ChainstoreTypeUrl = "";

        if(isset($this->chainstore_type) && strlen($this->chainstore_type) >= 1){
            $ChainstoreType = $this->contractTypeRepository->findOneBy(["url_parameter" => $this->chainstore_type, 'is_hidden' => 'N']);
            if(!is_object($ChainstoreType)){
                $ChainstoreType = $this->contractTypeRepository->findOneBy(["reg_url_parameter" => $this->chainstore_type, 'is_hidden' => 'N']);
                if(!is_object($ChainstoreType)){
                    $ChainStoreTypeErr = true;
                }else{
                    $ChainstoreTypeMode = "full";
                    $ChainstoreTypeUrl = $ChainstoreType->getRegUrlParameter();
                }
            }else{
                $ChainstoreTypeMode = "simple";
                $ChainstoreTypeUrl = $ChainstoreType->getUrlParameter();
            }
        }

        /** @var $Customer \Eccube\Entity\Customer */
        $Customer = $this->customerRepository->newCustomer();
        $Customer->setIsChainStore(is_object($ChainstoreType));

        /* @var $builder \Symfony\Component\Form\FormBuilderInterface */
        $builder = $this->formFactory->createBuilder(EntryType::class, $Customer);

        $event = new EventArgs(
            [
                'builder' => $builder,
                'Customer' => $Customer,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_ENTRY_INDEX_INITIALIZE, $event);

        /* @var $form \Symfony\Component\Form\FormInterface */
        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            switch ($request->get('mode')) {
                case 'confirm':
                    log_info('????????????????????????');
                    log_info('????????????????????????');

                    $urlRoute = 'entry_confirm';
                    $twigFile = 'Entry/confirm.twig';

                    if($ChainstoreType){
                        $urlRoute = "entry_chainstore_confirm";
                        $twigFile = 'Entry/chainstore_confirm.twig';
                    }

                    return $this->render(
                        $twigFile,
                        [
                            'form' => $form->createView(),
                            'Page' => $this->pageRepository->getPageByRoute($urlRoute),
                            'ChainStoreTypeErr' => $ChainStoreTypeErr,
                            'ChainstoreType' => $ChainstoreType,
                            'ChainstoreTypeMode' => $ChainstoreTypeMode,
                            'ChainstoreTypeUrl' => $ChainstoreTypeUrl
                        ]
                    );

                case 'complete':
                    log_info('??????????????????');

                    $encoder = $this->encoderFactory->getEncoder($Customer);
                    $salt = $encoder->createSalt();
                    $password = $encoder->encodePassword($Customer->getPassword(), $salt);
                    $secretKey = $this->customerRepository->getUniqueSecretKey();

                    $Customer
                        ->setSalt($salt)
                        ->setPassword($password)
                        ->setSecretKey($secretKey)
                        ->setPoint(0);

                    if($ChainstoreType){
                        $ChainStoreStatus = $this->entityManager->find(ChainStoreStatus::class, ChainStoreStatus::PROVISIONAL);
                        $preChainStore = $this->preChainStoreRepository->findOneBy(["id" => $Customer->getChainStore()->getPreChainStore()]);

                        $ChainStore = $Customer->getChainStore();
                        $Customer->getChainStore()->setStatus($ChainStoreStatus);
                        $Customer->getChainStore()->setMarginPrice(0);
                        $Customer->getChainStore()->setMarginNotIncluded(1);
                        $Customer->getChainStore()->setPurchasingLimitPrice(0);
                        $Customer->getChainStore()->setPreChainStore($preChainStore);
                        
                        if($ChainstoreType->getId()=="1"){
                            $Customer->getChainStore()->setPurchasingLimitPrice(1000000);
                        }

                        if($ChainstoreType->getId()=="1"){
                            $Customer->getChainStore()->setDeliveryRegistrations(9);
                        }else{
                            $Customer->getChainStore()->setDeliveryRegistrations(0);
                        }
                        
                        //$Customer->getChainStore()->setOptionOrderLimit(1);

                        if($ChainstoreType->getId()=="2"){
                            $Customer->getChainStore()->setOrderLimitText("???????????????????????????");
                        }//else{
                        //    $Customer->getChainStore()->setOrderLimitText("?????????????????????????????????????????????????????????????????????????????????");
                        //}

                        //?????????????????????????????????
                        $name01 = $ChainStore->getName01();
                        $name02 = $ChainStore->getName02();
                        $Customer->getChainStore()->setFullName($name01."".$name02);

                        //????????? ???????????????????????????
                        $mediatorName01 = $ChainStore->getMediatorName01();
                        $mediatorName02 = $ChainStore->getMediatorName02();
                        $Customer->getChainStore()->setMediatorFullname($mediatorName01.$mediatorName02);

                        //??????????????????(??????????????????)
                        $chainStoreTradingAccountType = $ChainStore->getChainStoreTradingAccountType();
                        if(is_object($chainStoreTradingAccountType)){
                            //??????????????????
                            if($chainStoreTradingAccountType->getId() == 2){
                                if(trim($ChainStore->getBankAccount()) != ""){
                                    $branchNo = $ChainStore->getCodeNumber();
                                    $accountNo = $ChainStore->getAccountNumber();

                                    if(!empty($branchNo)){
                                        //2???3??????????????????????????????8???????????????????????????????????????????????????
                                        $branchNo = substr($branchNo, 1, 2)."8";
                                    }
                                    //????????????1????????????????????????????????????????????????
                                    if(!empty($accountNo)){
                                        $accountNo = substr($accountNo, 0, -1);
                                    }

                                    $bankInfo = $this->bankBranchRepository->findOneBy(['bank_code' => "9900", "branch_code" => $branchNo]);
                                    if(is_object($bankInfo)){
                                        $Bank = $this->bankRepository->findOneBy(['id' => $bankInfo->getBankId()]);
                                        $bankAccountType = $this->bankAccountTypeRepository->findOneBy(['id' => 1]);  //??????

                                        //==> ???????????????
                                        $Customer->getChainStore()->setBank($Bank);
                                        //==> ?????????
                                        $Customer->getChainStore()->setBankBranch($bankInfo->getId());
                                        //==> ????????????
                                        $Customer->getChainStore()->setBankAccountType($bankAccountType);
                                        //==> ????????????
                                        $chainStore["bankAccountNo"] = $accountNo;
                                    }
                                }
                            }
                        }
                    }

                    $this->entityManager->persist($Customer);
                    $this->entityManager->flush();

                    log_info('??????????????????');

                    $event = new EventArgs(
                        [
                            'form' => $form,
                            'Customer' => $Customer,
                            'ChainStoreTypeErr' => $ChainStoreTypeErr,
                            'ChainstoreType' => $ChainstoreType,
                            'ChainstoreTypeMode' => $ChainstoreTypeMode,
                            'ChainstoreTypeUrl' => $ChainstoreTypeUrl
                        ],
                        $request
                    );
                    $this->eventDispatcher->dispatch(EccubeEvents::FRONT_ENTRY_INDEX_COMPLETE, $event);

                    $activateFlg = $this->BaseInfo->isOptionCustomerActivate();

                    // ????????????????????????????????????????????????????????????????????????????????????.
                    if ($activateFlg) {
                        $activateUrl = $this->generateUrl('entry_activate', ['secret_key' => $Customer->getSecretKey()], UrlGeneratorInterface::ABSOLUTE_URL);

                        // ???????????????
                        if($ChainstoreType){
                            $this->mailService->sendChainStoreConfirmMail($Customer, $activateUrl, $ChainstoreType);
                        }else{
                            $this->mailService->sendCustomerConfirmMail($Customer, $activateUrl);
                        }

                        if ($event->hasResponse()) {
                            return $event->getResponse();
                        }

                        log_info('????????????????????????????????????????????????');

                        return $this->redirectToRoute('entry_complete');
                    } else {
                        // ?????????????????????????????????????????????????????????????????????.
                        $qtyInCart = $this->entryActivate($request, $Customer->getSecretKey());
                        
                        if($qtyInCart === "not_found"){
                            return $this->render('Entry/activate_error.twig', [
                                'Page' => $this->pageRepository->getPageByRoute("activate_not_found")
                            ]);
                        }else{
                            // URL??????????????????????????????????????????????????????
                            return $this->redirectToRoute('entry_activate', [
                                'secret_key' => $Customer->getSecretKey(),
                                'qtyInCart' => $qtyInCart,
                            ]);
                        }
                    }
            }
        }

        return [
            'form' => $form->createView(),
            'ChainStoreTypeErr' => $ChainStoreTypeErr,
            'ChainstoreType' => $ChainstoreType,
            'ChainstoreTypeMode' => $ChainstoreTypeMode,
            'ChainstoreTypeUrl' => $ChainstoreTypeUrl
        ];
    }

    /**
     * ??????????????????????????????.
     *
     * @Route("/entry/register/{chainstore_type}", name="entry_chainstore", methods={"GET", "POST"})
     * @Route("/entry/register/{chainstore_type}", name="entry_chainstore_confirm", methods={"GET", "POST"})
     * @Template("Entry/chainstore_index.twig")
     */
    public function chainstore(Request $request, $chainstore_type)
    {
        $this->chainstore_type = $chainstore_type;
        return $this->index($request);
    }

    /**
     * ????????????????????????.
     *
     * @Route("/entry/complete", name="entry_complete", methods={"GET"})
     * @Template("Entry/complete.twig")
     */
    public function complete()
    {
        return [];
    }

    /**
     * ?????????????????????????????????????????????????????????.
     *
     * @Route("/entry/activate/{secret_key}/{qtyInCart}", name="entry_activate", methods={"GET"})
     * @Template("Entry/activate.twig")
     */
    public function activate(Request $request, $secret_key, $qtyInCart = null)
    {
        $errors = $this->recursiveValidator->validate(
            $secret_key,
            [
                new Assert\NotBlank(),
                new Assert\Regex(
                    [
                        'pattern' => '/^[a-zA-Z0-9]+$/',
                    ]
                ),
            ]
        );

        if (!is_null($qtyInCart)) {
            return [
                'qtyInCart' => $qtyInCart,
            ];
        } elseif ($request->getMethod() === 'GET' && count($errors) === 0) {
            // ???????????????????????????
            $qtyInCart = $this->entryActivate($request, $secret_key);

            if($qtyInCart === "not_found"){
                return $this->render('Entry/activate_error.twig', [
                    'Page' => $this->pageRepository->getPageByRoute("activate_not_found")
                ]);
            }else{
                return [
                    'qtyInCart' => $qtyInCart,
                ];
            }
        }

        throw new HttpException\NotFoundHttpException();
    }

    /**
     * ???????????????????????????
     *
     * @param Request $request
     * @param $secret_key
     *
     * @return \Eccube\Entity\Cart|mixed
     */
    private function entryActivate(Request $request, $secret_key)
    {
        log_info('?????????????????????');
        $Customer = $this->customerRepository->getProvisionalCustomerBySecretKey($secret_key);
        if (is_null($Customer)) {
            return "not_found";
            //throw new HttpException\NotFoundHttpException();
        }

        $CustomerStatus = $this->customerStatusRepository->find(CustomerStatus::REGULAR);

        $Customer->setStatus($CustomerStatus);
        $ChainStore = $Customer->getChainStore();

        if(is_object($ChainStore)){
            $ChainStoreStatus = $this->chainStoreStatusRepository->find(ChainStoreStatus::REGULAR);
            $ChainStore->setStatus($ChainStoreStatus);
        }

        $this->entityManager->persist($Customer);
        $this->entityManager->flush();

        log_info('?????????????????????');

        $event = new EventArgs(
            [
                'Customer' => $Customer,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_ENTRY_ACTIVATE_COMPLETE, $event);

        // ???????????????
        if(is_object($ChainStore)){
            $this->mailService->sendChainStoreCompleteMail($Customer, $ChainStore, $ChainStore->getContractType());
        }else{
            $this->mailService->sendCustomerCompleteMail($Customer);
        }

        $ChainStore = $Customer->getChainstore();

        if(is_object($ChainStore)){
            $ContractType = $ChainStore->getContractType();
            if(is_object($ContractType)){
                $MemberList = $this->memberRepository->findBy(['Work' => Work::ACTIVE]);

                foreach($MemberList as $Member){
                    // ??????????????????????????????
                    $this->mailService->sendChainStoreConfirmAdminMail($Member, $Customer, $ChainStore, $ContractType);
                }
            }
        }

        // Assign session carts into customer carts
        $Carts = $this->cartService->getCarts();
        $qtyInCart = 0;
        foreach ($Carts as $Cart) {
            $qtyInCart += $Cart->getTotalQuantity();
        }

        // ????????????????????????????????????????????????
        $token = new UsernamePasswordToken($Customer, null, 'customer', ['ROLE_USER']);
        $this->tokenStorage->setToken($token);
        $request->getSession()->migrate(true);

        if ($qtyInCart) {
            $this->cartService->save();
        }

        log_info('????????????????????????', [$this->getUser()->getId()]);

        return $qtyInCart;
    }
}
