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
use Customize\Entity\Master\Bank;
use Customize\Repository\Master\BankBranchRepository;
use Customize\Repository\ChainStoreRepository;
use Customize\Repository\PreChainStoreRepository;

class ApiController extends AbstractController
{
    /**
     * @var BankBranchRepository
     */
    protected $bankBranchRepository;
	
    /**
     * @var ChainStoreRepository
     */
    protected $chainstoreRepository;

    /**
     * @var PreChainStoreRepository
     */
    protected $preChainStoreRepository;
    
    /**
     * @var MemberRepository
     */
    protected $memberRepository;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var MailService
     */
    protected $mailService;

	/**
     * BankController constructor.
     */
    public function __construct(
        BankBranchRepository $bankBranchRepository,
        ChainStoreRepository $chainstoreRepository,
        PreChainStoreRepository $preChainStoreRepository,
        MemberRepository $memberRepository,
        CustomerRepository $customerRepository,
        MailService $mailService)
    {
        $this->bankBranchRepository = $bankBranchRepository;
        $this->chainstoreRepository = $chainstoreRepository;
        $this->preChainStoreRepository = $preChainStoreRepository;
        $this->memberRepository = $memberRepository;
        $this->customerRepository = $customerRepository;
        $this->mailService = $mailService;
    }

    /**
     * Bank.
     *
     * @Route("/bank/list/{bank_id}", name="bank_list", methods={"POST"})
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function bankList(Request $request, $bank_id)
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->json(['status' => 'NG'], 400);
        }

        $result = [];
        try {
            // タイムアウトを無効にする.
            set_time_limit(0);

            // sql loggerを無効にする.
            $em = $this->entityManager;
            $em->getConfiguration()->setSQLLogger(null);

            $bankBranch = $this->bankBranchRepository->findBy(
                [
                    'bank_id' => $bank_id
                ],
                ['sort_no' => 'ASC']
            );


        } catch (\Exception $e) {
            log_error('予期しないエラーです', [$e->getMessage()]);

            return $this->json(['status' => 'NG2'], 500);
        }

        return $this->json(array_merge(['status' => 'OK', 'data' => $bankBranch], $result));
    }

    
    /**
     * chainstore.
     *
     * @Route("/chainstore/api/list/{keyword}", name="chainstore_api_list", methods={"POST"})
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function api_chainstore_list(Request $request, $keyword)
    {
        /*
        if (!$request->isXmlHttpRequest()) {
            return $this->json(['status' => 'NG'], 400);
        }
        */

        $result = [];
        
        try {
            // タイムアウトを無効にする.
            set_time_limit(0);
            $ChainStoreList = $this->chainstoreRepository->getResultBySearchKeyword($keyword);
            foreach($ChainStoreList as $ChainStore){
                $chainStore = [];
                $chainStore["id"] = $ChainStore->getId();
                $chainStore["name01"] = $ChainStore->getName01();
                $chainStore["name02"] = $ChainStore->getName02();
                $chainStore["companyName"] = $ChainStore->getCompanyName();
                $chainStore["stock_number"] = $ChainStore->getStockNumber();
                $chainStore["ContractTypeName"] = $ChainStore->getContractType()->getName();
                $chainStore["dealerCode"] = $ChainStore->getDealerCode();

                array_push($result, $chainStore);
            }
        } catch (\Exception $e) {
            log_error('予期しないエラーです', [$e->getMessage()]);

            return $this->json(['status' => $e], 500);
        }

        return $this->json(array_merge(['status' => 'OK', 'data' => $result], []));
    }


    /**
     * chainstore.
     *
     * @Route("/chainstore/api/main/list/{keyword}", name="chainstore_api_main_list", methods={"POST"})
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function api_chainstore_main_list(Request $request, $keyword)
    {
        /*
        if (!$request->isXmlHttpRequest()) {
            return $this->json(['status' => 'NG'], 400);
        }
        */

        $result = [];
        
        try {
            // タイムアウトを無効にする.
            set_time_limit(0);
            $ChainStoreList = $this->chainstoreRepository->getResultByMainSearchKeyword($keyword);
            foreach($ChainStoreList as $ChainStore){
                $chainStore = [];
                $chainStore["id"] = $ChainStore->getId();
                $chainStore["name01"] = $ChainStore->getName01();
                $chainStore["name02"] = $ChainStore->getName02();
                $chainStore["companyName"] = $ChainStore->getCompanyName();
                $chainStore["stock_number"] = $ChainStore->getStockNumber();
                $chainStore["ContractTypeName"] = $ChainStore->getContractType()->getName();
                $chainStore["dealerCode"] = $ChainStore->getDealerCode();

                array_push($result, $chainStore);
            }
        } catch (\Exception $e) {
            log_error('予期しないエラーです', [$e->getMessage()]);

            return $this->json(['status' => $e], 500);
        }

        return $this->json(array_merge(['status' => 'OK', 'data' => $result], []));
    }


    /**
     * search pre-chainstore.
     *
     * @Route("/chainstore/api/pre", name="chainstore_api_pre", methods={"POST"})
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function api_chainstore_pre(Request $request)
    {
        /*
        if (!$request->isXmlHttpRequest()) {
            return $this->json(['status' => 'NG'], 400);
        }
        */

        $result = [];
        
        try {
            $contractId = $request->get('contractId');
            $email = $request->get('email');
            $birthday = $request->get('birthday');

            // タイムアウトを無効にする.
            set_time_limit(0);
            $preChainstoreList = $this->preChainStoreRepository->findActiveRegisterInfo($contractId, $email, $birthday);

            foreach($preChainstoreList as $preChainStore){
                $chainStore = [];
                $chainStore["id"] = $preChainStore->getId();

                //==> 証券番号
                $chainStore["stockNumber"] = $preChainStore->getStockNumber();              //03.契約番号(証券番号)

                //==> 販売店名
                //「法人名・屋号」空の場合は代表者姓、名を結合して入れる
                if(empty($preChainStore->getCompanyName())){
                    //25.代表者名・氏名「姓」+ 27.代表者名・氏名「名」
                    $chainStore["companyName"] = $preChainStore->getName01().$preChainStore->getName02();
                }else{
                    //09.法人名・屋号
                    $chainStore["companyName"] = $preChainStore->getCompanyName();
                }

                //==> 販売店名(カナ)
                //「法人名・屋号（フリガナ）」空の場合は代表者姓カナ、名カナを結合して入れる
                if(empty($preChainStore->getCompanyNameKana())){
                    //29.代表者名・氏名「姓」（フリガナ）+ 31.代表者名・氏名「名」（フリガナ）
                    $chainStore["companyNameKana"] = $preChainStore->getKana01().$preChainStore->getKana02();
                }else{
                    //11.法人名・屋号（フリガナ）
                    $chainStore["companyNameKana"] = $preChainStore->getCompanyNameKana();
                }
                
                //==> お名前（代表者）
                $chainStore["name01"] = $preChainStore->getName01();                        //25.代表者名・氏名「姓」
                $chainStore["name02"] = $preChainStore->getName02();                        //27.代表者名・氏名「名」

                //==> お名前（代表者）(カナ)
                $chainStore["kana01"] = $preChainStore->getKana01();                        //29.代表者名・氏名「姓」（フリガナ）
                $chainStore["kana02"] = $preChainStore->getKana02();                        //31.代表者名・氏名「名」（フリガナ）

                //==> 生年月日
                //設立日ではなく生年月日をログイン用に使う
                $chainStore["birthday"] = $preChainStore->getBirthday();                    //33.生年月日(設立日ではなく生年月日をログイン用に使う)	

                //==> 電話番号
                $chainStore["phoneNo"] = $preChainStore->getCellphoneNo();                  //41.携帯電話

                //==> ディーラーコード
                $chainStore["dealerCode"] = $preChainStore->getDealerCode();                //55.ディーラーコード

                //59.取引口座選択(ゆうちょ銀行以外の銀行・)	
                if($preChainStore->getIsPostbankList() == "ゆうちょ銀行"){

                    $chainStore["postCodeNumber"] = $preChainStore->getPostCodeNumber();                    //81.通帳記号（下5桁）（ゆうちょ）
                    $chainStore["postPassbookNumber"] = $preChainStore->getPostPassbookNumber();            //83.通帳番号（8桁）（ゆうちょ）
                    $chainStore["postBankHolderKana01"] = $preChainStore->getPostBankHolderKana01();        //89.口座名義「姓」（フリガナ）（ゆうちょ）
                    $chainStore["postBankHolderKana02"] = $preChainStore->getPostBankHolderKana02();        //91.口座名義「名」（フリガナ）（ゆうちょ）
                }else{
                    $chainStore["bankId"] = $preChainStore->getBankId();                                    //61.金融機関コード
                    $chainStore["bankName"] = $preChainStore->getBankName();                                //63.金融機関名
                    $chainStore["bankBranchId"] = $preChainStore->getBankBranchId();                        //65.支店コード
                    $chainStore["bankBranchName"] = $preChainStore->getBankBranchName();                    //67.支店名
                    $chainStore["bankAccountTypeName"] = $preChainStore->getBankAccountTypeName();          //69.預金種目
                    $chainStore["bankAccount"] = $preChainStore->getBankAccount();                          //71.口座番号
                    $chainStore["bankHolderKana01"] = $preChainStore->getBankHolderKana01();                //77.口座名義「姓」（フリガナ）
                    $chainStore["bankHolderKana02"] = $preChainStore->getBankHolderKana02();                //79.口座名義「名」（フリガナ）
                }  

                //==> お名前（担当者）
                $chainStore["chainstoreName"] = $preChainStore->getChainstoreName();                    //97.販売店舗名

                //==> お名前（担当者）(カナ)
                $chainStore["chainstoreNameKana"] = $preChainStore->getChainstoreNameKana();            //99.販売店舗名（フリガナ）

                //==> 住所-郵便番号
                $chainStore["chainstorePostalCode"] = $preChainStore->getChainstorePostalCode();        //109.販売店舗所在地：（郵便番号）

                //==> 住所-都道府県
                $chainStore["chainstoreAddr01"] = $preChainStore->getChainstoreAddr01();                //111.販売店舗所在地：（都道府県）

                //==> 住所-市町村名
                $chainStore["chainstoreAddr02"] = $preChainStore->getChainstoreAddr02();                //113.販売店舗所在地：（市町村名）

                //==> 住所-番地・ビル名
                $chainStore["chainstoreAddr03"] = $preChainStore->getChainstoreAddr03();                //115.販売店舗所在地：（番地・ビル名）

                //以下備用
                //$chainStore["email"] = $preChainStore->getEmail();                          //35.連絡用メールアドレス                

                array_push($result, $chainStore);
            }
        } catch (\Exception $e) {
            log_error('予期しないエラーです', [$e->getMessage()]);

            return $this->json(['status' => 'NG', 'message' => $e->getMessage()]);
        }

        return $this->json(array_merge(['status' => 'OK', 'data' => $result], []));
    }

}
