<nav id="navGlobal">
	<ul>
		<li class="hasDropdown">
			<a href="#" >Teams</a>
            <div class="dropdown neighbours">
                <div class="primary">
                    <span class="subheading">Eastern Conference</span>
                    <ul>
                        <?php
                        $allEastTeams = getAllEastTeamsOrderByName();
                        foreach ($allEastTeams as $key => $team)
                        {
                            echo '<li>';
                            echo '<span class="icon-team-'.preg_replace('/\s+/', '', strtolower($team->getName())).'">&nbsp;</span>';
                            echo '<a href="' . $GLOBALS['router']->generateUrl( 'team_display', array( 'id' => $team->getId() ) ) . '" >';
                            echo $team->getFullName();
                            echo '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="secondary">
                    <span class="subheading">Western Conference</span>
                    <ul>
                        <?php
                        $allWestTeams = getAllWestTeamsOrderByName();
                        foreach ($allWestTeams as $key => $team)
                        {
                            echo '<li>';
                            echo '<span class="icon-team-'.preg_replace('/\s+/', '', strtolower($team->getName())).'">&nbsp;</span>';
                            echo '<a href="' . $GLOBALS['router']->generateUrl( 'team_display', array( 'id' => $team->getId() ) ) . '" >';
                            echo $team->getFullName();
                            echo '</a></li>';
                        }
                        ?>
                    </ul>
                </div> 
            </div>
		</li>
        
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'game_schedule' ); ?>">Scores & Schedules</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'player_list_all' ); ?>">Players</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'standings_display' ); ?>">Standings</a></li>
		
		<li class="hasDropdown">
			<a href="#">Stats</a>
            <div class="dropdown">
                <div class="primary">
                    <ul>
                        <li><a href="<?php echo $GLOBALS['router']->generateUrl( 'stat_filter', array( 'selection' => 'players' ) ); ?>">Players Top Stats</a></li>
                        <li><a href="<?php echo $GLOBALS['router']->generateUrl( 'stat_filter', array( 'selection' => 'teams' ) ); ?>">Team Stats</a></li>
                    </ul>
                </div>
            </div>
		</li>
		
		<li class="hasDropdown">
            <a href="#">News</a>
            <div class="dropdown">
                <div class="primary">
                    <ul>
                        <li><a href="<?php echo $GLOBALS['router']->generateUrl( 'award_news' ); ?>">Awards</a></li>
                        <li><a href="#">Transactions</a></li>
                        <li><a href="<?php echo $GLOBALS['router']->generateUrl( 'injury_current' ); ?>">Injuries</a></li>
                    </ul>
                </div>
            </div>
		</li>
        
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'draft_history' ); ?>">Draft</a></li>
		<li><a href="<?php echo $GLOBALS['router']->generateUrl( 'prospect_list', array( 'selection' => 'all' ) ); ?>">Prospects</a></li>
        
		<li class="hasDropdown">
			<a href="#">Archives</a>
            <div class="dropdown">
                <div class="primary">
                    <ul>
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
                </div>
            </div>
		</li>

	</ul>
</nav>