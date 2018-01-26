<?php

class StandingController
{

	public function __construct() { }

	public function displayAction()
	{
		$teamStanding = getTeamStandingForCurrentSeason();
		usort( $teamStanding, 'Standing::compare' );
		include( $GLOBALS['path']['views'] . 'standing/displayStandings.php');
	}

}