<?php	
	echo '<br /><br />Retired Players... I LOVE THIS GAME !!!<br />';
	$oldLetter = NULL;
	foreach($retiredPlayers as $retiredPlayer)
	{
		if(substr($retiredPlayer->getName(),0,1)!=$oldLetter)
		{
			echo '<br />' . substr($retiredPlayer->getName(),0,1) . '<br />';
		}
        echo '<a href="index.php?section=player&player_id=' . $retiredPlayer->getId() .'">';
		echo $retiredPlayer->getFirstname() . ' ' . $retiredPlayer->getName() . '</a>';
        
        echo '<br />';
        
		$oldLetter = substr($retiredPlayer->getName(),0,1);
	}
?>
