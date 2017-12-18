<form action="nba.php?section=add_prospect&submit=yes" method="post">
<p>
	<?php
	include_once('view/person/inputAddPerson.php');
	include_once('view/person/prospect/inputAddProspect.php');
    if(isset($id))
    {
        echo 'Prospect Added...';
    }
	?>
	<input type="submit" value="Submit Prospect"/> 
</p>
</form>
