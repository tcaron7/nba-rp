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

$GLOBALS['router']->get(  '/draft/lottery',       'DraftController::lotteryAction',            'draft_lottery' );
$GLOBALS['router']->get(  '/draft/subscribe',     'DraftController::selectProspectsAction',    'draft_select' );
$GLOBALS['router']->post( '/draft/subscribe',     'DraftController::subscribeProspectsAction', 'draft_subscribe' );
$GLOBALS['router']->get(  '/draft/do',            'DraftController::doAction',                 'draft_do' );
$GLOBALS['router']->get(  '/draft/pick',          'DraftController::chooseAction',             'draft_choose' );
$GLOBALS['router']->post( '/draft/pick',          'DraftController::pickAction',               'draft_pick' );
$GLOBALS['router']->get(  '/draft/history',       'DraftController::historyChooseYearAction',  'draft_history' );
$GLOBALS['router']->get(  '/draft/history/:year', 'DraftController::historyDisplayAction',     'draft_year' );

$GLOBALS['router']->get( '/games',    'GameController::scheduleAction', 'game_schedule' );
$GLOBALS['router']->get( '/game/:id', 'GameController::recapAction',    'game_recap' );