<fieldset>
	<input type="hidden" name="playerId" value="<?php echo $id ?>">
	<legend>Player injury</legend>
	Days of recovery	:  <input type="number" name="recovery" min="0" required /><br />
	Severity			:  <select name="severity">
							  <option value="Unavailable">Unavailable</option>
							  <option value="Weakened">Weakened</option>
							</select><br /> 
</fieldset>