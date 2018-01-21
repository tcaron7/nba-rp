<?php

// Database
$APP['db.options'] = array(
	'driver'   => 'mysql',
	'host'     => 'localhost',
	'dbname'   => 'nba',
	'user'     => 'nba',
	'password' => 'secret!',
	'charset'  => 'UTF8',
);

// Root folder
$APP['path.root'] = __DIR__ . '/../../';