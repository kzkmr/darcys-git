<?php

namespace Plugin\ZeusPayment4\Controller\Admin;

use Eccube\Controller\AbstractController;
use Eccube\Entity\Order;
use Eccube\Entity\Master\OrderStatus;
use Eccube\Entity\Master\PageMax;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Plugin\ZeusPayment4\Form\Type\Admin\OrderFormType;
use Knp\Component\Pager\PaginatorInterface;
use Plugin\ZeusPayment4\Repository\ConfigRepository;
use Plugin\ZeusPayment4\Entity\Config;
use Eccube\Service\OrderStateMachine;
use Symfony\Component\Workflow\StateMachine;
/*
 * ゼウス注文管理コントローラー
 */
class OrderController extends AbstractController
{
    protected $title;
    protected $subtitle;
    protected $orderStateMachine;
    protected $machine;

    public function __construct(OrderStateMachine $orderStateMachine, StateMachine $_orderStateMachine)
    {
        $this->title = '受注管理';
        $this->subtitle = 'ゼウス受注管理';
        $this->orderStateMachine = $orderStateMachine;
        $this->machine = $_orderStateMachine;
    }

    /**
     * ゼウス受注管理画面
     * @Route("/%eccube_admin_route%/order/zeus_payment/{page_no}", name="zeus_order_list")
     * @Template("@ZeusPayment4/admin/order.twig")
     */
    public function index(Request $request, PaginatorInterface $paginator, $page_no = null)
    {
        $session = $request->getSession();
        $searchForm = $this->formFactory->createBuilder(OrderFormType::class)->getForm();

        $pagination = array();
        $pageMaxis = $this->entityManager->getRepository(PageMax::class)->findAll();
        $page_count = $this->eccubeConfig->get('eccube_default_page_count');

        $active = false;
        
        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);
            
            if ($searchForm->isValid()) {
                $searchData = $searchForm->getData();

                // paginator
                $qb = $this->getSearchQd($searchData);
                $page_no = 1;
                $pagination = $paginator->paginate($qb, $page_no, $page_count);
                
                // sessionのデータ保持
                $session->set('eccube.plugin.zeus_payment.admin.order.search', $searchData);
                $active = true;
            }
        } else {
            if (is_null($page_no)) {
                // sessionを削除
                $session->remove('eccube.plugin.zeus_payment.admin.order.search');
            } else {
                // pagingなどの処理
                $searchData = $session->get('eccube.plugin.zeus_payment.admin.order.search');
                if (! is_null($searchData)) {
                    // 表示件数
                    $pcount = $request->get('page_count');
                    $page_count = empty($pcount) ? $page_count : $pcount;
                    
                    $qb = $this->getSearchQd($searchData);
                    $pagination = $paginator->paginate($qb, $page_no, $page_count);

                    // セッションから検索条件を復元
                    $searchForm->setData($searchData);
                    $active = true;
                }
            }
        }
        return[
            'maintitle' => $this->title,
            'subtitle' => $this->subtitle,
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'pageMaxis' => $pageMaxis,
            'page_no' => $page_no,
            'page_count' => $page_count,
            'active' => $active,
            'can_cancel_status' => $this->getCanCancelStates()
        ];
    }

    private function getSearchQd($searchData)
    {
        $repository = $this->getDoctrine()->getRepository(Order::class);
        $configRepository = $this->getDoctrine()->getRepository(Config::class);
        $config = $configRepository->get();
        $paymentIds = [-1];
        $payments = $config->getPayments();
        foreach ($payments as $payment) {
            $paymentIds[] = $payment->getId();
        }
        //add join to keep same results as eccube order list
        $query = $repository->createQueryBuilder('o')->where("o.Payment IN (:Payments)")
        ->leftJoin('o.OrderItems', 'oi')
        ->leftJoin('o.Pref', 'pref')
        ->innerJoin('o.Shippings', 's');
        
        $query->setParameter('Payments', $paymentIds);
        $orderId = isset($searchData['order_id'])?trim($searchData['order_id']):'';
        if (! empty($orderId) && $orderId) {
            $query->andWhere('o.id = :order_id')->setParameter('order_id', $this->toInt($orderId));
        }

        // zeus_order_id
        $zeusOrderId = isset($searchData['zeus_order_id'])?trim($searchData['zeus_order_id']):'';
        if ($zeusOrderId!=='') {
            $query->andWhere('o.zeus_order_id LIKE :zeus_order_id')->setParameter(
                'zeus_order_id',
                '%' . $zeusOrderId . '%'
            );
        }

        // multi
        $multi = isset($searchData['multi'])?trim($searchData['multi']):'';
        //$multi = preg_match('/^\d+$/', $multi) ? $multi : '';
        if ($multi!=='') {
            $query->andWhere('o.id = :multi OR o.zeus_order_id LIKE :likemulti ')
                ->setParameter('multi', $this->toInt($multi))
                ->setParameter('likemulti', '%' . $multi . '%');
        }

        // Order By
        $query->addOrderBy('o.id', 'DESC');

        return $query;
    }

    /**
     * 一括キャンセル
     * @Route("/%eccube_admin_route%/order/zeus_cancel", name="zeus_order_cancel")
     */
    public function cancelAll(Request $request)
    {
        $ids = "";
        $fail_ids = "";
        $orderStatus = $this->entityManager->getRepository(
            '\Eccube\Entity\Master\OrderStatus'
        )->find(OrderStatus::CANCEL);
        $orderRepo = $this->entityManager->getRepository('\Eccube\Entity\Order');

        $configRepository = $this->getDoctrine()->getRepository(Config::class);
        $config = $configRepository->get();
        $paymentIds = [-1];
        $payments = $config->getPayments();
        foreach ($payments as $payment) {
            $paymentIds[] = $payment->getId();
        }

        foreach ($request->query->all() as $key => $value) {
            $id = str_replace('ids', '', $key);
            $order = $orderRepo->find($id);
            $payment = $order->getPayment();
            if ($order && $payment && in_array($payment->getId(), $paymentIds)) {
                if ($this->orderStateMachine->can($order, $orderStatus)) {
                    $ids = $id . ',' . $ids;
                    $this->orderStateMachine->apply($order, $orderStatus);
                    $this->entityManager->persist($order);
                } else {
                    $fail_ids = $id . ',' . $fail_ids;
                }
            }
        }
        $this->entityManager->flush();
        $ids = substr($ids, 0, - 1);
        $fail_ids = substr($fail_ids, 0, - 1);

        if ($ids) {
            $this->addSuccess('一括キャンセルしました。決済のキャンセルはゼウス管理画面で行ってください。( ID => ' . $ids . ' )', 'admin');
        }
        if ($fail_ids) {
            $this->addWarning('一括キャンセルに失敗しました。( ID => ' . $fail_ids . ' )', 'admin');
        }
        return $this->redirect($this->generateUrl('zeus_order_list'));
    }

    private function toInt($sid){

        $max = 0xffffffff;
        $max = ($max-1)/2;
        $sid = intval($sid);
        if($sid>$max || $sid<0){
            $sid = 0;
        }

        return $sid;
    }

    private function getCanCancelStates()
    {
        $transitions = $this->machine->getDefinition()->getTransitions();
        $status = [];
        foreach ($transitions as $t) {
            if ($t->getName() == 'cancel') {
                $status =  array_merge($status, $t->getFroms());
            }
        }
        return $status;
    }
}
