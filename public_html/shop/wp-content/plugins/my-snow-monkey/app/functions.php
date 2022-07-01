<?php

/*
  ec-cubeへのルートの関数
*/
function ec_url()
{
  return "//darcys-factory.co.jp";
}
function ec_asset_url()
{
  return "//darcys-factory.co.jp/html/template/default/assets";
}

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

/*
	タイトルタグ
*/
add_theme_support( 'title-tag' );

add_filter( 'pre_get_document_title', 'change_document_title' );
function change_document_title( $title )
{
	if ( is_page('news') ) {
		$title = '新着情報｜ダシーズファクトリー公式';
	} elseif ( is_page('story') || is_parent_slug() === 'story' ) {
		$title = 'ダシーズアイスの誕生物語｜ダシーズファクトリー公式';
	} elseif ( is_page('concept') || is_parent_slug() === 'concept' ) {
		$title = '製品のこだわり｜ダシーズファクトリー公式';
	} elseif ( is_page('products-list') || get_post_type() === 'products' ) {
		$title = '商品ラインアップ｜ダシーズファクトリー公式';
	} elseif ( is_post_type_archive('stores') || get_post_type() === 'stores' ) {
		$title = '店舗紹介｜ダシーズファクトリー公式○';
	} elseif ( is_page( array('contact', 'contact-m', 'contact-general') ) ) {
		$title = 'お問い合わせ｜ダシーズファクトリー公式';
	} elseif ( is_page( 'guide' ) ) {
		$title = 'ご利用の手引き｜ダシーズファクトリー公式';
	}

	return $title;
}

/*
	OGPタグ設定を出力
*/
function my_meta_ogp() {
	if( is_front_page() || is_home() || is_singular() ) {
		global $post;
		$ogp_title = '';
		$ogp_descr = '';
		$ogp_url = '';
		$ogp_img = '';
		$ogp_site_name = '';
		$insert = '';

		if ( is_page('news') ) {
			$ogp_title = '新着情報｜ダシーズファクトリー公式';
			$ogp_descr = 'こちらではダシーズアイスのことや企業としての情報をご案内しています。';
			$ogp_url = home_url('/news/');
			$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/news.png';
			$ogp_site_name = 'Darcy\'s - ダシーズファクトリー公式';
		} elseif ( is_page('story') || is_parent_slug() === 'story' ) {
			setup_postdata($post);
				$ogp_title = 'ダシーズアイスの誕生物語｜ダシーズファクトリー公式';
				$ogp_descr = 'ダシーズファクトリーのアイスの誕生物語。当初ダシーズギルトフリーアイスクリームラボ（研究所）としてスタート。オリンピック金メダリストの松本薫の長年の夢から生まれました。みんなが安心して食べられる食材を厳選して、身体に素材の喜びを感じることが出来たなら。そんな想いは「ギルトフリー（罪悪感がない）」という考え方に繋がりました。';
				$ogp_url = get_permalink();
				$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/story.png';
				$ogp_site_name = 'Darcy\'s - ダシーズファクトリー公式';
			wp_reset_postdata();
		} elseif ( is_page('concept') || is_parent_slug() === 'concept' ) {
			setup_postdata($post);
				$ogp_title = '製品のこだわり｜ダシーズファクトリー公式';
				$ogp_descr = 'ダシーズファクトリーの製品に対するこだわりをご紹介しています。ダシーズのアイスは、「誰でも安心して食べられる」ことがコンセプト。そして、食べることで健康になれるように、使う材料は細部にまでこだわりが詰まっています。みんな笑顔になれるアイスのヒミツ、ぜひ知ってください。';
				$ogp_url = get_permalink();
				$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/concept.png';
				$ogp_site_name = 'Darcy\'s - ダシーズファクトリー公式';
			wp_reset_postdata();
		} elseif ( is_page('products-list') || get_post_type() === 'products' ) {
			setup_postdata($post);
				$ogp_title = '商品ラインアップ｜ダシーズファクトリー公式';
				$ogp_descr = 'ダシーズアイスの商品ラインアップをご案内するページです。プレミアムココナッツミルクチョコクッキー、豆乳焦がしキャラメル、ル・ショコラ、一番抹茶、チョコミントココナッツミルク、パクチーキウイを中心に季節限定商品などもこちらでご紹介します。';
				$ogp_url = get_permalink();
				$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/products.png';
				$ogp_site_name = 'Darcy\'s - ダシーズファクトリー公式';
			wp_reset_postdata();
		} elseif ( is_post_type_archive('stores') || get_post_type() === 'stores' ) {
			setup_postdata($post);
				$ogp_title = '店舗紹介｜ダシーズファクトリー公式';
				$ogp_descr = 'ダシーズファクトリーの販売店舗をご紹介しています。店舗は東京富士大学構内に直営店を出店しています。';
				$ogp_url = get_permalink();
				$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/stores.png';
				$ogp_site_name = 'Darcy\'s - ダシーズファクトリー公式';
			wp_reset_postdata();
		} elseif ( is_page( array('contact', 'contact-m', 'contact-general') ) ) {
			setup_postdata($post);
				$ogp_title = 'お問い合わせ｜ダシーズファクトリー公式';
				$ogp_descr = 'ダシーズファクトリーに対するお問い合わせや松本薫への各種オファーなどを申請頂けるフォームを設置しています。';
				$ogp_url = get_permalink();
				$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/top.png';
				$ogp_site_name = 'Darcy\'s - ダシーズファクトリー公式';
			wp_reset_postdata();
		} elseif ( is_page( 'guide' ) ) {
			$ogp_title = 'ご利用の手引き｜ダシーズファクトリー公式';
			$ogp_descr = 'ダシーズファクトリー公式サイトでのショッピングにおけるご利用案内のページとなります。';
			$ogp_url = home_url('/guide/');
			$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/top.png';
			$ogp_site_name = 'Darcy\'s - ダシーズファクトリー公式';
		} else {
			setup_postdata($post);
				$ogp_title = get_bloginfo('name');
				$ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
				$ogp_url = get_permalink();
				$ogp_img = 'https:' . ec_url() . '/html/template/default/assets/img/ogp/top.png';
				$ogp_site_name = 'ダシーズファクトリー公式';
			wp_reset_postdata();
		}

		//og:type
		$ogp_type = 'article';

		//出力するOGPタグをまとめる
		$insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'" />' . "\n";
		$insert .= '<meta property="og:description" content="'.esc_attr($ogp_descr).'" />' . "\n";
		$insert .= '<meta property="og:type" content="'.$ogp_type.'" />' . "\n";
		$insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'" />' . "\n";
		$insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'" />' . "\n";
		$insert .= '<meta property="og:site_name" content="'.esc_attr($ogp_site_name).'" />' . "\n";
		$insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
		$insert .= '<meta name="twitter:site" content="Darcy\'s - ダシーズファクトリー公式" />' . "\n";
		$insert .= '<meta property="og:locale" content="ja_JP" />' . "\n";

		echo $insert;
	}
}
add_action('wp_head','my_meta_ogp');


/**
 * home pass URL
 *
 * @return string
 */
function home_url_shortcode()
{
  return esc_url(home_url('/'));
}
add_shortcode('home', 'home_url_shortcode');


/**
 * カスタムHTMLウィジェットでショートコード使用
 */
add_filter('widget_text', 'do_shortcode');


/*
  footerにドロワー追加
*/
add_action(
  'snow_monkey_append_footer',
  function () {
    include(WP_PLUGIN_DIR . "/my-snow-monkey/inc/drawer.php");
  }
);


/*
  Google Fontsを読み込む
*/

add_action(
  'wp_head',
  function () {
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
function shortcode_getUploadsURL()
{
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
function strip_magic_quotes_slashes($arr)
{
  if (is_array($arr)) {
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

function instagram()
{
  echo do_shortcode('[instagram-feed feed=1]');
}


/*
  管理画面の「投稿」を「NEWS」表記に変更
*/

function ChangeAdminLabel()
{
  global $menu;
  global $submenu;
  $name = 'NEWS';
  $menu[5][0] = $name;
  $submenu['edit.php'][5][0] = $name . '一覧';
  $submenu['edit.php'][10][0] = '新規追加';
}
function ChangeAdminObject()
{
  global $wp_post_types;
  $name = 'NEWS';
  $labels = &$wp_post_types['post']->labels;
  $labels->name = $name;
  $labels->singular_name = $name;
  $labels->add_new = _x('追加', $name);
  $labels->add_new_item = $name . 'の新規追加';
  $labels->edit_item = $name . 'の編集';
  $labels->new_item = '新規' . $name;
  $labels->view_item = $name . 'を表示';
  $labels->search_items = $name . 'を検索';
  $labels->not_found = $name . 'が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'ChangeAdminObject');
add_action('admin_menu', 'ChangeAdminLabel');


/*
  NEWSページクエリー制御
*/

add_filter(
  'snow_monkey_recent_posts_widget_args_info',
  function ($query_args) {
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
  function ($query_args) {
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
  function ($query_args) {
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
  function ($query_args) {
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
  function ($query_args) {
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
  function ($post_type) {
    // カスタム投稿タイプ「products」に絞り込み条件を追加する.
    if ('products' === $post_type) {
      // 「products_type」で絞り込むためのドロップダウンを追加する.
      $taxonomy = 'products_type';
      wp_dropdown_categories(
        [
          'show_option_all' => '商品カテゴリー',
          'orderby'         => 'name',
          'selected'        => get_query_var($taxonomy),
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

add_filter('snow_monkey_recent_posts_widget_args_product-ice', function ($query_args) {
  $query_args = [
    'tax_query' => [
      [
        'taxonomy' => 'products_type',
        'field'    => 'slug',
        'terms'    => ['product_ice'],
      ]
    ],
  ] + $query_args;
  $query_args['posts_per_page'] = 8;
  $query_args['order'] = 'ASC';
  $query_args['orderby'] = 'menu_order';
  return $query_args;
});


/*
  「商品」投稿ページレイアウト
*/

add_action(
  'snow_monkey_prepend_contents',
  function () {
    if (is_singular('products')) {
      echo do_shortcode('[call_php file=pageheader]');
      echo do_shortcode('[call_php file=breadcrumb]');
    }
    if (is_singular('post')) {
      echo do_shortcode('[call_php file=pageheader]');
      echo do_shortcode('[call_php file=breadcrumb]');
    }
  }
);

