<?php

// Session start
session_start();

// Default timezone
date_default_timezone_set( 'Europe/Paris' );

// Connexion to database
try
{
	$db = new PDO(
		$APP['db.options']['driver'] . ':host=' . $APP['db.options']['host'] . '; dbname=' . $APP['db.options']['dbname'],
		$APP['db.options']['user'],
		$APP['db.options']['password'],
		array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $APP['db.options']['charset'] )
	);
}
catch ( PDOException $e )
{
	echo 'Unable to connect to database : ' . $e;
	exit();
}

// Import classes
require_once( 'classes.php' );

// Load routes
$APP['router'] = new Router( isset( $_GET['url'] ) ? $_GET['url'] : '' );
require_once( 'routes.php' );