<fieldset>    
<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Player</th>
            <th>Age</th>
            <th>Experience</th>
            <th>Salary</th>
            <th>Optional Year</th>
            <th>Contract type</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach($playersWithOption as $playerWithOption)
        {
            echo '<tr>';
            echo '<td>' . $playerWithOption->getPosition()      . '</td>';
            echo '<td>' . $playerWithOption->getFullName()      . '</td>';
            echo '<td>' . $playerWithOption->getAge()           . '</td>';
            echo '<td>' . $playerWithOption->getExperience()    . '</td>';
            echo '<td>' . $playerWithOption->getSalary()        . '</td>';
            echo '<td>' . $playerWithOption->getOptionalYear()  . '</td>';
            echo '<td>' . $playerWithOption->getContractType()  . '</td>';
            echo '<td>';
                echo '<form action="index.php?section=players_option&activate=yes" method="post">';
                echo '<input type="hidden" name="playerId" value="' . $playerWithOption->getId() . '">';
                echo '<input type="submit" value="Activate Option"/>';
                echo '</form>';
            echo '</td>';
            echo '<td>';
                echo '<form action="index.php?section=players_option&activate=no" method="post">';
                echo '<input type="hidden" name="playerId" value="' . $playerWithOption->getId() . '">';
                echo '<input type="submit" value="Reject Option"/>';
                echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
</fieldset>

