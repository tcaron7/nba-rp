<?php
foreach ($prospects as $prospect)
{
    echo '<div>';
    echo '<input
        type="checkbox"
        id="selectProspect' . $prospect->getPersonId() .'"
        name="selectedProspects[]"
        value=' . $prospect->getPersonId() . '
    />';
    
    echo '<label for="selectTeam' . $prospect->getPersonId() .'">' . $prospect->getRanking() . '. ' . $prospect->getFullName() . '</label>';
    echo '</div>';
}
echo '</br>';
?>