<?php
/**
 * Name: Simple
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.8.2
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
	<?php
	if ( get_theme_mod( 'infobar-content' ) ) {
		Helper::get_template_part(
			'template-parts/common/infobar',
			null,
			[
				'_content' => get_theme_mod( 'infobar-content' ),
				'_url'     => get_theme_mod( 'infobar-url' ),
				'_align'   => get_theme_mod( 'infobar-align' ),
			]
		);
	}
	?>

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
