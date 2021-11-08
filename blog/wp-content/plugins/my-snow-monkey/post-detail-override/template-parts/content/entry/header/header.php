<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_title_top_widget_area' => false,
		'_display_entry_meta'            => false,
	]
);
?>

<header class="c-entry__header">
	<div class="wp-block-snow-monkey-blocks-container smb-container c-container p-page-header p-page-header--red">
		<div class="smb-container__body">
			<h2>施工例</h2>
			<p>WORKS</p>
		</div>
	</div>

	<?php if ( $args['_display_entry_meta'] ) : ?>
		<div class="c-entry__meta">
			<?php
			Helper::get_template_part(
				'template-parts/content/entry-meta',
				$args['_name']
			);
			?>
		</div>
	<?php endif; ?>
</header>
