<fieldset>
	<legend><?php echo $freeAgent->getFirstname() . ' ' . $freeAgent->getName(); ?></legend>
	Team 		: <select name="teamId">
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
					  <option value="Player">Player</option>
					  <option value="Team">Team</option>
                  </select><br /> 
</fieldset>