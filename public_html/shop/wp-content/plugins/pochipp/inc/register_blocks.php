<?php
namespace POCHIPP;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register block
 */
add_action( 'init', function() {
	// 記事で使うポチップブロック
	register_block_type_from_metadata( POCHIPP_PATH . 'src/blocks/linkbox', [
		'render_callback'  => '\POCHIPP\cb_pochipp_block',
	] );

	// 設定用ブロック
	if ( is_admin() && \POCHIPP::check_post_type_at_init( \POCHIPP::POST_TYPE_SLUG ) ) {
		register_block_type_from_metadata( POCHIPP_PATH . 'src/blocks/setting' );
	}

	// ボタン部分のプレビュー: フロントでも登録しないとServerSideRenderできない
	register_block_type_from_metadata( POCHIPP_PATH . 'src/blocks/setting-preview', [
		'render_callback' => '\POCHIPP\cb_pochipp_setting_preview',
	] );

} );


/**
 * 設定画面のボタンプレビュー
 */
function cb_pochipp_setting_preview( $attrs, $content ) {

	$pdata = json_decode( $attrs['meta'], true ) ?: [];
	if ( ! is_array( $pdata ) ) {
		$pdata = [];
	}

	$keywords           = $pdata['keywords'] ?? '';
	$asin               = $pdata['asin'] ?? '';
	$rakuten_detail_url = $pdata['rakuten_detail_url'] ?? '';
	$yahoo_detail_url   = $pdata['yahoo_detail_url'] ?? '';

	$amazon_url  = '';
	$rakuten_url = '';
	$yahoo_url   = '';

	// もしも用aid
	$amazon_aid  = \POCHIPP::get_setting( 'moshimo_amazon_aid' );
	$rakuten_aid = \POCHIPP::get_setting( 'moshimo_rakuten_aid' );
	$yahoo_aid   = \POCHIPP::get_setting( 'moshimo_yahoo_aid' );

	// AmazonボタンURL
	if ( \POCHIPP::$has_affi['amazon'] ) {
		$amazon_url = $asin ? 'https://www.amazon.co.jp/dp/' . $asin : \POCHIPP::get_amazon_searched_url( $keywords );
	}

	// 楽天ボタンURL
	if ( \POCHIPP::$has_affi['rakuten'] ) {
		$rakuten_url = $rakuten_detail_url ?: \POCHIPP::get_rakuten_searched_url( $keywords );
	}

	// YahooボタンURL
	if ( \POCHIPP::$has_affi['yahoo'] ) {
		$yahoo_url = $yahoo_detail_url ?: \POCHIPP::get_yahoo_searched_url( $keywords );
	}

	ob_start();
	\POCHIPP\render_pochipp_btns([
		'amazon_url'        => $amazon_url,
		'rakuten_url'       => $rakuten_url,
		'yahoo_url'         => $yahoo_url,
		'is_paypay'         => $pdata['is_paypay'] ?? '',
		'custom_btn_url'    => $pdata['custom_btn_url'] ?? '',
		'custom_btn_text'   => $pdata['custom_btn_text'] ?? '',
		'custom_btn_url_2'  => $pdata['custom_btn_url_2'] ?? '',
		'custom_btn_text_2' => $pdata['custom_btn_text_2'] ?? '',
		'btn_layout_pc'     => $pdata['btnLayoutPC'] ?? '',
		'btn_layout_sp'     => $pdata['btnLayoutSP'] ?? '',
		'rel_target'        => 'rel="nofollow noopener" target="_blank"',
	]);

	return ob_get_clean();
}


/**
 * 記事で使うポチップブロック
 */
function cb_pochipp_block( $attrs, $content ) {

	$pid      = $attrs['pid'] ?? 0;
	$title    = $attrs['title'] ?? '';
	$metadata = [];

	// メタデータ取得
	if ( $pid ) {
		$title    = $title ?: get_the_title( $pid );
		$metadata = get_post_meta( $pid, \POCHIPP::META_SLUG, true );
		$metadata = json_decode( $metadata, true ) ?: [];
	}

	// 商品未選択時
	if ( ! $title ) {
		if ( defined( 'REST_REQUEST' ) ) {
			return '<p class="__nullText"></p>';
		} else {
			return '';
		}
	}

	// 空情報を削除
	$attrs = array_filter( $attrs, function ( $elem ) {
		return ! empty( $elem );
	} );

	// $attr > $metadata の優先度
	$render_args = array_merge( $metadata, $attrs );

	ob_start();
	\POCHIPP\render_pochipp_block( $title, $render_args );
	return ob_get_clean();

}

function render_pochipp_block( $title = '', $pdata = [] ) {

	// ※ 定期的に、データの再取得も行う
	$pdata = array_merge([
		'pid'                  => 0,
		'className'            => '',
		'keywords'             => '',
		'searched_at'          => '',
		'asin'                 => '',
		'itemcode'             => '',
		// 'seller_id'     => '',
		'amazon_affi_url'      => '',
		'rakuten_detail_url'   => '',
		'yahoo_detail_url'     => '',
		'is_paypay'            => '',
		'info'                 => '',
		'price'                => 0,
		'price_at'             => '',
		'image_url'            => '',
		'image_id'             => '',
		'custom_btn_url'       => '',
		'custom_btn_text'      => '',
		'custom_btn_url_2'     => '',
		'custom_btn_text_2'    => '',
		'is_all_search_result' => false,
		'hideInfo'             => false,
		'hidePrice'            => false,
		'showPrice'            => false,
		'hideAmazon'           => false,
		'hideRakuten'          => false,
		'hideYahoo'            => false,
		'hideCustom'           => false,
		'hideCustom2'          => false,
		'btnLayoutPC'          => '',
		'btnLayoutSP'          => '',
		'isCount'              => false,
		'cvKey'                => '',
	], $pdata );

	$pid               = $pdata['pid'];
	$add_class         = $pdata['className'];
	$keywords          = $pdata['keywords'];
	$searched_at       = $pdata['searched_at'];
	$asin              = $pdata['asin'];
	$image_url         = $pdata['image_url'];
	$image_id          = $pdata['image_id'];
	$custom_btn_url    = $pdata['custom_btn_url'];
	$custom_btn_text   = $pdata['custom_btn_text'];
	$custom_btn_url_2  = $pdata['custom_btn_url_2'];
	$custom_btn_text_2 = $pdata['custom_btn_text_2'];

	$main_url    = '';
	$amazon_url  = '';
	$rakuten_url = '';
	$yahoo_url   = '';

	// もしも用aid
	$amazon_aid  = \POCHIPP::get_setting( 'moshimo_amazon_aid' );
	$rakuten_aid = \POCHIPP::get_setting( 'moshimo_rakuten_aid' );
	$yahoo_aid   = \POCHIPP::get_setting( 'moshimo_yahoo_aid' );

	// 価格を表示するかどうか
	$show_price = \POCHIPP::get_setting( 'display_price' ) !== 'off';
	if ( ! $show_price && $pdata['showPrice'] ) {
		$show_price = true;
	} elseif ( $show_price && $pdata['hidePrice'] ) {
		$show_price = false;
	}

	// AmazonボタンURL
	if ( apply_filters( 'pochipp_show_amazon_btn', ! $pdata['hideAmazon'], $pid ) ) {
		// $pdata['amazon_custom_url']
		$show_detail_url = $asin && ! $pdata['is_all_search_result'];
		$amazon_url      = $show_detail_url ? 'https://www.amazon.co.jp/dp/' . $asin : \POCHIPP::get_amazon_searched_url( $keywords );
		$amazon_url      = \POCHIPP::get_amazon_affi_url( $pdata['amazon_affi_url'], $amazon_url, $amazon_aid );
	}

	// 楽天ボタンURL
	if ( apply_filters( 'pochipp_show_rakuten_btn', ! $pdata['hideRakuten'], $pid ) ) {
		// $pdata['rakuten_custom_url']
		$show_detail_url = $pdata['rakuten_detail_url'] && ! $pdata['is_all_search_result'];
		$rakuten_url     = $show_detail_url ? $pdata['rakuten_detail_url'] : \POCHIPP::get_rakuten_searched_url( $keywords );
		$rakuten_url     = \POCHIPP::get_rakuten_affi_url( $rakuten_url, $rakuten_aid );
	}

	// YahooボタンURL
	if ( apply_filters( 'pochipp_show_yahoo_btn', ! $pdata['hideYahoo'], $pid ) ) {
		$show_detail_url = $pdata['yahoo_detail_url'] && ! $pdata['is_all_search_result'];
		$yahoo_url       = $show_detail_url ? $pdata['yahoo_detail_url'] : \POCHIPP::get_yahoo_searched_url( $keywords );
		$yahoo_url       = \POCHIPP::get_yahoo_affi_url( $yahoo_url, $yahoo_aid );
	}

	// カスタムボタン
	if ( ! apply_filters( 'pochipp_show_custom_btn', ! $pdata['hideCustom'], $pid ) ) {
		$custom_btn_url  = '';
		$custom_btn_text = '';
	}

	// カスタムボタン2
	if ( ! apply_filters( 'pochipp_show_custom_btn_2', ! $pdata['hideCustom2'], $pid ) ) {
		$custom_btn_url_2  = '';
		$custom_btn_text_2 = '';
	}

	// 画像とかタイトル部分のリンク先
	if ( 'rakuten' === $searched_at ) {
		$main_url = $rakuten_url ?: $amazon_url ?: $yahoo_url;
	} else {
		$main_url = $amazon_url ?: $rakuten_url ?: $yahoo_url;
	}

	// 商品画像
	$item_image = \POCHIPP::get_item_image( $image_id, $image_url, $searched_at );

	$is_blank = \POCHIPP::get_setting( 'show_amazon_normal_link' );
	if ( $is_blank ) {
		$rel_target = 'rel="nofollow noopener" target="_blank"';
	} else {
		$rel_target = 'rel="nofollow"';
	}

	$price_memo = $pdata['price_at'] . '時点';
	if ( 'rakuten' === $searched_at ) {
		$price_memo .= ' | 楽天市場調べ';
	} elseif ( 'amazon' === $searched_at ) {
		$price_memo .= ' | Amazon調べ';
	} elseif ( 'yahoo' === $searched_at ) {
		$price_memo .= ' | Yahooショッピング調べ';
	}

	// スタイル
	$btn_style = \POCHIPP::get_setting( 'btn_style' );
	if ( 'default' === $btn_style ) {
		$btn_style = 'dflt';
	}

	// class
	$box_class = 'pochipp-box';
	if ( $add_class ) {
		$box_class .= ' ' . $add_class;
	}

	// 追加属性
	$ex_props = '';
	if ( $pdata['isCount'] && $pdata['cvKey'] ) {
		$ex_props .= ' data-cvkey="' . esc_attr( $pdata['cvKey'] ) . '"';
	}
	if ( $pid && \POCHIPP::should_periodic_update( $pdata ) ) {
		$ex_props                .= ' data-auto-update="true"';
		\POCHIPP::$load_update_js = true;
	}

	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
		<div class="<?php echo esc_attr( $box_class ); ?>"
			data-id="<?php echo esc_attr( $pid ); ?>"
			data-img="<?php echo esc_attr( \POCHIPP::get_setting( 'img_position' ) ); ?>"
			data-lyt-pc="<?php echo esc_attr( \POCHIPP::get_setting( 'box_layout_pc' ) ); ?>"
			data-lyt-mb="<?php echo esc_attr( \POCHIPP::get_setting( 'box_layout_mb' ) ); ?>"
			data-btn-style="<?php echo esc_attr( $btn_style ); ?>"
			data-btn-radius="<?php echo esc_attr( \POCHIPP::get_setting( 'btn_radius' ) ); ?>"
			data-sale-effect="<?php echo esc_attr( \POCHIPP::get_setting( 'sale_text_effect' ) ); ?>"
			<?php echo $ex_props; ?>
		>
			<?php if ( $item_image ) : ?>
				<div class="pochipp-box__image">
					<a href="<?php echo esc_url( $main_url ); ?>" <?php echo $rel_target; ?>>
						<?php echo $item_image; // ignore:phpcs ?>
					</a>
				</div>
			<?php endif; ?>
			<div class="pochipp-box__body">
				<div class="pochipp-box__title">
					<a href="<?php echo esc_url( $main_url ); ?>" <?php echo $rel_target; ?>>
						<?php echo esc_html( $title ); ?>
					</a>
				</div>

				<?php if ( ! $pdata['hideInfo'] && $pdata['info'] ) : ?>
					<div class="pochipp-box__info"><?php echo esc_html( $pdata['info'] ); ?></div>
				<?php endif; ?>

				<?php if ( $show_price && $pdata['price'] ) : ?>
					<div class="pochipp-box__price">
						¥<?php echo esc_html( number_format( (int) $pdata['price'] ) ); ?>
						<span>（<?php echo esc_html( $price_memo ); ?>）</span>
					</div>
				<?php endif; ?>
			</div>
			<?php
				\POCHIPP\render_pochipp_btns([
					'amazon_url'        => $amazon_url,
					'rakuten_url'       => $rakuten_url,
					'yahoo_url'         => $yahoo_url,
					'amazon_sale_text'  => apply_filters( 'pochipp_amazon_sale_text', '', $pid ),
					'rakuten_sale_text' => apply_filters( 'pochipp_rakuten_sale_text', '', $pid ),
					'yahoo_sale_text'   => apply_filters( 'pochipp_yahoo_sale_text', '', $pid ),
					'amazon_aid'        => $amazon_aid,
					'rakuten_aid'       => $rakuten_aid,
					'yahoo_aid'         => $yahoo_aid,
					'is_paypay'         => $pdata['is_paypay'],
					'custom_btn_url'    => $custom_btn_url,
					'custom_btn_text'   => $custom_btn_text,
					'custom_btn_url_2'  => $custom_btn_url_2,
					'custom_btn_text_2' => $custom_btn_text_2,
					'rel_target'        => $rel_target,
					'btn_layout_pc'     => $pdata['btnLayoutPC'],
					'btn_layout_sp'     => $pdata['btnLayoutSP'],
				]);
			?>
			<?php if ( apply_filters( 'pochipp_show_box_logo', 1 ) ) : ?>
				<div class="pochipp-box__logo">
					<img src="<?php echo esc_url( POCHIPP_URL ); ?>assets/img/pochipp-logo-t1.png" alt="" width="32" height="32">
					<span>ポチップ</span>
				</div>
			<?php endif; ?>
		</div>
	<?php
	// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
}


function render_pochipp_btns( $btn_data = [], $is_preview = false ) {

	$amazon_url        = $btn_data['amazon_url'] ?? '';
	$rakuten_url       = $btn_data['rakuten_url'] ?? '';
	$yahoo_url         = $btn_data['yahoo_url'] ?? '';
	$rel_target        = $btn_data['rel_target'] ?? '';
	$amazon_aid        = $btn_data['amazon_aid'] ?? '';
	$rakuten_aid       = $btn_data['rakuten_aid'] ?? '';
	$yahoo_aid         = $btn_data['yahoo_aid'] ?? '';
	$is_paypay         = $btn_data['is_paypay'] ?? '';
	$custom_btn_url    = $btn_data['custom_btn_url'] ?? '';
	$custom_btn_text   = $btn_data['custom_btn_text'] ?? '';
	$custom_btn_url_2  = $btn_data['custom_btn_url_2'] ?? '';
	$custom_btn_text_2 = $btn_data['custom_btn_text_2'] ?? '';

	// セール通知テキスト
	$amazon_sale_text  = $btn_data['amazon_sale_text'] ?? '';
	$rakuten_sale_text = $btn_data['rakuten_sale_text'] ?? '';
	$yahoo_sale_text   = $btn_data['yahoo_sale_text'] ?? '';

	$btn_layout_pc = $btn_data['btn_layout_pc'] ?: \POCHIPP::get_setting( 'max_column_pc' );
	$btn_layout_sp = $btn_data['btn_layout_sp'] ?: \POCHIPP::get_setting( 'max_column_mb' );

	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
	<div class="pochipp-box__btns"
		data-maxclmn-pc="<?php echo esc_attr( $btn_layout_pc ); ?>"
		data-maxclmn-mb="<?php echo esc_attr( $btn_layout_sp ); ?>"
	>
		<?php if ( $amazon_url ) : ?>
			<div class="pochipp-box__btnwrap -amazon<?php if ($amazon_sale_text) echo ' -on-sale'; ?>">
				<?php if ( $amazon_sale_text ) : ?>
					<div class="pochipp-box__saleInfo -top">＼<?php echo esc_html( $amazon_sale_text ); ?>／</div>
				<?php endif; ?>
				<a href="<?php echo esc_url( $amazon_url ); ?>" class="pochipp-box__btn" <?php echo $rel_target; ?>>
					<span>
						<?php echo esc_html( \POCHIPP::get_setting( 'amazon_btn_text' ) ); ?>
					</span>
					<?php echo \POCHIPP::get_amazon_imptag( $amazon_aid ); ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( $rakuten_url ) : ?>
			<div class="pochipp-box__btnwrap -rakuten<?php if ($rakuten_sale_text) echo ' -on-sale'; ?>">
				<?php if ( $rakuten_sale_text ) : ?>
					<div class="pochipp-box__saleInfo -top">＼<?php echo esc_html( $rakuten_sale_text ); ?>／</div>
				<?php endif; ?>
				<a href="<?php echo esc_url( $rakuten_url ); ?>" class="pochipp-box__btn" <?php echo $rel_target; ?>>
					<span>
						<?php echo esc_html( \POCHIPP::get_setting( 'rakuten_btn_text' ) ); ?>
					</span>
					<?php echo \POCHIPP::get_rakuten_imptag( $rakuten_aid ); ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( $yahoo_url ) : ?>
			<?php
				// yahooは文字列の長さに注意する
				$yahoo_text = ( $is_paypay ) ? \POCHIPP::get_setting( 'paypay_btn_text' ) : \POCHIPP::get_setting( 'yahoo_btn_text' );
				$length     = mb_strwidth( $yahoo_text, 'UTF-8' );

				$add_class                          = $is_paypay ? '-paypay' : '-yahoo';
				if ( 14 < $length )  $add_class    .= ' -long-text';
				if ( $yahoo_sale_text ) $add_class .= ' -on-sale';
			?>
			<div class="pochipp-box__btnwrap <?php echo $add_class; ?>">
				<?php if ( $yahoo_sale_text ) : ?>
					<div class="pochipp-box__saleInfo -top">＼<?php echo esc_html( $yahoo_sale_text ); ?>／</div>
				<?php endif; ?>
				<a href="<?php echo esc_url( $yahoo_url ); ?>" class="pochipp-box__btn" <?php echo $rel_target; ?>>
					<span>
						<?php echo esc_html( $yahoo_text ); ?>
					</span>
					<?php echo \POCHIPP::get_yahoo_imptag( $yahoo_aid ); ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( $custom_btn_url && $custom_btn_text ) : ?>
			<?php
				// カスタムボタンも文字列の長さに注意する
				$length = mb_strwidth( $custom_btn_text, 'UTF-8' );
			?>
			<div class="pochipp-box__btnwrap -custom<?php if (14 < $length) echo ' -long-text'; ?>">
				<a href="<?php echo esc_url( $custom_btn_url ); ?>" class="pochipp-box__btn" <?php echo $rel_target; ?>>
					<span>
						<?php echo esc_html( $custom_btn_text ); ?>
					</span>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( $custom_btn_url_2 && $custom_btn_text_2 ) : ?>
			<?php
				// カスタムボタンも文字列の長さに注意する
				$length = mb_strwidth( $custom_btn_text_2, 'UTF-8' );
			?>
			<div class="pochipp-box__btnwrap -custom_2<?php if (14 < $length) echo ' -long-text'; ?>">
				<a href="<?php echo esc_url( $custom_btn_url_2 ); ?>" class="pochipp-box__btn" <?php echo $rel_target; ?>>
					<span>
						<?php echo esc_html( $custom_btn_text_2 ); ?>
					</span>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<?php
	// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
}
