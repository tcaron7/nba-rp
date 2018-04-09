<?php

// Database
$GLOBALS['db']['options'] = array(
	'driver'   => 'mysql',
	'host'     => 'localhost',
	'dbname'   => 'nba',
	'user'     => 'nba',
	'password' => 'secret!',
	'charset'  => 'UTF8',
);

// Server
$GLOBALS['server']      = '';
$GLOBALS['timezone']    = 'Europe/Paris';
$GLOBALS['environment'] = 'prod';

// Paths
$GLOBALS['path']['root']        = './';
$GLOBALS['path']['store']       = $GLOBALS['path']['root']    . 'store/';
$GLOBALS['path']['web']         = $GLOBALS['server']          . 'web/';
$GLOBALS['path']['css']         = $GLOBALS['path']['web']     . 'css/';
$GLOBALS['path']['img']         = $GLOBALS['path']['web']     . 'img/';
$GLOBALS['path']['js']          = $GLOBALS['path']['web']     . 'js/';
$GLOBALS['path']['views']       = $GLOBALS['path']['root']    . 'view/';
$GLOBALS['path']['sources']     = $GLOBALS['path']['root']    . 'src/';
$GLOBALS['path']['entities']    = $GLOBALS['path']['sources'] . 'entity/';
$GLOBALS['path']['controllers'] = $GLOBALS['path']['sources'] . 'controller/';
$GLOBALS['path']['models']      = $GLOBALS['path']['sources'] . 'model/';
$GLOBALS['path']['tests']       = $GLOBALS['path']['sources'] . 'test/';
