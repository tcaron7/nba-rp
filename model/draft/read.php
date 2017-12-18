<?php

/**
  * Returns a raw season using the year
  */
function getTeamNextDraftPick($numberYear, $teamId)
{
    global $db;
	$request;
	$tradedDraftPick;
	$numberYear = (int) $numberYear;
    $teamId     = (int) $teamId;
    
    $currentSeason = getCurrentSeason();
	
    $minYear = (int) $currentSeason;
    $maxYear = (int) $currentSeason+$numberYear;

	$request = $db->prepare('   SELECT *
                                FROM draftpick 
                                WHERE
                                    year >= :minYear
                                AND
                                    year < :maxYear
                                AND
                                    originalOwnerTeamId != currentOwnerTeamId
                                AND
                                    (originalOwnerTeamId = :teamId
                                    OR
                                    currentOwnerTeamId = :teamId)');
                                    
	$request->bindParam(':minYear', $minYear, PDO::PARAM_INT);
    $request->bindParam(':maxYear', $maxYear, PDO::PARAM_INT);
    $request->bindParam(':teamId',  $teamId,  PDO::PARAM_INT);
    
	$request->execute();
	$tradedDraftPicks = $request->fetchAll();
    
    $request->closeCursor();

    $index = 0;
    for($i = 0; $i < $numberYear; $i++)
    {
        $enableFirstRound  = 1;
        $enableSecondRound = 1;
        
        foreach ($tradedDraftPicks as $tradedDraftPick)
        {      
            if (
                ($tradedDraftPick['year'] == $currentSeason + $i) &&
                ($tradedDraftPick['currentOwnerTeamId'] != $teamId)
            )
            {
                if($tradedDraftPick['round'] == 1)
                {
                    $enableFirstRound  = 0; 
                }
                elseif($tradedDraftPick['round'] == 2)
                {
                    $enableSecondRound = 0;   
                }
            }
        }
        
        if($enableFirstRound == 1)
        {
            $teamDraftPick[2 * $i] = new DraftPick(null, $currentSeason + $i, 1, $teamId, $teamId, 0);
            $index = $index + 1;
        }
        if($enableSecondRound == 1)
        {
            $teamDraftPick[2 * $i + 1] = new DraftPick(null, $currentSeason + $i, 2, $teamId, $teamId, 0);
            $index = $index + 1;
        }
    }
    
    foreach($tradedDraftPicks as $tradedDraftPick)
    {
        if (
            ($tradedDraftPick['currentOwnerTeamId']  == $teamId) &&
            ($tradedDraftPick['originalOwnerTeamId'] != $teamId)
        )
        {
            $teamDraftPick[$index] = new DraftPick(null, $tradedDraftPick['year'], $tradedDraftPick['round'], $teamId, $tradedDraftPick['originalOwnerTeamId'], 0);
            $index = $index + 1;
        }
    }
    return $teamDraftPick;
}

/**
  * Returns a DraftPick object from the year, round and original owner of the pick
  */
function getDraftPickFromPickData($originalOwnerTeamId, $year, $round)
{
    global $db;
	$request;

	$request = $db->prepare('   SELECT *
                                FROM draftpick 
                                WHERE
                                    originalOwnerTeamId = :originalOwnerTeamId
                                AND
                                    year                = :year
                                AND
                                    round               = :round');
                                    
	$request->bindParam(':originalOwnerTeamId', $originalOwnerTeamId,   PDO::PARAM_INT);
    $request->bindParam(':year',                $year,                  PDO::PARAM_INT);
    $request->bindParam(':round',               $round,                 PDO::PARAM_INT);
    
	$request->execute();
	$draftPickData = $request->fetch();
    
    $request->closeCursor();
    
    if(!empty($draftPickData))
    {
        $draftPick = new DraftPick($draftPickData, null, null, null, null, null);
    }
    else
    {
        $draftPick = new DraftPick(null, $year, $round, $originalOwnerTeamId, $originalOwnerTeamId, 0);
    }
    
    return $draftPick;
}

/**
  * Check if a draft pick has already been written in the draftpick table
  */
function checkDraftPickExistence($originalOwnerTeamId, $year, $round)
{
    global $db;
	$request;

    $request = $db->prepare('
        SELECT draftPickId
        FROM draftpick
        WHERE originalOwnerTeamId = :originalOwnerTeamId
        AND year = :year
        AND round = :round
    ');
    $request->bindValue(':originalOwnerTeamId', $originalOwnerTeamId,   PDO::PARAM_INT);
    $request->bindValue(':year',                $year,                  PDO::PARAM_INT);
    $request->bindValue(':round',               $round,                 PDO::PARAM_INT);
    
    $request->execute();
    
    $id = $request->fetch();

    $request->closeCursor();
    return $id[0];
}

/**
  * Check if the lottery has been done
  */
function checkLottery($year)
{
    global $db;
	$request;
    
    $request = $db->prepare('
        SELECT min(choiceNumber)
        FROM draftpick
        WHERE year = :year
    ');
    $request->bindValue(':year', $year, PDO::PARAM_INT);
    
    $request->execute();
    $minChoiceNumber = intval($request->fetch());
    
    $request->closeCursor();
    
    if(empty($minChoiceNumber) or $minChoiceNumber == 0)
    {
        $lotteryDone = 0;
    }
    else
    {
        $lotteryDone = 1;
    }
    return $lotteryDone;
}

/**
  * Get all ordered draft picks from a given year
  */
function getDraftPickByYear($year)
{
    global $db;
	$request;
    
    $request = $db->prepare('
        SELECT *
        FROM draftpick
        WHERE year = :year
        ORDER BY round, choiceNumber
    ');
    $request->bindValue(':year', $year, PDO::PARAM_INT);
    
    $request->execute();
    $draftPicksData = $request->fetchAll();
    
    $request->closeCursor();
    
    $pick = 1;
    foreach($draftPicksData as $draftPickData)
    {
        $draftPicks[$pick] = new DraftPick($draftPickData, null, null, null, null, null);
        $pick = $pick + 1;
        
    }
    return $draftPicks;
}

/**
  * Get all ordered draft picks from a given year
  */
function getNextDraftPick()
{
    $year = getCurrentYear();
    global $db;
	$request;
    
    $request = $db->prepare('
        SELECT *
        FROM draftpick
        WHERE year = :year
        AND playerId = 0
        ORDER BY round ASC, choiceNumber ASC
        LIMIT 1
    ');
    $request->bindValue(':year', $year, PDO::PARAM_INT);
    
    $request->execute();
    $draftPickData = $request->fetch();
    
    $request->closeCursor();
    
    $draftPick = new DraftPick($draftPickData, null, null, null, null, null);
        
    return $draftPick;
}

/**
  * Get all ordered draft picks from a given year
  */
function getDraftPositionOfGivenProspectInGivenDraft($prospectId, $year)
{
    $year = getCurrentYear();
    global $db;
	$request;
    
    $request = $db->prepare('
        SELECT *
        FROM draftpick
        WHERE year = :year
        AND playerId = :prospectId
    ');
    $request->bindValue(':year',        $year,          PDO::PARAM_INT);
    $request->bindValue(':prospectId',  $prospectId,    PDO::PARAM_INT);
    
    $request->execute();
    $draftPickData = $request->fetch();
    
    $request->closeCursor();
    
    if(!empty($draftPickData))
    {
        $draftPick = new DraftPick($draftPickData, null, null, null, null, null);
    }
    else
    {
        $draftPick = new DraftPick(null, null, null, null, null, null);
    }
        
    return $draftPick;
}

/**
  * Return true if the draft has started, else false
  */
function checkIfDraftHasStarted($year)
{
    global $db;
	$request;
    
    $request = $db->prepare('
        SELECT (max(playerId)) as maxId
        FROM draftpick
        WHERE year = :year
    ');
    $request->bindValue(':year',        $year,          PDO::PARAM_INT);
    
    $request->execute();
    $draftPickData = $request->fetch();
    
    $request->closeCursor();
    
    if($draftPickData['maxId'] > 0)
    {
        $check = true;
    }
    else
    {
        $check = false;
    }
        
    return $check;
}

/**
  * Return year of draft history
  */
function getPreviousDraftYear()
{
    global $db;
	$request;
    
    $request = $db->prepare('
        SELECT year, min(playerId) as draftCheck
        FROM draftpick
        GROUP BY year
		HAVING draftCheck > 0
    ');
    
    $request->execute();
    $draftYear = $request->fetchAll();
    
    $request->closeCursor();
        
    return $draftYear;
}