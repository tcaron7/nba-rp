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
    <p>It is the last day to activate restricted free agents option, if you do not activate the option of a player, he will become unrestricted free agent.</p>
    <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'player_list_restricted' ); ?>">this link</a> to see players who have an option.</p>
    </div>
</section>