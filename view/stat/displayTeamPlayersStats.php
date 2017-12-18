<?php	
	echo 'Stats of the season... I LOVE THIS GAME !!!<br />';
?>
<table class="stats-leaders">
	<thead>
		<tr>
			<th>Player</th>
			<th>Games</th>
			<th>Min/G</th>
			<th>Pts/G</th>
			<th>FTM</th>
			<th>FTA</th>
			<th>%FT</th>
			<th>2FGM</th>
			<th>2FGA</th>
			<th>%2FG</th>
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
						$stat = $player->getStats()[$season];
						if(!is_null($stat) && $stat->getGames()>0)
						{
							$games = $stat->getGames();
							echo '<tr>';
							echo '<td>';
							echo '<a href="nba.php?section=player&player_id=' . $player->getId() .'">';
							echo $player->getFullname();
							echo '</a>';
							echo '</td>';
							echo '<td>' . $games                                             . '</td>';
							echo '<td>' . round($stat->getMinutes()/$games,1)                . '</td>';
							echo '<td>' . round($stat->getPoints()/$games,1)                 . '</td>';
							echo '<td>' . $stat->getFreeThrowsMade()          				 . '</td>';
							echo '<td>' . $stat->getFreeThrowsAttempt()          			 . '</td>';
							echo '<td>' . round($stat->getFreeThrowsPercentage(),1)          . '</td>';
							echo '<td>' . $stat->getTwoPointsMade()          				 . '</td>';
							echo '<td>' . $stat->getTwoPointsAttempt()          			 . '</td>';
							echo '<td>' . round($stat->getTwoPointsPercentage(),1)           . '</td>';
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
						}
					}   
				}
			?>
	</tbody>
</table>
