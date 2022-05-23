<?php

/*
  ec-cubeへのルートの関数
*/
function ec_url() {
	return "//test-darcys-factory.xyz";
}
function ec_asset_url() {
	return "//test-darcys-factory.xyz/html/template/default/assets";
}


/**
 * home pass URL
 *
 * @return string
 */
function home_url_shortcode() {
    return esc_url(home_url('/'));
}
add_shortcode('home', 'home_url_shortcode');


/**
 * カスタムHTMLウィジェットでショートコード使用
 */
add_filter( 'widget_text', 'do_shortcode' );


/*
  footerにドロワー追加
*/
add_action(
	'snow_monkey_append_footer',
	function() {
		include(WP_PLUGIN_DIR. "/my-snow-monkey/inc/drawer.php");
	}
);


/*
  Google Fontsを読み込む
*/

add_action( 'wp_head', function() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <?php
  },
  10,
  3
);


/*
  uploadディレクトリのURLを返す e.g.)http://hogehoge/wp-content/uploads
*/
function shortcode_getUploadsURL() {
	$upload_uri = wp_upload_dir()['url'] . '/';
	return $upload_uri;
}
add_shortcode('iurl', 'shortcode_getUploadsURL');

/*
  トップページNEWSでのクエリー変更
*/

// add_filter(
//   'snow_monkey_recent_posts_widget_args_top', function( $query_args ) {
//     $query_args['category_name'] = 'news';
//     return $query_args;
//   }
// );


/*
  WP側でクォーテーションがエスケープされるのを防ぐ
*/

//https://xoops.ec-cube.net/modules/newbb/viewtopic.php?topic_id=18696&forum=11
function strip_magic_quotes_slashes($arr){
  if(is_array($arr)){
    return array_map('strip_magic_quotes_slashes', $arr);
  } else {
    return stripslashes($arr);
  }
}
$_GET = strip_magic_quotes_slashes($_GET);
$_POST = strip_magic_quotes_slashes($_POST);


/*
  インスタグラムフィード
*/

function instagram(){
  echo do_shortcode('[instagram-feed feed=1]');
}


/*
  管理画面の「投稿」を「NEWS」表記に変更
*/

function ChangeAdminLabel() {
	global $menu;
	global $submenu;
	$name = 'NEWS';
	$menu[5][0] = $name;
	$submenu['edit.php'][5][0] = $name.'一覧';
	$submenu['edit.php'][10][0] = '新規追加';
}
function ChangeAdminObject() {
	global $wp_post_types;
	$name = 'NEWS';
	$labels = &$wp_post_types['post']->labels;
	$labels->name = $name;
	$labels->singular_name = $name;
	$labels->add_new = _x('追加', $name);
	$labels->add_new_item = $name.'の新規追加';
	$labels->edit_item = $name.'の編集';
	$labels->new_item = '新規'.$name;
	$labels->view_item = $name.'を表示';
	$labels->search_items = $name.'を検索';
	$labels->not_found = $name.'が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に'.$name.'は見つかりませんでした';
}
add_action( 'init', 'ChangeAdminObject' );
add_action( 'admin_menu', 'ChangeAdminLabel' );


/*
  NEWSページクエリー制御
*/

add_filter(
	'snow_monkey_recent_posts_widget_args_info',
	function( $query_args ) {
		$tax_query               = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => 'info',
			),
		);
		$query_args['tax_query'] = $tax_query;
		return $query_args;
	}
);
add_filter(
	'snow_monkey_recent_posts_widget_args_ice',
	function( $query_args ) {
		$tax_query               = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => 'ice',
			),
		);
		$query_args['tax_query'] = $tax_query;
		return $query_args;
	}
);
add_filter(
	'snow_monkey_recent_posts_widget_args_coffee',
	function( $query_args ) {
		$tax_query               = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => 'coffee',
			),
		);
		$query_args['tax_query'] = $tax_query;
		return $query_args;
	}
);
add_filter(
	'snow_monkey_recent_posts_widget_args_bread',
	function( $query_args ) {
		$tax_query               = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => 'bread',
			),
		);
		$query_args['tax_query'] = $tax_query;
		return $query_args;
	}
);
add_filter(
	'snow_monkey_recent_posts_widget_args_other',
	function( $query_args ) {
		$tax_query               = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => 'other',
			),
		);
		$query_args['tax_query'] = $tax_query;
		return $query_args;
	}
);


/*
  「products_type」で絞り込むためのドロップダウンを追加する
*/
add_action(
  'restrict_manage_posts',
  function ( $post_type ) {
    // カスタム投稿タイプ「products」に絞り込み条件を追加する.
    if ( 'products' === $post_type ) {
      // 「products_type」で絞り込むためのドロップダウンを追加する.
      $taxonomy = 'products_type';
      wp_dropdown_categories(
        [
          'show_option_all' => '商品カテゴリー',
          'orderby'         => 'name',
          'selected'        => get_query_var( $taxonomy ),
          'hide_empty'      => 0,
          'name'            => $taxonomy,
          'taxonomy'        => $taxonomy,
          'value_field'     => 'slug',
          'hierarchical'    => 1, // 親・子関係がある場合は1がおすすめ.
        ]
      );
    }
  }
);


/*

*/

add_filter( 'snow_monkey_recent_posts_widget_args_product-ice', function( $query_args ) {
    $query_args = [
      'tax_query' => [
        [
          'taxonomy' => 'products_type',
          'field'    => 'slug',
          'terms'    => [ 'product_ice' ],
        ]
      ],
    ] + $query_args;
    $query_args['posts_per_page'] = 8;
    $query_args['order'] = 'ASC';
    return $query_args;
} );


/*
  「商品」投稿ページレイアウト
*/

add_action(
  'snow_monkey_prepend_contents',
  function() {
    if ( is_singular('products') ) {
      echo do_shortcode( '[call_php file=pageheader]' );
      echo do_shortcode( '[call_php file=breadcrumb]' );
    }
    if ( is_singular('post') ) {
      echo do_shortcode( '[call_php file=pageheader]' );
      echo do_shortcode( '[call_php file=breadcrumb]' );
    }
  }
);


/**
 * 親ページを持つ子ページを判別
 */

function is_parent_slug() {
    global $post;
    if ($post->post_parent) {
        $post_data = get_post($post->post_parent);
        return $post_data->post_name;
    }
}


/**
 * EC-CUBE連携用関数
 */
require_once __DIR__.'/../../../../../vendor/autoload.php';

use \Customize\Twig\Extension\TwigExtension;

function get_token()
{
    $app = \Eccube\Application::getInstance();
    $tokenProvider = $app->getParentContainer()->get('security.csrf.token_manager');

    return $tokenProvider->getToken('_token')->getValue();
}

add_shortcode('token', 'get_token');

function get_title()
{
    $app = \Eccube\Application::getInstance();
    $tokenProvider = $app->getParentContainer()->get('');
}

add_shortcode('title', 'get_title');

function get_base_info()
{
    $app = \Eccube\Application::getInstance();
    $baseInfoRepositoy = $app->getParentContainer()->get('Eccube\Repository\BaseInfoRepository');
    $BaseInfo = $baseInfoRepositoy->get();

    return $BaseInfo;
}

add_shortcode('BaseInfo', 'get_base_info');

function is_granted()
{
    $app = \Eccube\Application::getInstance();

    return $app->getParentContainer()->get('security.authorization_checker')->isGranted('ROLE_USER');
}

add_shortcode('is_granted', 'is_granted');

function user()
{
    $app = \Eccube\Application::getInstance();
    $token = $app->getParentContainer()->get('security.token_storage')->getToken();
    if (!\is_object($user = $token->getUser())) {
        return;
    }

    return $user;
}

add_shortcode('user', 'user');

function get_all_carts()
{
    $app = \Eccube\Application::getInstance();
    $CartService = $app->getParentContainer()->get('Eccube\Service\CartService');

    return $CartService->getCarts();
}

add_shortcode('get_all_carts', 'get_all_carts');

function get_carts_total_quantity()
{
    $Carts = get_all_carts();
    $totalQuantity = array_reduce($Carts, function ($total, $Cart) {
        $total += $Cart->getTotalQuantity();

        return $total;
    }, 0);

    return $totalQuantity;
}

add_shortcode('get_carts_total_quantity', 'get_carts_total_quantity');

function get_carts_total_price()
{
    $Carts = get_all_carts();
    $totalPrice = array_reduce($Carts, function ($total, $Cart) {
        $total += $Cart->getTotalPrice();

        return $total;
    }, 0);

    return $totalPrice;
}

add_shortcode('get_carts_total_price', 'get_carts_total_price');

// 商品取得
function get_product($id)
{
    $app = \Eccube\Application::getInstance();
    $productRepository = $app->getParentContainer()->get('Eccube\Repository\ProductRepository');

    return $productRepository->find($id);
}

add_shortcode('get_product', 'get_product');

// メイン商品画像
function get_main_image($Product)
{
    $app = \Eccube\Application::getInstance();

    return $app->getParentContainer()->get('assets.packages')->getUrl($Product->getMainListImage(), 'save_image');
}

add_shortcode('get_main_image', 'get_main_image');


// ページ情報
function get_page_data()
{
    $app = \Eccube\Application::getInstance();

    $request = $app->getParentContainer()->get('request_stack');
    $attributes = $request->getCurrentRequest()->attributes;
    if ($attributes) {
        $route = $attributes->get('_route');

        if ($route == 'user_data') {
            $routeParams = $attributes->get('_route_params', []);
            $route = isset($routeParams['route']) ? $routeParams['route'] : $attributes->get('route', '');
        }

        $pageRepository = $app->getParentContainer()->get('Eccube\Repository\PageRepository');

        $Page = $pageRepository->getPageByRoute($route);
    }

    return $Page;
}

add_shortcode('get_page_data', 'get_page_data');

function chainStore()
{
    $LoginTypeInfo = IsChainStore();
    if ( $LoginTypeInfo ) {
      return true;
    } else {
      return false;
    }
}

// function IsChainStore()
// {
//     $LoginTypeInfo = $this->getLoginTypeInfo();
//     $LoginType = $LoginTypeInfo['LoginType'];
//     if ( $LoginType == 3 ) {
//       return true;
//     } else {
//       return false;
//     }
// }

// function getLoginTypeInfo()
// {
//     $LoginType = 1;         //Default is guest
//     $Customer = $this->getCurrentUser();
//     $ChainStore = null;
//     $ContractType = null;

//     if (is_object($Customer)) {
//         $ChainStore = $Customer->getChainStore();

//         if(is_object($ChainStore)){
//             $LoginType = 3;         //ChainStore member
//             $ContractType = $ChainStore->getContractType();
//         }else{
//             $LoginType = 2;         //Normal member
//         }
//     }else{
//         $Customer = null;
//     }

//     return [
//         'LoginType' => $LoginType,
//         'Customer' => $Customer,
//         'ChainStore' => $ChainStore,
//         'ContractType' => $ContractType,
//     ];
// }
/**
 * EC-CUBE連携用関数ここまで
 */