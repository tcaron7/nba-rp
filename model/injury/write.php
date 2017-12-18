<?php

/**
  * Returns a raw season using the year
  */
function updateInjury($injury)
{
	global $db;
	$request;

    $request = $db->prepare('
        INSERT INTO injury (
            playerId,
            injuryDate,
            recoveryDate,
            injurySeverity
        )
        VALUES (
            :playerId,
            :injuryDate,
            :recoveryDate,
            :injurySeverity
        )
    ');
	
    $request->bindValue(':playerId',		$injury->getPlayerId(),		PDO::PARAM_INT);
    $request->bindValue(':injuryDate',		$injury->getInjuryDate(),	PDO::PARAM_STR);
    $request->bindValue(':recoveryDate',	$injury->getRecoveryDate(),	PDO::PARAM_STR);
    $request->bindValue(':injurySeverity',	$injury->getSeverity(),		PDO::PARAM_STR);
    
	$request->execute();
    
    $request->closeCursor();

    return 1;
}