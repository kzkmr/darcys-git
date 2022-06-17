<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$terms = Helper::get_terms(
	[
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	]
);

foreach ( $terms as $_term ) {
	Framework::section(
		'design-' . $_term->taxonomy . '-' . $_term->term_id,
		[
			'title'           => sprintf(
				/* translators: 1: Tag name */
				__( '[ %1$s ] WooCommerce products category settings', 'snow-monkey' ),
				$_term->name
			),
			'priority'        => 131,
			'active_callback' => function() use ( $_term ) {
				if ( ! class_exists( '\woocommerce' ) ) {
					return false;
				}
				return is_product_category( $_term->name );
			},
		]
	);
}
