<?php

namespace SkyBetTechTest;

class FailureResponse {

	/**
	 * Failure response returned to anybody without an matching path.
	 */
	public function setData( $parameters ) {

		$this->response = array(
			'status'    => 'error',
		);

		if ( isset( $parameters['code'] ) ) {
		     $this->response['code'] = $parameters['code'];
		}

		if ( isset( $parameters['message'] ) ) {
			$this->response['message'] = $parameters['message'];
		}
	}

	/**
	 * Output the required information or feedback message.
	 */
	public function render() {
		header('Content-Type: application/json');
		echo json_encode( $this->response );
	}
}