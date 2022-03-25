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
        MemberRepository $memberRepository,
        CustomerRepository $customerRepository,
        MailService $mailService)
    {
        $this->bankBranchRepository = $bankBranchRepository;
        $this->chainstoreRepository = $chainstoreRepository;
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

}
