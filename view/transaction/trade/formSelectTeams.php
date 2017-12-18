<?php
	/** Description
	  * Team select menu for Trade
	  */
	  
	/** Parameters
	  * $allTeams
	  */
?>

<section id="selectTeams">
    <div class="sectionHeader">Select Teams</div>
    
    <div class="sectionBody">
    <?php
    foreach ($allTeams as $key => $team)
    {
        echo '<div class="checkboxInputLabel">';
        echo '<input
            type="checkbox"
            id="selectTeam' . $team->getId() .'"
            name="selectedTeams[]"
            value=' . $team->getId() . '
        />';
        
        echo '<label for="selectTeam' . $team->getId() .'">' . $team->getName() . '</label>';
        echo '</div>';
    }
    ?>
    </div>
</section>