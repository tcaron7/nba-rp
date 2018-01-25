<p>
<form action="<?php echo $GLOBALS['router']->generateUrl( 'award_attribute' ); ?>" method="post">
    <input type="hidden" name="season"      value="<?php echo getCurrentSeason() ?>" />
    <input type="hidden" name="month"       value="<?php echo $month ?>" />
    <input type="hidden" name="award"       value="<?php echo $name ?>" />
    <input type="hidden" name="playerId"    value="<?php echo $player->getId() ?>" />
    <input type="submit" value="<?php echo $player->getFullname() ?>"/>
</form>
</p>