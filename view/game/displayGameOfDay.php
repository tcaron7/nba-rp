<?php
	/** Description
	  * Displays the games of a giving day
	  */
	  
	/** Parameters
	  * $viewDay
      * $sectionTitle
	  */
?>

<section class="scoreboard">
<?php

    if ( !$sectionTitle )
    {
        $currentDate = getCurrentDate();
        if ($viewDay == $currentDate)
        {
            $sectionTitle = 'Games of the day !';
        }
        else {
            $sectionTitle = 'Games of the day ' . $viewDay . '.';
        }
    }
    echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
    
	$gamesOfTheDay = getGamesByDate($viewDay);
	echo '<div class="gamestrip">';
		if(isset($gamesOfTheDay))	{
			foreach ($gamesOfTheDay as $key => $game)
			{
				$home    = $game->getHomeTeam();
				$visitor = $game->getVisitorTeam();

                // Game not played
                if($game->getHomeTeamScore() == 0 and $game->getVisitorTeamScore() == 0)
                {
                    ?>
                    <div class="tile futur">
                        <div class="clock">&nbsp;</div>
                        <div class="matchup">
                            <div class="visitor">
                                <span class="icon-team-<?php echo preg_replace('/\s+/', '', strtolower($visitor->getName())); ?>">&nbsp;</span>
                                <div class="teamBox">
                                    <div class="score">0</div>
                                    <div class="team">
                                        <?php echo $visitor->getAbbreviation(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="vs">vs</div>
                            <div class="home">
                                <span class="icon-team-<?php echo preg_replace('/\s+/', '', strtolower($home->getName())); ?>">&nbsp;</span>
                                <div class="teamBox">
                                    <div class="score">0</div>
                                    <div class="team">
                                        <?php echo $home->getAbbreviation(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br class="clear"/>
                        <div class="play">
                            <a href="index.php?section=play&option=fillScore&id=<?php echo $game->getId(); ?>">
                                Play Game
                            </a>
                        </div>
                    </div>
                    <?php
                }
                
                // Game played
                else
                {
                    $classWinHome = '';
                    $classWinVisitor = '';
                    
                    if ($game->getHomeTeamScore() > $game->getVisitorTeamScore())
                    {
                        $classWinHome = 'win';
                        
                    }
                    else
                    {
                        $classWinVisitor = 'win';
                    }
                    
                    ?>
                    <a href="<?php echo $GLOBALS['router']->generateUrl( 'game_recap', array( 'id' => $game->getId() ) ); ?>" class="tile final">
                        <div class="clock">Final</div>
                        <div class="matchup">
                            <div class="visitor">
                                <span class="icon-team-<?php echo preg_replace('/\s+/', '', strtolower($visitor->getName())); ?>">&nbsp;</span>
                                <div class="teamBox">
                                    <div class="score <?php echo $classWinVisitor; ?>">
                                        <?php echo $game->getVisitorTeamScore(); ?>
                                    </div>
                                    <div class="team">
                                        <?php echo $visitor->getAbbreviation(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="home">
                                <span class="icon-team-<?php echo preg_replace('/\s+/', '', strtolower($home->getName())); ?>">&nbsp;</span>
                                <div class="teamBox">
                                    <div class="score <?php echo $classWinHome; ?>">
                                        <?php echo $game->getHomeTeamScore(); ?>
                                    </div>
                                    <div class="team">
                                        <?php echo $home->getAbbreviation(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                
                
			}
		}
    echo '</div>';
    echo '<br class="clear"/>';
?>
</section>