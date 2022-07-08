<?php
namespace FileBird\Classes;

defined( 'ABSPATH' ) || exit;

class Schedule {
	public function __construct() {
		add_action( 'filebird_remove_zip_files', array( $this, 'actionRemoveZipFiles' ) );
	}

	public static function registerSchedule() {
		if ( ! wp_next_scheduled( 'filebird_remove_zip_files' ) ) {
			wp_schedule_event( time(), 'daily', 'filebird_remove_zip_files' );
		}
	}

	public static function clearSchedule() {
		wp_clear_scheduled_hook( 'filebird_remove_zip_files' );
	}

	public function actionRemoveZipFiles() {
		$root_folder   = NJFB_UPLOAD_DIR;
		$upload_folder = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . $root_folder . DIRECTORY_SEPARATOR;
		$files         = scandir( $upload_folder );
		foreach ( $files as $k => $file ) {
			$created_at = filemtime( $upload_folder . $file );
			if ( ( time() - $created_at ) >= ( 24 * 60 * 60 ) ) {
				unlink( $upload_folder . $file );
			}
		}
	}
}
