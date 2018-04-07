<form action="<?php echo $GLOBALS['router']->generateUrl( 'game_play_pre', array( 'id' => $gameId ) ); ?>" method="post">
    <?php
    foreach($index as $teamIndex)
    {
    ?>   
        <section class="fillScoreSheet">    
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
                            <th style="text-align: left;">Score</th>
                        </tr>
                    </thead>
                
                    <tbody>
						<tr>
                            <td><input class="size2 total-<?php echo $teamIndex; ?>-score" type="number" name="<?php echo $gameId . '[' . $teamIndex . '][score]'; ?>"min="0"></td>
						</tr>
                    </tbody>
                </table>
            </div>
        </section>
    <?php
    }
    ?>
    <br />
    <section class="numberOvertime">
        <input class="size2 number_overtime" type="number" name="<?php echo $gameId . '[numberOvertime]'; ?>"min="0">
    </section>
    <br />
    <center>
        <input type="submit" value="Recap"/> 
    </center>
</form>
