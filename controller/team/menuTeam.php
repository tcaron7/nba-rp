<?php

// Recuperation des parametres
$team = new Team ($_GET['id']);

include_once('view/team/displayTeamPage.php');

// Display roster of team
if (isset($_GET['team']) && $_GET['team'] == 'roster')
{
	$teamPlayers = getAllPlayersOfTeam($team->getId());
	include('view/team/displayRoster.php');
    
    $teamPlayers = getAllUnsignedRookiesOfTeam($team->getId());
	include('view/team/displayRoster.php');
}
// Display team stats
elseif (isset($_GET['team']) && $_GET['team'] == 'stats')
{
	// $teamPlayersStats = getSeasonPlayersStatsOfATeam($team->getId(),getCurrentSeason());
	$players = getAllPlayersOfTeam($team->getId());
	$season = getCurrentSeason();
	// var_dump($teamPlayersStats);
	include('view/stat/displayTeamPlayersStats.php');
	// include('view/team/displayTeamStats.php');
}
// Display team schedule
elseif (isset($_GET['team']) && $_GET['team'] == 'schedule')
{
	$season = getCurrentSeason();
	$seasonGames = getTeamGamesBySeason($team->getId(), $season);
	include('view/game/displayGamesOfTheCurrentSeason.php');
}


