<?php

namespace SkyBetTechTest;

use SkyBetTechTest\Controller\FailureResponseController;
use SkyBetTechTest\Controller\JSONController;
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
	protected $method;
	protected $postData = null;

	public function __construct( $parameters ) {
		$this->db = $parameters['database'];
		$this->method = $parameters['method'];

		if ( isset( $parameters['postdata'] ) ) {
			$this->postData = $parameters['postdata'];
		}

		$this->request_uri = $parameters['uri'];

		$this->parse_endpoint();
	}

	/**
	 * Determine which endpoint the client is calling based on the uri.
	 */
	protected function parse_endpoint() {

		$parts = explode( DIRECTORY_SEPARATOR, $this->request_uri );

		if ( isset( $parts[1] ) ) {
			$this->endpoint = $parts[1];
		}
	}

	/**
	 * Runs the required service based on the endpoint requested.
	 */
	public function run() {

		if ( ! in_array( $this->method, array('GET', 'POST') ) ) {
			$this->response = new FailureResponse( 'invalid-method', 'Invalid HTTP Method.' );
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
				$controller = new PunditUpdateController( $this->db, $this->postData );
				break;

			case 'delete':
				$controller = new PunditDeleteController( $this->db, $this->postData );
				break;

			case 'create':
				$controller = new PunditCreateController( $this->db, $this->postData );
				break;

			default:
				$controller = null;
				$message = 'This request was invalid please check your things.';
				$this->response = new FailureResponse( 'invalid-request', $message );

		}

		if ( $controller instanceof JSONController ) {
			$controller->run();
			$this->response = $controller->getResponse();
		}
	}

	public function getResponse() {
		if ( $this->response instanceof FailureResponse ){
			return $this->response->getResponse();
		}

		return $this->response;
	}

	public function getJSONResponse() {
		return json_encode( $this->getResponse() );
	}
}