 <table class="player-stats">
	<thead>
		<tr>
			<th>Date</th>
			<th>Opponent</th>
			<th>Score</th>
			<th>Min</th>
			<th>Pts</th>
			<th>FTM</th>
			<th>FTA</th>
			<th>%FT</th>
			<th>2FGM</th>
			<th>2FGA</th>
			<th>%2FG</th>
			<th>3FGM</th>
			<th>3FGA</th>
			<th>%3FG</th>
			<th>Reb D</th>
			<th>Reb O</th>
			<th>Reb</th>
			<th>Assists</th>
			<th>Turnovers</th>
			<th>Steals</th>
			<th>Blocks</th>
			<th>Eff</th>
		</tr>
	</thead>
	<tbody>
			<?php
				$season = getCurrentSeason();
				if(isset($playerGamesLogs[0]))
				{
					foreach($playerGamesLogs as $playerGameLog)
					{
						$gameResult;
						if( $playerGameLog['playerTeamId'] == $playerGameLog['homeTeamId'] )
						{
							$opponentTeam = new Team($playerGameLog['visitorTeamId']);
							$opponent = 'vs ' . $opponentTeam-> getAbbreviation();
							if($playerGameLog['homeTeamScore'] > $playerGameLog['visitorTeamScore'])
							{
								$gameResult = 'W';
							}
							elseif($playerGameLog['homeTeamScore'] < $playerGameLog['visitorTeamScore'])
							{
								$gameResult = 'L';
							}	
						}
						elseif( $playerGameLog['playerTeamId'] == $playerGameLog['visitorTeamId'] )
						{
							$opponentTeam = new Team($playerGameLog['homeTeamId']);
							$opponent = 'at ' . $opponentTeam-> getAbbreviation();
							if($playerGameLog['visitorTeamScore'] > $playerGameLog['homeTeamScore'])
							{
								$gameResult = 'W';
							}
							elseif($playerGameLog['visitorTeamScore'] < $playerGameLog['homeTeamScore'])
							{
								$gameResult = 'L';
							}	
						}
						
						if($playerGameLog['freeThrowsAttempt'] > 0)
						{
							$freeThrowsPercentage = round(100*$playerGameLog['freeThrowsMade']/$playerGameLog['freeThrowsAttempt'],1);
						}
						else
						{
							$freeThrowsPercentage = '/';
						}
						
						if($playerGameLog['twoPointsAttempt'] > 0)
						{
							$twoPointsPercentage = round(100*$playerGameLog['twoPointsMade']/$playerGameLog['twoPointsAttempt'],1);
						}
						else
						{
							$twoPointsPercentage = '/';
						}
						
						if($playerGameLog['threePointsAttempt'] > 0)
						{
							$threePointsPercentage = round(100*$playerGameLog['threePointsMade']/$playerGameLog['threePointsAttempt'],1);
						}
						else
						{
							$threePointsPercentage = '/';
						}
						
						$gameResultString = $gameResult . ' ' . $playerGameLog['homeTeamScore'] . '-' . $playerGameLog['visitorTeamScore'];
						
						echo '<tr>';
						echo '<td>' . $playerGameLog['date']				. '</td>';
						echo '<td>' . $opponent								. '</td>';
						echo '<td>' . $gameResultString						. '</td>';
						echo '<td>' . $playerGameLog['minutes']				. '</td>';
						echo '<td>' . $playerGameLog['points']				. '</td>';
						echo '<td>' . $playerGameLog['freeThrowsMade']		. '</td>';
						echo '<td>' . $playerGameLog['freeThrowsAttempt']	. '</td>';
						echo '<td>' . $freeThrowsPercentage					. '</td>';
						echo '<td>' . $playerGameLog['twoPointsMade']		. '</td>';
						echo '<td>' . $playerGameLog['twoPointsAttempt']	. '</td>';
						echo '<td>' . $twoPointsPercentage					. '</td>';
						echo '<td>' . $playerGameLog['threePointsMade']		. '</td>';
						echo '<td>' . $playerGameLog['threePointsAttempt']	. '</td>';
						echo '<td>' . $threePointsPercentage				. '</td>';
						echo '<td>' . $playerGameLog['offensiveRebounds']	. '</td>';
						echo '<td>' . $playerGameLog['defensiveRebounds']	. '</td>';
						echo '<td>' . $playerGameLog['rebounds']			. '</td>';
						echo '<td>' . $playerGameLog['assists']				. '</td>';
						echo '<td>' . $playerGameLog['turnovers']			. '</td>';
						echo '<td>' . $playerGameLog['steals']				. '</td>';
						echo '<td>' . $playerGameLog['blocks']				. '</td>';
						echo '<td>' . $playerGameLog['evaluation']			. '</td>';
						echo '</tr>';  
					}
				}
			?>
	</tbody>
</table>