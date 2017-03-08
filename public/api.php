<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

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
 * Run Server, and see if there is a response based on the supplied data.
 */
$server = new APIServer( $request_uri, $database );
$server->run();