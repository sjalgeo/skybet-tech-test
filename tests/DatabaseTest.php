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
	 * Reset the Database before tests.
	 */
	public function setUp() {
		$this->db->reset();
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

	/**
	 * Change record id(3) to new name.
	 */
	public function testUpdate() {

		$data = array(
			'firstname' => 'Andy',
			'surname'   => 'Hinchcliffe'
		);

		$this->db->update( 'pundits', 3, $data );

		$this->db->fetch('pundits', 3);

		$pundit = $this->db->get_last_result();

		$this->assertEquals( 'Andy', $pundit['firstname'] );
		$this->assertEquals( 'Hinchcliffe', $pundit['surname'] );
	}

	/**
	 * Delete a single row from the database.
	 */
	public function testDelete() {

		// Record must exist to begin with.
		$this->db->fetch('pundits', 3);
		$pundit = $this->db->get_last_result();

		$this->assertArrayHasKey( 'firstname', $pundit );
		$this->assertArrayHasKey( 'surname', $pundit );

		// Delete record.
		$this->db->delete( 'pundits', 3 );

		// Record no longer exists.
		$this->db->fetch('pundits', 3);
		$pundit = $this->db->get_last_result();
		$this->assertNull($pundit);
	}

	/**
	 * Reset the Database after the tests.
	 */
	public function tearDown() {
		$this->db->reset();
	}
}