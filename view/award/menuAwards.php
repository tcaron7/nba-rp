<?php
	/** Description
	  * Displays the injury menu
	  */
	  
	/** Parameters
	  * $sectionTitle
	  */
?>
<section>
<?php
$sectionTitle = 'NBA Months Awards';
echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
?>
    <div class="sectionBody">
    <p>It is time to choose player of the month.</p>
    <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'award_choose', array( 'period' => 'month' ) );?>">this link</a> to select winning players.</p>
    </div>
</section>
<?php
if($viewDay == $season->getRegularSeasonAwardsDate())
{
?>
<section>
<?php
$sectionTitle = 'NBA Season Awards';
echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
?>
    <div class="sectionBody">
    <p>It is time to attribute Season Awards.</p>
    <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'award_choose', array( 'period' => 'season' ) );?>">this link</a> to select winning players.</p>
    </div>
</section>
<?php
}
?>