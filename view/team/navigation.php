<nav id="nav_team">
	<ul>
		<li><a href="index.php?section=team_view&id=<?php echo $_GET['id']?>&team=roster">Roster</a></li>
		<li><a href="index.php?section=team_view&id=<?php echo $_GET['id']?>&team=schedule">Schedules</a></li>
		<li><a href="index.php?section=team_view&id=<?php echo $_GET['id']?>&team=stats"">Stats</a></li>
		<li class="has_dropdown">
			<a href="#">Archives</a>
			<ul class="dropdown">
			<?php
			$lastTenSeasons = getLastTenSeasons();
			foreach ($lastTenSeasons as $key => $season)
			{
				echo '<li><a href="index.php?section=season_view&year=' . $season->getYear() . '" >';
				echo  $season->getYear();
				echo '</a></li>';
			}
			?>
		</ul>
		</li>
	</ul>
</nav>