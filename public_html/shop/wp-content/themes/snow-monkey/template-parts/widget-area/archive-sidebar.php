<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/archive-sidebar-widget-area.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'archive-sidebar-widget-area' ) ) {
	return;
}
?>

<div class="l-sidebar-widget-area"
	data-is-slim-widget-area="true"
	data-is-content-widget-area="false"
	>

	<?php dynamic_sidebar( 'archive-sidebar-widget-area' ); ?>
</div>
