<form action="index.php?section=play&option=fillGame&id=<?php echo $gameId; ?>" method="post">
    <?php
    foreach($index as $teamIndex)
    {
    ?>   
        <section class="preGameSheet">    
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
                        foreach($teamPlayers[$teamIndex] as $player)
                        {
                            echo '<tr>';
                            echo '<td>' . $player->getFullName() . '</td>';
                            $playerId = $player->getId();
                            $playerMinutes = $playersMinutes[$teamIndex][$playerId];
							include('view/game/inputAddPreGameStats.php');
                            echo '</tr>';
                        }
                        $ftm      = $gameTeamsStats[$teams[$teamIndex]->getId()]['ftm'];
                        $fta      = $gameTeamsStats[$teams[$teamIndex]->getId()]['fta'];
                        $twoFgm   = $gameTeamsStats[$teams[$teamIndex]->getId()]['2fgm'];
                        $twoFga   = $gameTeamsStats[$teams[$teamIndex]->getId()]['2fga'];
                        $threeFgm = $gameTeamsStats[$teams[$teamIndex]->getId()]['3fgm'];
                        $threeFga = $gameTeamsStats[$teams[$teamIndex]->getId()]['3fga'];
                        $offReb   = $gameTeamsStats[$teams[$teamIndex]->getId()]['ro'];
                        $defReb   = $gameTeamsStats[$teams[$teamIndex]->getId()]['rd'];
                        $assist   = $gameTeamsStats[$teams[$teamIndex]->getId()]['assist'];
                        $turnover = $gameTeamsStats[$teams[$teamIndex]->getId()]['turnover'];
                        $steal    = $gameTeamsStats[$teams[$teamIndex]->getId()]['steal'];
                        $block    = $gameTeamsStats[$teams[$teamIndex]->getId()]['block'];
                        ?>
						<tr>
                            <td>Total</td>
                            <td id="total-<?php echo $teamIndex; ?>-minutes">&nbsp;</td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-ftm"              type="number" name="<?php echo $gameId . '[' . $teamIndex . '][ftm]'; ?>"              min="0" value="<?php echo $ftm;      ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-fta"              type="number" name="<?php echo $gameId . '[' . $teamIndex . '][fta]'; ?>"              min="0" value="<?php echo $fta;      ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-fgm"              type="number" name="<?php echo $gameId . '[' . $teamIndex . '][fgm]'; ?>"              min="0" value="<?php echo $twoFgm;   ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-fga"              type="number" name="<?php echo $gameId . '[' . $teamIndex . '][fga]'; ?>"              min="0" value="<?php echo $twoFga;   ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-3fgm"             type="number" name="<?php echo $gameId . '[' . $teamIndex . '][3fgm]'; ?>"             min="0" value="<?php echo $threeFgm; ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-3fga"             type="number" name="<?php echo $gameId . '[' . $teamIndex . '][3fga]'; ?>"             min="0" value="<?php echo $threeFga; ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-offensive_boards" type="number" name="<?php echo $gameId . '[' . $teamIndex . '][offensive_boards]'; ?>" min="0" value="<?php echo $offReb;   ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-defensive_boards" type="number" name="<?php echo $gameId . '[' . $teamIndex . '][defensive_boards]'; ?>" min="0" value="<?php echo $defReb;   ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-assists"          type="number" name="<?php echo $gameId . '[' . $teamIndex . '][assists]'; ?>"          min="0" value="<?php echo $assist;   ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-turnovers"        type="number" name="<?php echo $gameId . '[' . $teamIndex . '][turnovers]'; ?>"        min="0" value="<?php echo $turnover; ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-steals"           type="number" name="<?php echo $gameId . '[' . $teamIndex . '][steals]'; ?>"           min="0" value="<?php echo $steal;    ?>"></td>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-blocks"           type="number" name="<?php echo $gameId . '[' . $teamIndex . '][blocks]'; ?>"           min="0" value="<?php echo $block;    ?>"></td>
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
