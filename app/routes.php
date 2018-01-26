<?php

$GLOBALS['router']->get( '/',         'HomeController::homeAction',    'home' );
$GLOBALS['router']->get( '/next_day', 'HomeController::nextDayAction', 'next_day' );
$GLOBALS['router']->get( '/plan',     'HomeController::planAction',    'plan' );

$GLOBALS['router']->get(  '/awards',                                 'AwardController::newsAction',        'award_news' );
$GLOBALS['router']->get(  '/award/attribute/:period',                'AwardController::chooseTypeAction',  'award_choose' );
$GLOBALS['router']->get(  '/award/attribute/:period/:name/nominees', 'AwardController::seeNomineesAction', 'award_nominees' );
$GLOBALS['router']->post( '/award/attribute',                        'AwardController::attributeAction',   'award_attribute' );

$GLOBALS['router']->get( '/standings', 'StandingController::displayAction', 'standings_display' );

$GLOBALS['router']->get( '/team/:id',          'TeamController::displayAction',  'team_display' );
$GLOBALS['router']->get( '/team/:id/roster',   'TeamController::rosterAction',   'team_roster' );
$GLOBALS['router']->get( '/team/:id/stats',    'TeamController::statsAction',    'team_stats' );
$GLOBALS['router']->get( '/team/:id/schedule', 'TeamController::scheduleAction', 'team_schedule' );