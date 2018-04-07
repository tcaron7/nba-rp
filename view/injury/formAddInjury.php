<form action="<?php echo $GLOBALS['router']->generateUrl( 'injury_insert' ); ?>" method="post">
<p>
	<fieldset>
		<legend>Injury on <?php echo $player->getFullName(); ?></legend>
		<input type="hidden" name="playerId" value="<?php echo $player->getId(); ?>">

		<label>Days of recovery	:</label>
		<input type="number" name="recovery" min="0" required /><br />

		<label>Severity			:</label>
		<select name="severity">
			<option value="Unavailable">Unavailable</option>
			<option value="Weakened">Weakened</option>
		</select>
	</fieldset>
	<input type="submit" value="Submit Injury"/> 
</p>
</form>