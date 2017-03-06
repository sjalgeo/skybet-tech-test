<?php

$root_directory = realpath( __FILE__ );
$root_directory = str_replace( 'bootstrap.php', '', $root_directory );

define( 'ROOT_DIR', $root_directory );

require_once ('autoload.php');