<p>
<form action="nba.php?section=awards&type=submit" method="post">
    <?php 
        if($_GET['type'] == 'month' and getCurrentDay() == 1)
        {
            if(getCurrentMonth() == 1)
            {
                $month = 12;
            }
            else
            {
                $month = getCurrentMonth() - 1;
            }
        }
        elseif($_GET['type'] == 'month' and getCurrentDay() != 1)
        {
            $month = getCurrentMonth();
        }
        else
        {
            $month = 0;
        }
    ?>
    <input type="hidden" name="season"      value="<?php echo getCurrentSeason() ?>" />
    <input type="hidden" name="month"       value="<?php echo $month ?>" />
    <input type="hidden" name="award"       value="<?php echo $_GET['award'] ?>" />
    <input type="hidden" name="playerId"    value="<?php echo $player->getId() ?>" />
    <input type="submit" value="<?php echo $player->getFullname() ?>"/>
</form>
</p>