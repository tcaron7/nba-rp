 <table class="player-stats">
	<thead>
		<tr>
			<th>Career</th>
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
			foreach($careerStats as $season => $stat)
			{
				$games = $stat->getGames();
				if($games>0)
				{
					echo '<tr>';
					echo '<td>' . $stat->getSeason()								 . '</td>';
					echo '<td>' . $stat->getTeam()->getName()                		 . '</td>';
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
				}
			}
		?>
	</tbody>
</table>