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

    if ( !$sectionTitle )
    {
        $sectionTitle = 'Transaction';
    }
    echo '<div class="sectionHeader">' . $sectionTitle . '</div>';
?>
    <div class="sectionBody">
    <?php 
        if($sectionTitle == 'Do a trade')
        { 
    ?>
            <p>During this period you are still able to make a trade.</p>
            <p>Follow <a href="<?php echo $GLOBALS['router']->generateUrl( 'trade_create' ); ?>">this link</a> to make a trade.</p>
    <?php 
        } 
        elseif($sectionTitle == 'Sign a player')
        { 
    ?>
            <p>During this period you are still able to sign a player.</p>
            <p>Follow <a href="index.php?section=signature">this link</a> to sign a player.</p>
    <?php 
        } 
    ?>
    </div>

</section>