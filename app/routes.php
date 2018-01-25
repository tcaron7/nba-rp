<?php

$GLOBALS['router']->get( '/',         'HomeController::homeAction',    'home'     );
$GLOBALS['router']->get( '/next_day', 'HomeController::nextDayAction', 'next_day' );
$GLOBALS['router']->get( '/plan',     'HomeController::planAction',    'plan' );

$GLOBALS['router']->get(  '/awards',                                 'AwardController::newsAction',        'award_news' );
$GLOBALS['router']->get(  '/award/attribute/:period',                'AwardController::chooseTypeAction',  'award_choose' );
$GLOBALS['router']->get(  '/award/attribute/:period/:name/nominees', 'AwardController::seeNomineesAction', 'award_nominees' );
$GLOBALS['router']->post( '/award/attribute',                        'AwardController::attributeAction',   'award_attribute' );
