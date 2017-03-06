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