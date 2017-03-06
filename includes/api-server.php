<?php

namespace SBTechTest;

use SBTechTest\Endpoint\Pundit_List_Endpoint;

class API_Server {

	protected $request_uri;
	protected $response;
	protected $endpoint = false;

	public function __construct( $request_uri, $root_directory ) {
		$this->request_uri = $request_uri;
		$this->root_directory = $root_directory;
		$this->db = new Database( $this->root_directory );

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
	 * List all pundits from database.
	 */
	protected function pundits_list() {
		$this->db->fetchAll('pundits');
		$this->response = array(
			'status' => 'success',
			'data' => $this->db->get_last_result()
		);
	}

	/**
	 * Resets the database to its initial values.
	 */
	protected function pundits_reset() {
		$this->db->reset();

		$this->response = array(
			'status'    => 'success'
		);
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
				$this->pundits_list();
				break;

			case 'reset':
				$this->pundits_reset();
				break;

			default:
				$this->failure_response();
		}

		$this->output();
	}

	/**
	 * Output the required information or feedback message.
	 */
	public function output() {
		header('Content-Type: application/json');
		echo json_encode( $this->response );
		exit;
	}
}