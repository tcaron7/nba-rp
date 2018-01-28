<?php	
    if($player->getOptionalYear() == 0 and $player->getGuarantedYear() == 0)
    {
        if( ($player->getExperience() > 0) or ($player->getTeamId() == 0) )
        {
            echo '<br />';
            echo '<a class="button" href="' . $GLOBALS['router']->generateUrl( 'signature_create', array( 'playerId' => $player->getId() ) ) . '">Sign Player</a>';
        }
        else
        {
            echo '<br />';
            echo '<form action="' . $GLOBALS['router']->generateUrl( 'signature_rookie' ) . '" method="post">
                <input type="hidden" name="playerId" value="' . $player->getId() . '" />
                <input type="submit" value="Sign Rookie" />
                </form>';
        }
    }
    echo '<br />';
    echo '<a class="button" href="index.php?section=player&player_id=' . $player->getId() . '&action=retirement">Retire</a>';
?>	

