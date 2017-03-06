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
	 * Fetch a single record from the database.
	 */
	public function fetch( $table, $id ) {
		$this->last_error  = null;

		$this->fetchAll($table);

		// This wouldn't scale well, but neither would a flat file database :)
		foreach ($this->get_last_result() as $pundit) {
			if ( isset($pundit['id']) AND intval($pundit['id']) === $id ) {
				$this->last_result = $pundit;
				return;
			}
		}

		$this->last_result = null;
	}

	/**
	 * Update a row in the database.
	 *
	 * @param $table - The name of the flat file database table.
	 * @param $id - The unique id of the record to update.
	 * @param $update_data - Key value pairs of data to update.
	 */
	public function update( $table, $id, $update_data ) {
		$this->last_error  = null;
		// cleanse the post data.

		$this->fetch($table, $id);
		$previous_record = $this->get_last_result();

		$new_record = $previous_record;

		foreach ( $update_data as $property => $value ) {

			if ( isset( $new_record[$property] ) ){
				$new_record[$property] = $value;
			}
		}

		$this->fetchAll($table);
		$all = $this->get_last_result();

		$found = false;

		foreach ($all as $key => $row) {
			if ( isset($row['id']) AND intval($row['id']) === $id ) {
				$all[$key] = $new_record;
				$found = true;
			}
		}

		if ( $found ) {
			$this->commit($table, $all);
		} else {
			$this->last_error = 'ID_NOT_FOUND';
		}
	}

	/**
	 * Overwrites the entire data of the database.
	 *
	 * @param $table - The table to update
	 * @param $data - The collection of rows for the table (as php array)
	 */
	protected function commit($table, $data) {
		$db_file = $this->root_directory.'pundits.json';
		file_put_contents( $db_file, json_encode( array_values( $data ) ) );
	}

	/**
	 * @return The last piece of data fetch from the database.
	 */
	public function get_last_result() {
		return $this->last_result;
	}
}