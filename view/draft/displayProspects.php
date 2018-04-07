<b>Selected prospects</b> <br />
<a href="<?php echo $GLOBALS['router']->generateUrl( 'draft_select' ); ?>">Choose more</a><br /><br />

<?php

foreach ( $prospects as $prospect )
{
	echo $prospect->getFullName() . '<br/>';
}