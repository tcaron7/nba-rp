<?php

// Entities
require_once( $GLOBALS['path']['entities'] . 'Route.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Router.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Date.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Conference.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Division.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Person.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Player.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Prospect.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Team.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Game.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Season.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Standing.class.php' );
require_once( $GLOBALS['path']['entities'] . 'StatPlayer.class.php' );
require_once( $GLOBALS['path']['entities'] . 'StatTeam.class.php' );
require_once( $GLOBALS['path']['entities'] . 'StatGame.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Transaction.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Trade.class.php' );
require_once( $GLOBALS['path']['entities'] . 'TradeElement.class.php' );
require_once( $GLOBALS['path']['entities'] . 'TradeElementPlayer.class.php' );
require_once( $GLOBALS['path']['entities'] . 'TradeElementDraftPick.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Signature.class.php' );
require_once( $GLOBALS['path']['entities'] . 'SignatureFreeAgent.class.php' );
require_once( $GLOBALS['path']['entities'] . 'SignatureProspect.class.php' );
require_once( $GLOBALS['path']['entities'] . 'DraftPick.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Injury.class.php' );
require_once( $GLOBALS['path']['entities'] . 'Award.class.php' );

// Controllers
require_once( $GLOBALS['path']['controllers'] . 'HomeController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'AwardController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'StandingController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'TeamController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'DraftController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'GameController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'InjuryController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'TradeController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'SignatureController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'SeasonController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'PlayerController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'ProspectController.class.php' );
require_once( $GLOBALS['path']['controllers'] . 'StatController.class.php' );

// Models
require_once( $GLOBALS['path']['models'] . 'DateModel.class.php' );
require_once( $GLOBALS['path']['models'] . 'ConferenceModel.class.php' );
require_once( $GLOBALS['path']['models'] . 'DivisionModel.class.php' );
require_once( $GLOBALS['path']['models'] . 'TeamModel.class.php' );
