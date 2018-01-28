<?php

class GameController
{

	public function __construct() { }

	public function scheduleAction()
	{
		$seasonGames;
		$currentSeason = getCurrentSeason();
		$seasonGames   = getGamesBySeason($currentSeason);

		include_once( $GLOBALS['path']['views'] . 'game/displayGamesOfTheCurrentSeason.php');
	}

	public function recapAction( $id )
	{
		$game     = new Game( $id, null, null, null);
		$statGame = new StatGame( $id, null );
		$index    = array( 'homeTeam', 'visitorTeam' );

		// Get team Players
		$teams['homeTeam']           = new Team( $statGame->getHomeTeamId() );
		$playersStats['homeTeam']    = $statGame->getHomeTeamStats();

		$teams['visitorTeam']        = new Team( $statGame->getVisitorTeamId() );
		$playersStats['visitorTeam'] = $statGame->getVisitorTeamStats();

		// On affiche la page (vue)
		include_once( $GLOBALS['path']['views'] . 'game/recapPlayedGameStats.php');
	}

}