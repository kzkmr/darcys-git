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
use Eccube\Repository\MemberRepository;
use Eccube\Repository\CustomerRepository;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\Routing\Annotation\Route;

use Customize\Service\MailService;
use Customize\Service\CashbackService;
use Customize\Repository\ChainStoreRepository;
use Plugin\Coupon4\Repository\CouponRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CronJobController extends AbstractController
{
    private $key = "e564c9a69921be4a9268be4df8bc3fa271437c28";
	
    /**
     * @var ChainStoreRepository
     */
    protected $chainstoreRepository;
    
    /**
     * @var MemberRepository
     */
    protected $memberRepository;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var CouponRepository
     */
    protected $couponRepository;

    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * @var CashbackService
     */
    protected $cashbackService;

	/**
     * BankController constructor.
     */
    public function __construct(
        ChainStoreRepository $chainstoreRepository,
        MemberRepository $memberRepository,
        CustomerRepository $customerRepository,
        CouponRepository $couponRepository,
        MailService $mailService,
        CashbackService $cashbackService)
    {
        $this->chainstoreRepository = $chainstoreRepository;
        $this->memberRepository = $memberRepository;
        $this->customerRepository = $customerRepository;
        $this->couponRepository = $couponRepository;
        $this->mailService = $mailService;
        $this->cashbackService = $cashbackService;
    }


    /**
     * check chainstore mail.
     *
     * @Route("/cronjob/check_chainstore_mail/{key}", name="check_chainstore_mail", methods={"GET"})
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function checkChainStoreMail(Request $request, $key)
    {
        $result = [];
        
        try {
            if($this->key != $key){
                $result[] = "Incorrect registry key for Access!!";
            }else{
                // タイムアウトを無効にする.
                set_time_limit(0);
                $CustomerList = $this->customerRepository->findBy(["Status" => 2]);
                $MemberList = $this->memberRepository->findBy(["Work" => 1]);
                //$MemberList = $this->memberRepository->findBy(["id" => 2]);

                $DealerCodeList = [];
                $CouponCodeList = [];

                foreach($CustomerList as $Customer){
                    $ChainStore = $Customer->getChainStore();
                    if(is_object($ChainStore)){
                        $ContractType = $ChainStore->getContractType();
                        
                        $DealerCode = $ChainStore->getDealerCode();
                        if(!isset($DealerCode) || strlen($DealerCode) <= 1){
                            $DealerCodeList[] = $Customer;
                        }

                        if($ContractType->getId() == 1 || $ContractType->getId() == 2){
                            $CouponList = $this->couponRepository->findBy(["ChainStore" => $ChainStore]);
                            if(!$CouponList){
                                $CouponCodeList[] = $Customer;
                            }
                        }
                    }
                }

                if(count($DealerCodeList) > 0 || count($CouponCodeList) > 0){
                    foreach($MemberList as $Member){
                        // チェック販売店会員メール送信
                        $this->mailService->sendCheckChainStoreMail($Member, $DealerCodeList, $CouponCodeList);
                        $result[] = $Member->getId();
                    }
                }
            }
        } catch (\Exception $e) {
            log_error('予期しないエラーです', [$e->getMessage()]);

            return $this->json(['status' => $e->getMessage()], 500);
        }

        return $this->json(array_merge(['status' => 'OK', 'data' => $result], []));
    }

    /**
     * Cashback 計算画面.
     *
     * @Route("/cronjob/calc_cashback/{key}", name="calc_cashback", methods={"GET", "POST"})
     * @Template("Cashback/calcCashback.twig")
     */
    public function calcCashback(Request $request, $key)
    {
        $YM = date('Y-m');
        
        return $this->calcCashbackYM($request, $YM, $key);
    }

    /**
     * Cashback 計算画面(指定年月).
     *
     * @Route("/cronjob/calc_cashback/{YM}/{key}", name="calc_cashback_ym", methods={"GET", "POST"})
     * @Template("Cashback/calcCashback.twig")
     */
    public function calcCashbackYM(Request $request, $YM, $key)
    {
        if($this->key != $key){
            $error = "Incorrect registry key for Access!!";

            return [
                'Error' => $error
            ];
        }else{
            $CashbackResult = $this->cashbackService->calcCashback($YM);

            return [
                'CashbackResult' => $CashbackResult,
                'Error' => null
            ];
        }
    }

    /**
     * test chainstore register to admin mail.
     *
     * @Route("/test_admin_mail", name="test_admin_mail", methods={"GET"})
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function test_admin_mail(Request $request)
    {
        $result = [];
        
        try {
            // タイムアウトを無効にする.
            set_time_limit(0);
            $ChainStore = $this->chainstoreRepository->findOneBy(["id" => 68]);
            $Member = $this->memberRepository->findOneBy(["id" => 2]);
            $Customer = $this->customerRepository->findOneBy(["id" => 108]);

            // 販売店会員メール送信
            $this->mailService->sendChainStoreConfirmAdminMail($Member, $Customer, $ChainStore, $ChainStore->getContractType());
        } catch (\Exception $e) {
            log_error('予期しないエラーです', [$e->getMessage()]);

            return $this->json(['status' => $e->getMessage()], 500);
        }

        return $this->json(array_merge(['status' => 'OK', 'data' => $result], []));
    }


}
