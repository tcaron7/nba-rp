<?php

/**
  * Returns the total number of wins for a giving season
  */
function getTotalWinBySeason($season)
{
    global $db;
	$request;
	$win;
	
	$request = $db->prepare('
		SELECT winnerId, count(*) as win
		FROM game
		WHERE status = 1 AND season = :season
		GROUP BY winnerId
	');
	$request->bindParam(':season', $season, PDO::PARAM_INT);
	$request->execute();
    $win = $request->fetchAll();
    
	$request->closeCursor();
    return $win;
}

/**
  * Returns the total number of losses for a giving season
  */
function getTotalLossBySeason($season)
{
    global $db;
	$request;
	$loss;
	
	$request = $db->prepare('
		SELECT loserId, count(*) as loss
		FROM game
		WHERE status = 1 AND season = :season
		GROUP BY loserId
	');
	$request->bindParam(':season', $season, PDO::PARAM_INT);
	$request->execute();
    $loss = $request->fetchAll();
    
	$request->closeCursor();
    return $loss;
}

/**
  * Returns the total number of wins for the current season
  */
function getTotalWinForCurrentSeason()
{
	$currentSeason = getCurrentSeason();
	$win = getTotalWinBySeason($currentSeason);
    return $win;
}

/**
  * Returns the total number of losses for the current season
  */
function getTotalLossForCurrentSeason()
{
	$currentSeason = getCurrentSeason();
	$loss = getTotalLossBySeason($currentSeason);
    return $loss;
}

/**
  * Returns the total number of wins and losses for each team for the current season
  */
function getTeamStandingForCurrentSeason()
{
	// Recuperation des parametres
	$getWin;
	$getWin = getTotalWinForCurrentSeason();

	$getLoss;
	$getLoss = getTotalLossForCurrentSeason();
	
	// Traitement des parametres
	$teams = getAllTeamOrderByName();
	foreach($teams as $team)
	{
		$id = $team->getId();
		$teamWin  = 0;
		$teamLoss = 0;
		foreach($getWin as $win)
		{
			if($id == $win['winnerId'])
			{
				$teamWin = $win['win'];
			}
		}
		foreach($getLoss as $loss)
		{
			if($id == $loss['loserId'])
			{
				$teamLoss = $loss['loss'];
			}
		}
		$teamStanding[$id] = new Standing($id, $teamWin, $teamLoss);
	}
	return $teamStanding;
}