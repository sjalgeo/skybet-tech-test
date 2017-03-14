<?php

namespace SkyBetTechTest;

class FailureResponse {

	protected $response;

	/**
	 * Failure response returned to anybody without an matching path.
	 */
	public function __construct( $code, $message = null ) {
		$this->response = array(
			'status'    => 'error',
			'code'      => $code,
			'message'   => $message
		);
	}

	public function setCommand( $command ) {
		$this->response['command'] = $command;
	}

	public function getErrorCode() {
		return $this->response['code'];
	}

	public function getResponse() {
		return $this->response;
	}

	/**
	 * Output the required information or feedback message.
	 */
	public function render() {
		header('Content-Type: application/json');
		echo json_encode( $this->response );
	}
}