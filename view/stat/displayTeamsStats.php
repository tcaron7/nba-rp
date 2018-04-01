<?php	
	echo 'Stats of the season... I LOVE THIS GAME !!!<br />';
	echo 'Best NBA Scorers !!!<br /><br />';
?>
<form action="<?php echo $GLOBALS['router']->generateUrl( 'stat_display', array( 'selection' => 'teams' ) ); ?>" method="post">
    <p>
        <fieldset>
        <legend>Stats filtering</legend>
        Position	:  <select name="stats">
                          <option value="points">Points</option>
                          <option value="FTPercentage">%FT</option>
                          <option value="FGPercentage">%FG</option>
                          <option value="3FGPercentage">%3FG</option>
						  <option value="offRebounds">Off. rebounds</option>
						  <option value="defRebounds">Def. rebounds</option>
                          <option value="rebounds">Rebounds</option>
                          <option value="assists">Assists</option>
						  <option value="turnovers">Turnovers</option>
                          <option value="steals">Steals</option>
                          <option value="blocks">Blocks</option>
                          <option value="efficiency">Efficiency</option>
                        </select><br /> 
                        
        Months		:  <select name="period">
						  <option value="Season">Regular Season</option>
						  <option value="Playoffs">Playoffs</option>
						  <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                          <option value="January">January</option>
                          <option value="February">February</option>
						  <option value="March">March</option>
						  <option value="April">April</option>
                        </select><br /> 
        <input type="submit" value="Filter"/>
        </fieldset> 
    </p>
</form>
<?php
	$rank = 1;
?>   
    <table class="stats-leaders">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Team</th>
                <th>Games</th>
                <th>Min/G</th>
                <th>Pts/G</th>
                <th>FTM</th>
				<th>FTA</th>
				<th>%FT</th>
                <th>FGM</th>
				<th>FGA</th>
				<th>%FG</th>
                <th>3FGM</th>
				<th>3FGA</th>
				<th>%3FG</th>
                <th>Reb D/G</th>
                <th>Reb O/G</th>
                <th>Reb/G</th>
                <th>Assists/G</th>
                <th>Turnovers/G</th>
                <th>Steals/G</th>
                <th>Blocks/G</th>
                <th>Eff/G</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    if(isset($teams))
                    {
                        foreach($teams as $team)
                        {
                            $stat = $team->getStats()[$season];
                            $games = $stat->getGames();
							
                            echo '<tr>';
                            echo '<td>' . $rank                                              	. '</td>';
							echo '<td>';
							echo '<a href="' . $GLOBALS['router']->generateUrl( 'team_display', array( 'id' => $team->getId() ) ) . '">';
							echo $team->getFullname();
							echo '</a>';
							echo '</td>';
                            echo '<td>' . $games                                             	. '</td>';
                            echo '<td>' . round($stat->getMinutes()/max(1,$games),1)           	. '</td>';
                            echo '<td>' . round($stat->getPoints()/max(1,$games),1)          	. '</td>';
                            echo '<td>' . $stat->getFreeThrowsMade()          				 	. '</td>';
							echo '<td>' . $stat->getFreeThrowsAttempt()          			 	. '</td>';
							echo '<td>' . round($stat->getFreeThrowsPercentage(),1)          	. '</td>';
							echo '<td>' . $stat->getFieldGoalMade()          				 	. '</td>';
							echo '<td>' . $stat->getFieldGoalAttempt()          			 	. '</td>';
                            echo '<td>' . round($stat->getFieldGoalPercentage(),1)           	. '</td>';
							echo '<td>' . $stat->getThreePointsMade()          				 	. '</td>';
							echo '<td>' . $stat->getThreePointsAttempt()          			 	. '</td>';
                            echo '<td>' . round($stat->getThreePointsPercentage(),1)         	. '</td>';
                            echo '<td>' . round($stat->getDefensiveRebounds()/max(1,$games),1)	. '</td>';
                            echo '<td>' . round($stat->getOffensiveRebounds()/max(1,$games),1)	. '</td>';
                            echo '<td>' . round($stat->getRebounds()/max(1,$games),1)        	. '</td>';
                            echo '<td>' . round($stat->getAssists()/max(1,$games),1)          	. '</td>';
                            echo '<td>' . round($stat->getTurnovers()/max(1,$games),1)       	. '</td>';
                            echo '<td>' . round($stat->getSteals()/max(1,$games),1)          	. '</td>';
                            echo '<td>' . round($stat->getBlocks()/max(1,$games),1)         	. '</td>';
                            echo '<td>' . round($stat->getEvaluation()/max(1,$games),1)       	. '</td>';
                            echo '</tr>';
                            $rank = $rank + 1;
                        }   
                    }
                ?>
        </tbody>
    </table>
