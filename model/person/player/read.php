<?php

/**
  * Returns the raw information of a player using the playerId
  */
function getPlayerById($id)
{
    global $db;
	$request;
    $player;
	
	$request = $db->prepare('
		SELECT * FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE playerId = :id
	');
	$request->bindParam(':id', $id, PDO::PARAM_INT);
	$request->execute();
	$player = $request->fetch();

	$request->closeCursor();
    return $player;
}

/**
  * Returns an array of all the players that are in teams
  */
function getAllPlayersInTeamsOrderByName()
{
    global $db;
	$request;
    $players;
	$inTeamPlayers;
	
	$request = $db->prepare('
		SELECT player.playerId FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE player.teamId != 0
        AND   player.teamId != 31
		ORDER BY person.name
	');
	$request->execute();
	$players = $request->fetchAll();

	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$inTeamPlayers[$id] = new Player($id);
	}
	
	$request->closeCursor();
    return $inTeamPlayers;
}

/**
  * Returns an array of all the candidates to a given award
  */
function getAllCandidatesToAnAward($award)
{
    global $db;
	$request;
    $players;
	$inTeamPlayers;
    $sql = '    SELECT player.playerId FROM player
                LEFT JOIN person ON player.personId = person.personId
                LEFT JOIN team   ON player.teamId   = team.teamId
                WHERE player.teamId != 0
                AND   player.teamId != 31';
                
    // Player type selection
    if($award == 'roy' or $award == 'east_rookie' or $award == 'west_rookie')
    {
        $sql .= ' AND player.experience = 0';
    }
    
    // Player conference selection
    if($award == 'east_rookie' or $award == 'east_player')
    {
        $sql .= ' AND team.conference = "East"';
    }
    elseif($award == 'west_rookie' or $award == 'west_player')
    {
        $sql .= ' AND team.conference = "West"';
    }
    
    $sql .= ' ORDER BY person.name';
        
	$request = $db->prepare($sql);
	$request->execute();
	$players = $request->fetchAll();
    
	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$inTeamPlayers[$id] = new Player($id);
	}
	
	$request->closeCursor();
    return $inTeamPlayers;
}

/**
  * Returns an array of all the players that are free agents
  */
function getAllUnrestrictedFreeAgentPlayersOrderByName()
{
    global $db;
	$request;
    $players;
	$freeAgentPlayers=null;
	
	$request = $db->prepare('
		SELECT player.playerId FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE player.teamId = 0
		ORDER BY person.name
	');
	$request->execute();
	$players = $request->fetchAll();

	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$freeAgentPlayers[$id] = new Player($id);
	}
	
	$request->closeCursor();
    return $freeAgentPlayers;
}

/**
  * Returns an array of all the players that are free agents restricted
  */
function getAllRestrictedFreeAgentPlayersOrderByName()
{
    global $db;
	$request;
    $players;
	$freeAgentPlayers=null;
	
	$request = $db->prepare("
		SELECT player.playerId FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE player.guarantedYear = 0
        AND   player.optionalYear = 0
        AND   player.contractType = 'Rookie'
		ORDER BY person.name
	");
	$request->execute();
	$players = $request->fetchAll();

	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$freeAgentPlayers[$id] = new Player($id);
	}
	
	$request->closeCursor();
    return $freeAgentPlayers;
}

/**
  * Returns an array of all the players that have a contract option
  */
function getAllPlayersWithAContractOption()
{
    global $db;
	$request;
    $players;
	$optionPlayers=null;
	
	$request = $db->prepare('
		SELECT player.playerId FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE player.guarantedYear = 0
        AND player.optionalYear > 0
		ORDER BY person.name
	');
	$request->execute();
	$players = $request->fetchAll();

	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$optionPlayers[$id] = new Player($id);
	}
	
	$request->closeCursor();
    return $optionPlayers;
}

/**
  * Returns an array of all the players that are retired
  */
function getAllRetiredPlayersOrderByName()
{
    global $db;
	$request;
    $players;
	$freeAgentPlayers=null;
	
	$request = $db->prepare('
		SELECT player.playerId FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE player.teamId = 31
		ORDER BY person.name
	');
	$request->execute();
	$players = $request->fetchAll();

	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$freeAgentPlayers[$id] = new Player($id);
	}
	
	$request->closeCursor();
    return $freeAgentPlayers;
}

/**
  * Returns an array of all the players of a giving teamId
  */
function getAllPlayersOfTeam($teamId)
{
    global $db;
	$request;
    $players;
	$teamPlayers = null;
	
	if ( $teamId > 30 or $teamId <=0 ) {
		return null;
	}
	
	$request = $db->prepare('
		SELECT player.playerId FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE player.teamId = :teamId
        AND   player.guarantedYear > 0    
		ORDER BY player.position
	');
	$request->bindParam(':teamId', $teamId, PDO::PARAM_INT);
	$request->execute();
	$players = $request->fetchAll();

	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$teamPlayers[$id] = new Player($id);
	}
		
	$request->closeCursor();
    return $teamPlayers;
}

/**
  * Returns an array of all the players of a giving teamId
  */
function getAllUnsignedRookiesOfTeam($teamId)
{
    global $db;
	$request;
    $players;
	$teamPlayers = null;
	
	if ( $teamId > 30 or $teamId <=0 ) {
		return null;
	}
	
	$request = $db->prepare('
		SELECT player.playerId FROM player
		LEFT JOIN person ON player.personId = person.personId
		WHERE player.teamId = :teamId
        AND   player.guarantedYear = 0
        AND   player.experience = 0    
		ORDER BY person.name
	');
	$request->bindParam(':teamId', $teamId, PDO::PARAM_INT);
	$request->execute();
	$players = $request->fetchAll();

	$id;
	foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$teamPlayers[$id] = new Player($id);
	}
		
	$request->closeCursor();
    return $teamPlayers;
}

/**
  * Returns an array of all the players who played at least one game in the current season
  */
function getAllPlayersWhoPlayedInTheCurrentSeason()
{
    global $db;
	$request;
    $players;
	$inTeamPlayers = null;
	
	$season = getCurrentSeason();
	$request = $db->prepare('
		SELECT * 
		FROM player 
		LEFT JOIN person ON player.personId = person.personId 
		LEFT JOIN statplayer ON player.playerId = statplayer.playerId 
		WHERE statplayer.season = :season AND statplayer.games = max(statplayer.games)
        GROUP BY statplayer.playerId');
		
	$request->bindParam(':season', $season, PDO::PARAM_INT);	
	$request->execute();
	$players = $request->fetchAll();

	$id;
    foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$inTeamPlayers[$id] = new Player($id);
	}
	$request->closeCursor();
    return $inTeamPlayers;
}

/**
  * Returns an array of all the players who played at least one game in the current season
  */
function getPlayersForTopStatsDisplay($period, $playerType, $stats)
{
    global $db;
	$request;
    $players;
	$inTeamPlayers = null;
    
	if($period == 'Season')
	{
		$sql = '
			SELECT 
				player.playerId as playerId,  
				sum(statplayer.games) as games, 
				sum(statplayer.minutes)/sum(statplayer.games) as minutes, 
				sum(statplayer.points)/sum(statplayer.games) as points, 
				100*sum(statplayer.freeThrowsMade)/sum(statplayer.freeThrowsAttempt) as FTPercentage,
				100*sum(statplayer.twoPointsMade + statplayer.threePointsMade)/sum(statplayer.twoPointsAttempt + statplayer.threePointsAttempt) as FGPercentage,
				100*sum(statplayer.threePointsMade)/sum(statplayer.threePointsAttempt) as 3FGPercentage ,
				sum(statplayer.offensiveRebounds)/sum(statplayer.games) as offRebounds,
				sum(statplayer.defensiveRebounds)/sum(statplayer.games) as defRebounds,
				sum(statplayer.rebounds)/sum(statplayer.games) as rebounds,
				sum(statplayer.assists)/sum(statplayer.games) as assists,
				sum(statplayer.turnovers)/sum(statplayer.games) as turnovers,
				sum(statplayer.steals)/sum(statplayer.games) as steals,
				sum(statplayer.blocks)/sum(statplayer.games) as blocks,
				sum(statplayer.evaluation)/sum(statplayer.games) as efficiency 
			FROM player 
			LEFT JOIN person ON player.personId = person.personId 
			LEFT JOIN statplayer ON player.playerId = statplayer.playerId 
			WHERE statplayer.season = :season
		';
	}
	else
	{
		$sql = '
			SELECT 				
				player.playerId as playerId, 
				count(*) as games, 
				sum(statsgame.minutes)/count(*) as minutes, 
				sum(statsgame.points)/count(*) as points, 
				100*sum(statsgame.freeThrowsMade)/sum(statsgame.freeThrowsAttempt) as FTPercentage,
				100*sum(statsgame.twoPointsMade + statsgame.threePointsMade)/sum(statsgame.twoPointsAttempt + statsgame.threePointsAttempt) as FGPercentage,
				100*sum(statsgame.threePointsMade)/sum(statsgame.threePointsAttempt) as 3FGPercentage,
				sum(statsgame.offensiveRebounds)/count(*) as offRebounds,
				sum(statsgame.defensiveRebounds)/count(*) as defRebounds,
				sum(statsgame.rebounds)/count(*) as rebounds,
				sum(statsgame.assists)/count(*) as assists,
				sum(statsgame.turnovers)/count(*) as turnovers,
				sum(statsgame.steals)/count(*) as steals,
				sum(statsgame.blocks)/count(*) as blocks,
				sum(statsgame.evaluation)/count(*) as efficiency
			FROM player 
			LEFT JOIN person ON player.personId = person.personId 
			LEFT JOIN statsgame ON player.playerId = statsgame.playerId 
			LEFT JOIN game ON statsgame.gameId = game.gameId 
			WHERE statsgame.season = :season AND statsgame.playerId > 0
		';
		    
		if($period == 'October')
		{
			$sql .= ' AND month(game.date) = 10 ';
		}
		elseif($period == 'November')
		{
			$sql .= ' AND month(game.date) = 11 ';
		}
		elseif($period == 'December')
		{
			$sql .= ' AND month(game.date) = 12 ';
		}    
		elseif($period == 'January')
		{
			$sql .= ' AND month(game.date) = 1 ';
		}
		elseif($period == 'February')
		{
			$sql .= ' AND month(game.date) = 2 ';
		}
		elseif($period == 'March')
		{
			$sql .= ' AND month(game.date) = 3 ';
		}
		elseif($period == 'April')
		{
			$sql .= ' AND month(game.date) = 4 ';
		}
	}
	
    if($playerType == 'Rookie')
    {
        $sql .= ' AND player.experience = 0 ';
    }
    elseif($playerType == 'Sophomore')
    {
        $sql .= ' AND player.experience = 1 ';
    }
    
	if($period == 'Season')
	{
		$sql .= 'GROUP BY statplayer.playerId ';
	}
	else
	{
		$sql .= 'GROUP BY statsgame.playerId ';
	}	
	$sql .= 'ORDER BY ' . $stats . ' DESC';
	
	$season = getCurrentSeason();
	$request = $db->prepare($sql);
    
	$request->bindParam(':season',      $season,        PDO::PARAM_INT);	
	$request->execute();
	$players = $request->fetchAll();

	$id;
    foreach ($players as $key => $player) {
		$id = $player['playerId'];
		$inTeamPlayers[$id] = new Player($id);
	}
	$request->closeCursor();
    return $inTeamPlayers;
}

/**
  * Returns number of players in a given team by name
  */
function getNumberOfPlayersInATeam($teamId)
{
    global $db;
    $teams;
	$allTeams;
	
	$request = $db->prepare('   SELECT count(*) 
                                FROM player 
                                WHERE teamId = :teamId
                                AND salary > 0');
    $request->bindParam(':teamId', $teamId, PDO::PARAM_INT);
    
	$request->execute();    
	$numberOfPlayers = $request->fetch();
	$request->closeCursor();
    
    return $numberOfPlayers[0];
}

/**
  * Returns number of players in a given team by name
  */
function getTeamTotalSalary($teamId)
{
    global $db;
    $teams;
	$allTeams;
	
	$request = $db->prepare('   SELECT sum(salary) 
                                FROM player 
                                WHERE teamId = :teamId
                                AND salary > 0');
    $request->bindParam(':teamId', $teamId, PDO::PARAM_INT);
    
	$request->execute();    
	$teamSalary = $request->fetch();
	$request->closeCursor();
    
    return round($teamSalary[0],1);
}