<?php

/*
  uploadディレクトリのURLを返す e.g.)http://hogehoge/wp-content/uploads
*/
function shortcode_getUploadsURL() {
	$upload_uri = wp_upload_dir()['url'] . '/';
	return $upload_uri;
}
add_shortcode('iurl', 'shortcode_getUploadsURL');

/*
  「施工例」ページでのカテゴリーの出し分け
*/
add_filter(
  'snow_monkey_recent_posts_widget_args_works', function( $query_args ) {
    $query_args['category_name'] = 'work,furniture,joinery';
    return $query_args;
  }
);

/*
  トップページNEWSでのクエリー変更
*/

add_filter(
  'snow_monkey_recent_posts_widget_args_top', function( $query_args ) {
    $query_args['category_name'] = 'news';
    return $query_args;
  }
);
