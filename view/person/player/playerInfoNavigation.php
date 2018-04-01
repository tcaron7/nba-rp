<nav id="navPlayer">
	<ul>       
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'player_stats', array( 'id' => $player->getId() ) ); ?>">Season</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'player_games', array( 'id' => $player->getId() ) ); ?>">Games Logs</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'player_career', array( 'id' => $player->getId() ) ); ?>">Career</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'player_awards', array( 'id' => $player->getId() ) ); ?>">Awards & Records</a></li>
	</ul>
</nav>

