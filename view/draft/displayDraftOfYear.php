<?php
	/** Description
	  * Displays the draft of a giving day
	  */
	  
	/** Parameters
	  * $viewYear
      * $draftPicks
	  */
?>

<section>
    <div class="sectionHeader">
        NBA <?php echo $viewYear; ?> Draft&nbsp;
		<?php
		if ( $section != 'draft_history' )
		{
			echo '<a href="' . $GLOBALS['router']->generateUrl( 'draft_choose' ) . '" class="button mainoption">Select next pick &raquo;</a>';
			echo '<a href="index.php?section=trade" class="button">Make a trade</a>';
		}
		?>
    </div>
    
    <div class="sectionBody">
        <?php    
        $round = 1;
        include('view/draft/displayDraftTable.php');

        $round = 2;
        include('view/draft/displayDraftTable.php');
        ?>
    </div>
</section>