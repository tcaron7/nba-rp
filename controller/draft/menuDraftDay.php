<?php
	/** Description
	  * Displays the transaction menu
	  */
	  
	/** Parameters
	  * $sectionTitle
	  */

$year = getCurrentSeason();
$lotteryDone = checkLottery($year);
?>
<section>
<?php
if($lotteryDone == 0)
{
    $sectionTitle = 'NBA Lottery';
    echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
?>
    <div class="sectionBody">
    <?php 
        if($sectionTitle == 'NBA Lottery')
        { 
    ?>
            <p>It is time to NBA Draft Lottery.</p>
            <p>Follow <a href="nba.php?section=lottery">this link</a> to proceed the lottery.</p>
    <?php 
        } 
    ?>
    </div>
<?php 
}
else
{
    $sectionTitle = 'NBA Draft';
    echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
?>
    <div class="sectionBody">
    <?php 
        if($sectionTitle == 'NBA Draft')
        {
            if(checkIfDraftHasStarted($year) == false)
            {
                echo '<p>Underclassmen prospects will declare them eligible to the <?php echo $year;?> draft.</p>';
                echo '<p>Follow <a href="nba.php?section=draft_subscription">this link</a> to complete the prospect list.</p>';
            }
    ?>      
            <p>The <?php echo $year;?> NBA draft will begin.</p>
            <p>Follow <a href="nba.php?section=draft">this link</a> to start the draft.</p>
    <?php 
        } 
    ?>
    </div>
<?php 
} 
?>
</section>