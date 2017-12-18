<?php
/**
  * Update check if an award is attributed
  */
function checkAwardAttribution($season,$month,$award)
{
	global $db;
	$request;

    $request = $db->prepare('
        SELECT awardId
        FROM awards
        WHERE season = :season
        AND   month  = :month
        AND   award  = :award');
	
    $request->bindValue(':season',  $season,    PDO::PARAM_INT);
    $request->bindValue(':month',   $month,	    PDO::PARAM_INT);
    $request->bindValue(':award',   $award,     PDO::PARAM_STR);
    
	$request->execute();
    $awardPlayerId = $request->fetchAll();
    
    $request->closeCursor();

    if(empty($awardPlayerId))
    {
        $checkAwardAttribution = false;
    }
    else
    {
        $checkAwardAttribution = true;
    }
    
    return $checkAwardAttribution;
}

/**
  * Get awards distributed in a given season
  */
function getSeasonAwards($season)
{
    global $db;
	$request;

    $request = $db->prepare('
        SELECT awardId
        FROM awards
        WHERE season = :season');
	
    $request->bindValue(':season',  $season,    PDO::PARAM_INT);
    
	$request->execute();
    $awardsId = $request->fetchAll();
    
    foreach($awardsId as $awardId)
	{
		$awards[$awardId['awardId']] = new Award($awardId['awardId'], null);
	}
    
    $request->closeCursor();
    return $awards;
}

/**
  * Get an award by a given id
  */
function getAwardById($id)
{
    global $db;
	$request;

    $request = $db->prepare('
        SELECT *
        FROM awards
        WHERE awardId = :awardId');
	
    $request->bindValue(':awardId',  $id,    PDO::PARAM_INT);
    
	$request->execute();
    $award = $request->fetch();
    
    $request->closeCursor();
    return $award;
}

/**
  * Get winner of a given player of the month award
  */
function getMonthAwardWinner($season, $month, $award)
{
    global $db;
	$request;

    $request = $db->prepare('
        SELECT playerId, teamId
        FROM awards
        WHERE season = :season
        AND   month  = :month 
        AND   award  = :award
        ');
	
    $request->bindValue(':season',  $season,    PDO::PARAM_INT);
    $request->bindValue(':month',   $month,     PDO::PARAM_INT);
    $request->bindValue(':award',   $award,     PDO::PARAM_INT);
    
	$request->execute();
    $awardWinnerIds = $request->fetch();
    $request->closeCursor();
    
    if(!empty($awardWinnerIds))
    {
        $winner     = new Player($awardWinnerIds['playerId']);
        $winnerTeam = new Team($awardWinnerIds['teamId']);
        $winnerStr = $winner->getFullname() . '(' . $winnerTeam->getName() . ')'; 
    }
    else
    {
        $winnerStr = '';
    }
    
    return $winnerStr;
}

/**
  * Get winner of a given season award
  */
function getSeasonAwardWinner($season, $award)
{
    global $db;
	$request;

    $request = $db->prepare('
        SELECT playerId, teamId
        FROM awards
        WHERE season = :season 
        AND   award  = :award
        ');
	
    $request->bindValue(':season',  $season,    PDO::PARAM_INT);
    $request->bindValue(':award',   $award,     PDO::PARAM_INT);
    
	$request->execute();
    $awardWinnerIds = $request->fetch();
    $request->closeCursor();
    
    if(!empty($awardWinnerIds))
    {
        $winner     = new Player($awardWinnerIds['playerId']);
        $winnerTeam = new Team($awardWinnerIds['teamId']);
        $winnerStr = $winner->getFullname() . '(' . $winnerTeam->getName() . ')'; 
    }
    else
    {
        $winnerStr = '';
    }
    
    return $winnerStr;
}