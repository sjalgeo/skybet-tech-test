<?php

namespace SkyBetTechTest\Controller;

use SkyBetTechTest\Database;

abstract class JSONController {

	protected $response;
	protected $db;

	public function __construct( Database $database, $postData = array() ) {
		$this->db = $database;
		$this->postData = $postData;
	}

	abstract function run();

	/**
	 * Output the required information or feedback message.
	 */
	public function getResponse() {
		return $this->response;
	}
}