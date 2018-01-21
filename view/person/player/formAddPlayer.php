<form action="index.php?section=add_player&submit=yes" method="post">
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
