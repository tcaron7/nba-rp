<?php

/**
  * Returns an array of the seasons played by a player
  */
function getSeasonsPlayedByPlayers($playerId)
{
    global $db;
	$request;
	$seasons;
	$playerSeasons=null;
    
	$request = $db->prepare('SELECT season FROM statPlayer WHERE playerId = :playerId GROUP BY season');
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
    $request->execute();
	$seasons = $request->fetchAll();
	
	$id;
    if($seasons!=null)
    {
        foreach ($seasons as $season) 
        {
            $year = $season['season'];
            $playerSeasons[$year] = new Season($year);
        }
    }
	$request->closeCursor();
    return $playerSeasons;
}

/**
  * Returns an array of the teams where a given player has played in a given season
  */
function getTeamsPlayedByPlayersInASeason($playerId, $season)
{
    global $db;
	$request;
	$teams;
	$playerSeasonTeams=null;
    
	$request = $db->prepare('SELECT teamId FROM statPlayer WHERE playerId = :playerId AND season = :season GROUP BY teamId');
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	$request->bindParam(':season',	 $season, 	PDO::PARAM_INT);
    $request->execute();
	$teams = $request->fetchAll();
	
	$id;
    if($teams!=null)
    {
        foreach ($teams as $team) 
        {
            $teamId = $team['teamId'];
            $playerSeasonTeams[$teamId] = new Team($teamId);
        }
    }
	$request->closeCursor();
    return $playerSeasonTeams;
}