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

$GLOBALS['router']->get(  '/game/:id/play/score',  'GameController::playScoreAction',  'game_play_score' );
$GLOBALS['router']->post( '/game/:id/play/pre',    'GameController::playPreAction',    'game_play_pre' );
$GLOBALS['router']->post( '/game/:id/play/fill',   'GameController::playFillAction',   'game_play_fill' );
$GLOBALS['router']->post( '/game/:id/play/recap',  'GameController::playRecapAction',  'game_play_recap' );
$GLOBALS['router']->post( '/game/:id/play/submit', 'GameController::playSubmitAction', 'game_play_submit' );

$GLOBALS['router']->get(  '/injuries',                'InjuryController::displayCurrentAction', 'injury_current' );
$GLOBALS['router']->get(  '/injury/create',           'InjuryController::selectAction',         'injury_select' );
$GLOBALS['router']->get(  '/injury/create/:playerId', 'InjuryController::createAction',         'injury_create' );
$GLOBALS['router']->post( '/injury',                  'InjuryController::insertAction',         'injury_insert' );

$GLOBALS['router']->get(  '/trade', 'TradeController::createAction', 'trade_create' );
$GLOBALS['router']->post( '/trade', 'TradeController::doAction',     'trade_do' );

$GLOBALS['router']->get(  '/signature',           'SignatureController::chooseAction',     'signature_choose' );
$GLOBALS['router']->get(  '/signature/:playerId', 'SignatureController::createAction',     'signature_create' );
$GLOBALS['router']->post( '/signature/player',    'SignatureController::signPlayerAction', 'signature_player' );
$GLOBALS['router']->post( '/signature/rookie',    'SignatureController::signRookieAction', 'signature_rookie' );

$GLOBALS['router']->get(  '/season/new',   'SeasonController::createAction',  'season_create' );
$GLOBALS['router']->post( '/season/new',   'SeasonController::insertAction',  'season_insert' );
$GLOBALS['router']->get(  '/season/:year', 'SeasonController::displayAction', 'season_display' );

$GLOBALS['router']->get(  '/player/list',                    'PlayerController::listAllAction',            'player_list_all' );
$GLOBALS['router']->get(  '/player/list/option',             'PlayerController::listOptionAction',         'player_list_option' );
$GLOBALS['router']->get(  '/player/list/restricted',         'PlayerController::listRestrictedAction',     'player_list_restricted' );
$GLOBALS['router']->get(  '/player/create',                  'PlayerController::createAction',             'player_create' );
$GLOBALS['router']->get(  '/player/:id',                     'PlayerController::displayAction',            'player_display' );
$GLOBALS['router']->get(  '/player/:id/stats',               'PlayerController::statsAction',              'player_stats' );
$GLOBALS['router']->get(  '/player/:id/career',              'PlayerController::careerAction',             'player_career' );
$GLOBALS['router']->get(  '/player/:id/games',               'PlayerController::gamesAction',              'player_games' );
$GLOBALS['router']->get(  '/player/:id/awards',              'PlayerController::awardsAction',             'player_awards' );
$GLOBALS['router']->get(  '/player/:id/retire',              'PlayerController::retireAction',             'player_retire' );
$GLOBALS['router']->get(  '/player/:id/option/activate',     'PlayerController::optionActivateAction',     'player_option_activate' );
$GLOBALS['router']->get(  '/player/:id/option/decline',      'PlayerController::optionDeclineAction',      'player_option_decline' );
$GLOBALS['router']->get(  '/player/:id/restricted/activate', 'PlayerController::restrictedActivateAction', 'player_restricted_activate' );
$GLOBALS['router']->get(  '/player/:id/restricted/decline',  'PlayerController::restrictedDeclineAction',  'player_restricted_decline' );
$GLOBALS['router']->get(  '/player/create',                  'PlayerController::createAction',             'player_create' );
$GLOBALS['router']->post( '/player',                         'PlayerController::insertAction',             'player_insert' );

$GLOBALS['router']->get(  '/prospect/list/:selection', 'ProspectController::listAction',   'prospect_list' );
$GLOBALS['router']->get(  '/prospect/create',          'ProspectController::createAction', 'prospect_create' );
$GLOBALS['router']->post( '/prospect',                 'ProspectController::insertAction', 'prospect_insert' );

$GLOBALS['router']->get(  '/stats/:selection', 'StatController::filterAction',  'stat_filter' );
$GLOBALS['router']->post( '/stats/:selection', 'StatController::displayAction', 'stat_display' );
