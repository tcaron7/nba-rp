<form action="<?php echo $GLOBALS['router']->generateUrl( 'player_insert' ); ?>" method="post">
<p>
	<?php
	include_once('view/person/inputAddPerson.php');
	include_once('view/person/player/inputAddPlayer.php');
    if(isset($id))
    {
        echo 'Player Added...';
    }
	?>
	<input type="submit" value="Submit Player"/> 
</p>
</form>
