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
        foreach( $players as $player )
        {
            echo '<tr>';
            echo '<td>' . $player->getPosition()      . '</td>';
            echo '<td>' . $player->getFullName()      . '</td>';
            echo '<td>' . $player->getAge()           . '</td>';
            echo '<td>' . $player->getExperience()    . '</td>';
            echo '<td>' . $player->getSalary()        . '</td>';
            echo '<td>' . $player->getOptionalYear()  . '</td>';
            echo '<td>' . $player->getContractType()  . '</td>';
            echo '<td>';
                echo '<a class="button" href="'
                    . $GLOBALS['router']->generateUrl( 'player_restricted_activate', array( 'id' => $player->getId() ) )
                    . '">Activate Option</a>';
            echo '</td>';
            echo '<td>';
                echo '<a class="button" href="'
                    . $GLOBALS['router']->generateUrl( 'player_restricted_decline', array( 'id' => $player->getId() ) )
                    . '">Reject Option</a>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
</fieldset>

