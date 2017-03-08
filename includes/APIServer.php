<?php

namespace SkyBetTechTest;

use SkyBetTechTest\Controller\PunditCreateController;
use SkyBetTechTest\Controller\PunditDeleteController;
use SkyBetTechTest\Controller\PunditListController;
use SkyBetTechTest\Controller\PunditResetController;
use SkyBetTechTest\Controller\PunditUpdateController;

class APIServer {

	protected $request_uri;
	protected $response;
	protected $endpoint = false;
	protected $db;

	public function __construct( $request_uri, $database ) {
		$this->request_uri = $request_uri;
		$this->db = $database;

		$this->parse_endpoint();
	}

	/**
	 * Determine which endpoint the client is calling based on the uri.
	 */
	protected function parse_endpoint() {

		$parts = explode( '/', $this->request_uri );

		if ( isset( $parts[1] ) ) {
			$this->endpoint = $parts[1];
		}
	}











	/**
	 * Failure response returned to anybody without an matching path.
	 */
	protected function failure_response() {
		$this->response = array(
			'status'    => 'error',
			'code'      => 'invalid-request',
			'message'   => 'This request was invalid please check your things.'
		);
	}

	/**
	 * Runs the required service based on the endpoint requested.
	 */
	public function run() {

		if ( ! in_array( $_SERVER['REQUEST_METHOD'], array('GET', 'POST') ) ) {
			$this->response = array(
				'status'    => 'error',
				'code'      => 'invalid-method',
				'message'   => 'Invalid HTTP Method.'
			);
			return;
		}

		switch ( $this->endpoint ) {

			case 'list':
				$controller = new PunditListController( $this->db );
				break;

			case 'reset':
				$controller = new PunditResetController( $this->db );
				break;

			case 'update':
				$controller = new PunditUpdateController( $this->db );
				break;

			case 'delete':
				$controller = new PunditDeleteController( $this->db );
				break;

			case 'create':
				$controller = new PunditCreateController( $this->db );
				break;

			default:
				$this->failure_response();
		}

		$controller->run();
		$controller->render();
	}
}