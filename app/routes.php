<?php

$GLOBALS['router']->get( '/',         'HomeController::homeAction',    'home'     );
$GLOBALS['router']->get( '/next_day', 'HomeController::nextDayAction', 'next_day' );
$GLOBALS['router']->get( '/plan',     'HomeController::planAction',    'plan' );
