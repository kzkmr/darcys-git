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
use Eccube\Repository\PageRepository;
use Customize\Service\MailService;
use Customize\Entity\Master\Bank;
use Customize\Repository\Master\BankBranchRepository;
use Customize\Repository\Master\BankAccountTypeRepository;
use Customize\Repository\ChainStoreRepository;
use Customize\Repository\PreChainStoreRepository;
use Customize\Repository\ZipcodeInfoRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Data\QRMatrix;

class QRCodeController extends AbstractController
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
     * @var PageRepository
     */
    protected $pageRepository;

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
        PageRepository $pageRepository,
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
        $this->pageRepository = $pageRepository;
        $this->cartService = $cartService;
    }

    /**
     * QRCode Text.
     *
     * @Route("/qrcode/text/{text}", name="qrcode_text", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function qrcode(Request $request, $text)
    {
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
        $url = $baseurl."/coupon/".$text;

        $options = new QROptions([
            'version'      => 7,
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
            'scale'        => 10,
            'imageBase64'  => false,
            'imageTransparent'    => false,
        ]);

        try{
            $im = (new QRCode($options))->render($url);
        }
        catch(Throwable $e){
            exit($e->getMessage());
        }
        
        // Generate response
        $response = new Response();

        // Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', 'image/png' );
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $text . '.png";');
        $response->headers->set('Content-length',  strlen($im));

        // Send headers before outputting anything
        $response->sendHeaders();
        $response->setContent( $im );

        return $response;
    }

}

