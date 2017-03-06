<?php

namespace SBTechTest;

class Database {

	private $last_result = null;
	private $last_id = null;
	private $last_error = null;

	public function __construct($root_directory) {
		$this->root_directory = $root_directory;
	}

	/**
	 * @param $table - The name of the flat file database table.
	 */
	public function fetchAll( $table ) {
		$this->last_error  = null;

		$data =  file_get_contents( $this->root_directory . '/' . $table . '.json' );
		$this->last_result = json_decode($data, true);
	}

	/**
	 * @return The last piece of data fetch from the database.
	 */
	public function get_last_result() {
		return $this->last_result;
	}
}