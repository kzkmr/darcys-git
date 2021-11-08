<?php
/**
 * Plugin name: My Snow Monkey
 * Description: このプラグインに、あなたの Snow Monkey 用カスタマイズコードを書いてください。
 * Version: 0.1.1
 *
 * @package my-snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}

/**
 * Directory url of this plugin
 *
 * @var string
 */
define( 'MY_SNOW_MONKEY_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Directory path of this plugin
 *
 * @var string
 */
define( 'MY_SNOW_MONKEY_DIR_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

/**
 * @param array $hierarchy ルートディレクトリ配列
 * @param array $slug 対象のtemplateのslug
 * @param array $name 対象のtemplateの名前
 * @param array $vars パラメータ
 * @return $root ルート先とするディレクトリ配列
 */
add_filter(
	'snow_monkey_template_part_root_hierarchy',
	function( $hierarchy, $slug, $name, $vars ) {
		$hierarchy[] = __DIR__ . '/view';
		return $hierarchy;
	},
	10,
	4
);

/**
 * 実際のページ用の CSS 読み込み
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			'my-snow-monkey',
			MY_SNOW_MONKEY_URL . '/assets/css/style.min.css',
			[ Framework\Helper::get_main_style_handle() ],
			filemtime( MY_SNOW_MONKEY_DIR_PATH . '/assets/css/style.min.css')
		);
		if ( is_front_page() || is_page('works') ) {
			wp_enqueue_style(
				'slick',
				MY_SNOW_MONKEY_URL . '/assets/slick/slick.css',
				[],
				'1.8.1'
			);
			wp_enqueue_style(
				'slick-theme',
				MY_SNOW_MONKEY_URL . '/assets/slick/slick-theme.css',
				['slick'],
				'1.8.1'
			);
		}
	}
);

/**
 * エディター用の CSS 読み込み
 */
add_action(
	'after_setup_theme',
	function() {
		add_editor_style( '/../../plugins/my-snow-monkey/assets/css/style.min.css' );
	},
	11
);

/**
 * appフォルダ内のPHPファイル 読み込み
 */
add_action(
	'init',
	function() {
		\Framework\Helper::include_files( untrailingslashit( __DIR__ ) . '/app', true );
	}
);

/**
 * jsファイル 読み込み
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			'jquery',
			'/wp-content/plugins/my-snow-monkey/assets/js/jquery-3.5.1.min.js',
			'',
			'3.5.1',
			true
		);
		wp_enqueue_script(
			'main',
			'/wp-content/plugins/my-snow-monkey/assets/js/main.js',
      'jquery',
      '1.0',
			true
		);
		if ( is_front_page() || is_page('works') ) {
			wp_enqueue_script(
				'slick',
				'/wp-content/plugins/my-snow-monkey/assets/slick/slick.min.js',
				'jquery',
				'1.0',
				true
			);
		}
	}
);


/*
  copyright.php を上書き
*/

add_filter(
  'snow_monkey_template_part_root_hierarchy_template-parts/footer/copyright',
  function( $hierarchy, $name, $vars ) {
    $hierarchy[] = untrailingslashit( __DIR__ ) . '/copyright-override';
    return $hierarchy;
  },
  10,
  3
);


/*
  記事詳細ヘッダー content/entry/header/header.php を上書き
*/

add_filter(
  'snow_monkey_template_part_root_hierarchy_template-parts/content/entry/header/header',
  function( $hierarchy, $name, $vars ) {
    $hierarchy[] = untrailingslashit( __DIR__ ) . '/post-detail-override';
    return $hierarchy;
  },
  10,
  3
);


/**
 * incフォルダ内のPHPファイルをショートコードで読み込み
 *
 * @param array $params
 * @param string $file ファイル名（ショートコードのパラメータ）
 *
 * 使用例（sample.phpを配置した場合）
 * inc
 */
function my_php_Include($params = array()) {
	extract(shortcode_atts(array('file' => 'default'), $params));
	ob_start();
	include(WP_PLUGIN_DIR. "/my-snow-monkey/inc/$file.php");
	return ob_get_clean();
}
add_shortcode('call_php', 'my_php_Include');
