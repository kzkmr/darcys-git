<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.2
 */

if ( ! defined( 'SNOW_MONKEY_MEGA_MENU_PATH' ) ) {
	return;
}

/**
 * Output CSS in head
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'output-head-style' ) ) {
			return;
		}

		add_filter(
			'inc2734_wp_page_speed_optimization_output_head_styles',
			function( $handles ) {
				return array_merge(
					$handles,
					[
						'snow-monkey-mega-menu',
					]
				);
			}
		);
	}
);
