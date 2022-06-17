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
use Customize\Repository\Master\BankAccountTypeRepository;
use Customize\Repository\ChainStoreRepository;
use Customize\Repository\PreChainStoreRepository;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ApiController extends AbstractController
{
    /**
     * @var BankBranchRepository
     */
    protected $bankBranchRepository;

    /**
     * @var BankAccountTypeRepository
     */
    protected $bankAccountTypeRepository;

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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

	/**
     * BankController constructor.
     */
    public function __construct(
        BankBranchRepository $bankBranchRepository,
        BankAccountTypeRepository $bankAccountTypeRepository,
        ChainStoreRepository $chainstoreRepository,
        PreChainStoreRepository $preChainStoreRepository,
        MemberRepository $memberRepository,
        CustomerRepository $customerRepository,
        MailService $mailService,
        TokenStorageInterface $tokenStorage)
    {
        $this->bankBranchRepository = $bankBranchRepository;
        $this->bankAccountTypeRepository = $bankAccountTypeRepository;
        $this->chainstoreRepository = $chainstoreRepository;
        $this->preChainStoreRepository = $preChainStoreRepository;
        $this->memberRepository = $memberRepository;
        $this->customerRepository = $customerRepository;
        $this->mailService = $mailService;
        $this->tokenStorage = $tokenStorage;
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
        $fixedMessage = "申し訳ありません。データ登録で問題が発生しました。<br>
        お手数をおかけしますが、<br>
        <a href=\"mailto:keiyaku@darcys-factory.co.jp\">keiyaku@darcys-factory.co.jp</a><br>
        までご連絡下さい。";

        try {
            $params = [];

            if ($content = $request->getContent()) {
                $params = json_decode($content, true);
            }

            $contractId = $params['contractId'];
            $email = $params['email'];
            $birthday = $params['birthday'];
            $error = "";

            // タイムアウトを無効にする.
            set_time_limit(0);
            $preChainStore = $this->preChainStoreRepository->findActiveRegisterInfo($contractId, $email, $birthday);

            //foreach($preChainstoreList as $preChainStore){
            if(is_object($preChainStore)){
                $chainStore = [];
                $chainStore["id"] = $preChainStore->getId();

                //==> 証券番号
                $chainStore["stockNumber"] = $preChainStore->getStockNumber();              //03.契約番号(証券番号)

                //==> 販売店名
                //「法人名・屋号」空の場合は代表者姓、名を結合して入れる
                $companyName = $preChainStore->getCompanyName();
                if(empty($companyName)){
                    //25.代表者名・氏名「姓」+ 27.代表者名・氏名「名」
                    $chainStore["companyName"] = $preChainStore->getName01().$preChainStore->getName02();
                }else{
                    //09.法人名・屋号
                    $chainStore["companyName"] = $companyName;
                }

                //==> 販売店名(カナ)
                //「法人名・屋号（フリガナ）」空の場合は代表者姓カナ、名カナを結合して入れる
                $companyNameKana = $preChainStore->getCompanyNameKana();
                if(empty($companyNameKana)){
                    //29.代表者名・氏名「姓」（フリガナ）+ 31.代表者名・氏名「名」（フリガナ）
                    $chainStore["companyNameKana"] = $preChainStore->getKana01().$preChainStore->getKana02();
                }else{
                    //11.法人名・屋号（フリガナ）
                    $chainStore["companyNameKana"] = $companyNameKana;
                }

                //==> お名前（代表者）
                $name01 = $preChainStore->getName01();                        //25.代表者名・氏名「姓」
                if(empty($name01)){
                    $error .= "25.代表者名・氏名「姓」の値はNULLです\r\n";
                }else{
                    $chainStore["name01"] = $name01;
                }

                $name02 = $preChainStore->getName02();                        //27.代表者名・氏名「名」
                if(empty($name02)){
                    $error .= "27.代表者名・氏名「名」の値はNULLです\r\n";
                }else{
                    $chainStore["name02"] = $name02;
                }

                //==> お名前（代表者）(カナ)
                $kana01 = $preChainStore->getKana01();                        //29.代表者名・氏名「姓」（フリガナ）
                if(empty($kana01)){
                    $error .= "29.代表者名・氏名「姓」（フリガナ）の値はNULLです\r\n";
                }else{
                    $chainStore["kana01"] = $kana01;
                }

                $kana02 = $preChainStore->getKana02();                        //31.代表者名・氏名「名」（フリガナ）
                if(empty($kana02)){
                    $error .= "31.代表者名・氏名「名」（フリガナ）の値はNULLです\r\n";
                }else{
                    $chainStore["kana02"] = $kana02;
                }

                //==> 生年月日
                //設立日ではなく生年月日をログイン用に使う
                $chainStore["birthday"] = $preChainStore->getBirthday();                    //33.生年月日(設立日ではなく生年月日をログイン用に使う)

                //==> 電話番号
                $cellphoneNo = $preChainStore->getCellphoneNo();                            //41.携帯電話
                if(empty($cellphoneNo)){
                    $error .= "41.携帯電話の値はNULLです\r\n";
                }else{
                    $chainStore["phoneNo"] = $cellphoneNo;
                }

                //==> ディーラーコード
                $chainStore["dealerCode"] = $preChainStore->getDealerCode();                //55.ディーラーコード

                //59.取引口座選択(ゆうちょ銀行以外の銀行・)
                if($preChainStore->getIsPostbankList() == "ゆうちょ銀行"){
                    $branchNo = $preChainStore->getPostCodeNumber();                        //81.通帳記号（下5桁）（ゆうちょ）
                    $accountNo = $preChainStore->getPostPassbookNumber();                   //83.通帳番号（8桁）（ゆうちょ）

                    if(!empty($branchNo)){
                        //2～3桁目の数字の末尾に「8」を付与したものを支店コードとする
                        $branchNo = substr($branchNo, 1, 2)."8";
                    }else{
                        $error .= "81.通帳記号（下5桁）（ゆうちょ）の値はNULLです\r\n";
                    }

                    //末尾の「1」を除外したものを口座番号とする
                    if(!empty($accountNo)){
                        $accountNo = substr($accountNo, 0, -1);
                    }else{
                        $error .= "83.通帳番号（8桁）（ゆうちょ）の値はNULLです\r\n";
                    }

                    $bankInfo = $this->bankBranchRepository->findOneBy(['bank_code' => "9900", "branch_code" => $branchNo]);
                    if(is_object($bankInfo)){
                        //==> 金融機関名
                        $chainStore["bankId"] = $bankInfo->getBankId();
                        //==> 支店名
                        $chainStore["branchId"] = $bankInfo->getId();
                        //==> 預金種目
                        $chainStore["bankAccountType"] = "1";       //普通
                        //==> 口座番号
                        $chainStore["bankAccountNo"] = $accountNo;
                        //==> 口座名義

                        $bankHolderKana01 = $preChainStore->getPostBankHolderKana01();              //89.口座名義「姓」（フリガナ）（ゆうちょ）
                        $bankHolderKana02 = $preChainStore->getPostBankHolderKana02();              //91.口座名義「名」（フリガナ）（ゆうちょ）
                        if(empty($bankHolderKana01) && empty($bankHolderKana02)){
                            $error .= "89.口座名義「姓」（フリガナ）（ゆうちょ）と91.口座名義「名」（フリガナ）（ゆうちょ）の値はNULLです\r\n";
                        }else{
                            $chainStore["bankHolder"] = $bankHolderKana01.$bankHolderKana02;
                        }
                    }else{
                        //無法取得銀行資料
                        $error .= "金融取引データの取得に失敗しました。\r\n";
                    }
                }else{
                    $bankId = $preChainStore->getBankId();                                                      //61.金融機関コード
                    $branchId = $preChainStore->getBankBranchId();                                              //65.支店コード
                    //$chainStore["bankName"] = $preChainStore->getBankName();                                  //63.金融機関名
                    //$chainStore["bankBranchName"] = $preChainStore->getBankBranchName();                      //67.支店名

                    $bankInfo = $this->bankBranchRepository->findOneBy(['bank_code' => $bankId, "branch_code" => $branchId]);
                    if(is_object($bankInfo)){
                        $accountTypeName = $preChainStore->getBankAccountTypeName();                            //69.預金種目
                        $accountType = $this->bankAccountTypeRepository->findOneBy(["name" => $accountTypeName]);

                        if(is_object($accountType)){
                            //==> 金融機関名
                            $chainStore["bankId"] = $bankInfo->getBankId();
                            //==> 支店名
                            $chainStore["branchId"] = $bankInfo->getId();
                            //==> 預金種目
                            $chainStore["bankAccountType"] = $accountType->getId();
                            //==> 口座番号
                            $bankAccount = $preChainStore->getBankAccount();                        //71.口座番号
                            if(empty($bankAccount)){
                                $error .= "71.口座番号の値はNULLです\r\n";
                            }else{
                                $chainStore["bankAccountNo"] = $bankAccount;
                            }

                            //==> 口座名義
                            $bankHolderKana01 = $preChainStore->getBankHolderKana01();              //77.口座名義「姓」（フリガナ）
                            $bankHolderKana02 = $preChainStore->getBankHolderKana02();              //79.口座名義「名」（フリガナ）
                            if(empty($bankHolderKana01) && empty($bankHolderKana02)){
                                $error .= "77.口座名義「姓」（フリガナ）と79.口座名義「名」（フリガナ）の値はNULLです\r\n";
                            }else{
                                $chainStore["bankHolder"] = $bankHolderKana01.$bankHolderKana02;
                            }
                        }else{
                            //無法取得 預金種目
                            $error .= "金融機関の預金種目データの取得に失敗しました。\r\n";
                        }
                    }else{
                        //無法取得 銀行資料
                        $error .= "金融取引データの取得に失敗しました。\r\n";
                    }
                }

                //==> お名前（担当者）姓
                $chainStoreOwner01 = $preChainStore->getChainstoreOwner01();               //117.販売店舗担当者名-姓
                if(empty($chainStoreOwner01)){
                    //$error .= "117.販売店舗担当者名-姓の値はNULLです\r\n";
                    //25.代表者名・氏名「姓」
                    $chainStore["chainstoreName01"] = $preChainStore->getName01();
                }else{
                    $chainStore["chainstoreName01"] = $chainStoreOwner01;
                }

                //==> お名前（担当者）名
                $chainStoreOwner02 = $preChainStore->getChainstoreOwner02();               //119.販売店舗担当者名-名
                if(empty($chainStoreOwner01)){
                    //$error .= "119.販売店舗担当者名-名の値はNULLです\r\n";
                    //27.代表者名・氏名「名」
                    $chainStore["chainstoreName02"] = $preChainStore->getName02();
                }else{
                    $chainStore["chainstoreName02"] = $chainStoreOwner02;
                }

                //==> お名前（担当者）(カナ) 姓
                $chainStoreOwnerKana01 = $preChainStore->getChainstoreOwnerKana01();       //121.販売店舗担当者名-姓カナ
                if(empty($chainStoreOwnerKana01)){
                    //$error .= "121.販売店舗担当者名-姓カナの値はNULLです\r\n";
                    //29.代表者名・氏名「姓」（フリガナ）
                    $chainStore["chainstoreNameKana01"] = $preChainStore->getKana01();
                }else{
                    $chainStore["chainstoreNameKana01"] = $chainStoreOwnerKana01;
                }

                //==> お名前（担当者）(カナ) 名
                $chainStoreOwnerKana02 = $preChainStore->getChainstoreOwnerKana02();       //123.販売店舗担当者名-名カナ
                if(empty($chainStoreOwnerKana02)){
                    //$error .= "123.販売店舗担当者名-名カナの値はNULLです\r\n";
                    //31.代表者名・氏名「名」（フリガナ）
                    $chainStore["chainstoreNameKana02"] = $preChainStore->getKana02();
                }else{
                    $chainStore["chainstoreNameKana02"] = $chainStoreOwnerKana02;
                }

                //==> 会社名
                $chainStoreCompanyName = $preChainStore->getChainstoreName();             //97.販売店舗名
                if(empty($chainStoreCompanyName)){
                    //同上 ==> 販売店名
                    //「法人名・屋号」空の場合は代表者姓、名を結合して入れる
                    $companyName = $preChainStore->getCompanyName();
                    if(empty($companyName)){
                        //25.代表者名・氏名「姓」+ 27.代表者名・氏名「名」
                        $chainStore["chainstoreCompanyName"] = $preChainStore->getName01().$preChainStore->getName02();
                    }else{
                        //09.法人名・屋号
                        $chainStore["chainstoreCompanyName"] = $companyName;
                    }
                }else{
                    $chainStore["chainstoreCompanyName"] = $chainStoreCompanyName;
                }

                //==> 住所-郵便番号
                $chainStorePostalCode = $preChainStore->getChainstorePostalCode();              //109.販売店舗所在地：（郵便番号）
                if(empty($chainStorePostalCode)){
                    //$error .= "109.販売店舗所在地：（郵便番号）の値はNULLです\r\n";
                    $chainStore["chainstorePostalCode"] = $preChainStore->getPostalCode();      //15.所在地・住所：（郵便番号）
                }else{
                    $chainStore["chainstorePostalCode"] = $chainStorePostalCode;
                }

                //==> 住所-都道府県
                $chainStoreAddr01 = $preChainStore->getChainstoreAddr01();                      //111.販売店舗所在地：（都道府県）
                if(empty($chainStoreAddr01)){
                    //$error .= "111.販売店舗所在地：（都道府県）の値はNULLです\r\n";
                    $chainStore["chainstoreAddr01"] = $preChainStore->getAddr01();              //17.所在地・住所（都道府県）
                }else{
                    $chainStore["chainstoreAddr01"] = $chainStoreAddr01;
                }

                //==> 住所-市町村名
                $chainStoreAddr02 = $preChainStore->getChainstoreAddr02();                      //113.販売店舗所在地：（市町村名）
                if(empty($chainStoreAddr02)){
                    //$error .= "113.販売店舗所在地：（市町村名）の値はNULLです\r\n";
                    $chainStore["chainstoreAddr02"] = $preChainStore->getAddr02();              //19.所在地・住所（市町村名）
                }else{
                    $chainStore["chainstoreAddr02"] = $chainStoreAddr02;
                }

                //==> 住所-番地・ビル名
                $chainStoreAddr03 = $preChainStore->getChainstoreAddr03();                      //115.販売店舗所在地：（番地・ビル名）
                if(empty($chainStoreAddr03)){
                    //$error .= "115.販売店舗所在地：（番地・ビル名）の値はNULLです\r\n";
                    $chainStore["chainstoreAddr03"] = $preChainStore->getAddr03();              //21.所在地・住所（番地・ビル名）
                }else{
                    $chainStore["chainstoreAddr03"] = $chainStoreAddr03;
                }

                if(empty($error)){
                    $result = $chainStore;
                }else{
                    //return $this->json(['status' => 'NG', 'message' => $error]);
                    return $this->json(['status' => 'NG', 'message' => $fixedMessage, 'debug' => $error]);
                }

                //以下備用
                //$chainStore["email"] = $preChainStore->getEmail();                                    //35.連絡用メールアドレス

                //array_push($result, $chainStore);
            }else{
                return $this->json(['status' => 'NF', 'message' => "「".$email."」に一致する情報は見つかりませんでした。"]);
            }
        } catch (\Exception $e) {
            log_error('予期しないエラーです', [$e->getMessage()]);

            return $this->json(['status' => 'NG', 'message' => $fixedMessage, 'debug' => $e->getMessage()]);
            //return $this->json(['status' => 'NG', 'message' => "予期しないエラーです"]);
        }

        return $this->json(array_merge(['status' => 'OK', 'data' => $result], []));
    }

    /**
     * 外部からのログインチェック.
     *
     * @Route("/mypage/api_login", name="api_login", methods={"POST"})
     */
    public function apiLogin(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException();
        }

        log_info('ログインチェック処理開始',[]);

        // ログインチェック
        if ($this->isGranted('ROLE_USER')) {
            $done = true;
        }else{
            $done = false;
        }

        log_info('ログインチェック処理完了',[]);

        return $this->json(['done' => $done ]);
    }

    /**
     * 外部からのログインチェック.
     *
     * @Route("/mypage/api_isstore", name="api_isstore", methods={"POST"})
     */
    function apiIsStore(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException();
        }

        log_info('販売店チェック処理開始',[]);

        // ログインチェック
        $LoginTypeInfo = $this->getLoginTypeInfo();
        $LoginType = $LoginTypeInfo['LoginType'];
        if ( $LoginType == 3 ) {
          $done = true;
        } else {
          $done = false;
        }

        log_info('販売店チェック処理完了',[]);

        return $this->json(['done' => $done ]);
    }

    function getLoginTypeInfo()
    {
        $LoginType = 1;         //Default is guest
        $Customer = $this->getCurrentUser();
        $ChainStore = null;
        $ContractType = null;

        if (is_object($Customer)) {
            $ChainStore = $Customer->getChainStore();

            if(is_object($ChainStore)){
                $LoginType = 3;         //ChainStore member
                $ContractType = $ChainStore->getContractType();
            }else{
                $LoginType = 2;         //Normal member
            }
        }else{
            $Customer = null;
        }

        return [
            'LoginType' => $LoginType,
            'Customer' => $Customer,
            'ChainStore' => $ChainStore,
            'ContractType' => $ContractType,
        ];
    }

    function getCurrentUser()
    {
        if(!$this->tokenStorage){
            return null;
        }

        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        if (!$token->isAuthenticated()) {
            return null;
        }

        if(!$user = $token->getUser()){
            return null;
        }

        if(is_object($user)){
            return $user;
        }

        return null;
    }

}

