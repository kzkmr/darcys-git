<?php

namespace WPForms\SmartTags\SmartTag;

use WP_User;

/**
 * Class UserFirstName.
 *
 * @since 1.6.7
 */
class UserFirstName extends SmartTag {

	/**
	 * Get smart tag value.
	 *
	 * @since 1.6.7
	 *
	 * @param array  $form_data Form data.
	 * @param array  $fields    List of fields.
	 * @param string $entry_id  Entry ID.
	 *
	 * @return string
	 */
	public function get_value( $form_data, $fields = [], $entry_id = '' ) {

		$current_user = wp_get_current_user();

		if ( ! $current_user instanceof WP_User ) {
			return '';
		}

		return $current_user->exists() ? esc_html( wp_strip_all_tags( $current_user->user_firstname ) ) : '';
	}
}
