<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

/**
 * Remove trailing slashes.
 */
$request_uri = trim( $_SERVER['REQUEST_URI'], '/' );

use SkyBetTechTest\APIServer;

/**
 * Determine app's root directory as a reference for the rest of the app.
 */
$root_directory = rtrim( __DIR__, 'public');

/**
 * Run Server, and see if there is a response based on the supplied data.
 */
$server = new APIServer( $request_uri, $root_directory );
$server->run();