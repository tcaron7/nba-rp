<?php	
	echo 'Stats of the season... I LOVE THIS GAME !!!<br />';
	echo 'Best NBA Scorers !!!<br /><br />';
?>
<form action="#" method="post">
    <p>
        <fieldset>
        <legend>Stats filtering</legend>
        Stats		:  <select name="stats">
						  <option value="minutes">Minutes</option>
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
                        
        Players		:  <select name="players">
                          <option value="All">All</option>
						  <option value="Rookie">Rookie</option>
						  <option value="Sophomore">Sophomore</option>
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
                <th>Player</th>
                <th>Games</th>
                <th>Min/G</th>
                <th>Pts/G</th>
                <th>FTM</th>
				<th>FTA</th>
				<th>%FT</th>
                <th>2FGM</th>
				<th>2FGA</th>
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
                    if(isset($players))
                    {
                        foreach($players as $player)
                        {
							if($period != 'Season')
							{
								if(isset($player->getMonthsSeasonStats()[$period]))
								{
									$stat = $player->getMonthsSeasonStats()[$period];
								}
							}
							else
							{
								$stat = $player->getStats()[$season];
							}
							if(isset($stat))
							{
								$games = $stat->getGames();
								echo '<tr>';
								echo '<td>' . $rank                                              . '</td>';
								echo '<td>';
								echo '<a href="' . $GLOBALS['router']->generateUrl( 'player_display', array( 'id' => $player->getId() ) ) .'">';
								echo $player->getFullname();
								echo '</a>';
								echo '</td>';
								echo '<td>' . $games                                             . '</td>';
								echo '<td>' . round($stat->getMinutes()/$games,1)                . '</td>';
								echo '<td>' . round($stat->getPoints()/$games,1)                 . '</td>';
								echo '<td>' . $stat->getFreeThrowsMade()          				 . '</td>';
								echo '<td>' . $stat->getFreeThrowsAttempt()          			 . '</td>';
								echo '<td>' . round($stat->getFreeThrowsPercentage(),1)          . '</td>';
								echo '<td>' . $stat->getFieldGoalMade()          				 . '</td>';
								echo '<td>' . $stat->getFieldGoalAttempt()          			 . '</td>';
								echo '<td>' . round($stat->getFieldGoalPercentage(),1)           . '</td>';
								echo '<td>' . $stat->getThreePointsMade()          				 . '</td>';
								echo '<td>' . $stat->getThreePointsAttempt()          			 . '</td>';
								echo '<td>' . round($stat->getThreePointsPercentage(),1)         . '</td>';
								echo '<td>' . round($stat->getDefensiveRebounds()/$games,1)		 . '</td>';
								echo '<td>' . round($stat->getOffensiveRebounds()/$games,1)		 . '</td>';
								echo '<td>' . round($stat->getRebounds()/$games,1)               . '</td>';
								echo '<td>' . round($stat->getAssists()/$games,1)                . '</td>';
								echo '<td>' . round($stat->getTurnovers()/$games,1)         	 . '</td>';
								echo '<td>' . round($stat->getSteals()/$games,1)                 . '</td>';
								echo '<td>' . round($stat->getBlocks()/$games,1)                 . '</td>';
								echo '<td>' . round($stat->getEvaluation()/$games,1)             . '</td>';
								echo '</tr>';
								$rank = $rank + 1;
							}
                        }   
                    }
                ?>
        </tbody>
    </table>
