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

namespace Customize\Service;

use Eccube\Service\MailService;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\BaseInfo;
use Eccube\Entity\Customer;
use Eccube\Entity\Member;
use Eccube\Entity\Order;
use Eccube\Entity\OrderItem;
use Eccube\Entity\Shipping;
use Customize\Entity\ChainStore;
use Customize\Entity\CashbackSummary;
use Customize\Entity\DealerSummary;
use Customize\Entity\BankTransferInfo;
use Customize\Entity\Master\ContractType;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Customize\Repository\ShippingRepository;
use Customize\Repository\CustomerRepository;
use Customize\Repository\ChainStoreRepository;
use Customize\Repository\BankTransferInfoRepository;
use Customize\Repository\CashbackSummaryRepository;
use Customize\Repository\DealerSummaryRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CashbackService
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var ShippingRepository
     */
    protected $shippingRepository;

    /**
     * @var ChainStoreRepository
     */
    protected $chainStoreRepository;

    /**
     * @var CashbackSummaryRepository
     */
    protected $cashbackSummaryRepository;

    /**
     * @var DealerSummaryRepository
     */
    protected $dealerSummaryRepository;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var BaseInfo
     */
    protected $BaseInfo;

    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var BankTransferInfoRepository
     */
    protected $bankTransferInfoRepository;

    /**
     * CashbackService constructor.
     *
     * @param OrderRepository $orderRepository
     * @param ShippingRepository $shippingRepository
     * @param ChainStoreRepository $chainStoreRepository
     * @param CashbackSummaryRepository $cashbackSummaryRepository
     * @param DealerSummaryRepository $dealerSummaryRepository
     * @param BaseInfoRepository $baseInfoRepository
     * @param EventDispatcherInterface $eventDispatcher
     * @param \Twig_Environment $twig
     * @param EccubeConfig $eccubeConfig
     * @param EntityManagerInterface $entityManager
     * @param BankTransferInfoRepository $bankTransferInfoRepository
     */
    public function __construct(
        OrderRepository $orderRepository,
        ShippingRepository $shippingRepository,
        ChainStoreRepository $chainStoreRepository,
        CashbackSummaryRepository $cashbackSummaryRepository,
        DealerSummaryRepository $dealerSummaryRepository,
        BaseInfoRepository $baseInfoRepository,
        EventDispatcherInterface $eventDispatcher,
        \Twig_Environment $twig,
        EccubeConfig $eccubeConfig,
        EntityManagerInterface $entityManager,
        BankTransferInfoRepository $bankTransferInfoRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->shippingRepository = $shippingRepository;
        $this->chainStoreRepository = $chainStoreRepository;
        $this->cashbackSummaryRepository = $cashbackSummaryRepository;
        $this->dealerSummaryRepository = $dealerSummaryRepository;
        $this->BaseInfo = $baseInfoRepository->get();
        $this->eventDispatcher = $eventDispatcher;
        $this->eccubeConfig = $eccubeConfig;
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->bankTransferInfoRepository = $bankTransferInfoRepository;
    }

    public function calcDealer($calcYM)
    {
        $this->dealerSummaryRepository->deleteByYM($calcYM);
        $this->entityManager->flush();

        $calcDealerList = $this->shippingRepository->findCalcDealerList($calcYM);

        foreach($calcDealerList as $dealer){
            if($dealer["sales_total"] == null && $dealer["self_total"] == null){
                continue;
            }

            $ChainStoreId = $dealer["id"];
            $ChainStore = $this->chainStoreRepository->findOneBy(["id" => $ChainStoreId]);

            $dealerSummary = new DealerSummary();
            $dealerSummary->setReferenceYm($calcYM);
            $dealerSummary->setChainStore($ChainStore);
            $dealerSummary->setSalesTotal(($dealer["sales_total"]?: 0));
            $dealerSummary->setSalesMargin(($dealer["sales_margin"]?: 0));
            $dealerSummary->setSelfTotal(($dealer["self_total"]?: 0));
            $dealerSummary->setOenSelfTotal(($dealer["oen_self_total"]?: 0));
            $dealerSummary->setKouriSelfTotal(($dealer["kouri_self_total"]?: 0));
            $dealerSummary->setChainTotal(($dealer["chain_total"]?: 0));
            $dealerSummary->setMarginTotal(($dealer["margin_total"]?: 0));
            $dealerSummary->setExportCnt(0);

            $this->dealerSummaryRepository->save($dealerSummary);
            $this->entityManager->flush();
        }

        return $calcDealerList;
    }

    public function calcCashback($calcYM){
        $calcMarginList = $this->shippingRepository->findCalcMarginList($calcYM);
        $calcDealerList = $this->calcDealer($calcYM);
        
        $date = new \DateTime($calcYM."-01");
        $date->modify('-1 months');
        $previousYM = $date->format('Y-m');
        $previousCashbackList = $this->cashbackSummaryRepository->findBy(["referenceYm" => $previousYM]);

        $this->cashbackSummaryRepository->deleteByYM($calcYM);
        $this->entityManager->flush();
        
        $Cashback = [];

        foreach($calcMarginList as $margin){
            $ChainStoreId = $margin["id"];
            $previousMarginPrice = 0;
            $ChainStore = $this->chainStoreRepository->findOneBy(["id" => $ChainStoreId]);

            /*
            if($ChainStore){
                if( $ChainStore->getContractType()->getId() == 3 ){
                    continue;
                }
            }else{
                continue;
            }
            */

            if($previousCashbackList){
                foreach($previousCashbackList as $previousCashback){
                    if($previousCashback->getChainStore()){
                        if($previousCashback->getChainStore()->getId() == $ChainStoreId){
                            $previousMarginPrice = $previousCashback->getCarriedForward();
                            break;
                        }
                    }
                }
            }

            //請求金額
            $requestAmount = ($margin["self_total"]+$margin["kouri_self_total"]) - ($margin["margin_total"] + $previousMarginPrice);

            if(is_object($ChainStore)){
                //応援
                if( $ChainStore->getContractType()->getId() == 2 ){
                    //請求金額
                    if($margin["oen_self_total"] > $margin["margin_total"]){
                        $requestAmount = $margin["oen_self_total"] - $margin["margin_total"];
                    }
                }
            }

            $cashbackSummary = new CashbackSummary();
            $cashbackSummary->setReferenceYm($calcYM);
            $cashbackSummary->setChainStore($ChainStore);
            $cashbackSummary->setPreviousMarginPrice($previousMarginPrice);
            $cashbackSummary->setMarginPrice($margin["margin_total"]);
            $cashbackSummary->setExportCnt(0);
            $cashbackSummary->setPurchaseAmount(0);
            //マージン残高
            $cashbackSummary->setMarginBalance(0);
            //繰り越しマージン
            $cashbackSummary->setCarriedForward(0);
            //請求金額
            $cashbackSummary->setRequestAmount(0);

            if($margin["self_total"]){
                $cashbackSummary->setPurchaseAmount($margin["self_total"]);
            }

            if($ChainStore){
                if( $ChainStore->getContractType()->getId() == 2 ){
                    if($margin["oen_self_total"]){
                        $cashbackSummary->setPurchaseAmount($margin["oen_self_total"]);
                    }
                }
                if( $ChainStore->getContractType()->getId() == 3 ){
                    if($margin["kouri_self_total"]){
                        $cashbackSummary->setPurchaseAmount($margin["kouri_self_total"]);
                    }
                }
            }

            //請求金額
            if($requestAmount > 0){
                //請求金額
                $cashbackSummary->setRequestAmount($requestAmount);
            }else{
                //マージン残高
                $marginBalance = ($margin["margin_total"] + $previousMarginPrice) - $margin["self_total"];

                if($ChainStore){
                    //応援
                    if( $ChainStore->getContractType()->getId() == 2 ){
                        $marginBalance = $marginBalance - $margin["oen_self_total"];
                    }
                }

                $cashbackSummary->setMarginBalance($marginBalance);
                //繰り越しマージン
                if($marginBalance < 2000){
                    $cashbackSummary->setCarriedForward($marginBalance);
                }
            }

            $this->cashbackSummaryRepository->save($cashbackSummary);
            $this->entityManager->flush();

            $Cashback[] = $cashbackSummary;
        }

        foreach($previousCashbackList as $previousItem){
            $inMarginList = false;
            $ChainStore = $previousItem->getChainStore();

            if(!is_object($ChainStore)){
                continue;
            }

            foreach($calcMarginList as $margin){
                $marginChainStoreId = $margin["id"];

                if($ChainStore->getId() == $marginChainStoreId){
                    $inMarginList = true;
                    break;
                }
            }

            if($inMarginList){
                continue;
            }

            if($previousItem->getCarriedForward() <= 0){
                continue;
            }

            $cashbackSummary = new CashbackSummary();
            $cashbackSummary->setReferenceYm($calcYM);
            $cashbackSummary->setChainStore($ChainStore);
            $cashbackSummary->setPreviousMarginPrice($previousItem->getCarriedForward());
            $cashbackSummary->setMarginPrice(0);
            $cashbackSummary->setExportCnt(0);
            $cashbackSummary->setPurchaseAmount(0);
            //マージン残高
            $cashbackSummary->setMarginBalance(0);
            //繰り越しマージン
            $cashbackSummary->setCarriedForward($previousItem->getCarriedForward());
            //請求金額
            $cashbackSummary->setRequestAmount(0);

            $this->cashbackSummaryRepository->save($cashbackSummary);
            $this->entityManager->flush();
        }

        $transferDate = $this->bankTransferInfoRepository->findOneBy(["referenceYm" => $calcYM]);
        if(!is_object($transferDate)){
            $defaultTransferDate = strtotime("+1 months", strtotime($calcYM."-15"));
            //Insert
            $bankTransferInfo = new BankTransferInfo();
            $bankTransferInfo->setReferenceYm($calcYM);
            $bankTransferInfo->setTransferDate(date('Y/m/d', $defaultTransferDate));
            $this->entityManager->persist($bankTransferInfo);
            $this->entityManager->flush();
        }

        return  [
            "MarginList" => $calcMarginList,
            "DealerList" => $calcDealerList,
            "Cashback" => $Cashback
        ];
    }
}
