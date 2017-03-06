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
	 * Resets the Database to its initial values.
	 */
	public function reset() {
		$this->last_error  = null;
		$data = '[{"firstname":"Jeff","surname":"Stelling","id":"1"},{"firstname":"Chris","surname":"Kamara","id":"2"},{"firstname":"Alex","surname":"Hammond","id":"3"},{"firstname":"Jim","surname":"White","id":"4"},{"firstname":"Natalie","surname":"Sawyer","id":"5"}]';
		file_put_contents( $this->root_directory.'pundits.json', $data );
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