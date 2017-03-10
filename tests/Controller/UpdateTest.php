<?php

namespace SkyBetTechTest\Tests\Controller;

use SkyBetTechTest\APIServer;
use SkyBetTechTest\Database;

class UpdateTest extends \PHPUnit_Framework_TestCase {

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
	 * @group failing
	 * Tests that the Update controller is called given the parameters.
	 */
	public function testUpdate() {

		$this->assertTrue(true);

		$request_uri = $this->root_url . 'update';

		$parameters = array(
			'uri'       => $request_uri,
			'method'    => 'POST',
			'database'  => $this->db,
			'postdata'  => array(
				'id' => 4,
				'firstname' => 'Andrei',
				'surname'   => 'Kanchelskis',
			)
		);

		$server = new APIServer( $parameters );

		$server->run();

		$response  = $server->getResponse();

		$this->assertArrayHasKey('status', $response);
		$this->assertArrayHasKey('command', $response);

		$this->assertEquals( $response['command'], 'update' );
	}
}