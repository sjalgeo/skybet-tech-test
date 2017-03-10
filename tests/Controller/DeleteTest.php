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

		$this->assertTrue(true);

		$request_uri = $this->root_url . 'delete';

		$parameters = array(
			'uri'       => $request_uri,
			'method'    => 'GET',
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
}