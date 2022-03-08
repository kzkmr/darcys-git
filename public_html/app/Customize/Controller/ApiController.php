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

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\Routing\Annotation\Route;

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
     * BankController constructor.
     */
    public function __construct(
        BankBranchRepository $bankBranchRepository,
        ChainStoreRepository $chainstoreRepository)
    {
        $this->bankBranchRepository = $bankBranchRepository;
        $this->chainstoreRepository = $chainstoreRepository;
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
     * @Route("/chainstore/api/list/{keyword}", name="chainstore_api_list", methods={"GET", "POST"})
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
}
