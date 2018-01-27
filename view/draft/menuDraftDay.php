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
            <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'draft_lottery' ) ; ?>">this link</a> to proceed the lottery.</p>
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
                echo '<p>Underclassmen prospects will declare them eligible to the ' . $year . 'draft.</p>';
                echo '<p>Follow <a href="' . $GLOBALS['router']->generateUrl( 'draft_select' ) . '">this link</a> to complete the prospect list.</p>';
            }
    ?>      
            <p>The <?php echo $year;?> NBA draft will begin.</p>
            <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'draft_do' ); ?>">this link</a> to start the draft.</p>
    <?php 
        } 
    ?>
    </div>
<?php 
} 
?>
</section>