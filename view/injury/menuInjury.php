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
$sectionTitle = 'NBA Update players injuries';
echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
?>
    <div class="sectionBody">
    <p>Sadly, a new injury has happened.</p>
    <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'injury_select' ); ?>">this link</a> if a player is injured.</p>
    </div>
</section>