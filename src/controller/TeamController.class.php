<?php

class TeamController
{

	public function __construct() { }

	public function displayAction( $id )
	{
		$team = new Team ( $id );
		include_once( $GLOBALS['path']['views'] . 'team/displayTeamPage.php' );
	}

	public function rosterAction( $id )
	{
		$this->displayAction( $id );
		$team = new Team ( $id );

		$teamPlayers = getAllPlayersOfTeam( $id );
		include( $GLOBALS['path']['views'] . 'team/displayRoster.php' );

		$teamPlayers = getAllUnsignedRookiesOfTeam( $id );
		include( $GLOBALS['path']['views'] . 'team/displayRoster.php' );
	}

	public function statsAction( $id )
	{
		$this->displayAction( $id );
		$team = new Team ( $id );

		$players = getAllPlayersOfTeam( $id );
		$season  = getCurrentSeason();
		include( $GLOBALS['path']['views'] . 'stat/displayTeamPlayersStats.php');
	}

	public function scheduleAction( $id )
	{
		$this->displayAction( $id );
		$team = new Team ( $id );

		$season      = getCurrentSeason();
		$seasonGames = getTeamGamesBySeason( $id, $season );
		include('view/game/displayGamesOfTheCurrentSeason.php');
	}

}