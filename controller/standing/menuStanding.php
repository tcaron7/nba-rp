<?php

// Recuperation des parametres
$teamStanding = getTeamStandingForCurrentSeason();

usort($teamStanding,'compare');
function compare($a, $b) 
{
  return $a->getWinRate() < $b->getWinRate();
}

// On affiche la page (vue)
include_once('view/standing/displayStandings.php');

