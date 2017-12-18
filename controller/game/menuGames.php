<?php
// On affiche la page (vue)
if(!isset($_GET['gameId']))
{
	// Recuperation des parametres
	$seasonGames;
	$currentSeason = getCurrentSeason();
	$seasonGames   = getGamesBySeason($currentSeason);
	
	include_once('view/game/displayGamesOfTheCurrentSeason.php');
}
else
{
	$gameId = $_GET['gameId'];
	$game = new Game($gameId, null, null, null);

	$index[0] = 'homeTeam';
	$index[1] = 'visitorTeam';
	
    $statsGame = new StatsGame($gameId,null);
    
    $homeTeamId     = $statsGame->getHomeTeamId();
    $visitorTeamId  = $statsGame->getVisitorTeamId();
    
    // Get team Players
    $teams['homeTeam']           = new Team ($homeTeamId);
    $playersStats['homeTeam']    = $statsGame->getHomeTeamStats();

    $teams['visitorTeam']        = new Team ($visitorTeamId);
    $playersStats['visitorTeam'] = $statsGame->getVisitorTeamStats();
  
    // On affiche la page (vue)
    include_once('view/game/recapPlayedGameStats.php');
}