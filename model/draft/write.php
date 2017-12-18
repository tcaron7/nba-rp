<?php

/**
  * Returns a raw season using the year
  */
function updateDraftChoice($data)
{
    global $db;
	$request;

	$request = $db->prepare('   UPDATE draftpick 
                                SET
                                    choiceNumber = :choiceNumber
                                WHERE
                                    year = :year
                                AND
                                    round = :round
                                AND
                                    originalOwnerTeamId = :originalOwnerTeamId');
                                    
	$request->bindValue(':choiceNumber',        $data->getDraftPick(),                  PDO::PARAM_INT);
    $request->bindValue(':year',                $data->getYear(),                       PDO::PARAM_INT);
    $request->bindValue(':round',               $data->getDraftRound(),                 PDO::PARAM_INT);
    $request->bindValue(':originalOwnerTeamId', $data->getOriginalOwnerTeam()->getId(), PDO::PARAM_INT);
    
	$request->execute();
    
    $request->closeCursor();

    return 1;
}

/**
  * Returns a raw season using the year
  */
function insertDraftPick($year, $round, $teamId)
{
    global $db;
	$request;

    $request = $db->prepare('
        INSERT INTO draftpick (
            year,
            round,
            originalOwnerTeamId,
            currentOwnerTeamId
        )
        VALUES (
            :year,
            :round,
            :originalOwnerTeamId,
            :currentOwnerTeamId
        )
    ');
    $request->bindValue(':year',                $year,      PDO::PARAM_INT);
    $request->bindValue(':round',               $round,     PDO::PARAM_INT);
    $request->bindValue(':originalOwnerTeamId', $teamId,    PDO::PARAM_INT);
    $request->bindValue(':currentOwnerTeamId',  $teamId,    PDO::PARAM_INT);
    
	$request->execute();
    
    $request->closeCursor();

    return 1;
}

/**
  * Returns a raw season using the year
  */
function updateSelectedPlayerInPick($pick, $prospectId)
{
    $prospectId = intval($prospectId);
    global $db;
	$request;

	$request = $db->prepare('   UPDATE draftpick 
                                SET
                                    playerId = :playerId
                                WHERE
                                    year = :year
                                AND
                                    round = :round
                                AND
                                    choiceNumber = :choiceNumber');
                                    
	$request->bindValue(':choiceNumber',    $pick->getDraftPick(),  PDO::PARAM_INT);
    $request->bindValue(':year',            $pick->getYear(),       PDO::PARAM_INT);
    $request->bindValue(':round',           $pick->getDraftRound(), PDO::PARAM_INT);
    $request->bindValue(':playerId',        $prospectId,            PDO::PARAM_INT);
    
	$request->execute();
    
    $request->closeCursor();

    return 1;
}