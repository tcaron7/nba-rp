<?php

/**
  * Returns a raw season using the year
  */
function getSeasonByYear($year)
{
    global $db;
	$request;
	$season;
	$year = (int) $year;
	
	$request = $db->prepare('SELECT * FROM season WHERE year = :year');
	$request->bindParam(':year', $year, PDO::PARAM_INT);
	$request->execute();
	$season = $request->fetch();
	
	$request->closeCursor();
    return $season;
}


/**
  * Returns all seasons
  */
function getAllSeasons()
{
    global $db;
	$request;
	$seasons;
	$allSeasons;
	
	$request = $db->prepare('SELECT year FROM season ORDER BY year');
	$request->execute();
	$seasons = $request->fetchAll();
	
	$id;
	foreach ($seasons as $key => $season) {
		$year = $season['year'];
		$allSeasons[$year] = new Season($year);
	}
	
	$request->closeCursor();
    return $allSeasons;
}

/**
  * Returns an array of the last ten seasons
  */
function getLastTenSeasons()
{
    global $db;
	$request;
	$seasons;
	$lastTenSeasons;
	
	$request = $db->prepare('SELECT year FROM season ORDER BY year DESC LIMIT 10');
	$request->execute();
	$seasons = $request->fetchAll();
	
	$id;
	foreach ($seasons as $key => $season) {
		$year = $season['year'];
		$lastTenSeasons[$year] = new Season($year);
	}
	
	$request->closeCursor();
    return $lastTenSeasons;
}

/**
  * Returns an array of the seasons played by a player
  */
function getSeasonsPlayedByPlayers($playerId)
{
    global $db;
	$request;
	$seasons;
	$playerSeasons=null;
    
	$request = $db->prepare('SELECT season FROM statplayer WHERE playerId = :playerId GROUP BY season');
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
    
	$request = $db->prepare('SELECT teamId FROM statplayer WHERE playerId = :playerId AND season = :season GROUP BY teamId');
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
