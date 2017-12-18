<?php

/**
  * Inserts a raw player in database
  */
function updateGameResult($statsGame)
{
	global $db;
	$request;
    
    $homeTeamScore    = $statsGame->getHomeTeamStats()['Total']-> getPoints();
    $visitorTeamScore = $statsGame->getVisitorTeamStats()['Total']->getPoints();
    if($homeTeamScore > $visitorTeamScore)
    {
        $winnerId = $statsGame->getHomeTeamId();
        $loserId  = $statsGame->getVisitorTeamId();
    }
    else
    {
        $winnerId = $statsGame->getVisitorTeamId();
        $loserId  = $statsGame->getHomeTeamId();
    }
    
    // Insert player stat
    $request = $db->prepare('
        UPDATE game
        SET
            homeTeamScore = :homeTeamScore ,
            visitorTeamScore = :visitorTeamScore ,
            overtime = :overtime ,
            winnerId = :winnerId ,
            loserId = :loserId ,
            status = :status
        WHERE gameId = :gameId
    ');
    $request->bindValue(':homeTeamScore',       $homeTeamScore,             PDO::PARAM_INT);
    $request->bindValue(':visitorTeamScore',    $visitorTeamScore,          PDO::PARAM_INT);
    $request->bindValue(':overtime',            0,                          PDO::PARAM_INT);
    $request->bindValue(':winnerId',            $winnerId,                  PDO::PARAM_INT);
    $request->bindValue(':loserId',             $loserId,                   PDO::PARAM_INT);
    $request->bindValue(':status',              1,                          PDO::PARAM_INT);
    $request->bindValue(':gameId',              $statsGame->getGameId(),    PDO::PARAM_INT);

    $request->execute();
    $request->closeCursor();
    
    return 1;
}