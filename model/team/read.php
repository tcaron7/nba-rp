<?php

/**
  * Returns a team using teamId
  */
function getTeamById($id)
{
    global $db;
    $id = (int) $id;
	
	if ( $id >= 1 and $id <= 30)
	{
		$request = $db->prepare('SELECT * FROM team WHERE teamId = :id LIMIT 1');
		$request->bindParam(':id', $id, PDO::PARAM_INT);
		$request->execute();
		$team = $request->fetch();
    
		$request->closeCursor();
	}
	else
	{
		$team = NULL;
	}

    return $team;
}

/**
  * Returns all teams ordered by name
  */
function getAllTeamOrderByName()
{
    global $db;
    $teams;
	$allTeams;
	
	$request = $db->prepare('SELECT teamId FROM team');
	$request->execute();
	$teams = $request->fetchAll();
	
	$id;
	foreach ($teams as $key => $team) {
		$id = $team['teamId'];
		$allTeam[$id] = new Team($id);
	}
	
	$request->closeCursor();
    return $allTeam;
}

/**
  * Returns all teams with players ordered by name
  */
function getAllTeamsWithPlayersOrderByName()
{
    global $db;
    $teams;
	$allTeams;
	
	$request = $db->prepare('SELECT teamId FROM team');
	$request->execute();
	$teams = $request->fetchAll();
	
	$id;
	foreach ($teams as $key => $team) {
		$id = $team['teamId'];
		$allTeam[$id] = new Team($id);
		$allTeam[$id]->getPlayers();
	}
	
	$request->closeCursor();
    return $allTeam;
}

/**
  * Returns all west teams ordered by name
  */
function getAllWestTeamsOrderByName()
{
    global $db;
    $teams;
	$allTeams;
	
	$request = $db->prepare('SELECT * FROM team WHERE conference like "West"');
	$request->execute();
	$teams = $request->fetchAll();
	
	$id;
	foreach ($teams as $key => $team) {
		$id = $team['teamId'];
		$allTeam[$id] = new Team($id);
	}
	
	$request->closeCursor();
    return $allTeam;
}

/**
  * Returns all east teams ordered by name
  */
function getAllEastTeamsOrderByName()
{
    global $db;
    $teams;
	$allTeams;
	
	$request = $db->prepare('SELECT * FROM team WHERE conference like "East"');
	$request->execute();
	$teams = $request->fetchAll();
	
	$id;
	foreach ($teams as $key => $team) {
		$id = $team['teamId'];
		$allTeam[$id] = new Team($id);
	}
	
	$request->closeCursor();
    return $allTeam;
}