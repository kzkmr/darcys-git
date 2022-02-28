<?php
/**
 * @package snow-monkey-blocks
 * @author inc2734
 * @license GPL-2.0+
 */

wp_register_style(
	'snow-monkey-blocks/list',
	SNOW_MONKEY_BLOCKS_DIR_URL . '/dist/block/list/style.css',
	[],
	filemtime( SNOW_MONKEY_BLOCKS_DIR_PATH . '/dist/block/list/style.css' )
);

wp_register_style(
	'snow-monkey-blocks/list/editor',
	SNOW_MONKEY_BLOCKS_DIR_URL . '/dist/block/list/editor.css',
	[],
	filemtime( SNOW_MONKEY_BLOCKS_DIR_PATH . '/dist/block/list/editor.css' )
);

wp_register_script(
	'snow-monkey-blocks/list',
	SNOW_MONKEY_BLOCKS_DIR_URL . '/dist/block/list/script.js',
	[],
	filemtime( SNOW_MONKEY_BLOCKS_DIR_PATH . '/dist/block/list/script.js' ),
	true
);

register_block_type(
	__DIR__,
	[
		'script' => ! is_admin() ? 'snow-monkey-blocks/list' : null,
	]
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
				'snow-monkey-blocks/lsit',
			]
		);
	}
);
