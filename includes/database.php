<?php

namespace SBTechTest;

class Database {

	private $last_result = null;
	private $last_id = null;
	private $last_error = null;

	public function __construct($root_directory) {
		$this->root_directory = $root_directory;
	}

	public function fetchAll( $table ) {
		$this->last_error  = null;

		$data =  file_get_contents( $this->root_directory . '/' . $table . '.json' );
		$this->last_result = json_decode($data, true);
	}
}