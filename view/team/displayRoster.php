
<?php
	echo 'Roster of the ' . $team->getCity() . ' ' . $team->getName() . '<br />';
    echo $team->getNumberOfPlayersInTeam() . ' players are under contract<br />';
    echo 'Total salary spend by the team is ' . $team->getSalarialMarginTeam() . '$';
?>
<fieldset>    
<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Player</th>
            <th>Age</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Experience</th>
            <th>Formation</th>
            <th>Nationality</th>
            <th>Salary</th>
            <th>Contract</th>
            <th>Contract type</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if(isset($teamPlayers))
        {
            foreach($teamPlayers as $teamPlayer)
            {
                echo '<tr>';
                echo '<td>' . $teamPlayer->getPosition()                                 . '</td>';
                echo '<td>';
                echo '<a href="index.php?section=player&player_id=' . $teamPlayer->getId() .'">';
                echo $teamPlayer->getFullname();
                echo '</a>';
                echo '</td>';
                echo '<td>' . $teamPlayer->getAge()                                      . '</td>';
                echo '<td>' . $teamPlayer->getHeight()                                   . '</td>';
                echo '<td>' . $teamPlayer->getWeight()                                   . '</td>';
                echo '<td>' . $teamPlayer->getExperience() . '</td>';
                echo '<td>' . $teamPlayer->getFormation() . '</td>';
                echo '<td>' . $teamPlayer->getNationality() . '</td>';
                echo '<td>' . $teamPlayer->getSalary() . '</td>';
                echo '<td>' . $teamPlayer->getGuarantedYear() . '</td>';
                echo '<td>' . $teamPlayer->getContractType() . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
</fieldset>