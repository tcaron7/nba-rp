<?php	
    if($player->getOptionalYear() == 0 and $player->getGuarantedYear() == 0)
    {
        if( ($player->getExperience() > 0) or ($player->getTeamId() == 0) )
        {
            echo '<br />';
            echo '<a class="button" href="nba.php?section=sign_player&id=' . $player->getId() . '">Sign Player</a>'; 
        }
        else
        {
            echo '<br />';
            echo '<a class="button" href="nba.php?section=sign_rookie&id=' . $player->getId() . '">Sign Rookie</a>';
        }
    }
    echo '<br />';
    echo '<a class="button" href="nba.php?section=player&player_id=' . $player->getId() . '&action=retirement">Retire</a>';
?>	

