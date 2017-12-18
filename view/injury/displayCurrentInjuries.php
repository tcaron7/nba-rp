<table class="currentInjury">
    <thead>
        <tr>
            <th colspan="6">
				Current Injuries
            </th>
        </tr>
        <tr>
            <th>Player</th>
            <th>Team</th>
            <th>Recovery Date</th>
            <th>Injury Date</th>
            <th>Injury Severity</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if(isset($injuries))
        {
            foreach($injuries as $injury)
            {
				$player = new Player($injury->getPlayerId());
				echo '<tr>';
				echo '<td>' . $player->getFullname()			. '</td>';
				echo '<td>' . $player->getTeam()->getName()		. '</td>';
				echo '<td>' . $injury->getRecoveryDate()		. '</td>';
				echo '<td>' . $injury->getInjuryDate()			. '</td>';
				echo '<td>' . $injury->getSeverity() 			. '</td>';
				echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>