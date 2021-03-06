<?php
/**
 * HTTP redirects output for HTTP headers.
 *
 * @package query-monitor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class QM_Output_Headers_Redirects extends QM_Output_Headers {

	/**
	 * Collector instance.
	 *
	 * @var QM_Collector_Redirects Collector.
	 */
	protected $collector;

	/**
	 * @return array<string, mixed>
	 */
	public function get_output() {

		$data = $this->collector->get_data();
		$headers = array();

		if ( empty( $data['trace'] ) ) {
			return array();
		}

		$headers['Redirect-Trace'] = implode( ', ', $data['trace']->get_stack() );
		return $headers;

	}

}

/**
 * @param array<string, QM_Output> $output
 * @param QM_Collectors $collectors
 * @return array<string, QM_Output>
 */
function register_qm_output_headers_redirects( array $output, QM_Collectors $collectors ) {
	$collector = QM_Collectors::get( 'redirects' );
	if ( $collector ) {
		$output['redirects'] = new QM_Output_Headers_Redirects( $collector );
	}
	return $output;
}

add_filter( 'qm/outputter/headers', 'register_qm_output_headers_redirects', 140, 2 );
