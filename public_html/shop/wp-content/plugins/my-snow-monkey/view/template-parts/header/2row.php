<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.9.0
 *
 * renamed: template-parts/2row-header.php
 */

use Framework\Helper;

$header_content         = get_theme_mod( 'header-content' );
$header_type            = get_theme_mod( 'header-layout' ) . '-header';
$header_alignfull       = get_theme_mod( 'header-alignfull' );
$has_global_nav         = has_nav_menu( 'global-nav' );
$has_drawer_nav         = has_nav_menu( 'drawer-nav' ) || has_nav_menu( 'drawer-sub-nav' );
$has_header_sub_nav     = has_nav_menu( 'header-sub-nav' );
$data_has_global_nav    = $has_global_nav ? 'true' : 'false';
$container_class        = $header_alignfull ? 'c-fluid-container' : 'c-container';
$hamburger_btn_position = get_theme_mod( 'hamburger-btn-position' );
?>

<div class="l-<?php echo esc_attr( $header_type ); ?>" data-has-global-nav="<?php echo esc_attr( $data_has_global_nav ); ?>">
	<div class="<?php echo esc_attr( $container_class ); ?>">

    <?php /*
		<div class="l-<?php echo esc_attr( $header_type ); ?>__row">
			<div class="c-row c-row--margin-s c-row--lg-margin c-row--middle c-row--nowrap">
				<?php if ( $has_drawer_nav && 'left' === $hamburger_btn_position ) : ?>
				<div class="c-row__col c-row__col--fit u-invisible-lg-up">
					<?php
						Helper::get_template_part(
							'template-parts/header/hamburger-btn',
							null,
							[
								'_id' => false,
							]
						);
						?>
				</div>
				<?php endif; ?>
			</div>
		</div>
    */ ?>

		<!-- スマホ/タブレット 用 -->
		<div class="c-row u-invisible-lg-up ec-header-navi-sp">
			<div class="ec-header-navi-sp__logo">
				<a href="<?php echo ec_url(); ?>">
					<img src="<?php echo ec_asset_url(); ?>/img/common/logo_sp.png" width="80">
				</a>
			</div>
			<!-- <div class="ec-header-navi-sp__login">
				{% if is_granted('ROLE_USER') %}
					<a href="{{ url('logout') }}">
						<img src="{{ asset('assets/img/common/icon_login_sp.png') }}" width="25">
					</a>
				{% else %}
					<a href="{{ url('mypage_login') }}">
						<img src="{{ asset('assets/img/common/icon_login_sp.png') }}" width="25">
					</a>
				{% endif %}
			</div>
			<div class="ec-header-navi-sp__cart">
				<div class="ec-headerRole__cart">
						{{ include('Block/cart.twig') }}
				</div>
			</div> -->
			<div class="ec-header-navi-sp__store">
				<a href="<?php echo ec_url(); ?>">
					<p><span class="small">ONLINE</span><span class="large">SHOP</span></p>
					<img src="<?php echo ec_asset_url(); ?>/img/common/icon_online_store.png" width="32">
				</a>
			</div>
			<div class="ec-header-navi-sp__btn">
				<div class="ec-header-sp-btn">
					<div class="ec-header-sp-btn__text">
						<span>MENU</span>
					</div>
					<div class="ec-header-sp-btn__bars">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>

		<!-- PC 用 -->
    <div class="c-row p-custom-header u-invisible-md-down">
      <div class="ec-header-bottom">
        <div class="ec-header-bottom__logo">
          <p class="ec-header-bottom__img">
            <a href="<?php echo ec_url(); ?>">
              <img src="<?php echo ec_asset_url(); ?>/img/common/logo_header.png">
            </a>
          </p>
        </div>
        <div class="ec-header-bottom__center">
          <div class="ec-header-bottom__gnav">
            <ul class="p-global-navi">
              <li class="p-global-navi__item">
                <a href="<?php echo esc_url(home_url('/news/')); ?>">NEWS</a>
              </li>
              <li class="p-global-navi__item has-child">
                <a href="<?php echo esc_url(home_url('/story/')); ?>">STORY</a>
                <span class="p-global-navi__jp">製品の誕生ものがたり</span>
                <ul class="p-global-navi-child">
                  <li class="p-global-navi-child__item">
                    <a href="">- ICE CREAM</a>
                  </li>
                  <li class="p-global-navi-child__item">
                    <a href="">- COFFEE</a>
                  </li>
                  <li class="p-global-navi-child__item">
                    <a href="">- BREAD</a>
                  </li>
                </ul>
              </li>
              <li class="p-global-navi__item has-child">
                <a href="<?php echo esc_url(home_url('/concept/')); ?>">CONCEPT</a>
                <span class="p-global-navi__jp">製品のこだわり</span>
                <ul class="p-global-navi-child">
                  <li class="p-global-navi-child__item">
                    <a href="">- ICE CREAM</a>
                  </li>
                  <li class="p-global-navi-child__item">
                    <a href="">- COFFEE</a>
                  </li>
                  <li class="p-global-navi-child__item">
                    <a href="">- BREAD</a>
                  </li>
                </ul>
              </li>
              <li class="p-global-navi__item has-child">
                <a href="<?php echo esc_url(home_url('/products-list/')); ?>">PRODUCTS</a>
                <span class="p-global-navi__jp">商品ラインアップ</span>
                <ul class="p-global-navi-child">
                  <li class="p-global-navi-child__item">
                    <a href="">- ICE CREAM</a>
                  </li>
                  <li class="p-global-navi-child__item">
                    <a href="">- COFFEE</a>
                  </li>
                  <li class="p-global-navi-child__item">
                    <a href="">- BREAD</a>
                  </li>
                </ul>
              </li>
              <li class="p-global-navi__item">
                <a href="<?php echo ec_url(); ?>/company">ABOUT US</a>
              </li>
              <li class="p-global-navi__item">
                <a href="<?php echo esc_url(home_url('/stores/')); ?>">STORE</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="ec-header-bottom__right">
          <div class="ec-header-bottom__store-link">
            <a href="<?php echo ec_url(); ?>/products/list">
              <img src="<?php echo ec_asset_url(); ?>/img/common/icon_store.png" alt="" width="34">
              <span>ONLINE SHOP</span>
            </a>
          </div>
        </div>
          <?php /* <div class="ec-headerNaviRoleTop__btn">
            <a href="">
              <img src="<?php echo ec_asset_url(); ?>/img/common/icon_store.png" width="28" height="28">
              ONLINE SHOP
            </a>
          </div>
        </div> */ ?>
      </div>
    </div>

		<?php /* if ( $has_global_nav ) : ?>
			<div class="l-<?php echo esc_attr( $header_type ); ?>__row u-invisible-md-down p-global-nav-wrap">
				<?php
				Helper::get_template_part(
					'template-parts/nav/global',
					null,
					[
						'_vertical'          => false,
						'_gnav-hover-effect' => get_theme_mod( 'gnav-hover-effect' ),
					]
				);
				?>
			</div>
		<?php endif; */ ?>
	</div>
</div>

<?php /* if ( ! is_front_page() ) : ?>

<?php
$page_header = Helper::get_page_header_class();

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title'                 => $page_header::get_title(),
		'_image'                 => $page_header::get_image(),
		'_align'                 => $page_header::get_align(),
		'_display_entry_meta'    => false,
		'_display_image_caption' => false,
	]
);

// Migrate from less than v11.5 to more than v11.5
if ( isset( $args['_page_header_title'] ) ) {
	$args['_title'] = $args['_page_header_title'];
}
if ( isset( $args['_page_header_image'] ) ) {
	$args['_image'] = $args['_page_header_image'];
}
if ( isset( $args['_is_output_page_header_title'] ) ) {
	$args['_title'] = $args['_is_output_page_header_title']
		? Helper::get_page_title_from_breadcrumbs()
		: false;
}
?>

<div
	class="c-page-header"
	data-align="<?php echo esc_attr( $args['_align'] ); ?>"
	data-has-content="<?php echo esc_attr( $args['_title'] ? 'true' : 'false' ); ?>"
	data-has-image="<?php echo esc_attr( $args['_image'] ? 'true' : 'false' ); ?>"
	>

	<?php if ( $args['_image'] ) : ?>
		<div class="c-page-header__bgimage">
			<?php
			echo wp_kses(
				$args['_image'],
				[
					'img' => Helper::img_allowed_attributes(),
				]
			);
			?>

			<?php if ( $args['_display_image_caption'] ) : ?>
				<?php
				$image_caption = $page_header::get_image_caption();
				?>
				<?php if ( $image_caption ) : ?>
					<div class="c-page-header__bgimage-caption">
						<div class="c-container">
							<?php echo wp_kses_post( $image_caption ); ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

  <div class="c-container">
    <div class="c-page-header__content">
      <h1 class="c-page-header__title">
        <img src="https://taniguchijidousha.com/wp-content/uploads/logo_page-header.svg" alt="TANIGUCHI MOTOR" width="248">
      </h1>
    </div>
  </div>
</div>

<div class="p-global-nav-wrap u-invisible-md-down" data-has-global-nav="<?php echo esc_attr( $data_has_global_nav ); ?>">
	<div class="<?php echo esc_attr( $container_class ); ?>">

		<?php if ( $has_global_nav ) : ?>
		<div class="p-global-nav__inner">
			<?php
				Helper::get_template_part(
					'template-parts/nav/global',
					null,
					[
						'_vertical'          => false,
						'_gnav-hover-effect' => get_theme_mod( 'gnav-hover-effect' ),
					]
				);
				?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; */ ?>
