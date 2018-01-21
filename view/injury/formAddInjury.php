<form action="index.php?section=injury&player_id=<?php echo $id ?>&submit=yes" method="post">
<p>
	<?php
	include_once('view/injury/inputAddInjury.php');
    if(isset($id))
    {
        echo 'Injury Added...';
    }
	?>
	<input type="submit" value="Submit Injury"/> 
</p>
</form>