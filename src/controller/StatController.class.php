<?php

class StatController
{

	public function __construct() { }

	public function displayAction( $selection )
	{
		$season      = getCurrentSeason();
		$period      = isset( $_POST['period'] )  ? $_POST['period']  : 'Season';
		$playersType = isset( $_POST['players'] ) ? $_POST['players'] : 'All';
		$stats       = isset( $_POST['stats'] )   ? $_POST['stats']   : 'points';

		if ( $selection == 'players' )
		{
			$players = getPlayersForTopStatsDisplay( $period, $playersType, $stats );
			include_once( $GLOBALS['path']['views'] . 'stat/displayPlayersTopStats.php' );
		}
		elseif ( $selection == 'teams' )
		{
			$teams = getAllTeamOrderByName();
			include_once( $GLOBALS['path']['views'] . 'stat/displayTeamsStats.php' );
		}
	}

}