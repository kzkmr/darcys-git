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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CustomTopController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Template("index.twig")
     */

     public function index(Request $request)
    {

        // ブログ情報を取得
        // $header = array(
        //   'Content-Type: application/x-www-form-urlencoded',
        //   'Authorization: Basic '.base64_encode('darcys:202111')
        // );
        // $options = array('http' => array(
        //   'method' => 'GET',
        //   'header' => implode("\r\n", $header ),
        // ));
        // $options = stream_context_create($options);
        // if (wp_remote_get($request->getSchemeAndHttpHost().$request->getBasePath().'/shop/wp-json/wp/v2/posts?per_page=3&_embed', false, $options)) {
        //   $response = wp_remote_get($request->getSchemeAndHttpHost().$request->getBasePath().'/shop/wp-json/wp/v2/posts?per_page=3&_embed', false, $options);
        //   $posts = json_decode($response["body"]);
        // } else {
        //   $posts = false;
        // }

        $options = stream_context_create();
        if (wp_remote_get($request->getSchemeAndHttpHost().$request->getBasePath().'/shop/wp-json/wp/v2/posts?per_page=3&_embed', false)) {
          $response = wp_remote_get($request->getSchemeAndHttpHost().$request->getBasePath().'/shop/wp-json/wp/v2/posts?per_page=3&_embed', false);
          $posts = json_decode($response["body"]);
        } else {
          $posts = false;
        }

        $blogDatas = [];
        if ($posts) {

          foreach ($posts as $data) {
              $item = [];
              $item['title'] = $data->title;
              $item['date'] = $data->date;
              $item['link'] = $data->link;
              $name = 'wp:featuredmedia';
              if (isset($data->_embedded->{$name})) {
                  $item['attachment'] = $data->_embedded->{$name}[0];
              }
              $name = 'wp:term';
              if (isset($data->_embedded->{$name})) {
                  $item['category'] = $data->_embedded->{$name}[0];
              }
              $blogDatas[] = $item;
          }
        }

        return [
            'blogDatas' => $blogDatas,
        ];
    }
}
