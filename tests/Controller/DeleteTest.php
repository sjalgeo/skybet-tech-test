<?php

namespace SkyBetTechTest\Tests\Controller;

use SkyBetTechTest\APIServer;
use SkyBetTechTest\Database;

class DeleteTest extends \PHPUnit_Framework_TestCase {

	private $root_url;
	private $db;

	public function __construct() {
		$this->root_url = 'api.php/';
		$this->db = new Database( ROOT_DIR );
	}

	public function setUp() {
		$this->db->reset();
	}

	public function tearDown() {
		$this->db->reset();
	}

	/**
	 * Tests that the Delete controller is called given the parameters.
	 */
	public function testDelete() {

		$request_uri = $this->root_url . 'delete';

		$parameters = array(
			'uri'       => $request_uri,
			'method'    => 'POST',
			'database'  => $this->db,
			'postdata'  => array( 'id' => 3 )
		);

		$server = new APIServer( $parameters );

		$server->run();

		$response  = $server->getResponse();

		$this->assertArrayHasKey('status', $response);
		$this->assertArrayHasKey('command', $response);

		$this->assertEquals( $response['command'], 'delete' );
	}

	/**
	 * Confirm appropriate response is given when the ID is missing from the database.
	 */
	public function testDeleteMissing() {

		$request_uri = $this->root_url . 'delete';

		$parameters = array(
			'uri'       => $request_uri,
			'method'    => 'POST',
			'database'  => $this->db,
			'postdata'  => array( 'id' => 333 )
		);

		$server = new APIServer( $parameters );

		$server->run();

		$response  = $server->getResponse();

		$this->assertArrayHasKey('status', $response);
		$this->assertArrayHasKey('command', $response);

		$this->assertEquals( $response['status'], 'error' );
		$this->assertEquals( $response['command'], 'delete' );
		$this->assertEquals( $response['code'], 'ID_NOT_FOUND' );
	}
}