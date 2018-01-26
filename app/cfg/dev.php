<?php

// Overwrite prod configuration
require( __DIR__ . '/prod.php' );

// Database
$GLOBALS['db']['options'] = array(
	'driver'   => 'mysql',
	'host'     => 'localhost',
	'dbname'   => 'nba',
	'user'     => 'root',
	'password' => 'root',
	'charset'  => 'UTF8',
);

// Server
$GLOBALS['server'] = 'http://localhost/nba-rp/';

// Paths
$GLOBALS['path']['web'] = $GLOBALS['server']      . 'web/';
$GLOBALS['path']['css'] = $GLOBALS['path']['web'] . 'css/';
$GLOBALS['path']['img'] = $GLOBALS['path']['web'] . 'img/';
$GLOBALS['path']['js']  = $GLOBALS['path']['web'] . 'js/';

// Debug
$GLOBALS['debug'] = true;

// Log
error_reporting( E_ALL );
