<?php

/**
  * Update the stats of a player in database
  */
function updateStatPlayer($statsGame)
{
    $currentSeason = getCurrentSeason();
	global $db;
	$request;
		
	foreach($statsGame->getTeamsStats() as $teamIndex => $statsTeam)
	{
		foreach($statsTeam as $statsPlayer)
		{
			$teamId = $statsGame->getTeamsId()[$teamIndex];
			if( ($statsPlayer->getPlayerId() != 0) and ($statsPlayer->getMinutes() != 0) )
			{
                if(isStatPlayerDataExist($statsPlayer->getPlayerId(), $currentSeason, $teamId))
                {
					var_dump($statsPlayer->getPlayerId());
                    // Update player stat
                    $request = $db->prepare('
                        UPDATE statplayer
                        SET
                            games 				= games + 1,
                            minutes 			= minutes 				+ :minutes,
                            points 				= points  				+ :points,
                            freeThrowsMade 		= freeThrowsMade  		+ :freeThrowsMade,
                            freeThrowsAttempt 	= freeThrowsAttempt  	+ :freeThrowsAttempt,
                            twoPointsMade 		= twoPointsMade  		+ :twoPointsMade,
                            twoPointsAttempt 	= twoPointsAttempt  	+ :twoPointsAttempt,
                            threePointsMade 	= threePointsMade		+ :threePointsMade,
                            threePointsAttempt	= threePointsAttempt	+ :threePointsAttempt,
                            offensiveRebounds 	= offensiveRebounds  	+ :offensiveRebounds,
                            defensiveRebounds 	= defensiveRebounds  	+ :defensiveRebounds,
                            rebounds 			= rebounds  			+ :rebounds,
                            assists 			= assists  				+ :assists,
                            turnovers 			= turnovers  			+ :turnovers,
                            steals 				= steals  				+ :steals,
                            blocks 				= blocks  				+ :blocks,
                            evaluation 			= evaluation  			+ :evaluation
                        WHERE
                            playerId = :playerId AND
                            season = :season AND
                            teamId = :teamId
                        '
                    );
                }
                else
                {
					var_dump($statsPlayer->getPlayerId());
                    // Insert player stat
                    $request = $db->prepare('
                        INSERT INTO statplayer( 
                            playerId,
                            season,
                            teamId,
                            games,
                            minutes,
                            points,
                            freeThrowsMade,
                            freeThrowsAttempt,
                            twoPointsMade,
                            twoPointsAttempt,
                            threePointsMade,
                            threePointsAttempt,
                            offensiveRebounds,
                            defensiveRebounds,
                            rebounds,
                            assists,
                            turnovers,
                            steals,
                            blocks,
                            evaluation
                        )
                        VALUES( 
                            :playerId,
                            :season,
                            :teamId,
                            1,
                            :minutes,
                            :points,
                            :freeThrowsMade,
                            :freeThrowsAttempt,
                            :twoPointsMade,
                            :twoPointsAttempt,
                            :threePointsMade,
                            :threePointsAttempt,
                            :offensiveRebounds,
                            :defensiveRebounds,
                            :rebounds,
                            :assists,
                            :turnovers,
                            :steals,
                            :blocks,
                            :evaluation
                        )'
                    );
                }
                $request->bindValue(':minutes',    			$statsPlayer->getMinutes(),  			PDO::PARAM_INT);
                $request->bindValue(':points',     			$statsPlayer->getPoints(),    			PDO::PARAM_INT);
                $request->bindValue(':freeThrowsMade',    	$statsPlayer->getFreeThrowsMade(),		PDO::PARAM_INT);
                $request->bindValue(':freeThrowsAttempt',	$statsPlayer->getFreeThrowsAttempt(),	PDO::PARAM_INT);
                $request->bindValue(':twoPointsMade',    	$statsPlayer->getTwoPointsMade(),		PDO::PARAM_INT);
                $request->bindValue(':twoPointsAttempt',    $statsPlayer->getTwoPointsAttempt(),	PDO::PARAM_INT);
                $request->bindValue(':threePointsMade',    	$statsPlayer->getThreePointsAttempt(),	PDO::PARAM_INT);
                $request->bindValue(':threePointsAttempt',	$statsPlayer->getPoints(),    			PDO::PARAM_INT);
                $request->bindValue(':offensiveRebounds',   $statsPlayer->getOffensiveRebounds(),	PDO::PARAM_INT);
                $request->bindValue(':defensiveRebounds',  	$statsPlayer->getDefensiveRebounds(),  	PDO::PARAM_INT);
                $request->bindValue(':rebounds',    		$statsPlayer->getRebounds(),  			PDO::PARAM_INT);
                $request->bindValue(':assists',     		$statsPlayer->getAssists(),    			PDO::PARAM_INT);
                $request->bindValue(':turnovers',    		$statsPlayer->getTurnovers(),  			PDO::PARAM_INT);
                $request->bindValue(':steals',     			$statsPlayer->getSteals(),    			PDO::PARAM_INT);
                $request->bindValue(':blocks',    			$statsPlayer->getBlocks(),  			PDO::PARAM_INT);
                $request->bindValue(':evaluation',     		$statsPlayer->getEvaluation(),    		PDO::PARAM_INT);
                
                $request->bindValue(':playerId',    $statsPlayer->getPlayerId(),  		PDO::PARAM_INT);
                $request->bindValue(':season',      $currentSeason,    				    PDO::PARAM_INT);
                $request->bindValue(':teamId',      $teamId,    						PDO::PARAM_INT);
                $request->execute();
                $statId = $db->lastInsertId();

                $request->closeCursor();
            }
		}
	}
}

/**
  * Inserts the stats of a player in database
  */
function insertStatPlayer($statPlayer)
{
	global $db;
	$request;
    
    // Insert player stat
    $request = $db->prepare('
        INSERT INTO statplayer (
            playerId,
            season
        )
        VALUES (
            :playerId,
            :season
        )
    ');
    
    $request->bindValue(':playerId',    $statPlayer->getPlayerId(),  PDO::PARAM_INT);
    $request->bindValue(':season',      $statPlayer->getSeason(),    PDO::PARAM_INT);

    $request->execute();
    $statId = $db->lastInsertId();

    $request->closeCursor();
        
    return $statId;
}

/**
  * Inserts the stats of a game in database
  */
function insertStatsGame($statsGame)
{
	global $db;
	$request; 
    
    foreach($statsGame->getTeamsStats() as $teamIndex => $statsTeam)
    {
        foreach($statsTeam as $statsPlayer)
            {
            $teamId = $statsGame->getTeamsId()[$teamIndex];
            if($statsPlayer->getMinutes() != 0)
            {
                // Insert player stat
                $request = $db->prepare('
                    INSERT INTO statsgame (
                        playerId,
                        playerTeamId,
                        season,
                        gameId,
                        minutes,
                        points,
                        freeThrowsMade,
                        freeThrowsAttempt,
                        twoPointsMade,
                        twoPointsAttempt,
                        threePointsMade,
                        threePointsAttempt,
                        offensiveRebounds,
                        defensiveRebounds,
                        rebounds,
                        assists,
                        turnovers,
                        steals,
                        blocks,
                        evaluation
                    )
                    VALUES (
                        :playerId,
                        :playerTeamId,
                        :season,
                        :gameId,
                        :minutes,
                        :points,
                        :freeThrowsMade,
                        :freeThrowsAttempt,
                        :twoPointsMade,
                        :twoPointsAttempt,
                        :threePointsMade,
                        :threePointsAttempt,
                        :offensiveRebounds,
                        :defensiveRebounds,
                        :rebounds,
                        :assists,
                        :turnovers,
                        :steals,
                        :blocks,
                        :evaluation
                    )
                ');
                
                $request->bindValue(':playerId',            $statsPlayer->getPlayerId(),            PDO::PARAM_INT);
                $request->bindValue(':playerTeamId',        $teamId,                                PDO::PARAM_INT);
                $request->bindValue(':season',              getCurrentSeason(),                     PDO::PARAM_INT);
                $request->bindValue(':gameId',              $statsGame->getGameId(),                PDO::PARAM_INT);
                $request->bindValue(':minutes',             $statsPlayer->getMinutes(),             PDO::PARAM_INT);
                $request->bindValue(':points',              $statsPlayer->getPoints(),              PDO::PARAM_INT);
                $request->bindValue(':freeThrowsMade',      $statsPlayer->getFreeThrowsMade(),      PDO::PARAM_INT);
                $request->bindValue(':freeThrowsAttempt',   $statsPlayer->getFreeThrowsAttempt(),   PDO::PARAM_INT);
                $request->bindValue(':twoPointsMade',       $statsPlayer->getTwoPointsMade(),       PDO::PARAM_INT);
                $request->bindValue(':twoPointsAttempt',    $statsPlayer->getTwoPointsAttempt(),    PDO::PARAM_INT);
                $request->bindValue(':threePointsMade',     $statsPlayer->getThreePointsMade(),     PDO::PARAM_INT);
                $request->bindValue(':threePointsAttempt',  $statsPlayer->getThreePointsAttempt(),  PDO::PARAM_INT);
                $request->bindValue(':offensiveRebounds',   $statsPlayer->getOffensiveRebounds(),   PDO::PARAM_INT);
                $request->bindValue(':defensiveRebounds',   $statsPlayer->getDefensiveRebounds(),   PDO::PARAM_INT);
                $request->bindValue(':rebounds',            $statsPlayer->getRebounds(),            PDO::PARAM_INT);
                $request->bindValue(':assists',             $statsPlayer->getAssists(),             PDO::PARAM_INT);
                $request->bindValue(':turnovers',           $statsPlayer->getTurnovers(),           PDO::PARAM_INT);
                $request->bindValue(':steals',              $statsPlayer->getSteals(),              PDO::PARAM_INT);
                $request->bindValue(':blocks',              $statsPlayer->getBlocks(),              PDO::PARAM_INT);
                $request->bindValue(':evaluation',          $statsPlayer->getEvaluation(),          PDO::PARAM_INT);
                    
                $request->execute();
                $request->closeCursor();
            }
        }
    }
}
