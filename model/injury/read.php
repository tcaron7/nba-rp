<?php

/**
  * Returns player injury status
  */
function getPlayerInjuryStatus($id)
{
	$currentDate = getCurrentDate();
	
	global $db;
	$request;
	$request = $db->prepare('   SELECT *
                                FROM injury 
                                WHERE
                                    playerId = :playerId
                                AND
                                    recoveryDate >= :currentDate
							');
	
    $request->bindParam(':playerId',	$id,			PDO::PARAM_INT);
    $request->bindParam(':currentDate',	$currentDate,	PDO::PARAM_STR);
    
	$request->execute();
    
	$playerInjury = $request->fetch();
    $request->closeCursor();
	
	if(isset($playerInjury['injurySeverity']))
	{
		$injuryStatus = $playerInjury['injurySeverity'];
	}
	else
	{
		$injuryStatus = 'Healthy';
	}

    return $injuryStatus;
}

/**
  * Returns current injuries
  */
function getCurrentInjuries()
{
	$currentDate = getCurrentDate();
	
	global $db;
	$request;
	$currentInjury;
	
	$request = $db->prepare('   SELECT injuryId
                                FROM injury 
                                WHERE
                                    recoveryDate >= :currentDate
								ORDER BY
									recoveryDate
							');
	
    $request->bindParam(':currentDate',	$currentDate,	PDO::PARAM_STR);
    
	$request->execute();
    
	$currentInjuriesId = $request->fetchAll();
    $request->closeCursor();

	foreach($currentInjuriesId as $currentInjuryId)
	{
		$currentInjury[$currentInjuryId['injuryId']] = new Injury($currentInjuryId['injuryId'], null);
	}

    return $currentInjury;
}

/**
  * Returns injury by Id
  */
function getInjuryById($id)
{
	$currentDate = getCurrentDate();
	
	global $db;
	$request;
	$injury;
	
	$request = $db->prepare('   SELECT *
                                FROM injury 
                                WHERE
									injuryId = :injuryId
							');
	$request->bindParam(':injuryId',	$id,			PDO::PARAM_INT);
    
	$request->execute();
    
	$injury = $request->fetch();
    $request->closeCursor();

    return $injury;
}