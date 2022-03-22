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
use Eccube\Service\MailService;
use Plugin\Coupon4\Entity\Coupon;
use Plugin\Coupon4\Repository\CouponRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
     * @var ChainStoreRepository
     */
    private $chainStoreRepository;

    /**
     * @var CustomerCouponRepository
     */
    private $customerCouponRepository;

    /**
     * CouponController constructor.
     *
     * @param MailService $mailService
     * @param PageRepository $pageRepository
     * @param PluginRepository $pluginRepository
     * @param CouponRepository $couponRepository
     * @param ChainStoreRepository $chainStoreRepository
     * @param CustomerCouponRepository $customerCouponRepository
     */
    public function __construct(
        MailService $mailService,
        PageRepository $pageRepository,
        PluginRepository $pluginRepository,
        CouponRepository $couponRepository,
        ChainStoreRepository $chainStoreRepository,
        CustomerCouponRepository $customerCouponRepository)
    {
        $this->mailService = $mailService;
        $this->pageRepository = $pageRepository;
        $this->pluginRepository = $pluginRepository;
        $this->couponRepository = $couponRepository;
        $this->chainStoreRepository = $chainStoreRepository;
        $this->customerCouponRepository = $customerCouponRepository;
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
                
                //POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST' || $isget){
                    if( is_object($ChainStore) ){
                        $Coupon = null;
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
            $this->customerCouponRepository->delete( $CustomerCoupon );
        }

        return $this->redirectToRoute('mypage_coupon_list');
    }

    private function getCouponPluginInfo(){
        $Coupon4Plugin = $this->pluginRepository->findOneBy(['code' => 'Coupon4', 'enabled' => 1]);
        return $Coupon4Plugin;
    }

}