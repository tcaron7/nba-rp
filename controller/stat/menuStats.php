<?php
include_once('menuStatsFilterChoice.php');

// Recuperation des parametres
if ($_GET['stats'] == 'players')
{
	$players;
    $players = getPlayersForTopStatsDisplay($period, $playersType, $stats);          
}
elseif ($_GET['stats'] == 'teams')
{
	$teams;
	$teams = getAllTeamOrderByName();
}

$season  = getCurrentSeason();

//include_once('menuStatsCategoryChoice.php');

// On affiche la page (vue)
if ($_GET['stats'] == 'players')
{
	include_once('view/stat/displayPlayersTopStats.php');
}
elseif ($_GET['stats'] == 'teams')
{
	include_once('view/stat/displayTeamsStats.php');
}
