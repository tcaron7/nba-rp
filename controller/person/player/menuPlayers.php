<?php

// Recuperation des parametres
$players;
$players = getAllPlayersInTeamsOrderByName();

$currentSeason = getCurrentSeason();

if(isset($_GET['player_id']))
{
    $player = new Player($_GET['player_id']);
	include_once('view/person/player/playerGlobalInfo.php');
	include_once('view/person/player/playerInfoNavigation.php');
	if(isset($_GET['section']) && $_GET['section'] == 'player_career_stats')
	{
		$careerStats = $player->getStats();
		include_once('view/person/player/playerCareerStats.php');
	}
	elseif(isset($_GET['section']) && $_GET['section'] == 'player_games_logs')
	{
		$playerGamesLogs = getPlayerGamesLogsOfASeason($player->getId(), $currentSeason);
		include_once('view/person/player/playerGamesLogs.php');
	}
	elseif(isset($_GET['section']) && $_GET['section'] == 'player_awards')
	{
		include_once('view/person/player/playerAwards.php');
	}
	else
	{
		$season = getCurrentSeason();
		if(isset($player->getStats()[$season]))
		{
			$stat = $player->getStats()[$season];
			include('view/person/player/playerSeasonStats.php');
			
			$homeRoadStats = $player->getHomeRoadSeasonStats();
			include('view/person/player/playerHomeRoadSeasonStats.php');
			
			$winsLossesStats = $player->getWinsLossesSeasonStats();
			include('view/person/player/playerWinsLossesSeasonStats.php');
			
			$monthsStats = $player->getMonthsSeasonStats();
			include('view/person/player/playerMonthsSeasonStats.php');
		}
	}
	include_once('view/person/player/playerAction.php');
    if(isset($_GET['action']) && $_GET['action'] == 'retirement')
    {
        updatePlayerRetirement($player->getId());
        echo $player->getFullName() . ' retires';
    }
}
else
{
    // On affiche la page (vue)
    include_once('view/person/player/playersList.php'); 
}


