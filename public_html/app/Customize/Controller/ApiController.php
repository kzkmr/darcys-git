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

use Eccube\Service\CartService;

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
use Customize\Repository\ZipcodeInfoRepository;

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
     * @var CartService
     */
    protected $cartService;

    /**
     * @var ZipcodeInfoRepository
     */
    protected $zipcodeInfoRepository;

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
        ZipcodeInfoRepository $zipcodeInfoRepository,
        MailService $mailService,
        TokenStorageInterface $tokenStorage,
        CartService $cartService)
    {
        $this->bankBranchRepository = $bankBranchRepository;
        $this->bankAccountTypeRepository = $bankAccountTypeRepository;
        $this->chainstoreRepository = $chainstoreRepository;
        $this->preChainStoreRepository = $preChainStoreRepository;
        $this->memberRepository = $memberRepository;
        $this->customerRepository = $customerRepository;
        $this->zipcodeInfoRepository = $zipcodeInfoRepository;
        $this->mailService = $mailService;
        $this->tokenStorage = $tokenStorage;
        $this->cartService = $cartService;
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
     * search city by zipcode.
     *
     * @Route("/chainstore/api/zipcode", name="api_zipcode", methods={"POST"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function api_zipcode(Request $request)
    {

        $result = [];

        try {
            $params = [];

            if ($content = $request->getContent()) {
                $params = json_decode($content, true);
            }

            $code = $params['zipcode'];

            // タイムアウトを無効にする.
            set_time_limit(0);
            $zipcodeInfo = $this->zipcodeInfoRepository->findOneBy(["zipcode" => $code]);

            if(is_object($zipcodeInfo)){
                $zipcode = [];
                $zipcode["id"] = $zipcodeInfo->getId();
                $zipcode["zipcode"] = $zipcodeInfo->getZipcode();
                $zipcode["countyName"] = $zipcodeInfo->getCountyName();
                $zipcode["cityName"] = $zipcodeInfo->getCityName();
                $zipcode["townshipName"] = $zipcodeInfo->getTownshipName();

                array_push($result, $zipcode);
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
                $chainStore["stockNumber"] = trim($preChainStore->getStockNumber());                          //03.契約番号(証券番号)
                //==> 申込者の契約区分
                $chainStore["applicantContractTypeName"] = trim($preChainStore->getApplicantContractTypeName());        //05.申込者の契約区分
                //==> 法人番号
                $chainStore["corporateNumber"] = trim($preChainStore->getCorporateNumber());                    //07.法人番号
                //==> 設立日（開業日）
                $chainStore["beginDay"] = $preChainStore->getBeginDay();                                       //13.設立日（開業日）
                //==> 所在地：郵便番号
                $chainStore["postalCode"] = trim($preChainStore->getPostalCode());                              //15.所在地：郵便番号
                //==> 所在地・住所（都道府県）
                $chainStore["addr01"] = trim($preChainStore->getAddr01());                                      //17.所在地・住所（都道府県）
                //==> 所在地・住所（市町村名）
                $chainStore["addr02"] = trim($preChainStore->getAddr02());                                      //19.所在地・住所（市町村名）
                //==> 所在地・住所（番地・ビル名）
                $chainStore["addr03"] = trim($preChainStore->getAddr03());                                      //21.所在地・住所（番地・ビル名）
                //==> 所在地・住所(フリガナ)
                $chainStore["addr01Ka"] = trim($preChainStore->getAddr01Ka());                                  //23.所在地・住所(フリガナ)
                //==> 固定電話
                $chainStore["telephoneNo"] = trim($preChainStore->getTelephoneNo());                            //39.固定電話
                //==> 携帯電話
                $chainStore["cellphoneNo"] = trim($preChainStore->getCellphoneNo());                            //41.携帯電話
                //==> この情報を基に契約書を作成します
                $chainStore["optionMakeContract"] = trim($preChainStore->getOptionMakeContract());              //この情報を基に契約書を作成します

                //==> 取引口座選択
                $chainStore["isPostbankList"] = trim($preChainStore->getIsPostbankList());                      //59.取引口座選択(ゆうちょ銀行以外の銀行・ゆうちょ銀行)
                //==> 通帳記号（下5桁）（ゆうちょ）
                $chainStore["postCodeNumber"] = trim($preChainStore->getPostCodeNumber());                      //81.通帳記号（下5桁）（ゆうちょ）
                //==> 通帳番号（8桁）（ゆうちょ）
                $chainStore["postPassbookNumber"] = trim($preChainStore->getPostPassbookNumber());              //83.通帳番号（8桁）（ゆうちょ）

                //==> 法人名・屋号（仲介者）
                $chainStore["mediatorCompanyName"] = trim($preChainStore->getMediatorCompanyName());            //43.法人名・屋号（仲介者）
                //==> 仲介者 法人名・屋号（フリガナ）
                $chainStore["mediatorCompanyNameKana"] = trim($preChainStore->getMediatorCompanyNameKana());    //45.仲介者 法人名・屋号（フリガナ）
                //==> 代表者氏名「姓」（仲介者）
                $chainStore["mediatorName01"] = trim($preChainStore->getMediatorName01());                      //47.代表者氏名「姓」（仲介者）
                //==> 代表者氏名「名」（仲介者）
                $chainStore["mediatorName02"] = trim($preChainStore->getMediatorName02());                      //49.代表者氏名「名」（仲介者）
                //==> 代表者氏名「姓」（フリガナ）（仲介者）
                $chainStore["mediatorKana01"] = trim($preChainStore->getMediatorKana01());                      //51.代表者氏名「姓」（フリガナ）（仲介者）
                //==> 代表者氏名「名」（フリガナ）（仲介者）
                $chainStore["mediatorKana02"] = trim($preChainStore->getMediatorKana02());                      //53.代表者氏名「名」（フリガナ）（仲介者）
                //==> ディーラーコード
                $chainStore["dealerCode"] = $preChainStore->getDealerCode();                                    //55.ディーラーコード
                //==> 所在地・住所（仲介者）
                $chainStore["mediatorAddress01"] = $preChainStore->getMediatorAddress01();                      //57.所在地・住所（仲介者）
                //==> 電話番号（仲介者）
                $chainStore["mediatorPhoneNumber"] = trim($preChainStore->getMediatorPhoneNumber());            //57.電話番号（仲介者）


                //==> 販売店舗の関連性
                $chainStore["relatedChainstoreTypeName"] = trim($preChainStore->getRelatedChainstoreTypeName());        //93.販売店舗の関連性
                //==> 販売店の業務形態
                $chainStore["chainstoreBusinessTypeName"] = trim($preChainStore->getChainstoreBusinessTypeName());      //95.販売店の業務形態
                //==> 販売店の業務形態(その他)
                $chainStore["chainstoreBusinessOtherTypeName"] = trim($preChainStore->getChainstoreBusinessOtherTypeName());    //95.販売店の業務形態(その他)
                //==> 販売店舗名
                $chainStore["chainstoreName"] = trim($preChainStore->getChainstoreName());                              //97.販売店舗名
                //==> 販売店舗名（フリガナ）
                $chainStore["chainstoreNameKana"] = trim($preChainStore->getChainstoreNameKana());                      //99.販売店舗名（フリガナ）
                //==> 運営会社・運営者
                $chainStore["operatingName"] = trim($preChainStore->getOperatingName());                                //101.運営会社・運営者
                //==> 運営会社・運営者（フリガナ）
                $chainStore["operatingNameKana"] = trim($preChainStore->getOperatingNameKana());                        //103.運営会社・運営者（フリガナ）
                //==> アイスの提供方法（予定）
                $chainStore["chainstoreProvideTypeName"] = trim($preChainStore->getChainstoreProvideTypeName());        //105.アイスの提供方法（予定）
                //==> アイスの提供スタイル（予定）
                $chainStore["chainstoreProvideStyleTypeName"] = trim($preChainStore->getChainstoreProvideStyleTypeName());        //107.アイスの提供スタイル（予定）
                //==> 販売店舗所在地：（郵便番号）
                $chainStore["chainstoreMainPostalCode"] = trim($preChainStore->getChainstorePostalCode());              //109.販売店舗所在地：（郵便番号）
                //==> 販売店舗所在地：（都道府県）
                $chainStore["chainstoreMainAddr01"] = trim($preChainStore->getChainstoreAddr01());                      //111.販売店舗所在地：（都道府県）
                //==> 販売店舗所在地：（市町村名）
                $chainStore["chainstoreMainAddr02"] = trim($preChainStore->getChainstoreAddr02());                      //113.販売店舗所在地：（市町村名）
                //==> 販売店舗所在地：（番地・ビル名）
                $chainStore["chainstoreMainAddr03"] = trim($preChainStore->getChainstoreAddr03());                      //115.販売店舗所在地：（番地・ビル名）
                //==> 販売店舗担当者名「姓」
                $chainStore["chainstoreOwner01"] = trim($preChainStore->getChainstoreOwner01());                        //117.販売店舗担当者名「姓」
                //==> 販売店舗担当者名「名」
                $chainStore["chainstoreOwner02"] = trim($preChainStore->getChainstoreOwner02());                        //119.販売店舗担当者名「名」
                //==> 販売店舗担当者名「姓」（フリガナ）
                $chainStore["chainstoreOwnerKana01"] = trim($preChainStore->getChainstoreOwnerKana01());                //121.販売店舗担当者名「姓」（フリガナ）
                //==> 販売店舗担当者名「名」（フリガナ）
                $chainStore["chainstoreOwnerKana02"] = trim($preChainStore->getChainstoreOwnerKana02());                //123.販売店舗担当者名「名」（フリガナ）
                //==> 販売店舗連絡先（電話番号）
                $chainStore["chainstoreTelephoneNo"] = trim($preChainStore->getChainstoreTelephoneNo());                //125.販売店舗連絡先（電話番号）
                //==> 販売店舗メールアドレス
                $chainStore["chainstoreEmail"] = trim($preChainStore->getChainstoreEmail());                            //127.販売店舗メールアドレス
                //==> WEBショップでダシーズの出品予定はありますか
                $chainStore["webshopSaleIceList"] = $this->changeText(trim($preChainStore->getWebshopSaleIceList()));   //131.WEBショップでダシーズの出品予定はありますか
                //==> ＷＥＢショップ店舗名
                $chainStore["webshopName"] = trim($preChainStore->getWebshopName());                                    //133.ＷＥＢショップ店舗名
                //==> 出店WEBショップURL
                $chainStore["webshopUrl"] = trim($preChainStore->getWebshopUrl());                                      //135.出店WEBショップURL
                //==> 出店WEBショップの運営会社
                $chainStore["chainstoreWebshopOpeningTypeName"] = trim($preChainStore->getChainStoreWebShopOpeningTypeName());                  //137.出店WEBショップの運営会社
                //==> 出店WEBショップの運営会社(その他)
                $chainStore["chainstoreWebshopOpeningOtherTypeName"] = trim($preChainStore->getChainStoreWebShopOpeningOtherTypeName());        //137.出店WEBショップの運営会社(その他)
                //==> WEBショップ運営担当者
                $chainStore["chainstoreWebshopOwnerTypeName"] = trim($preChainStore->getChainstoreWebshopOwnerTypeName());                      //139.WEBショップ運営担当者
                //==> 上記WEBショップ運営担当者名
                $chainStore["chainstoreWebshopOwnerName"] = trim($preChainStore->getChainstoreWebshopOwnerName());                              //141.上記WEBショップ運営担当者名
                //==> 運営担当者電話番号
                $chainStore["chainstoreWebshopPhoneTypeName"] = trim($preChainStore->getChainstoreWebshopPhoneTypeName());                      //143.運営担当者電話番号
                //==> 運営担当者電話番号(その他)
                $chainStore["chainstoreWebshopPhoneOtherTypeName"] = trim($preChainStore->getChainstoreWebshopPhoneOtherTypeName());            //143.運営担当者電話番号(その他)
                //==> 運営担当者メールアドレス
                $chainStore["chainstoreWebshopEmailTypeName"] = trim($preChainStore->getChainstoreWebshopEmailTypeName());                      //145.運営担当者メールアドレス
                //==> 運営担当者メールアドレス(その他)
                $chainStore["chainstoreWebshopEmailOtherTypeName"] = trim($preChainStore->getChainstoreWebshopEmailOtherTypeName());            //145.運営担当者メールアドレス(その他)
                //==> パートナー指定
                $chainStore["optionPartner"] = $this->changeText(trim($preChainStore->getOptionPartner()));                         //147.パートナー指定
                //==> パートナーの法人名・屋号
                $chainStore["partnerCompanyName"] = trim($preChainStore->getPartnerCompanyName());                                  //149.パートナーの法人名・屋号
                //==> パートナーの法人名・屋号（フリガナ）
                $chainStore["partnerCompanyNameKana"] = trim($preChainStore->getPartnerCompanyNameKana());                          //151.パートナーの法人名・屋号（フリガナ）
                //==> パートナーの代表者名・氏名「姓」
                $chainStore["partnerName01"] = trim($preChainStore->getPartnerName01());                                            //153.パートナーの代表者名・氏名「姓」
                //==> パートナーの代表者名・氏名「名」
                $chainStore["partnerName02"] = trim($preChainStore->getPartnerName02());                                            //155.パートナーの代表者名・氏名「名」
                //==> パートナーの代表者名・氏名「姓」（フリガナ）
                $chainStore["partnerKana01"] = trim($preChainStore->getPartnerNameKana01());                                        //157.パートナーの代表者名・氏名「姓」（フリガナ）
                //==> パートナーの代表者名・氏名「名」（フリガナ）
                $chainStore["partnerKana02"] = trim($preChainStore->getPartnerNameKana02());                                        //159.パートナーの代表者名・氏名「名」（フリガナ）
                //==> パートナーの電話番号
                $chainStore["partnerPhoneNumber"] = trim($preChainStore->getPartnerPhoneNumber());                                  //161.パートナーの電話番号



                //==> 販売店名
                //「法人名・屋号」空の場合は代表者姓、名を結合して入れる
                $companyName = $preChainStore->getCompanyName();
                if(empty($companyName)){
                    //25.代表者名・氏名「姓」+ 27.代表者名・氏名「名」
                    $chainStore["companyName"] = $preChainStore->getName01().$preChainStore->getName02();
                }else{
                    //09.法人名・屋号
                    $chainStore["companyName"] = trim($companyName);
                }

                //==> 販売店名(カナ)
                //「法人名・屋号（フリガナ）」空の場合は代表者姓カナ、名カナを結合して入れる
                $companyNameKana = $preChainStore->getCompanyNameKana();
                if(empty($companyNameKana)){
                    //29.代表者名・氏名「姓」（フリガナ）+ 31.代表者名・氏名「名」（フリガナ）
                    $chainStore["companyNameKana"] = $preChainStore->getKana01().$preChainStore->getKana02();
                }else{
                    //11.法人名・屋号（フリガナ）
                    $chainStore["companyNameKana"] = trim($companyNameKana);
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

                        $bankHolderName01 = $preChainStore->getPostBankHolder01();                  //85.口座名義「姓」（ゆうちょ）
                        $bankHolderName02 = $preChainStore->getPostBankHolder02();                  //87.口座名義「名」（ゆうちょ）
                        if(empty($bankHolderName01) && empty($bankHolderName02)){
                            $error .= "85.口座名義「姓」（ゆうちょ）と87.口座名義「名」（ゆうちょ）の値はNULLです\r\n";
                        }else{
                            $chainStore["bankHolderName"] = $bankHolderName01.$bankHolderName02;
                        }

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
                            $bankHolderName01 = $preChainStore->getBankHolder01();                  //73.口座名義「姓」
                            $bankHolderName02 = $preChainStore->getBankHolder02();                  //75.口座名義「名」
                            if(empty($bankHolderName01) && empty($bankHolderName02)){
                                $error .= "73.口座名義「姓」と75.口座名義「名」の値はNULLです\r\n";
                            }else{
                                $chainStore["bankHolderName"] = $bankHolderName01.$bankHolderName02;
                            }

                            //==> 口座名義（フリガナ）
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
                    $chainStore["chainstoreName01"] = trim($preChainStore->getName01());
                }else{
                    $chainStore["chainstoreName01"] = trim($chainStoreOwner01);
                }

                //==> お名前（担当者）名
                $chainStoreOwner02 = $preChainStore->getChainstoreOwner02();               //119.販売店舗担当者名-名
                if(empty($chainStoreOwner01)){
                    //$error .= "119.販売店舗担当者名-名の値はNULLです\r\n";
                    //27.代表者名・氏名「名」
                    $chainStore["chainstoreName02"] = trim($preChainStore->getName02());
                }else{
                    $chainStore["chainstoreName02"] = trim($chainStoreOwner02);
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

        $num = 0;
        // ログインチェック
        if ($this->isGranted('ROLE_USER')) {
            $Carts = $this->cartService->getCarts();
            $totalQuantity = array_reduce($Carts, function ($total, $Cart) {
                /* @var Cart $Cart */
                $total += $Cart->getTotalQuantity();
                return $total;
            }, 0);
            $done = true;
            $num = $totalQuantity;
        }else{
            $done = false;
            $num = 0;
        }

        log_info('ログインチェック処理完了',[]);

        return $this->json(['done' => $done, 'num' => $num]);
    }

    /**
     * 外部からの販売店チェック.
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

    function changeText($val){
        if($val == "ある"){
            return "あり";
        }
        if($val == "ない"){
            return "なし";
        }
        return $val;
    }
}

