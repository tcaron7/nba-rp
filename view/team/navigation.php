<nav id="nav_team">
	<ul>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'team_roster', array( 'id' => $team->getId() ) );?>">Roster</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'team_stats', array( 'id' => $team->getId() ) );?>">Stats</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'team_schedule', array( 'id' => $team->getId() ) );?>">Schedules</a></li>
		<li class="has_dropdown">
			<a href="#">Archives</a>
			<ul class="dropdown">
			<?php
			$lastTenSeasons = getLastTenSeasons();
			foreach ($lastTenSeasons as $key => $season)
			{
				echo '<li><a href="' . $GLOBALS['router']->generateUrl( 'season_display', array( 'year' => $season->getYear() ) ) . '" >';
				echo  $season->getYear();
				echo '</a></li>';
			}
			?>
		</ul>
		</li>
	</ul>
</nav>