<span class="logo" title="Home"><a href="<?php echo $GLOBALS['router']->generateUrl( 'home' ); ?>">&nbsp;</a></span>

<div class="topLine">

    <div class="case">
        <span>
            <?php
                preg_match('/^(?<century>[0-9]{2})(?<year>[0-9]{2})-(?<month>[0-9]{2})-(?<day>[0-9]{2})$/', getCurrentDate(), $current);
                $currentDate = new Date($current['year'], $current['month'], $current['day']);
                echo $currentDate->getStringDay() . ',&nbsp;' . $currentDate->getStringMonth() . '&nbsp;' . $currentDate->getDay();
                
                if (preg_match("/1$/", $current['day']))
                {
                    echo '<sup>st</sup>&nbsp;';
                }
                else if (preg_match("/2$/", $current['day']))
                {
                    echo '<sup>nd</sup>&nbsp;';
                }
                else if (preg_match("/3$/", $current['day']))
                {
                    echo '<sup>rd</sup>&nbsp;';
                }
                else
                {
                    echo '<sup>th</sup>&nbsp;';
                }
                
                echo $currentDate->getYear();
            ?>
        </span>
    </div>
    
    <?php
        if(checkDayOver() == 1)
        {
    ?>
            <div class="case">
            <a href="<?php echo $GLOBALS['router']->generateUrl( 'next_day' ); ?>" class="button mainoption">Next Day &raquo;</a>
            </div>
    <?php
        }
    ?>

</div>

<?php include_once('view/navigation.php'); ?>

<br class="clear" />