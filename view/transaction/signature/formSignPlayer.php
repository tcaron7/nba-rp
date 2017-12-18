<form action="nba.php?section=sign_player&id=<?php echo $_GET['id'];?>&submit=yes" method="post">
<p>
	<?php
	include_once('view/transaction/signature/inputSignPlayer.php');
    if(isset($id))
    {
        echo 'Player Signed...';
    }
	?>
	<input type="submit" value="Sign Player"/> 
</p>
</form>
