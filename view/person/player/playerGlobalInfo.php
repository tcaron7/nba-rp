<section id="playerGlobalInfo">
	<div class="sectionHeader">
		<?php 
			echo $player->getFullname();
		?>
	</div>
	
	<div class="sectionBody">
		<?php 
			echo $player->getPosition() . '</br>';
			echo $player->getBirthdate() . ' (' . $player->getAge() . ' years)' . '</br>';
			echo number_format($player->getHeight(),2) . 'm-' . $player->getWeight() . 'kg' . '</br>';
			echo $player->getDraftPosition() . 'th in ' . $player->getDraftPromotion() . '</br>';
			echo 'From ' . $player->getFormation() . '</br>';
			echo $player->getInjuryStatus() . '</br>';
		?>
	</div>
	<div class="sectionBody"> 
		<span class="icon-team-<?php echo preg_replace('/\s+/', '', strtolower($player->getTeam()->getName())); ?>">&nbsp;</span>
		<?php 
			echo $player->getTeam()->getFullname();
		?>
		<table class="player-rough-stats">
			<caption>Current Season Stats</caption>
			<thead>
				<tr>
					<th>Games</th>
					<th>Points</th>
					<th>Rebounds</th>
					<th>Assists</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php
					echo '<td>' . $player->getRoughStats()['games'] 				. '</td>';
					echo '<td>' . round($player->getRoughStats()['points'],1) 		. '</td>';
					echo '<td>' . round($player->getRoughStats()['rebounds'],1) 	. '</td>';
					echo '<td>' . round($player->getRoughStats()['assists'],1) 		. '</td>';
					?>
				</tr>
			</tbody>
		</table>
	</div>
</section>

