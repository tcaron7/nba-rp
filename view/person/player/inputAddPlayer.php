<fieldset>
	<legend>Player information</legend>
	Position	:  <select name="position">
					  <option value="PG">PG</option>
					  <option value="SG">SG</option>
					  <option value="SF">SF</option>
					  <option value="PF">PF</option>
					  <option value="C">C</option>
					</select><br /> 
	Team 		: <select name="teamId">
					  <option value="0">None</option>
					  <?php
					  $allTeams = getAllTeamOrderByName();
					  foreach ($allTeams as $key => $team)
					  {
						echo '<option value="' . $team->getId() . '">' . $team->getName() . '</option>';  
					  }
					  ?>
				  </select><br />
	Salary 		: <input type="text" name="salary" required /><br />
	Guaranted 	: <input type="number" name="guarantedYear" min="0" max="5" required /><br />
	Optional 	: <input type="number" name="optionalYear" min="0" max="2" required /><br />
	Contract	: <select name="contractType">
					  <option value="">None</option>
					  <option value="Rookie">Rookie</option>
					  <option value="Player">Player</option>
					  <option value="Team">Team</option>
					</select><br /> 
	Experience 	: <input type="number" name="experience" min="0" required /><br />
	Promotion 	: <input type="number" name="draftPromotion" min="2000" required /><br />
	Draft 		: <input type="number" name="draftPosition" min="0" max="60" required /><br />
</fieldset>