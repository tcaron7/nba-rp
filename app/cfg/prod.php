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
$APP['path.root']     = __DIR__ . '/../../';
$APP['path.sources']  = $APP['path.root'] . 'src/';
$APP['path.entities'] = $APP['path.sources'] . 'entity/';