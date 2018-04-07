<form action="<?php echo $GLOBALS['router']->generateUrl( 'signature_player' ); ?>" method="post">
	<fieldset>
		<legend><?php echo $freeAgent->getFullName(); ?></legend>
		<input type="hidden" name="playerId" value="<?php echo $freeAgent->getId(); ?>" />

		<label>Team:</label>
		<select name="teamId">
				<?php
				$allTeams = getAllTeamOrderByName();
				foreach ( $allTeams as $key => $team )
				{
					echo '<option value="' . $team->getId() . '">' . $team->getName() . '</option>';
				}
				?>
		</select>
		<br />

		<label>Salary:</label>
		<input type="text" name="salary" required />
		<br />

		<label>Guaranted:</label>
		<input type="number" name="guarantedYear" min="0" max="5" required />
		<br />

		<label>Optional:</label>
		<input type="number" name="optionalYear" min="0" max="2" required />
		<br />

		<label>Contract:</label>
		<select name="contractType">
			<option value="">None</option>
			<option value="Player">Player</option>
			<option value="Team">Team</option>
		</select>
	</fieldset>
	<input type="submit" value="Sign Player"/> 
</form>
