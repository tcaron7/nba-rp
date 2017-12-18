<?php
	/** Description
	  * Displays the games of the season
      * TODO
	  */
	  
	/** Parameters
	  * $viewDay
	  */
?>

<section>
    <div class="sectionHeader">Games of the season !</div>
    
    <div class="sectionBody">
    <?php
        $oldDate = NULL;
        foreach ($seasonGames as $game)
        {
            if($game->getGameDate() != $oldDate)
            {
                echo '<b>' . $game->getGameDate() . '</b><br />';
            }
            if($game->getStatus())
            {
                echo $game->getVisitorTeam()->getName() . ' ' . $game->getVisitorTeamScore() . '<br />';
				echo $game->getHomeTeam()->getName() . ' ' . $game->getHomeTeamScore() . '<br />';
				echo '<a href="nba.php?section=schedule&gameId=' . $game->getId() . '">';
				echo 'Recap';
				echo '</a><br /><br />';
            }
            else
            {
                echo $game->getVisitorTeam()->getName() . '<br />';
				echo $game->getHomeTeam()->getName() . '<br /><br />';
            }
            $oldDate = $game->getGameDate();
        }
    ?>
    </div>
</section>