<?php
/**
 * Name: Left sidebar
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.4.0
 */

use Framework\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true" data-scrolled="false">
<?php Helper::get_template_part( 'template-parts/common/head' ); ?>

<body <?php body_class( [ 'l-body--left-sidebar' ] ); ?> id="body"
	data-has-sidebar="true"
	data-is-full-template="false"
	data-is-slim-width="true"
	data-header-layout="<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>"
	data-infobar-position="<?php echo esc_attr( get_theme_mod( 'infobar-position' ) ); ?>"
	ontouchstart=""
	>

	<?php wp_body_open(); ?>
	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<?php
	if ( has_nav_menu( 'drawer-nav' ) || has_nav_menu( 'drawer-sub-nav' ) ) {
		Helper::get_template_part( 'template-parts/nav/drawer' );
	}
	?>

	<div class="l-container">
		<?php Helper::get_header(); ?>

		<div class="l-contents" role="document">
			<?php do_action( 'snow_monkey_prepend_contents' ); ?>

			<?php
			if ( get_theme_mod( 'header-content' ) ) {
				Helper::get_template_part( 'template-parts/header/content', 'sm' );
			}
			?>

			<?php if ( get_theme_mod( 'infobar-content' ) ) : ?>
				<div class="p-infobar-wrapper p-infobar-wrapper--header-bottom">
					<?php
					Helper::get_template_part(
						'template-parts/common/infobar',
						null,
						[
							'_content' => get_theme_mod( 'infobar-content' ),
							'_url'     => get_theme_mod( 'infobar-url' ),
							'_target'  => get_theme_mod( 'infobar-link-target' ),
							'_align'   => get_theme_mod( 'infobar-align' ),
						]
					);
					?>
				</div>
			<?php endif; ?>

			<?php
			if ( Helper::display_page_header() ) {
				$vars = [
					'_display_entry_meta' => is_singular( 'post' ),
				];
				Helper::get_template_part( 'template-parts/common/page-header', null, $vars );
			}
			?>

			<div class="l-contents__body">
				<div class="l-contents__container c-container">
					<?php
					if (
						! is_front_page()
						&& in_array( get_theme_mod( 'breadcrumbs-position' ), [ 'default', 'content-width' ], true )
					) {
						Helper::get_template_part( 'template-parts/common/breadcrumbs' );
					}
					?>

					<?php do_action( 'snow_monkey_before_contents_inner' ); ?>

					<div class="l-contents__inner">
						<main class="l-contents__main" role="main">
							<?php do_action( 'snow_monkey_prepend_main' ); ?>

							<?php
							// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
							$args['_view_controller']->view();
							// phpcs:enable
							?>

							<?php do_action( 'snow_monkey_append_main' ); ?>
						</main>

						<aside class="l-contents__sidebar" role="complementary">
							<?php do_action( 'snow_monkey_prepend_sidebar' ); ?>

							<?php Helper::get_sidebar(); ?>

							<?php do_action( 'snow_monkey_append_sidebar' ); ?>
						</aside>
					</div>

					<?php do_action( 'snow_monkey_after_contents_inner' ); ?>

					<?php
					if (
						! is_front_page()
						&& in_array( get_theme_mod( 'breadcrumbs-position' ), [ 'bottom', 'bottom-content-width' ], true )
					) {
						Helper::get_template_part( 'template-parts/common/breadcrumbs' );
					}
					?>
				</div>
			</div>

			<?php do_action( 'snow_monkey_append_contents' ); ?>
		</div>

		<?php Helper::get_footer(); ?>

		<?php
		if ( get_theme_mod( 'display-page-top' ) ) {
			Helper::get_template_part( 'template-parts/common/page-top' );
		}
		?>

		<?php
		if ( has_nav_menu( 'footer-sticky-nav' ) ) {
			Helper::get_template_part( 'template-parts/nav/footer-sticky' );
		}
		?>
	</div>

<?php wp_footer(); ?>
</body>
</html>
