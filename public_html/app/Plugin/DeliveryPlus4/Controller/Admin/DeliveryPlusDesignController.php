<?php
/*
* Plugin Name : DeliveryPlus4
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\DeliveryPlus4\Controller\Admin;

use Eccube\Util\StringUtil;
use Plugin\DeliveryPlus4\Form\Type\Admin\DeliveryPlusDesignType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class DeliveryPlusDesignController extends \Eccube\Controller\AbstractController
{
    /**
     * @Route("/%eccube_admin_route%/content/deliveryplus/detail", name="admin_content_deliveryplus_detail")
     * @Template("@DeliveryPlus4/admin/Content/detail.twig")
     */
    public function detailDesign(Request $request, Environment $twig, FileSystem $fs)
    {
        $form = $this->formFactory
                ->createBuilder(DeliveryPlusDesignType::class)
                ->getForm();

        $html = $twig->getLoader()
                ->getSourceContext('Product/weight_size.twig')
                ->getCode();

        $form->get('detail_html')->setData($html);

        if ('POST' === $request->getMethod()) {
            switch($request->get('mode')){
                case 'regist':
                    $form->handleRequest($request);

                    $dir = sprintf('%s/app/template/%s/Product',
                        $this->getParameter('kernel.project_dir'),
                        $this->getParameter('eccube.theme'));

                    $file = $dir.'/weight_size.twig';

                    $source = $form->get('detail_html')->getData();
                    $source = StringUtil::convertLineFeed($source);
                    $fs->dumpFile($file, $source);

                    // twigキャッシュの削除
                    $cacheDir = $this->getParameter('kernel.cache_dir').'/twig';
                    $fs->remove($cacheDir);

                    $this->addSuccess('deliveryplus.admin.content.save.complete', 'admin');
                    break;
                case 'init':
                    $requestData = $request->get('delivery_plus_design');
                    $content = file_get_contents($this->getParameter('plugin_realdir') . '/DeliveryPlus4/Resource/template/default/Product/weight_size.twig');
                    $requestData['detail_html'] = $content;
                    $request->request->set('delivery_plus_design',$requestData);
                    $form->handleRequest($request);
                    break;
                default:
                    break;
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/%eccube_admin_route%/content/deliveryplus/cart", name="admin_content_deliveryplus_cart")
     * @Template("@DeliveryPlus4/admin/Content/cart.twig")
     */
    public function cartDesign(Request $request, Environment $twig, FileSystem $fs)
    {
        $form = $this->formFactory
                ->createBuilder(DeliveryPlusDesignType::class)
                ->getForm();

        $html = $twig->getLoader()
                ->getSourceContext('Cart/weight_size.twig')
                ->getCode();

        $form->get('cart_html')->setData($html);

        if ('POST' === $request->getMethod()) {
            switch($request->get('mode')){
                case 'regist':
                    $form->handleRequest($request);

                    $dir = sprintf('%s/app/template/%s/Cart',
                        $this->getParameter('kernel.project_dir'),
                        $this->getParameter('eccube.theme'));

                    $file = $dir.'/weight_size.twig';

                    $source = $form->get('cart_html')->getData();
                    $source = StringUtil::convertLineFeed($source);
                    $fs->dumpFile($file, $source);

                    // twigキャッシュの削除
                    $cacheDir = $this->getParameter('kernel.cache_dir').'/twig';
                    $fs->remove($cacheDir);

                    $this->addSuccess('deliveryplus.admin.content.save.complete', 'admin');
                    break;
                case 'init':
                    $requestData = $request->get('delivery_plus_design');
                    $content = file_get_contents($this->getParameter('plugin_realdir') . '/DeliveryPlus4/Resource/template/default/Cart/weight_size.twig');
                    $requestData['cart_html'] = $content;
                    $request->request->set('delivery_plus_design',$requestData);
                    $form->handleRequest($request);
                    break;
                default:
                    break;
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }
}