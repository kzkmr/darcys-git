<?php
/**
 * @package snow-monkey-blocks
 * @author inc2734
 * @license GPL-2.0+
 */

wp_register_style(
	'snow-monkey-blocks/media-text',
	SNOW_MONKEY_BLOCKS_DIR_URL . '/dist/block/media-text/style.css',
	[],
	filemtime( SNOW_MONKEY_BLOCKS_DIR_PATH . '/dist/block/media-text/style.css' )
);

register_block_type(
	__DIR__
);

/**
 * excerpt_allowed_blocks
 */
add_filter(
	'excerpt_allowed_blocks',
	function( $allowed_blocks ) {
		return array_merge(
			$allowed_blocks,
			[
				'snow-monkey-blocks/media-text',
			]
		);
	}
);
