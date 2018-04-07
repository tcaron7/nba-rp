<?php

/**
  * Inserts the stats of a player in database
  */
function insertNewSeason($data)
{
    $year = getCurrentYear()+1;
    $startDate = $year-1 . '-07-01';
    $stopDate = $year . '-06-30';
    $tradeLimitDate = $year . '-02-22';
    $signatureLimitDate = $year . '-03-15';
    $restrictedFreeAgentOptionDate = $year-1 . '-08-01'; 
    $allStarDate = $data['allStarYear'] . '-' . $data['allStarMonth'] . '-' . $data['allStarDay'];
    $regularSeasonAwardsDate = $year . '-04-23';
    $draftDate = $year . '-06-28';
    $maxPlayersInTeam = $data['maxPlayersInTeam'];
    $salaryCap = $data['salaryCap'];
    $contractMax = $data['contractMax'];

	global $db;
	$request;
    
    // Insert player stat
    $request = $db->prepare('
        INSERT INTO season (
            year,
            champion,
            finalist,
            status,
            startDate,
            stopDate,
            tradeLimitDate,
            signatureLimitDate,
            restrictedFreeAgentOptionDate,
            allStarDate,
            regularSeasonAwardsDate,
            draftDate,
            maxPlayersInTeam,
            salaryCap,
            contractMax
        )
        VALUES (
            :year,
            0,
            0,
            1,
            :startDate,
            :stopDate,
            :tradeLimitDate,
            :signatureLimitDate,
            :restrictedFreeAgentOptionDate,
            :allStarDate,
            :regularSeasonAwardsDate,
            :draftDate,
            :maxPlayersInTeam,
            :salaryCap,
            :contractMax
        )
    ');
    
    $request->bindValue(':year',                            $year,                          PDO::PARAM_INT);
    $request->bindValue(':startDate',                       $startDate,                     PDO::PARAM_STR);
    $request->bindValue(':stopDate',                        $stopDate,                      PDO::PARAM_STR);
    $request->bindValue(':tradeLimitDate',                  $tradeLimitDate,                PDO::PARAM_STR);
    $request->bindValue(':signatureLimitDate',              $signatureLimitDate,            PDO::PARAM_STR);
    $request->bindValue(':restrictedFreeAgentOptionDate',   $restrictedFreeAgentOptionDate, PDO::PARAM_STR);
    $request->bindValue(':allStarDate',                     $allStarDate,                   PDO::PARAM_STR);
    $request->bindValue(':regularSeasonAwardsDate',         $regularSeasonAwardsDate,       PDO::PARAM_STR);
    $request->bindValue(':draftDate',                       $draftDate,                     PDO::PARAM_STR);
    $request->bindValue(':maxPlayersInTeam',                $maxPlayersInTeam,              PDO::PARAM_INT);
    $request->bindValue(':salaryCap',                       $salaryCap,                     PDO::PARAM_INT);
    $request->bindValue(':contractMax',                     $contractMax,                   PDO::PARAM_INT);

    $request->execute();

    $request->closeCursor();
        
    return 1;
}

function insertSeasonSchedule($seasonGames)
{
    global $db;
    
    foreach($seasonGames as $seasonGame)
    {
        $request;
        $request = $db->prepare('
                                    INSERT INTO game (
                                        season,
                                        date,
                                        homeTeamId,
                                        visitorTeamId,
                                        homeTeamScore,
                                        visitorTeamScore,
                                        overtime,
                                        status
                                    )
                                    VALUES (
                                        :season,
                                        :date,
                                        :homeTeamId,
                                        :visitorTeamId,
                                        :homeTeamScore,
                                        :visitorTeamScore,
                                        :overtime,
                                        :status
                                    )
                                ');

        $request->bindValue(':season',              $seasonGame->getSeason(),               PDO::PARAM_INT);
        $request->bindValue(':date',                $seasonGame->getGameDate(),             PDO::PARAM_STR);
        $request->bindValue(':homeTeamId',          $seasonGame->getHomeTeam()->getId(),    PDO::PARAM_INT);
        $request->bindValue(':visitorTeamId',       $seasonGame->getVisitorTeam()->getId(), PDO::PARAM_INT);
        $request->bindValue(':homeTeamScore',       $seasonGame->getHomeTeamScore(),        PDO::PARAM_INT);
        $request->bindValue(':visitorTeamScore',    $seasonGame->getVisitorTeamScore(),     PDO::PARAM_INT);
        $request->bindValue(':overtime',            $seasonGame->getOvertime(),             PDO::PARAM_INT);
        $request->bindValue(':status',              $seasonGame->getStatus(),               PDO::PARAM_INT);

        $request->execute();
        $request->closeCursor();
    }
}