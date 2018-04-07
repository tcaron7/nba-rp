<form action="<?php echo $GLOBALS['router']->generateUrl( 'game_play_recap', array( 'id' => $gameId ) ); ?>" method="post">
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
