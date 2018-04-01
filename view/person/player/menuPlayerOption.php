<?php
	/** Description
	  * Displays the transaction menu
	  */
	  
	/** Parameters
	  * $sectionTitle
	  */
?>
<section>
<?php
$sectionTitle = 'NBA Activate Players Option';
echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
?>
    <div class="sectionBody">
    <p>It is time to activate team and player option.</p>
    <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'player_list_option' ) ?>">this link</a> to see players who have an option.</p>
    </div>
</section>