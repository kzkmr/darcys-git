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
use Eccube\Entity\Customer;
use Customize\Entity\CustomerCoupon;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Customize\Util\StringUtil;
use Eccube\Form\Type\Front\ContactType;
use Eccube\Repository\PageRepository;
use Eccube\Repository\PluginRepository;
use Customize\Repository\ChainStoreRepository;
use Customize\Repository\CustomerCouponRepository;
use Customize\Repository\CashbackSummaryRepository;
use Customize\Repository\ShippingRepository;
use Customize\Repository\BankTransferInfoRepository;
use Eccube\Service\MailService;
use Plugin\Coupon4\Entity\Coupon;
use Plugin\Coupon4\Repository\CouponRepository;
use Plugin\Coupon4\Repository\CouponOrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Asset\Packages;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CouponController extends AbstractController
{
    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * @var PluginRepository
     */
    protected $pluginRepository;

    /**
     * @var CouponRepository
     */
    private $couponRepository;

    /**
     * @var CouponOrderRepository
     */
    private $couponOrderRepository;

    /**
     * @var ChainStoreRepository
     */
    private $chainStoreRepository;

    /**
     * @var CustomerCouponRepository
     */
    private $customerCouponRepository;

    /**
     * @var ShippingRepository
     */
    private $shippingRepository;

    /**
     * @var CashbackSummaryRepository
     */
    private $cashbackSummaryRepository;
    
    /**
     * @var BankTransferInfoRepository
     */
    protected $bankTransferInfoRepository;

    /**
     * CouponController constructor.
     *
     * @param MailService $mailService
     * @param PageRepository $pageRepository
     * @param PluginRepository $pluginRepository
     * @param CouponRepository $couponRepository
     * @param CouponOrderRepository $couponOrderRepository
     * @param ChainStoreRepository $chainStoreRepository
     * @param CustomerCouponRepository $customerCouponRepository
     * @param ShippingRepository $shippingRepository
     * @param CashbackSummaryRepository $cashbackSummaryRepository
     * @param BankTransferInfoRepository $bankTransferInfoRepository
     */
    public function __construct(
        MailService $mailService,
        PageRepository $pageRepository,
        PluginRepository $pluginRepository,
        CouponRepository $couponRepository,
        CouponOrderRepository $couponOrderRepository,
        ChainStoreRepository $chainStoreRepository,
        CustomerCouponRepository $customerCouponRepository,
        ShippingRepository $shippingRepository,
        CashbackSummaryRepository $cashbackSummaryRepository,
        BankTransferInfoRepository $bankTransferInfoRepository)
    {
        $this->mailService = $mailService;
        $this->pageRepository = $pageRepository;
        $this->pluginRepository = $pluginRepository;
        $this->couponRepository = $couponRepository;
        $this->couponOrderRepository = $couponOrderRepository;
        $this->chainStoreRepository = $chainStoreRepository;
        $this->customerCouponRepository = $customerCouponRepository;
        $this->shippingRepository = $shippingRepository;
        $this->cashbackSummaryRepository = $cashbackSummaryRepository;
        $this->bankTransferInfoRepository = $bankTransferInfoRepository;
    }


    /**
     * クーポン画面.
     *
     * @Route("/coupon_demo/{coupon_code}", name="coupon_demo", methods={"GET", "POST"})
     * @Template("Coupon/index_demo.twig")
     */
    public function index_demo(Request $request, SessionInterface $session, $coupon_code)
    {
        return $this->index_get($request, $session, $coupon_code, false);
    }


    /**
     * クーポン画面.
     *
     * @Route("/coupon/{coupon_code}", name="coupon", methods={"GET", "POST"})
     * @Template("Coupon/index.twig")
     */
    public function index(Request $request, SessionInterface $session, $coupon_code)
    {
        return $this->index_get($request, $session, $coupon_code, false);
    }

    /**
     * クーポン画面.
     *
     * @Route("/coupon/{coupon_code}/{isget}", name="coupon_get", methods={"GET", "POST"})
     * @Template("Coupon/index.twig")
     */
    public function index_get(Request $request, SessionInterface $session, $coupon_code, $isget)
    {
        $Coupon4Plugin = $this->getCouponPluginInfo();
        $isActive = (is_object($Coupon4Plugin));
        $Coupon = null;
        $Customer = null;
        $ChainStore = null;
        $CustomerCoupon = null;
        $hasCoupon = false;
        $CanGetCoupon = true;

        if ($this->isGranted('IS_AUTHENTICATED_FULLY') || $this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $Customer = $this->getUser();
            $ChainStore = $Customer->getChainStore();
        }

        if($isActive){
            $Coupon = $this->couponRepository->findActiveCoupon($coupon_code);
            
            if (!$Coupon) {
                //Coupon not found!
                $Coupon = null;
            }else{
                $checkCouponUseTime = $this->couponRepository->checkCouponUseTime($Coupon->getCouponCd());
                if (!$checkCouponUseTime) {
                    //Coupon not found!
                    $Coupon = null;
                }else{
                    //POST
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $isget){
                        if( is_object($ChainStore) ){
                            //$Coupon = null;
                            $CanGetCoupon = false;
                        }else{
                            if (!$this->isGranted('IS_AUTHENTICATED_FULLY') && !$this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                                //$params = array('url'=> 'coupon', 'params'=> array('coupon_code' => $coupon_code));
                                $this->addFlash('eccube.login.target.path', '/coupon/'.$coupon_code.'/get');
                                return $this->redirectToRoute('mypage_login');
                            }

                            $CustomerCoupon = $this->customerCouponRepository->findOneBy(['Customer' => $Customer, 'Coupon' => $Coupon]);

                            if(!$CustomerCoupon){
                                $CustomerCoupon = new CustomerCoupon();
                                $CustomerCoupon->setCustomer( $Customer );
                                $CustomerCoupon->setCoupon( $Coupon );
                                $CustomerCoupon->setCreateDate( new \DateTime() );
                                $this->customerCouponRepository->save($CustomerCoupon);
                            }

                            $hasCoupon = true;
                        }
                    }else{
                        //GET
                        if ($this->isGranted('IS_AUTHENTICATED_FULLY') || $this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                            $CustomerCoupon = $this->customerCouponRepository->findOneBy(['Customer' => $Customer, 'Coupon' => $Coupon]);
                            if($CustomerCoupon){
                                $hasCoupon = true;
                            }
                        }
                    }
                }
            }


        }

        return [
            'isActive' => $isActive,
            'Coupon' => $Coupon,
            'CanGetCoupon' => $CanGetCoupon,
            'CustomerCoupon' => $CustomerCoupon,
            'CouponCode' => $coupon_code,
            'hasCoupon' => $hasCoupon
        ];
    }

    /**
     * クーポン画面.(一般会員)
     *
     * @Route("/mypage/coupon_list", name="mypage_coupon_list", methods={"GET", "POST"})
     * @Template("Coupon/coupon_list.twig")
     */
    public function coupon_list(Request $request, PaginatorInterface $paginator)
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY') && !$this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('mypage_login');
        }

        $Customer = $this->getUser();
        $ChainStore = $Customer->getChainStore();
        if(is_object($ChainStore)){
            return $this->redirectToRoute('mypage_login');
        }

        $Coupon4Plugin = $this->getCouponPluginInfo();
        $isActive = (is_object($Coupon4Plugin));
        $pagination = null;

        if($isActive){
            //個人クーポン情報取得
            $CustomerCoupon = $this->customerCouponRepository->findActiveCouponList($Customer);
            //$CustomerCoupon = $this->customerCouponRepository->findBy(['Customer' => $Customer],['create_date' => 'DESC']);

            $pagination = $paginator->paginate(
                $CustomerCoupon,
                $request->get('pageno', 1),
                $this->eccubeConfig['eccube_search_pmax']
            );
        }

        return [
            'isActive' => $isActive,
            'pagination' => $pagination,
        ];
    }


    /**
     * クーポン画面.(販売店の特別会員)
     *
     * @Route("/mypage/chainstore_coupon_list", name="mypage_chainstore_coupon_list", methods={"GET", "POST"})
     * @Template("Coupon/chainstore_coupon_list.twig")
     */
    public function chainstore_coupon_list(Request $request, PaginatorInterface $paginator)
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY') && !$this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('mypage_login');
        }

        $Customer = $this->getUser();
        $ChainStore = $Customer->getChainStore();

        if(!is_object($ChainStore)){
            return $this->redirectToRoute('mypage_login');
        }

        $Coupon4Plugin = $this->getCouponPluginInfo();
        $isActive = (is_object($Coupon4Plugin));
        $pagination = null;

        if($isActive){
            if($ChainStore->getContractType()->getPageCouponList() != "Y"){
                return $this->redirectToRoute('mypage_login');
            }

            $ChainStoreCoupon = $this->couponRepository->findChainStoreActiveCouponAll($ChainStore);

            $pagination = $paginator->paginate(
                $ChainStoreCoupon,
                $request->get('pageno', 1),
                $this->eccubeConfig['eccube_search_pmax']
            );
        }

        return [
            'isActive' => $isActive,
            'ChainStore' => $ChainStore,
            'pagination' => $pagination,
        ];
    }

    /**
     * クーポン実績画面.(販売店の特別会員)
     *
     * @Route("/mypage/chainstore_coupon_jisseki", name="mypage_chainstore_coupon_jisseki", methods={"GET", "POST"})
     * @Template("Coupon/chainstore_coupon_jisseki.twig")
     */
    public function chainstore_coupon_jisseki(Request $request, PaginatorInterface $paginator)
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY') && !$this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('mypage_login');
        }

        $Customer = $this->getUser();
        $ChainStore = $Customer->getChainStore();

        if(!is_object($ChainStore)){
            return $this->redirectToRoute('mypage_login');
        }

        $Coupon4Plugin = $this->getCouponPluginInfo();
        $isActive = (is_object($Coupon4Plugin));
        $pagination = null;
        $Cashback = null;
        $transferDate = null;
        $currentYear = date("Y");
        $selDate = "";  //date("Y-m");
        $selDateName = "";
        $paymentDate = "";
        $listDate = [];

        if($isActive){
            if($ChainStore->getContractType()->getPageCouponList() != "Y"){
                return $this->redirectToRoute('mypage_login');
            }
            
            if(!empty($_SESSION["selDate"])){
                $selDate = $_SESSION["selDate"];
            }
            if(!empty($_POST)){
                if(!empty($_POST["selYear"])){
                    $selDate = $_POST["selYear"]."-".$_POST["selMonth"];
                    $_SESSION["selDate"]=$selDate;
                }
            }

            $selDateName = str_replace("-", "年", $selDate)."月";
            $paymentDate = date('Y/m/d', strtotime("+1 months", strtotime($selDate."-15")));

            $listDate1 = $this->shippingRepository->getChainStoreUseCouponJissekiListDate($ChainStore);
            $listDate2 = $this->cashbackSummaryRepository->getDateList($ChainStore);
            $listDate = $this->mergeDateList($listDate1, $listDate2);

            if(count($listDate) > 0){
                if($selDate == ""){
                    $selDate = date("Y-m");     //$listDate[0]["dateVal"];
                    $selDateName = date("Y年m月"); //$listDate[0]["dateName"];
                    $paymentDate = date('Y/m/d', strtotime("+1 months", strtotime($selDate."-15")));
                }

                $CouponJisseki = $this->shippingRepository->findChainStoreUseCouponJisseki($ChainStore, $selDate);
                $Cashback = $this->cashbackSummaryRepository->findOneBy(["ChainStore" => $ChainStore, "referenceYm" => $selDate]);
                $transferDate = $this->bankTransferInfoRepository->findOneBy(["referenceYm" => $selDate]);

                $pagination = $paginator->paginate(
                    $CouponJisseki,
                    $request->get('pageno', 1),
                    $this->eccubeConfig['eccube_search_pmax']
                );
            }
        }

        return [
            'isActive' => $isActive,
            'listDate' => $listDate,
            'selDate' => $selDate,
            'selDateName' => $selDateName,
            'currentYear' => $currentYear,
            'paymentDate' => $paymentDate,
            'ChainStore' => $ChainStore,
            'pagination' => $pagination,
            'Cashback' => $Cashback,
            'TransferDate' => $transferDate
        ];
    }

    /**
     * クーポン削除画面.(一般会員)
     *
     * @Route("/mypage/coupon_delete/{coupon_code}", name="mypage_coupon_delete", methods={"GET"})
     */
    public function coupon_delete(Request $request, $coupon_code)
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY') && !$this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('mypage_login');
        }

        $Customer = $this->getUser();
        $Coupon4Plugin = $this->getCouponPluginInfo();
        $isActive = (is_object($Coupon4Plugin));
        $pagination = null;

        if($isActive){
            $Coupon = $this->couponRepository->findOneBy(['coupon_cd' => $coupon_code]);
            $CustomerCoupon = $this->customerCouponRepository->findOneBy(['Customer' => $Customer, 'Coupon' => $Coupon]);
            if(is_object($CustomerCoupon)){
                $this->customerCouponRepository->delete( $CustomerCoupon );
            }
        }

        return $this->redirectToRoute('mypage_coupon_list');
    }

    /**
     * クーポン Image
     *
     * @Route("/coupon_img/{size}/{coupon_code}", name="coupon_img", methods={"GET"})
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function coupon_image(Request $request, Packages $assetsManager, $size, $coupon_code)
    {
        //Default
        //Value
        $discount = "0";                                    
        $discountColor = [249,11,50];
        $discountSize = ($size=="s"?140:280);
        $discountPaddingTop = 0;
        //Coupon Name
        $couponNameColor = [249,11,50];
        $couponName = "クーポンが見つかりません";           
        $couponNameSize = ($size=="s"?20:40);
        //Unit
        $unitColor = [249,11,50];
        $unitName = "";
        $unitSize = ($size=="s"?70:140);

        $base_dir = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;
        $filepath = $base_dir.$assetsManager->getUrl('assets/img/coupon/coupon'.($size == "s"?'-s':'').'.jpg');

        $Coupon = $this->couponRepository->findOneBy(['coupon_cd' => $coupon_code]);

        if(is_object($Coupon)){
            $discountColor = [0,0,0];
            $couponNameColor = [0,0,0];
            $unitColor = [0,0,0];
            $couponName = $Coupon->getCouponName();

            if($Coupon->getDiscountType() == 1){
                $discountSize = ($size=="s"?100:200);;
                $discountPaddingTop = ($size=="s"?15:30);;
                $discount = intval($Coupon->getDiscountPrice());
                $filepath = $base_dir.$assetsManager->getUrl('assets/img/coupon/coupon'.($size == "s"?'-s':'').'-space.jpg');
                $unitName = "円";
            }else{
                $discount = $Coupon->getDiscountRate();
            }
        }

        $fontpath = $base_dir.$assetsManager->getUrl('assets/fonts/hgrge.ttc');
        $filename = $coupon_code."-coupon.jpg";
        
        // Create Image From Existing File
        $jpg_image = imagecreatefromjpeg($filepath);
        $discountColorObj = imagecolorallocate($jpg_image, $discountColor[0], $discountColor[1], $discountColor[2]);
        $couponNameColorObj = imagecolorallocate($jpg_image, $couponNameColor[0], $couponNameColor[1], $couponNameColor[2]);
        
        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename);
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->setContent(file_get_contents($filepath));

        //Array ( [left] => 21 [top] => 211 [width] => 246 [height] => 219 
        //[box] => Array ( [0] => 22 [1] => 7 [2] => 268 [3] => 7 [4] => 268 [5] => -212 [6] => 22 [7] => -212 ) )
        $discount_box = $this->calculateTextBox($discount, $fontpath, $discountSize, 0);
        $couponName_box = $this->calculateTextBox($couponName, $fontpath, $couponNameSize, 0);

        //T:670, L:320
        //W:500, H:300
        $discount_left = ($size=="s"?160:320) + (($size=="s"?250:500) - $discount_box["width"]);
        $discount_top = ($size=="s"?335:670) + $discount_box["height"] + $discountPaddingTop;
        imagettftext($jpg_image, $discountSize, 0, $discount_left, $discount_top, $discountColorObj, $fontpath, $discount);
        //T:1040, L:315
        //W:975, H:90
        $couponName_left = ($size=="s"?158:316) + (($size=="s"?488:976) - $couponName_box["width"]);
        $couponName_top = ($size=="s"?520:1040) + $couponName_box["height"];
        imagettftext($jpg_image, $couponNameSize, 0, $couponName_left, $couponName_top, $couponNameColorObj, $fontpath, $couponName);

        if($unitName != ""){
            //$unit_box = $this->calculateTextBox($unitName, $fontpath, $unitSize, 0);
            //T:810, L:860
            //W:320, H:160
            $unit_left = ($size=="s"?430:860);
            $unit_top = ($size=="s"?405:810);;
            imagettftext($jpg_image, $unitSize, 0, $unit_left, $unit_top, $couponNameColorObj, $fontpath, $unitName);
        }

        imagejpeg($jpg_image);
        imagedestroy($jpg_image);

        return $response;
    }

    public function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) { 
        /************ 
        simple function that calculates the *exact* bounding box (single pixel precision). 
        The function returns an associative array with these keys: 
        left, top:  coordinates you will pass to imagettftext 
        width, height: dimension of the image you have to create 
        *************/ 
        $rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text); 
        $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6])); 
        $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6])); 
        $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7])); 
        $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7])); 
    
         return array( 
             "left"   => abs($minX) - 1, 
             "top"    => abs($minY) - 1, 
             "width"  => $maxX - $minX, 
             "height" => $maxY - $minY, 
             "box"    => $rect 
         ); 
    }

    private function getCouponPluginInfo(){
        $Coupon4Plugin = $this->pluginRepository->findOneBy(['code' => 'Coupon4', 'enabled' => 1]);
        return $Coupon4Plugin;
    }

    public function mergeDateList($list1, $list2)
    {
        $listDate = [];

        if($list1){
            foreach($list1 as $lst){
                $item = [];
                $item["dateVal"] = $lst["dateVal"];
                $item["dateName"] = $lst["dateName"];

                $listDate[] = $item;
            }
        }

        if($list2){
            foreach($list2 as $lst){
                $item = [];
                $item["dateVal"] = $lst["dateVal"];
                $item["dateName"] = $lst["dateName"];

                if (!$this->hasDateItem($listDate, $item)) {
                    $listDate[] = $item;
                }
            }
        }

        return $listDate;
    }

    public function hasDateItem($lstDate, $item)
    {
        foreach($lstDate as $lst){
            if($lst["dateVal"] == $item["dateVal"]) return true;
        }

        return false;
    }
}
