<?php

namespace SkyBetTechTest\Controller;

use SkyBetTechTest\Database;

abstract class JSONController {

	protected $response;
	protected $db;

	public function __construct( Database $database ) {
		$this->db = $database;
	}

	abstract function run();

	/**
	 * Output the required information or feedback message.
	 */
	public function render() {
		header('Content-Type: application/json');
		echo json_encode( $this->response );
	}
}