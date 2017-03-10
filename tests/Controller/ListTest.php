<?php

namespace SkyBetTechTest\Tests\Controller;

use SkyBetTechTest\APIServer;
use SkyBetTechTest\Database;

class ListTest extends \PHPUnit_Framework_TestCase {

	private $root_url;
	private $db;

	public function __construct() {
		$this->root_url = 'api.php/';
		$this->db = new Database( ROOT_DIR );
	}

	public function testList() {
		$request_uri = $this->root_url . 'list';

		$parameters = array(
			'uri'       => $request_uri,
			'method'    => 'GET',
			'database'  => $this->db,
			'postdata'  => array()
		);

		$server = new APIServer( $parameters );

		$server->run();

		$response  = $server->getResponse();

		$this->assertArrayHasKey('status', $response);
		$this->assertArrayHasKey('data', $response);
		$this->assertArrayHasKey('command', $response);

		$this->assertEquals( $response['command'], 'list' );

		$this->assertEquals( $response['status'], 'success');

		foreach ($response['data'] as $pundit) {
			$this->assertArrayHasKey('firstname', $pundit);
			$this->assertArrayHasKey('surname', $pundit);
			$this->assertArrayHasKey('id', $pundit);
		}
	}
}