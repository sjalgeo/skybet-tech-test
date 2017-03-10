<?php

/**
 * PSR-4 Autoloading of Classes
 */
require '../vendor/autoload.php';

/**
 * Remove trailing slashes.
 */
$request_uri = trim( $_SERVER['REQUEST_URI'], '/' );

use SkyBetTechTest\APIServer;
use SkyBetTechTest\Database;

/**
 * Determine app's root directory as a reference for the rest of the app.
 */
$root_directory = rtrim( __DIR__, 'public');

/**
 * Setup link to Database for use in the app.
 */
$database = new Database( $root_directory );

/**
 * Determine the request method used by the client.
 */
$request_method = $_SERVER['REQUEST_METHOD'];

/**
 * Run Server, and see if there is a response based on the supplied data.
 */
$parameters = array(
	'uri'       => $request_uri,
	'method'    => $request_method,
	'database'  => $database,
	'postdata'  => $_POST
);

$server = new APIServer( $parameters );
$server->run();

header('Content-Type: application/json');
echo $server->getJSONResponse();