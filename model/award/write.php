<?php
/**
  * Update award table
  */
function updateAward($award)
{
	global $db;
	$request;

    $request = $db->prepare('
        INSERT INTO awards (
            season,
            month,
            award,
            playerId,
            teamId
        )
        VALUES (
            :season,
            :month,
            :award,
            :playerId,
            :teamId
        )
    ');
	
    $request->bindValue(':season',		$award->getSeason(),            PDO::PARAM_INT);
    $request->bindValue(':month',		$award->getMonth(),	            PDO::PARAM_INT);
    $request->bindValue(':award',	    $award->getAward(),             PDO::PARAM_STR);
    $request->bindValue(':playerId',    $award->getPlayer()->getId(),   PDO::PARAM_INT);
    $request->bindValue(':teamId',      $award->getTeam()->getTeamId(), PDO::PARAM_INT);
    
	$request->execute();
    
    $request->closeCursor();

    return 1;
}