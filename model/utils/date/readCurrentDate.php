<?php

/**
  * Returns the current season
  */
function isAnAwardDay($season)
{
    $date  = getCurrentDate();
    $day   = (int)getCurrentDay();
    $month = (int)getCurrentMonth();
    
    if( ( $date == $season->getRegularSeasonAwardsDate() ) 
        or
        ( $day == 1 and ($month == 12 or $month <= 4 )        )
      )
    {
        $isAnAwardDay = true;
    }
    else
    {
        $isAnAwardDay = false;
    }
    return $isAnAwardDay;
}

/**
  * Returns the current season
  */
function checkDayOver()
{
    $dayOver = 1;
    $currentDate = getCurrentDate();
    $currentSeason = getCurrentSeason();
    $season = new Season($currentSeason);
    
    global $db;
    $request;
	
    // Check game status
    $request = $db->prepare('   SELECT count(*) as nbNonPlayedGames 
                                FROM game
                                WHERE date = :currentDate
                                AND   status = 0');
                            
    $request->bindParam(':currentDate', $currentDate, PDO::PARAM_INT);
    $request->execute();
	$nbNonPlayedGames = $request->fetch();
    if($nbNonPlayedGames['nbNonPlayedGames'] != 0)
    {
        $dayOver = 0;
    }
    
    // Check draft status
    $draftDay = $season->getDraftDate();
    if ($currentDate == $draftDay) 
    {
        $request = $db->prepare('   SELECT count(*) as nbNonPickedPlayer 
                                    FROM draftpick
                                    WHERE year = :currentSeason
                                    AND   playerId = 0');
                                    
        $request->bindParam(':currentSeason', $currentSeason, PDO::PARAM_INT);
        $request->execute();
        $nbNonPickedPlayer = $request->fetch();
        if($nbNonPickedPlayer['nbNonPickedPlayer'] != 0)
        {
            $dayOver = 0;
        }
    }
    
    // Check season transition status
    $endSeason = $season->getStopDate();
    if ($currentDate == $endSeason) 
    {
        $nextSeason = $currentSeason+1;
        $request = $db->prepare('   SELECT count(*) as seasonCheck 
                                    FROM season
                                    WHERE year = :nextSeason');
                                    
        $request->bindParam(':nextSeason', $nextSeason, PDO::PARAM_INT);
        $request->execute();
        $seasonCheck = $request->fetch();
        if($seasonCheck['seasonCheck'] == 0)
        {
            $dayOver = 0;
        }
    }
    
    // Check option activation status at season start
    $startSeason = $season->getStartDate();
    if ($currentDate == $startSeason) 
    {
        $request = $db->prepare('   SELECT count(*) as nbPlayerWithOption 
                                    FROM player
                                    WHERE guarantedYear = 0
                                    AND optionalYear != 0');
                                    
        $request->execute();
        $nbPlayerWithOption = $request->fetch();
        if($nbPlayerWithOption['nbPlayerWithOption'] != 0)
        {
            $dayOver = 0;
        }
    }
	
	// Check restricted free agents at limit date
    $restrictedFreeAgentOptionDate = $season->getRestrictedFreeAgentOptionDate();
    if ($currentDate == $restrictedFreeAgentOptionDate) 
    {
        $request = $db->prepare("   SELECT count(*) as nbRestrictedFreeAgents 
                                    FROM player
                                    WHERE guarantedYear = 0
                                    AND optionalYear = 0
									AND contractType = 'Rookie'");
                                    
        $request->execute();
        $nbPlayerWithOption = $request->fetch();
        if($nbPlayerWithOption['nbRestrictedFreeAgents'] != 0)
        {
            $dayOver = 0;
        }
    }
    
    // Check award attribution
    if (isAnAwardDay($season)) 
    {
        // Month awards
        // set season and month input
        $year = getCurrentSeason();
        if(getCurrentDay() == 1)
        {
            if(getCurrentMonth() == 1)
            {
                $month = 12;
            }
            else
            {
                $month = getCurrentMonth() - 1;
            }
        }
        elseif(getCurrentDay() != 1)
        {
            $month = getCurrentMonth();
        }
        
        // check awards attribution
        if( !checkAwardAttribution($year, $month, 'Eastern Rookie of The Month') or
            !checkAwardAttribution($year, $month, 'Western Rookie of The Month') or
            !checkAwardAttribution($year, $month, 'Eastern Player of The Month') or
            !checkAwardAttribution($year, $month, 'Western Player of The Month')
        )
        {
            $dayOver = 0;
        }
        
        // Season awards
        $regularSeasonAwardsDate = $season->getRegularSeasonAwardsDate();
        if($currentDate == $regularSeasonAwardsDate)
        {
            $month = 0;
            // check awards attribution
            if( !checkAwardAttribution($year, $month, '6th Man of The Year')  or
                !checkAwardAttribution($year, $month, 'MIP')                  or
                !checkAwardAttribution($year, $month, 'ROI')                  or
                !checkAwardAttribution($year, $month, 'DPOY')                 or
                !checkAwardAttribution($year, $month, 'MVP') 
            )
            {
                $dayOver = 0;
            }
        }
    }
    
	$request->closeCursor();
    return $dayOver;
}