<?php

/**
  * Returns the raw stats of a player for a giving season in a giving team
  */
function getStatPlayerByIdAndSeason($playerId, $season)
{
    global $db;
	$request;
    $playerStats;

	$request = $db->prepare('
	SELECT
		max(statsId) as statsId,
		playerId,
		teamId,
		season,
		sum(games) as games,
		sum(minutes) as minutes,
		sum(points) as points,
		sum(freeThrowsMade) as freeThrowsMade,
		sum(freeThrowsAttempt) as freeThrowsAttempt,
		sum(twoPointsMade) as twoPointsMade,
		sum(twoPointsAttempt) as twoPointsAttempt,
		sum(threePointsMade) as threePointsMade,
		sum(threePointsAttempt) as threePointsAttempt,
		sum(offensiveRebounds) as offensiveRebounds,
		sum(defensiveRebounds) as defensiveRebounds,
		sum(rebounds) as rebounds,
		sum(assists) as assists,
		sum(turnovers) as turnovers,
		sum(steals) as steals,
		sum(blocks) as blocks,
		sum(evaluation) as evaluation
	FROM statplayer
	WHERE season = :season AND playerId = :playerId
	GROUP BY playerId
	');
	$request->bindParam(':season',   $season,   PDO::PARAM_INT);
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	
	$request->execute();
	$playerStats = $request->fetch();
    
	$request->closeCursor();
    return $playerStats;
}

/**
  * Returns the raw stats of a player for a giving season in a giving team
  */
function getStatPlayerByIdAndSeasonAndTeamId($playerId, $season, $teamId)
{
    global $db;
	$request;
    $playerStats;

	$request = $db->prepare('
	SELECT
		max(statsId) as statsId,
		playerId,
		teamId,
		season,
		games,
		sum(minutes) as minutes,
		sum(points) as points,
		sum(freeThrowsMade) as freeThrowsMade,
		sum(freeThrowsAttempt) as freeThrowsAttempt,
		sum(twoPointsMade) as twoPointsMade,
		sum(twoPointsAttempt) as twoPointsAttempt,
		sum(threePointsMade) as threePointsMade,
		sum(threePointsAttempt) as threePointsAttempt,
		sum(offensiveRebounds) as offensiveRebounds,
		sum(defensiveRebounds) as defensiveRebounds,
		sum(rebounds) as rebounds,
		sum(assists) as assists,
		sum(turnovers) as turnovers,
		sum(steals) as steals,
		sum(blocks) as blocks,
		sum(evaluation) as evaluation
	FROM statplayer
	WHERE season = :season AND teamId = :teamId AND playerId = :playerId
	GROUP BY playerId
	');
	$request->bindParam(':teamId', 	 $teamId, 	PDO::PARAM_INT);
	$request->bindParam(':season',   $season,   PDO::PARAM_INT);
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	
	$request->execute();
	$playerStats = $request->fetch();
    
	$request->closeCursor();
    return $playerStats;
}

/**
  * Returns home stats of a player for a giving season
  */
function getHomeStatPlayerByIdAndSeason($playerId, $season)
{	
    global $db;
	$request;
    $playerHomeStats;

	$request = $db->prepare('
		SELECT
            max(statsgame.statsId) as statsId,
            statsgame.playerId,
			statsgame.playerTeamId,
            statsgame.season,
            count(*) as games,
            sum(statsgame.minutes) as minutes,
            sum(statsgame.points) as points,
            sum(statsgame.freeThrowsMade) as freeThrowsMade,
            sum(statsgame.freeThrowsAttempt) as freeThrowsAttempt,
            sum(statsgame.twoPointsMade) as twoPointsMade,
            sum(statsgame.twoPointsAttempt) as twoPointsAttempt,
            sum(statsgame.threePointsMade) as threePointsMade,
            sum(statsgame.threePointsAttempt) as threePointsAttempt,
            sum(statsgame.offensiveRebounds) as offensiveRebounds,
            sum(statsgame.defensiveRebounds) as defensiveRebounds,
            sum(statsgame.rebounds) as rebounds,
            sum(statsgame.assists) as assists,
            sum(statsgame.turnovers) as turnovers,
            sum(statsgame.steals) as steals,
            sum(statsgame.blocks) as blocks,
            sum(statsgame.evaluation) as evaluation
		FROM statsgame
		LEFT JOIN game
		ON game.gameId = statsgame.gameId
		WHERE statsgame.season = :season AND statsgame.playerId = :playerId AND game.homeTeamId = statsgame.playerTeamId
        GROUP BY statsgame.playerId
	');
	$request->bindParam(':season',   $season,   PDO::PARAM_INT);
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	
	$request->execute();
	$playerHomeStats = $request->fetch();
    
	$request->closeCursor();
    return $playerHomeStats;
}

/**
  * Returns away stats of a player for a giving season
  */
function getRoadStatPlayerByIdAndSeason($playerId, $season)
{	
    global $db;
	$request;
    $playerAwayStats;

	$request = $db->prepare('
		SELECT
            max(statsgame.statsId) as statsId,
            statsgame.playerId,
			statsgame.playerTeamId,
            statsgame.season,
            count(*) as games,
            sum(statsgame.minutes) as minutes,
            sum(statsgame.points) as points,
            sum(statsgame.freeThrowsMade) as freeThrowsMade,
            sum(statsgame.freeThrowsAttempt) as freeThrowsAttempt,
            sum(statsgame.twoPointsMade) as twoPointsMade,
            sum(statsgame.twoPointsAttempt) as twoPointsAttempt,
            sum(statsgame.threePointsMade) as threePointsMade,
            sum(statsgame.threePointsAttempt) as threePointsAttempt,
            sum(statsgame.offensiveRebounds) as offensiveRebounds,
            sum(statsgame.defensiveRebounds) as defensiveRebounds,
            sum(statsgame.rebounds) as rebounds,
            sum(statsgame.assists) as assists,
            sum(statsgame.turnovers) as turnovers,
            sum(statsgame.steals) as steals,
            sum(statsgame.blocks) as blocks,
            sum(statsgame.evaluation) as evaluation
		FROM statsgame
		LEFT JOIN game
		ON game.gameId = statsgame.gameId
		WHERE statsgame.season = :season AND statsgame.playerId = :playerId AND game.visitorTeamId = statsgame.playerTeamId
        GROUP BY statsgame.playerId
	');
	$request->bindParam(':season',   $season,   PDO::PARAM_INT);
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	
	$request->execute();
	$playerAwayStats = $request->fetch();
    
	$request->closeCursor();
    return $playerAwayStats;
}

/**
  * Returns wins stats of a player for a giving season
  */
function getWinsStatPlayerByIdAndSeason($playerId, $season)
{	
    global $db;
	$request;
    $playerHomeStats;

	$request = $db->prepare('
		SELECT
            max(statsgame.statsId) as statsId,
            statsgame.playerId,
			statsgame.playerTeamId,
            statsgame.season,
            count(*) as games,
            sum(statsgame.minutes) as minutes,
            sum(statsgame.points) as points,
            sum(statsgame.freeThrowsMade) as freeThrowsMade,
            sum(statsgame.freeThrowsAttempt) as freeThrowsAttempt,
            sum(statsgame.twoPointsMade) as twoPointsMade,
            sum(statsgame.twoPointsAttempt) as twoPointsAttempt,
            sum(statsgame.threePointsMade) as threePointsMade,
            sum(statsgame.threePointsAttempt) as threePointsAttempt,
            sum(statsgame.offensiveRebounds) as offensiveRebounds,
            sum(statsgame.defensiveRebounds) as defensiveRebounds,
            sum(statsgame.rebounds) as rebounds,
            sum(statsgame.assists) as assists,
            sum(statsgame.turnovers) as turnovers,
            sum(statsgame.steals) as steals,
            sum(statsgame.blocks) as blocks,
            sum(statsgame.evaluation) as evaluation
		FROM statsgame
		LEFT JOIN game
		ON game.gameId = statsgame.gameId
		WHERE statsgame.season = :season AND statsgame.playerId = :playerId AND game.winnerId = statsgame.playerTeamId
        GROUP BY statsgame.playerId
	');
	$request->bindParam(':season',   $season,   PDO::PARAM_INT);
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	
	$request->execute();
	$playerHomeStats = $request->fetch();
    
	$request->closeCursor();
    return $playerHomeStats;
}

/**
  * Returns losses stats of a player for a giving season
  */
function getLossesStatPlayerByIdAndSeason($playerId, $season)
{	
    global $db;
	$request;
    $playerHomeStats;

	$request = $db->prepare('
		SELECT
            max(statsgame.statsId) as statsId,
            statsgame.playerId,
			statsgame.playerTeamId,
            statsgame.season,
            count(*) as games,
            sum(statsgame.minutes) as minutes,
            sum(statsgame.points) as points,
            sum(statsgame.freeThrowsMade) as freeThrowsMade,
            sum(statsgame.freeThrowsAttempt) as freeThrowsAttempt,
            sum(statsgame.twoPointsMade) as twoPointsMade,
            sum(statsgame.twoPointsAttempt) as twoPointsAttempt,
            sum(statsgame.threePointsMade) as threePointsMade,
            sum(statsgame.threePointsAttempt) as threePointsAttempt,
            sum(statsgame.offensiveRebounds) as offensiveRebounds,
            sum(statsgame.defensiveRebounds) as defensiveRebounds,
            sum(statsgame.rebounds) as rebounds,
            sum(statsgame.assists) as assists,
            sum(statsgame.turnovers) as turnovers,
            sum(statsgame.steals) as steals,
            sum(statsgame.blocks) as blocks,
            sum(statsgame.evaluation) as evaluation
		FROM statsgame
		LEFT JOIN game
		ON game.gameId = statsgame.gameId
		WHERE statsgame.season = :season AND statsgame.playerId = :playerId AND game.loserId = statsgame.playerTeamId
        GROUP BY statsgame.playerId
	');
	$request->bindParam(':season',   $season,   PDO::PARAM_INT);
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	
	$request->execute();
	$playerHomeStats = $request->fetch();
    
	$request->closeCursor();
    return $playerHomeStats;
}

/**
  * Returns losses stats of a player for a giving season
  */
function getMonthsStatPlayerByIdAndSeason($playerId, $season)
{	
    global $db;
	$request;
    $playerHomeStats;

	$request = $db->prepare('
		SELECT
            max(statsgame.statsId) as statsId,
            statsgame.playerId,
			statsgame.playerTeamId,
            statsgame.season,
            count(*) as games,
			month(game.date) as month,
            sum(statsgame.minutes) as minutes,
            sum(statsgame.points) as points,
            sum(statsgame.freeThrowsMade) as freeThrowsMade,
            sum(statsgame.freeThrowsAttempt) as freeThrowsAttempt,
            sum(statsgame.twoPointsMade) as twoPointsMade,
            sum(statsgame.twoPointsAttempt) as twoPointsAttempt,
            sum(statsgame.threePointsMade) as threePointsMade,
            sum(statsgame.threePointsAttempt) as threePointsAttempt,
            sum(statsgame.offensiveRebounds) as offensiveRebounds,
            sum(statsgame.defensiveRebounds) as defensiveRebounds,
            sum(statsgame.rebounds) as rebounds,
            sum(statsgame.assists) as assists,
            sum(statsgame.turnovers) as turnovers,
            sum(statsgame.steals) as steals,
            sum(statsgame.blocks) as blocks,
            sum(statsgame.evaluation) as evaluation
		FROM statsgame
		LEFT JOIN game
		ON game.gameId = statsgame.gameId
		WHERE statsgame.season = :season AND statsgame.playerId = :playerId
        GROUP BY statsgame.playerId, month
	');
	$request->bindParam(':season',   $season,   PDO::PARAM_INT);
	$request->bindParam(':playerId', $playerId, PDO::PARAM_INT);
	
	$request->execute();
	$playerHomeStats = $request->fetchAll();
    
	$request->closeCursor();
    return $playerHomeStats;
}

/**
  * Returns the raw stats of a player for a giving season
  */
function getCurrentSeasonTeamStats($teamId, $season)
{
    global $db;
	$request;
    $teamStats;
	
	$request = $db->prepare('
		SELECT
            max(statsId) as statsId,
            season,
            count(*) as games,
            sum(minutes) as minutes,
            sum(points) as points,
            sum(freeThrowsMade) as ftm,
            sum(freeThrowsAttempt) as fta,
            sum(twoPointsMade) as fgm,
            sum(twoPointsAttempt) as fga,
            sum(threePointsMade) as 3fgm,
            sum(threePointsAttempt) as 3fga,
            sum(offensiveRebounds) as offensiveRebounds,
            sum(defensiveRebounds) as defensiveRebounds,
            sum(rebounds) as rebounds,
            sum(assists) as assists,
            sum(turnovers) as turnovers,
            sum(steals) as steals,
            sum(blocks) as blocks,
            sum(evaluation) as evaluation
		FROM statsgame
		WHERE season = :season 
		AND playerTeamId = :playerTeamId
		AND playerId = 0
        GROUP BY playerId
	');
	$request->bindParam(':season',       $season, PDO::PARAM_INT);
	$request->bindParam(':playerTeamId', $teamId, PDO::PARAM_INT);
	
	$request->execute();
	$teamStats = $request->fetch();

	$request->closeCursor();
    return $teamStats;
}

/**
  * Returns home and visitor teams stats of a given game
  */
function getGameTeamsStats($gameId)
{
	global $db;
	$playersGameStats;
	
	// Get players game stats
    $request = $db->prepare('
		SELECT *
		FROM statsgame 
		WHERE gameId = :gameId
	');
	$request->bindParam(':gameId', 		$gameId, 		PDO::PARAM_INT);
	
	$request->execute();
    $playersGameStats = $request->fetchAll();
	
    $request->closeCursor();
	
    return $playersGameStats;
}

/**
  * Returns all games stats of a given player for a given season
  */
function getPlayerGamesLogsOfASeason($playerId, $season)
{
	global $db;
	$playerGamesLogs;
	
	// Get players game stats
    $request = $db->prepare('
		SELECT *
		FROM statsgame
		LEFT JOIN game ON statsgame.gameId = game.gameId
		WHERE statsgame.playerId = :playerId
		AND   statsgame.season   = :season	
	');
	$request->bindParam(':playerId', 	$playerId, 		PDO::PARAM_INT);
	$request->bindParam(':season',		$season, 		PDO::PARAM_INT);
	
	$request->execute();
    $playerGamesLogs = $request->fetchAll();
	
    $request->closeCursor();
	
    return $playerGamesLogs;
}

/**
  * Returns home and visitor teams stats of a given game
  */
function getSeasonPlayersStatsOfATeam($teamId, $season)
{
	global $db;
	$playersTeamStats;
	
	// Get players game stats
    $request = $db->prepare('
		SELECT
            max(statsId) as statsId,
            playerId,
            season,
            count(*) as games,
            sum(minutes) as minutes,
            sum(points) as points,
            sum(freeThrowsMade) as freeThrowsMade,
            sum(freeThrowsAttempt) as freeThrowsAttempt,
            sum(twoPointsMade) as twoPointsMade,
            sum(twoPointsAttempt) as twoPointsAttempt,
            sum(threePointsMade) as threePointsMade,
            sum(threePointsAttempt) as threePointsAttempt,
            sum(offensiveRebounds) as offensiveRebounds,
            sum(defensiveRebounds) as defensiveRebounds,
            sum(rebounds) as rebounds,
            sum(assists) as assists,
            sum(turnovers) as turnovers,
            sum(steals) as steals,
            sum(blocks) as blocks,
            sum(evaluation) as evaluation
		FROM statsgame
		WHERE season = :season AND playerTeamId = :teamId
        GROUP BY playerId
	');
	$request->bindParam(':season', $season, PDO::PARAM_INT);
	$request->bindParam(':teamId', $teamId, PDO::PARAM_INT);
	
	$request->execute();
    $playersTeamStats = $request->fetchAll();
	
    $request->closeCursor();
	
    return $playersTeamStats;
}

/**
  * Returns home and visitor teams stats of a given game
  */
function isStatPlayerDataExist($playerId, $currentSeason, $teamId)
{
	global $db;
	//$request;
    
    // Update player stat
    $request = $db->prepare('
        SELECT statsId
        FROM statplayer
        WHERE
            playerId = :playerId AND
            season = :season AND
            teamId = :teamId
        '
    );
    
    $request->bindValue(':playerId',    $playerId,     PDO::PARAM_INT);
    $request->bindValue(':season',      $currentSeason, PDO::PARAM_INT);
    $request->bindValue(':teamId',      $teamId,        PDO::PARAM_INT);
    $request->execute();
    $statId = $db->lastInsertId();

    $request->closeCursor();
    
    if($statId != NULL)
    {
        $isStatPlayerDataExist = true;
    }
    else
    {
        $isStatPlayerDataExist = false;
    }
    return $isStatPlayerDataExist;
}