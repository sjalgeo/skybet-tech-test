<?php

namespace SkyBetTechTest\Tests\Database;

use SkyBetTechTest\Database;

class DatabaseTest extends \PHPUnit_Framework_TestCase {

	private $root_directory;
	private $db;

	public function __construct() {
		$this->root_directory = ROOT_DIR;
		$this->db = new Database( $this->root_directory );
		$this->db_file = $this->root_directory . DIRECTORY_SEPARATOR . 'pundits.json';
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
		$this->assertEquals( $test_data, $file_data );


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

		$this->db->fetch( 'pundits', 3 );

		$pundit = $this->db->get_last_result();

		$this->assertEquals( 'Andy', $pundit['firstname'] );
		$this->assertEquals( 'Hinchcliffe', $pundit['surname'] );
	}

	/**
	 * Delete a single row from the database.
	 */
	public function testDelete() {

		// Record must exist to begin with.
		$this->db->fetch( 'pundits', 3 );
		$pundit = $this->db->get_last_result();

		$this->assertArrayHasKey( 'firstname', $pundit );
		$this->assertArrayHasKey( 'surname', $pundit );

		// Delete record.
		$this->db->delete( 'pundits', 3 );

		// Record no longer exists.
		$this->db->fetch( 'pundits', 3 );
		$pundit = $this->db->get_last_result();
		$this->assertNull($pundit);
	}

	/**
	 * Adds a new record to the database.
	 */
	public function testCreate() {
		$this->db->fetchAll( 'pundits' );
		$all_pundits = $this->db->get_last_result();

		$ids_in_use = array_map( function ( $pundit ) {
			return $pundit['id'];
		}, $all_pundits);

		$new_pundit = array(
			'firstname' => 'Tim',
			'surname'   => 'Cahill'
		);

		$this->db->create( 'pundits', $new_pundit );

		$new_id = $this->db->get_last_id();

		$this->assertFalse( in_array( $new_id, $ids_in_use ) );

		$this->db->fetch( 'pundits', $new_id );
		$new_pundit = $this->db->get_last_result();

		$this->assertEquals( $new_pundit['firstname'], 'Tim' );
		$this->assertEquals( $new_pundit['surname'], 'Cahill' );

		$this->db->fetchAll( 'pundits' );
		$all_pundits = $this->db->get_last_result();

		$this->assertEquals( count( $all_pundits ), 6 );
	}

	/**
	 * Test fetching a single value from the database.
	 */
	public function testReadSingleFromDatabase() {
		$this->db->fetch( 'pundits', 3 );
		$pundit = $this->db->get_last_result();

		$this->assertArrayHasKey( 'firstname', $pundit );
		$this->assertArrayHasKey( 'surname', $pundit );
	}

	/**
	 * Test the app fails elegantly when the row does not exist.
	 */
	public function testMissingFromDatabase() {
		$this->db->fetch( 'pundits', 33 );
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