<?php
    $season = getCurrentSeason();
    foreach($index as $teamIndex)
    {
        $totalMinutes = 0;
        foreach($teamPlayers[$teamIndex] as $teamPlayer)
        {
            if(isset($teamPlayer->getStats()[$season]) && ($teamPlayer->getStats()[$season]) != NULL)
            {    
                $playerStats   = $teamPlayer->getStats()[$season];
                $playerGames   = $playerStats->getGames();
                $playerMinutes = $playerStats->getMinutes();
            }
            else
            {
                $playerGames   = 0;
                $playerMinutes = 0;
            }
            
            if( ($teamPlayer->getInjuryStatus() == 'Healthy') && ($playerGames > 0) )
            {
                if($playerMinutes/$playerGames > 10)
                {
                    $playersMinutes[$teamIndex][$teamPlayer->getId()] = round($playerMinutes/$playerGames*(1+25*$_POST[$gameId]['numberOvertime']/240));
                }
                else
                {
                    $playersMinutes[$teamIndex][$teamPlayer->getId()] = 0;
                } 
            }
            elseif($teamPlayer->getInjuryStatus() == 'Weakened')
            {
                if($playerMinutes/$playerGames > 10)
                {
                    $playersMinutes[$teamIndex][$teamPlayer->getId()] = round($playerMinutes/$playerGames*(1+25*$_POST[$gameId]['numberOvertime']/240));
                }
                else
                {
                    $playersMinutes[$teamIndex][$teamPlayer->getId()] = 0;
                }
            }
            else
            {
                $playersMinutes[$teamIndex][$teamPlayer->getId()] = 0;
            }

            $totalMinutes = $totalMinutes + $playersMinutes[$teamIndex][$teamPlayer->getId()];
        }
        
        $deltaMinutes = $totalMinutes - ( 240 + 25*$_POST[$gameId]['numberOvertime'] );

        for($i =0; $i < abs($deltaMinutes); $i++)
        {
            $counter = 0;
            do
            { 
                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                $counter = $counter + 1;
            } while($playersMinutes[$teamIndex][$randPlayerId] == 0 and $counter < 10);
            
            if($deltaMinutes > 0)
            {
                $playersMinutes[$teamIndex][$randPlayerId] = $playersMinutes[$teamIndex][$randPlayerId] - 1;
            }
            else
            {
                $playersMinutes[$teamIndex][$randPlayerId] = $playersMinutes[$teamIndex][$randPlayerId] + 1;
            }
        }
    }
?>