<?php

/**
  * Inserts a raw player in database
  */
function insertProspect($player)
{
	global $db;
	$request;
	
	// Insert person
	$personId = insertPerson($player);
	
    if(isset($personId))
    {
        // Insert player
        $request = $db->prepare('
            INSERT INTO prospect (
                personId,
                position,
                ranking,
                predictedDraftYear,
                actualDraftYear,
                cursusType
            )
            VALUES (
                :personId,
                :position,
                :ranking,
                :predictedDraftYear,
                :actualDraftYear,
                :cursusType
            )
        ');
        
        $request->bindValue(':personId',           $personId,                        PDO::PARAM_INT);
        $request->bindValue(':position',           $player->getPosition(),           PDO::PARAM_STR);
        $request->bindValue(':ranking',            $player->getRanking(),            PDO::PARAM_INT);
        $request->bindValue(':predictedDraftYear', $player->getPredictedDraftYear(), PDO::PARAM_INT);
        $request->bindValue(':actualDraftYear',    $player->getPredictedDraftYear(), PDO::PARAM_INT);
        $request->bindValue(':cursusType',         $player->getCursusType(),         PDO::PARAM_STR);

        
        $request->execute();
        $playerId = $db->lastInsertId();
        
        $request->closeCursor();
    }
    return $playerId;
}

/**
  * Update prospect draft year
  */
function updateProspectDraftYear($prospectId)
{
	global $db;
	$request;
	
    $year = intval(getCurrentYear());
    
    // Insert player
    $request = $db->prepare('
        UPDATE 
            prospect
        SET
            actualDraftYear = :actualDraftYear
        WHERE
            prospectId = :prospectId
    ');
    
    $request->bindValue(':prospectId',          $prospectId,    PDO::PARAM_INT);
    $request->bindValue(':actualDraftYear',     $year,          PDO::PARAM_INT);

    $request->execute();
    
    $request->closeCursor();
    
    return 1;
}