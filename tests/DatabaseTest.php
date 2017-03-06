<?php

namespace SBTechTest\Tests\API;

use SBTechTest\Database;

class DatabaseTest extends \PHPUnit_Framework_TestCase{

	public function __construct() {
		$this->root_directory = ROOT_DIR;
		$this->db = new Database( $this->root_directory );
		$this->db_file = $this->root_directory . 'pundits.json';
	}

	/**
	 * Updates the flat file with alternate data and then resets and confirms
	 * the correct data has been restored.
	 */
	public function testReset() {
		$test_data = 'NOT_THE_DATA';
		file_put_contents( $this->db_file, $test_data );
		$file_data = file_get_contents( $this->db_file );
		$this->assertEquals( $test_data, $file_data);

		$pundit_data = '[{"firstname":"Jeff","surname":"Stelling","id":"1"},{"firstname":"Chris","surname":"Kamara","id":"2"},{"firstname":"Alex","surname":"Hammond","id":"3"},{"firstname":"Jim","surname":"White","id":"4"},{"firstname":"Natalie","surname":"Sawyer","id":"5"}]';
		$this->db->reset();
		$file_data = file_get_contents( $this->db_file );
		$this->assertEquals( $pundit_data, $file_data );
	}

	/**
	 * Test should fetch all the pundits from the database as an array.
	 */
	public function testReadAllFromDatabase() {

		$this->db->fetchAll('pundits');
		$data = $this->db->get_last_result();

		foreach ($data as $pundit){
			$this->assertArrayHasKey( 'firstname', $pundit );
			$this->assertArrayHasKey( 'surname', $pundit );
		}

		$this->assertCount(5, $data);
	}
}