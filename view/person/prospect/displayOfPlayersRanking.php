<?php	
	echo 'Prospects ranking : Class ' . $predictedDraftYear . '... I LOVE THIS GAME !!!<br /><br />';
?>
<fieldset>    
<table>
    <thead>
        <tr>
            <th>Ranking</th>
            <th>Position</th>
            <th>Player</th>
            <th>Age</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Formation</th>
            <th>Nationality</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if(isset($prospectsClass))
        {
            foreach($prospectsClass as $prospect)
            {
                echo '<tr>';
                echo '<td>' . $prospect->getRanking() . '</td>';
                echo '<td>' . $prospect->getPosition()                                 . '</td>';
                echo '<td>' . $prospect->getFirstname() . ' ' . $prospect->getName() . '</td>';
                echo '<td>' . $prospect->getAge()                                      . '</td>';
                echo '<td>' . $prospect->getHeight()                                   . '</td>';
                echo '<td>' . $prospect->getWeight()                                   . '</td>';
                echo '<td>' . $prospect->getFormation() . '</td>';
                echo '<td>' . $prospect->getNationality() . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
</fieldset>