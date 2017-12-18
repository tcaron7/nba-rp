<?php

/**
  * Inserts a raw player in database
  */
function insertPlayer($player, $personId)
{
	global $db;
	$request;
	
	// Insert person
    if(is_null($personId))
    {
        $personId = insertPerson($player);
    }
	
	
    if(isset($personId))
    {
        // Insert player
        $request = $db->prepare('
            INSERT INTO player (
                personId,
                teamId,
                position,
                salary,
                guarantedYear,
                optionalYear,
                contractType,
                experience,
                draftPromotion,
                draftPosition
            )
            VALUES (
                :personId,
                :teamId,
                :position,
                :salary,
                :guarantedYear,
                :optionalYear,
                :contractType,
                :experience,
                :draftPromotion,
                :draftPosition
            )
        ');
        
        $request->bindValue(':personId',       $personId,                       PDO::PARAM_INT);
        $request->bindValue(':teamId',         $player->getTeamId(),            PDO::PARAM_INT);
        $request->bindValue(':position',       $player->getPosition(),          PDO::PARAM_STR);
        $request->bindValue(':salary',         $player->getSalary(),            PDO::PARAM_STR);
        $request->bindValue(':guarantedYear',  $player->getGuarantedYear(),     PDO::PARAM_INT);
        $request->bindValue(':optionalYear',   $player->getOptionalYear(),      PDO::PARAM_INT);
        $request->bindValue(':contractType',   $player->getContractType(),      PDO::PARAM_STR);
        $request->bindValue(':experience',     $player->getExperience(),        PDO::PARAM_INT);
        $request->bindValue(':draftPromotion', $player->getDraftPromotion(),    PDO::PARAM_INT);
        $request->bindValue(':draftPosition',  $player->getDraftPosition(),     PDO::PARAM_INT);
        $request->execute();
        $playerId = $db->lastInsertId();
        
        $request->closeCursor();
        
        if(isset($playerId))
        {
            // Get current season
            $season = getCurrentSeason();
            
            $statPlayer = new StatPlayer($playerId, $season, null, null);
            
            $statId = insertStatPlayer($statPlayer);
        }
    }
    return $statId;
}

/**
  * Inserts a raw player in database
  */
function updatePlayerRetirement($playerId)
{
	global $db;
	$request;
    
    // Insert player
    $request = $db->prepare('
        UPDATE player
        SET
            teamId = 31,
            salary = 0,
            guarantedYear = 0,
            optionalYear = 0,
            contractType = ""
        WHERE playerId = :playerId
        ');
        
    $request->bindValue(':playerId', $playerId, PDO::PARAM_INT);

    $request->execute();
    
    $request->closeCursor();
}

/**
  * Inserts a raw player in database
  */
function updatePlayerAtSeasonEnd()
{
	global $db;
	$request;
    
    // Update contract and experience
    $request = $db->prepare('
        UPDATE player
        SET
            experience = experience + 1,
            guarantedYear = guarantedYear - 1
        WHERE guarantedYear != 0
        ');

    $request->execute();
    
    // Update contract and experience
    $request = $db->prepare("
        UPDATE player
        SET
            salary = 0,
            teamId = 0
        WHERE 
            guarantedYear = 0
        AND 
            optionalYear = 0
        AND 
            contractType != 'Rookie'
        ");

    $request->execute();
    
    $request->closeCursor();
    
    return 1;
}

/**
  * Update player after his option was declined
  */
function declineContractOption($playerId)
{
	global $db;
	$request;
    
    // Update contract and experience
    $request = $db->prepare("
        UPDATE player
        SET
            teamId = 0,
            salary = 0,
            contractType = '',
            optionalYear = 0
        WHERE playerId = :playerId
        ");
    
    $request->bindValue(':playerId', $playerId, PDO::PARAM_INT);
    $request->execute();
    
    $request->closeCursor();
    
    return 1;
}

/**
  * Update player after his option was activate
  */
function activateContractOption($playerId)
{
	global $db;
	$request;
    
    $player = new Player($playerId);
    if($player->getContractType() == 'Rookie' and $player->getOptionalYear() == 3)
    {
        $contractType   = 'Rookie';
        $guarantedYear = $player->getGuarantedYear()+1;
        $optionalYear   = $player->getOptionalYear()-1;
    }
    else
    {
        $contractType   = '';
        $guarantedYear  = $player->getGuarantedYear()+$player->getOptionalYear();
        $optionalYear   = 0;
    }
    // Update contract and experience
    $request = $db->prepare("
        UPDATE player
        SET
            contractType = :contractType,
            guarantedYear = :guarantedYear,
            optionalYear = :optionalYear
        WHERE playerId = :playerId
        ");
    
    $request->bindValue(':contractType',    $contractType,  PDO::PARAM_STR);
    $request->bindValue(':guarantedYear',   $guarantedYear, PDO::PARAM_INT);
    $request->bindValue(':optionalYear',    $optionalYear,  PDO::PARAM_INT);
    $request->bindValue(':playerId',        $playerId,      PDO::PARAM_INT);
    
    $request->execute();
    
    $request->closeCursor();
    
    return 1;
}

/**
  * Update player after his option was activate
  */
function activateRestrictedContractOption($playerId)
{
	global $db;
	$request;
    
    // Update contract and experience
    $request = $db->prepare("
        UPDATE player
        SET
            contractType = '',
            guarantedYear = 1,
            optionalYear = 0,
            salary = 5
        WHERE playerId = :playerId
        ");
    
    $request->execute();
    
    $request->closeCursor();
    
    return 1;
}