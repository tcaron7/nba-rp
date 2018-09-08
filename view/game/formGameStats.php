<form action="nba.php?section=play&option=recapGame&id=<?php echo $gameId; ?>" method="post">
    <?php
    foreach($index as $teamIndex)
    {
    ?>   
        <section class="gameSheet">    
            <div class="sectionHeader">
                <?php
                echo '<span class="icon-team-'.preg_replace('/\s+/', '', strtolower($teams[$teamIndex]->getName())).'">&nbsp;</span>';
                echo $teams[$teamIndex]->getFullName();
                ?>
            </div>
            
            <div class="sectionBody">
                <table class="table-team-<?php echo preg_replace('/\s+/', '', strtolower($teams[$teamIndex]->getName())) ?>">
                    <thead>
                        <tr>
                            <th style="text-align: left;">Player</th>
                            <th>Minutes</th>
                            <th>FTM</th>
                            <th>FTA</th>
                            <th>FGM</th>
                            <th>FGA</th>
                            <th>3FGM</th>
                            <th>3FGA</th>
                            <th>Off.Reb.</th>
                            <th>Def.Reb.</th>
                            <th>Assists</th>
                            <th>Turnovers</th>
                            <th>Steals</th>
                            <th>Blocks</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <?php
                        $preStats[$teamIndex]['total']['minutes']            = 0;
                        $preStats[$teamIndex]['total']['ftm']                = 0;
                        $preStats[$teamIndex]['total']['fta']                = 0;
                        $preStats[$teamIndex]['total']['fgm']                = 0;
                        $preStats[$teamIndex]['total']['fga']                = 0;
                        $preStats[$teamIndex]['total']['3fgm']               = 0;
                        $preStats[$teamIndex]['total']['3fga']               = 0;
                        $preStats[$teamIndex]['total']['offensive_boards']   = 0;
                        $preStats[$teamIndex]['total']['defensive_boards']   = 0;
                        $preStats[$teamIndex]['total']['assists']            = 0;
                        $preStats[$teamIndex]['total']['turnovers']          = 0;
                        $preStats[$teamIndex]['total']['steals']             = 0;
                        $preStats[$teamIndex]['total']['blocks']             = 0;
              
                        $statsGame[$teamIndex]['total']['minutes']            = 0;
                        $statsGame[$teamIndex]['total']['ftm']                = 0;
                        $statsGame[$teamIndex]['total']['fta']                = 0;
                        $statsGame[$teamIndex]['total']['fgm']                = 0;
                        $statsGame[$teamIndex]['total']['fga']                = 0;
                        $statsGame[$teamIndex]['total']['3fgm']               = 0;
                        $statsGame[$teamIndex]['total']['3fga']               = 0;
                        $statsGame[$teamIndex]['total']['offensive_boards']   = 0;
                        $statsGame[$teamIndex]['total']['defensive_boards']   = 0;
                        $statsGame[$teamIndex]['total']['assists']            = 0;
                        $statsGame[$teamIndex]['total']['turnovers']          = 0;
                        $statsGame[$teamIndex]['total']['steals']             = 0;
                        $statsGame[$teamIndex]['total']['blocks']             = 0;
                        
                        foreach($teamPlayers[$teamIndex] as $player)
                        {
                            if($player->getInjuryStatus() == 'Healthy' or $player->getInjuryStatus() == 'Weakened')
                            {
                                $playerId = $player->getId();
                                $currentSeason = getCurrentSeason();
                                $minutes = $_POST[$gameId][$playerId]['minutes'];
                                
                                if(isset($player->getStats()[$currentSeason]))
                                {
                                    $preStats[$teamIndex][$playerId]['minutes']            = $minutes;
                                    $preStats[$teamIndex][$playerId]['ftm']                = round($minutes * ($player->getStats()[$currentSeason]->getFreeThrowsMade()     / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['fta']                = round($minutes * ($player->getStats()[$currentSeason]->getFreeThrowsAttempt()  / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['fgm']                = round($minutes * ($player->getStats()[$currentSeason]->getTwoPointsMade()      / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['fga']                = round($minutes * ($player->getStats()[$currentSeason]->getTwoPointsAttempt()   / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['3fgm']               = round($minutes * ($player->getStats()[$currentSeason]->getThreePointsMade()    / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['3fga']               = round($minutes * ($player->getStats()[$currentSeason]->getThreePointsAttempt() / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['offensive_boards']   = round($minutes * ($player->getStats()[$currentSeason]->getOffensiveRebounds()  / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['defensive_boards']   = round($minutes * ($player->getStats()[$currentSeason]->getDefensiveRebounds()  / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['assists']            = round($minutes * ($player->getStats()[$currentSeason]->getAssists()            / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['turnovers']          = round($minutes * ($player->getStats()[$currentSeason]->getTurnovers()          / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['steals']             = round($minutes * ($player->getStats()[$currentSeason]->getSteals()             / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                    $preStats[$teamIndex][$playerId]['blocks']             = round($minutes * ($player->getStats()[$currentSeason]->getBlocks()             / max(1,$player->getStats()[$currentSeason]->getMinutes())));
                                }
                                else
                                {
                                    $preStats[$teamIndex][$playerId]['minutes']            = $minutes;
                                    $preStats[$teamIndex][$playerId]['ftm']                = 0;
                                    $preStats[$teamIndex][$playerId]['fta']                = 0;
                                    $preStats[$teamIndex][$playerId]['fgm']                = 0;
                                    $preStats[$teamIndex][$playerId]['fga']                = 0;
                                    $preStats[$teamIndex][$playerId]['3fgm']               = 0;
                                    $preStats[$teamIndex][$playerId]['3fga']               = 0;
                                    $preStats[$teamIndex][$playerId]['offensive_boards']   = 0;
                                    $preStats[$teamIndex][$playerId]['defensive_boards']   = 0;
                                    $preStats[$teamIndex][$playerId]['assists']            = 0;
                                    $preStats[$teamIndex][$playerId]['turnovers']          = 0;
                                    $preStats[$teamIndex][$playerId]['steals']             = 0;
                                    $preStats[$teamIndex][$playerId]['blocks']             = 0;
                                }
                                $preStats[$teamIndex]['total']['minutes']            = $preStats[$teamIndex]['total']['minutes'] + $preStats[$teamIndex][$playerId]['minutes'];
                                $preStats[$teamIndex]['total']['ftm']                = $preStats[$teamIndex]['total']['ftm'] + $preStats[$teamIndex][$playerId]['ftm'];
                                $preStats[$teamIndex]['total']['fta']                = $preStats[$teamIndex]['total']['fta'] + $preStats[$teamIndex][$playerId]['fta'];
                                $preStats[$teamIndex]['total']['fgm']                = $preStats[$teamIndex]['total']['fgm'] + $preStats[$teamIndex][$playerId]['fgm'];
                                $preStats[$teamIndex]['total']['fga']                = $preStats[$teamIndex]['total']['fga'] + $preStats[$teamIndex][$playerId]['fga'];
                                $preStats[$teamIndex]['total']['3fgm']               = $preStats[$teamIndex]['total']['3fgm'] + $preStats[$teamIndex][$playerId]['3fgm'];
                                $preStats[$teamIndex]['total']['3fga']               = $preStats[$teamIndex]['total']['3fga'] + $preStats[$teamIndex][$playerId]['3fga'];
                                $preStats[$teamIndex]['total']['offensive_boards']   = $preStats[$teamIndex]['total']['offensive_boards'] + $preStats[$teamIndex][$playerId]['offensive_boards'];
                                $preStats[$teamIndex]['total']['defensive_boards']   = $preStats[$teamIndex]['total']['defensive_boards'] + $preStats[$teamIndex][$playerId]['defensive_boards'];
                                $preStats[$teamIndex]['total']['assists']            = $preStats[$teamIndex]['total']['assists'] + $preStats[$teamIndex][$playerId]['assists'];
                                $preStats[$teamIndex]['total']['turnovers']          = $preStats[$teamIndex]['total']['turnovers'] + $preStats[$teamIndex][$playerId]['turnovers'];
                                $preStats[$teamIndex]['total']['steals']             = $preStats[$teamIndex]['total']['steals'] + $preStats[$teamIndex][$playerId]['steals'];
                                $preStats[$teamIndex]['total']['blocks']             = $preStats[$teamIndex]['total']['blocks'] + $preStats[$teamIndex][$playerId]['blocks'];
                            }
                        }
                        
                        foreach($teamPlayers[$teamIndex] as $player)
                        {
                            if($player->getInjuryStatus() == 'Healthy' or $player->getInjuryStatus() == 'Weakened')
                            {
                                $playerId = $player->getId();
                                $currentSeason = getCurrentSeason();
                                $minutes = $_POST[$gameId][$playerId]['minutes'];
                                
                                if(isset($player->getStats()[$currentSeason]))
                                {    
                                    $statsGame[$teamIndex][$playerId]['minutes']            = $minutes;
                                    $statsGame[$teamIndex][$playerId]['ftm']                = round($_POST[$gameId][$teamIndex]['ftm'] * $preStats[$teamIndex][$playerId]['ftm']/max(1,$preStats[$teamIndex]['total']['ftm']));
                                    $statsGame[$teamIndex][$playerId]['fta']                = round($_POST[$gameId][$teamIndex]['fta'] * $preStats[$teamIndex][$playerId]['fta']/max(1,$preStats[$teamIndex]['total']['fta']));
                                    $statsGame[$teamIndex][$playerId]['fgm']                = round($_POST[$gameId][$teamIndex]['fgm'] * $preStats[$teamIndex][$playerId]['fgm']/max(1,$preStats[$teamIndex]['total']['fgm']));
                                    $statsGame[$teamIndex][$playerId]['fga']                = round($_POST[$gameId][$teamIndex]['fga'] * $preStats[$teamIndex][$playerId]['fga']/max(1,$preStats[$teamIndex]['total']['fga']));
                                    $statsGame[$teamIndex][$playerId]['3fgm']               = round($_POST[$gameId][$teamIndex]['3fgm'] * $preStats[$teamIndex][$playerId]['3fgm']/max(1,$preStats[$teamIndex]['total']['3fgm']));
                                    $statsGame[$teamIndex][$playerId]['3fga']               = round($_POST[$gameId][$teamIndex]['3fga'] * $preStats[$teamIndex][$playerId]['3fga']/max(1,$preStats[$teamIndex]['total']['3fga']));
                                    $statsGame[$teamIndex][$playerId]['offensive_boards']   = round($_POST[$gameId][$teamIndex]['offensive_boards'] * $preStats[$teamIndex][$playerId]['offensive_boards']/max(1,$preStats[$teamIndex]['total']['offensive_boards']));
                                    $statsGame[$teamIndex][$playerId]['defensive_boards']   = round($_POST[$gameId][$teamIndex]['defensive_boards'] * $preStats[$teamIndex][$playerId]['defensive_boards']/max(1,$preStats[$teamIndex]['total']['defensive_boards']));
                                    $statsGame[$teamIndex][$playerId]['assists']            = round($_POST[$gameId][$teamIndex]['assists'] * $preStats[$teamIndex][$playerId]['assists']/max(1,$preStats[$teamIndex]['total']['assists']));
                                    $statsGame[$teamIndex][$playerId]['turnovers']          = round($_POST[$gameId][$teamIndex]['turnovers'] * $preStats[$teamIndex][$playerId]['turnovers']/max(1,$preStats[$teamIndex]['total']['turnovers']));
                                    $statsGame[$teamIndex][$playerId]['steals']             = round($_POST[$gameId][$teamIndex]['steals'] * $preStats[$teamIndex][$playerId]['steals']/max(1,$preStats[$teamIndex]['total']['steals']));
                                    $statsGame[$teamIndex][$playerId]['blocks']             = round($_POST[$gameId][$teamIndex]['blocks'] * $preStats[$teamIndex][$playerId]['blocks']/max(1,$preStats[$teamIndex]['total']['blocks']));
                                }
                                else
                                {
                                    $statsGame[$teamIndex][$playerId]['minutes']            = $minutes;
                                    $statsGame[$teamIndex][$playerId]['ftm']                = 0;
                                    $statsGame[$teamIndex][$playerId]['fta']                = 0;
                                    $statsGame[$teamIndex][$playerId]['fgm']                = 0;
                                    $statsGame[$teamIndex][$playerId]['fga']                = 0;
                                    $statsGame[$teamIndex][$playerId]['3fgm']               = 0;
                                    $statsGame[$teamIndex][$playerId]['3fga']               = 0;
                                    $statsGame[$teamIndex][$playerId]['offensive_boards']   = 0;
                                    $statsGame[$teamIndex][$playerId]['defensive_boards']   = 0;
                                    $statsGame[$teamIndex][$playerId]['assists']            = 0;
                                    $statsGame[$teamIndex][$playerId]['turnovers']          = 0;
                                    $statsGame[$teamIndex][$playerId]['steals']             = 0;
                                    $statsGame[$teamIndex][$playerId]['blocks']             = 0;
                                }
                                $statsGame[$teamIndex]['total']['minutes']            = $statsGame[$teamIndex]['total']['minutes'] + $statsGame[$teamIndex][$playerId]['minutes'];
                                $statsGame[$teamIndex]['total']['ftm']                = $statsGame[$teamIndex]['total']['ftm'] + $statsGame[$teamIndex][$playerId]['ftm'];
                                $statsGame[$teamIndex]['total']['fta']                = $statsGame[$teamIndex]['total']['fta'] + $statsGame[$teamIndex][$playerId]['fta'];
                                $statsGame[$teamIndex]['total']['fgm']                = $statsGame[$teamIndex]['total']['fgm'] + $statsGame[$teamIndex][$playerId]['fgm'];
                                $statsGame[$teamIndex]['total']['fga']                = $statsGame[$teamIndex]['total']['fga'] + $statsGame[$teamIndex][$playerId]['fga'];
                                $statsGame[$teamIndex]['total']['3fgm']               = $statsGame[$teamIndex]['total']['3fgm'] + $statsGame[$teamIndex][$playerId]['3fgm'];
                                $statsGame[$teamIndex]['total']['3fga']               = $statsGame[$teamIndex]['total']['3fga'] + $statsGame[$teamIndex][$playerId]['3fga'];
                                $statsGame[$teamIndex]['total']['offensive_boards']   = $statsGame[$teamIndex]['total']['offensive_boards'] + $statsGame[$teamIndex][$playerId]['offensive_boards'];
                                $statsGame[$teamIndex]['total']['defensive_boards']   = $statsGame[$teamIndex]['total']['defensive_boards'] + $statsGame[$teamIndex][$playerId]['defensive_boards'];
                                $statsGame[$teamIndex]['total']['assists']            = $statsGame[$teamIndex]['total']['assists'] + $statsGame[$teamIndex][$playerId]['assists'];
                                $statsGame[$teamIndex]['total']['turnovers']          = $statsGame[$teamIndex]['total']['turnovers'] + $statsGame[$teamIndex][$playerId]['turnovers'];
                                $statsGame[$teamIndex]['total']['steals']             = $statsGame[$teamIndex]['total']['steals'] + $statsGame[$teamIndex][$playerId]['steals'];
                                $statsGame[$teamIndex]['total']['blocks']             = $statsGame[$teamIndex]['total']['blocks'] + $statsGame[$teamIndex][$playerId]['blocks'];
                            }
                        }
                        
                        $delta['ftm']                = $_POST[$gameId][$teamIndex]['ftm'] - $statsGame[$teamIndex]['total']['ftm'];
                        $delta['fta']                = $_POST[$gameId][$teamIndex]['fta'] - $statsGame[$teamIndex]['total']['fta']; 
                        $delta['fgm']                = $_POST[$gameId][$teamIndex]['fgm'] - $statsGame[$teamIndex]['total']['fgm'];
                        $delta['fga']                = $_POST[$gameId][$teamIndex]['fga'] - $statsGame[$teamIndex]['total']['fga'];
                        $delta['3fgm']               = $_POST[$gameId][$teamIndex]['3fgm'] - $statsGame[$teamIndex]['total']['3fgm'];
                        $delta['3fga']               = $_POST[$gameId][$teamIndex]['3fga'] - $statsGame[$teamIndex]['total']['3fga'];
                        $delta['offensive_boards']   = $_POST[$gameId][$teamIndex]['offensive_boards'] - $statsGame[$teamIndex]['total']['offensive_boards'];
                        $delta['defensive_boards']   = $_POST[$gameId][$teamIndex]['defensive_boards'] - $statsGame[$teamIndex]['total']['defensive_boards'];
                        $delta['assists']            = $_POST[$gameId][$teamIndex]['assists'] - $statsGame[$teamIndex]['total']['assists'];
                        $delta['turnovers']          = $_POST[$gameId][$teamIndex]['turnovers'] - $statsGame[$teamIndex]['total']['turnovers'];
                        $delta['steals']             = $_POST[$gameId][$teamIndex]['steals'] - $statsGame[$teamIndex]['total']['steals'];
                        $delta['blocks']             = $_POST[$gameId][$teamIndex]['blocks'] - $statsGame[$teamIndex]['total']['blocks'];
                        
                        for($i = 0; $i < abs($delta['ftm']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                                
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['ftm'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['ftm'] = $statsGame[$teamIndex][$randPlayerId]['ftm'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['ftm'] = $statsGame[$teamIndex][$randPlayerId]['ftm'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['fta']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['fta'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['fta'] = $statsGame[$teamIndex][$randPlayerId]['fta'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['fta'] = $statsGame[$teamIndex][$randPlayerId]['fta'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['fgm']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['fgm'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['fgm'] = $statsGame[$teamIndex][$randPlayerId]['fgm'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['fgm'] = $statsGame[$teamIndex][$randPlayerId]['fgm'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['fga']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['fga'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['fga'] = $statsGame[$teamIndex][$randPlayerId]['fga'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['fga'] = $statsGame[$teamIndex][$randPlayerId]['fga'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['3fgm']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['3fgm'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['3fgm'] = $statsGame[$teamIndex][$randPlayerId]['3fgm'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['3fgm'] = $statsGame[$teamIndex][$randPlayerId]['3fgm'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['3fga']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['3fga'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['3fga'] = $statsGame[$teamIndex][$randPlayerId]['3fga'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['3fga'] = $statsGame[$teamIndex][$randPlayerId]['3fga'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['offensive_boards']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['offensive_boards'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['offensive_boards'] = $statsGame[$teamIndex][$randPlayerId]['offensive_boards'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['offensive_boards'] = $statsGame[$teamIndex][$randPlayerId]['offensive_boards'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['defensive_boards']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['defensive_boards'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['defensive_boards'] = $statsGame[$teamIndex][$randPlayerId]['defensive_boards'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['defensive_boards'] = $statsGame[$teamIndex][$randPlayerId]['defensive_boards'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['assists']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['assists'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['assists'] = $statsGame[$teamIndex][$randPlayerId]['assists'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['assists'] = $statsGame[$teamIndex][$randPlayerId]['assists'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['turnovers']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['turnovers'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['turnovers'] = $statsGame[$teamIndex][$randPlayerId]['turnovers'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['turnovers'] = $statsGame[$teamIndex][$randPlayerId]['turnovers'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['steals']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['steals'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['steals'] = $statsGame[$teamIndex][$randPlayerId]['steals'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['steals'] = $statsGame[$teamIndex][$randPlayerId]['steals'] - 1;
                            }
                        }
                        
                        for($i = 0; $i < abs($delta['blocks']); $i++)
                        {
                            do
                            { 
                                $randPlayerId = array_rand($teamPlayers[$teamIndex]);
                            } while( (!isset($statsGame[$teamIndex][$randPlayerId]['minutes'])) or ($statsGame[$teamIndex][$randPlayerId]['minutes'] == 0) );
                            
                            if($delta['blocks'] > 0)
                            {
                                $statsGame[$teamIndex][$randPlayerId]['blocks'] = $statsGame[$teamIndex][$randPlayerId]['blocks'] + 1;
                            }
                            else
                            {
                                $statsGame[$teamIndex][$randPlayerId]['blocks'] = $statsGame[$teamIndex][$randPlayerId]['blocks'] - 1;
                            }
                        }
                        
                        foreach($teamPlayers[$teamIndex] as $player)
                        {
                            echo '<tr>';
                            echo '<td>' . $player->getFullName() . '</td>';
                            $playerId = $player->getId();
							include('view/game/inputAddGameStats.php');
                            echo '</tr>';
                        }
                        ?>
						<tr>
							<td><b>Total</b></td>
							<td id="total-<?php echo $teamIndex; ?>-minutes">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-ftm">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-fta">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-fgm">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-fga">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-3fgm">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-3fga">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-offensive_boards">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-defensive_boards">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-assists">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-turnovers">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-steals">&nbsp;</td>
							<td id="total-<?php echo $teamIndex; ?>-blocks">&nbsp;</td>
						</tr>
                    </tbody>
                </table>
            </div>
        </section>
    <?php
    }
    ?>
    <br />
    <center>
        <input type="submit" value="Recap"/> 
    </center>
</form>
