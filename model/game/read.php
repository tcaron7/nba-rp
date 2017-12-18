<?php

/**
  * Returns a raw game using the gameId
  */
function getGameById($id)
{
    global $db;
	$request;
	$game;
	
	$request = $db->prepare('SELECT * FROM game WHERE gameId = :id');
	$request->bindParam(':id', $id, PDO::PARAM_INT);
	$request->execute();
	$game = $request->fetch();
	
	$request->closeCursor();
    return $game;
}

/**
  * Returns an array of games of a giving day
  */
function getGamesByDate($date)
{
    global $db;
	$request;
	$games;
	$gamesOfTheDay = null;
	
	$request = $db->prepare('SELECT gameId FROM game WHERE date = :date');
	$request->bindParam(':date', $date, PDO::PARAM_INT);
	$request->execute();
	$games = $request->fetchAll();

	$id;
	foreach ($games as $key => $game) {
		$id = $game['gameId'];
		$gamesOfTheDay[$id] = new Game($id, null, null, null);
	}
	
	$request->closeCursor();
    return $gamesOfTheDay;
}

/**
  * Returns an array of the games of a giving season year
  */
function getGamesBySeason($season)
{
    global $db;
	$games;
	$seasonGames;
	
	$request = $db->prepare('
		SELECT *
		FROM game
		WHERE season = :season
		ORDER BY date
	');
	$request->bindParam(':season', $season, PDO::PARAM_INT);
	$request->execute();
    $games = $request->fetchAll();
	
	$id;
	foreach ($games as $key => $game) {
		$id = $game['gameId'];
		$seasonGames[$id] = new Game($id, null, null, null);
	}
	
	$request->closeCursor();
    return $seasonGames;
}

/**
  * Returns an array of the games of a given season year and a given team
  */
function getTeamGamesBySeason($teamId, $season)
{
    global $db;
	$games;
	$seasonGames;
	
	$request = $db->prepare('
		SELECT *
		FROM game
		WHERE season = :season
		AND (homeTeamId = :homeTeamId OR visitorTeamId = :visitorTeamId)
		ORDER BY date
	');
	$request->bindParam(':season', 			$season, PDO::PARAM_INT);
	$request->bindParam(':homeTeamId', 		$teamId, PDO::PARAM_INT);
	$request->bindParam(':visitorTeamId', 	$teamId, PDO::PARAM_INT);
	$request->execute();
    $games = $request->fetchAll();
	
	$id;
	foreach ($games as $key => $game) {
		$id = $game['gameId'];
		$seasonGames[$id] = new Game($id, null, null, null);
	}
	
	$request->closeCursor();
    return $seasonGames;
}

/**
  * Returns an array of the games of the current day
  */
function getGamesOfCurrentDate()
{
    $currentDate = getCurrentDate();
	$dateGames   = getGamesByDate($currentDate);
	
    return $dateGames;
}

/**
  * Returns an array of the games of the current season
  */
function getGamesOfCurrentSeason()
{
    global $db;
	$seasonGames;
	
    $request = $db->prepare('
		SELECT year
		FROM season
		WHERE 1
		ORDER BY year DESC
		LIMIT 1
	');
	$request->execute();
    $currentSeason = $request->fetch();
	$currentSeason = $currentSeason['year'];
	
	$seasonGames = getGamesBySeason($currentSeason);
	
    $request->closeCursor();
    return $seasonGames;
}

/**
  * Returns home and visitor teams of a given game
  */
function getGameTeamsId($gameId)
{
	global $db;
	$gameTeams;
	
    $request = $db->prepare('
		SELECT homeTeamId, visitorTeamId
		FROM game
		WHERE gameId = :gameId
	');
	$request->bindParam(':gameId', $gameId, PDO::PARAM_INT);
	
	$request->execute();
    $gameTeamsId = $request->fetch();
	
	$gameTeams['homeTeam'] = $gameTeamsId['homeTeamId'];
	$gameTeams['visitorTeam'] = $gameTeamsId['visitorTeamId'];
	
    $request->closeCursor();
	
    return $gameTeams;
}