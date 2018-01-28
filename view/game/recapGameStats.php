<form action="<?php echo $GLOBALS['router']->generateUrl( 'game_play_submit', array( 'id' => $gameId ) ); ?>" method="post">
    <?php
    foreach($index as $teamIndex)
    {
    ?>   
        <section>    
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
                            <th>Player</th>
                            <th>Minutes</th>
                            <th>Points</th>
                            <th>FTM</th>
                            <th>FTA</th>
                            <th>FGM</th>
                            <th>FGA</th>
                            <th>3FGM</th>
                            <th>3FGA</th>
                            <th>Off.Reb.</th>
                            <th>Def.Reb.</th>
                            <th>Rebounds</th>
                            <th>Assists</th>
                            <th>Turnovers</th>
                            <th>Steals</th>
                            <th>Blocks</th>
                            <th>Efficiency</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <?php
                        foreach($playersStats[$teamIndex] as $playerStats)
                        {
                            if($playerStats->getGames() == 1)
                            {
                                $playerId = $playerStats->getPlayerId();
                                echo '<tr>';
                                echo '<td>';
                                if($playerId == 'Total')
                                {
                                    echo 'Total';
                                }
                                else
                                {
                                    $player = new Player($playerId);
                                    echo $player->getFullName();
                                }
                                echo '</td>';
                                include('view/game/viewAddedGameStats.php');  
                                echo '</tr>';
                            } 
                        }
                        ?>
                    </tbody>
                </table>
            </table>
        </section>
    <?php
    }
    ?>
    <br />
    <center>
        <input type="submit" value="Submit"/> 
    </center>
</form>
