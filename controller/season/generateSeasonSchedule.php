<?php   
// Generate season games
$arrayOfTen = array(1,2,3,4,5,6,7,8,9,10);

$allTeams = getAllTeamOrderByName();
$nextSeason = getCurrentSeason()+1;
$season = new Season($nextSeason);

$gamesCount = 1;

foreach ($allTeams as $key => $homeTeam)
{
    $loopCounter=1;
    if(!isset($teamCount[$homeTeam->getDivision()]))
    {
        $teamCount[$homeTeam->getDivision()] = 0;
    }
    $homeTeamId = $homeTeam->getId();
    
    foreach ($allTeams as $key => $visitorTeam)
    {
        $visitorTeamId = $visitorTeam->getId();
        if($homeTeamId!=$visitorTeamId)
        {
            if($homeTeam->getDivision()==$visitorTeam->getDivision())
            {
                $newSeasonGames[$gamesCount] = new Game(null,$homeTeamId,$visitorTeamId,$nextSeason);
                $gamesCount = $gamesCount+1;
                $newSeasonGames[$gamesCount] = new Game(null,$homeTeamId,$visitorTeamId,$nextSeason);
                $gamesCount = $gamesCount+1;
            }
            elseif($homeTeam->getConference()!=$visitorTeam->getConference())
            {
                $newSeasonGames[$gamesCount] = new Game(null,$homeTeamId,$visitorTeamId,$nextSeason);
                $gamesCount = $gamesCount+1;
            }
            else
            {
                if(!isset($randomArray[$homeTeam->getDivision()]))
                {
                    shuffle($arrayOfTen);
                    $randomArray[$homeTeam->getDivision()]=$arrayOfTen;
                }
                if($randomArray[$homeTeam->getDivision()][$teamCount[$homeTeam->getDivision()]]!=$loopCounter and $randomArray[$homeTeam->getDivision()][$teamCount[$homeTeam->getDivision()]+1]!=$loopCounter)
                {
                    $newSeasonGames[$gamesCount] = new Game(null,$homeTeamId,$visitorTeamId,$nextSeason);
                    $gamesCount = $gamesCount+1;
                    $newSeasonGames[$gamesCount] = new Game(null,$homeTeamId,$visitorTeamId,$nextSeason);
                    $gamesCount = $gamesCount+1;
                }
                else
                {
                    $newSeasonGames[$gamesCount] = new Game(null,$homeTeamId,$visitorTeamId,$nextSeason);
                    $gamesCount = $gamesCount+1;
                }
                
                if($loopCounter==10)
                {
                    $teamCount[$homeTeam->getDivision()] = $teamCount[$homeTeam->getDivision()]+2;
                }
                $loopCounter=$loopCounter+1;
            }
        }
    }
}

shuffle($newSeasonGames);

$startDate = '2053-10-27';
$endDate = '2054-04-12';
$check = null;

$day = DateInterval::createFromDateString('1 day'); 
$date = new DateTime($startDate);

/**
  * Returns a boolean true if valid date, else false
  */
function checkValidDate($date,$game,$check, $season)
{
    $homeTeam = $game->getHomeTeam()->getId();
    $visitorTeam = $game->getVisitorTeam()->getId();
    $day = DateInterval::createFromDateString('1 day');
    $strDate = $date->format('Y-m-d');
    $strDatePlus1 = $date->add($day)->format('Y-m-d');
    $strDatePlus2 = $date->add($day)->format('Y-m-d');
    $strDateMinus1 = $date->sub($day)->sub($day)->sub($day)->format('Y-m-d');
    $strDateMinus2 = $date->sub($day)->format('Y-m-d');
    $date->add($day)->add($day)->format('Y-m-d');
    
    $allStarDate = new DateTime($season->getAllStarDate());
    $strAllStarDate = $allStarDate->format('Y-m-d');
    $strAllStarDatePlus1 = $allStarDate->add($day)->format('Y-m-d');
    $strAllStarDateMinus1 = $allStarDate->sub($day)->sub($day)->format('Y-m-d');
    
    if(isset($check[$strDate][$homeTeam]) or isset($check[$strDate][$visitorTeam]))
    {
        return false;
    }
    elseif(isset($check[$strDatePlus1][$homeTeam]) and isset($check[$strDatePlus2][$homeTeam]))
    {
        return false;
    }
    elseif(isset($check[$strDateMinus1][$homeTeam]) and isset($check[$strDateMinus2][$homeTeam]))
    {
        return false;
    }
    elseif(isset($check[$strDateMinus1][$homeTeam]) and isset($check[$strDatePlus1][$homeTeam]))
    {
        return false;
    }
    elseif(isset($check[$strDatePlus1][$visitorTeam]) and isset($check[$strDatePlus2][$visitorTeam]))
    {
        return false;
    }
    elseif(isset($check[$strDateMinus1][$visitorTeam]) and isset($check[$strDateMinus2][$visitorTeam]))
    {
        return false;
    }
    elseif(isset($check[$strDateMinus1][$visitorTeam]) and isset($check[$strDatePlus1][$visitorTeam]))
    {
        return false;
    }
    elseif($strDate == $strAllStarDateMinus1 or $strDate == $strAllStarDate or $strDate == $strAllStarDatePlus1)
    {
        return false;
    }
    else
    {
        return true;
    }
}

// Assign date to games
foreach($newSeasonGames as $newSeasonGame)
{
    $enableToExitLoop = 0;
    $initDate = $date->format('Y-m-d');
    if(checkValidDate(new DateTime($endDate),$newSeasonGame,$check, $season)==true)
    {
        $newSeasonGame->setGameDate($endDate);

        $check[$endDate][$newSeasonGame->getHomeTeam()->getId()] = 1;
        $check[$endDate][$newSeasonGame->getVisitorTeam()->getId()] = 1;
    }
    else
    {
        $i=0;
        while((checkValidDate($date ,$newSeasonGame,$check, $season) == false) and (($date->format('Y-m-d') != $initDate) or ($enableToExitLoop == 0)))
        {
            $i++;
            if($date->format('Y-m-d') == $endDate)
            {
                $date = new DateTime($startDate);
            }
            else
            {
                $date->add($day);
            }
            $enableToExitLoop = 1;
        }
        if(($enableToExitLoop == 1) and ($date->format('Y-m-d') == $initDate))
        {
            echo $i . '<br />';
            echo $enableToExitLoop . '<br />';
            echo $initDate . '<br />';
            echo $date->format('Y-m-d') . '<br /><br />';
            $newSeasonGame->setGameDate('2000-01-01');
        }
        else
        {
            $newSeasonGame->setGameDate($date->format('Y-m-d'));
        }
        

        $check[$date->format('Y-m-d')][$newSeasonGame->getHomeTeam()->getId()] = 1;
        $check[$date->format('Y-m-d')][$newSeasonGame->getVisitorTeam()->getId()] = 1;
        
        if($date->format('Y-m-d') == '2054-04-12')
        {
            $date = new DateTime($startDate);
        }
        else
        {
            $date->add($day);
        }
    }
}


/**
  * Inserts a raw person in database
  * Returns personId
  */
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

insertSeasonSchedule($newSeasonGames);
?>