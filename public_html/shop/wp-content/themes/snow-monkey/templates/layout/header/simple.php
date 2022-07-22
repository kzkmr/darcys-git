<?php
/**
 * Name: Simple
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.4.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title_tag' => 'div',
	]
);

$classes = Helper::get_header_classes();
?>

<header class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" role="banner">
	<?php if ( get_theme_mod( 'infobar-content' ) ) : ?>
		<div class="p-infobar-wrapper p-infobar-wrapper--header-top">
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

	<div class="l-header__content">
		<?php
		Helper::get_template_part(
			'template-parts/header/simple',
			null,
			[
				'_title_tag' => $args['_title_tag'],
			]
		);
		?>
	</div>
</header>
