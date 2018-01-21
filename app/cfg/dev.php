<?php

// Overwrite prod configuration
require( __DIR__ . '/prod.php' );

// Database
$APP['db.options'] = array(
	'driver'   => 'mysql',
	'host'     => 'localhost',
	'dbname'   => 'nba',
	'user'     => 'root',
	'password' => '',
	'charset'  => 'UTF8',
);

// Debug
$APP['debug'] = true;

// Log
error_reporting( E_ALL );