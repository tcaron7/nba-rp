<section class="playersList">
    <div class="sectionHeader">
        Select award winner
    </div>

    <div class="sectionBody">
    <?php
        $playersList = [];
        $oldLetter = NULL;
        
        // Create list ordered by first letter of name 
        foreach ( $players as $player )
        {
            $newLetter = substr( $player->getName(), 0, 1 );
            if ( $newLetter != $oldLetter )
            {
                $playersList[$newLetter] = [];
            }
            array_push( $playersList[$newLetter], $player );
            $oldLetter = $newLetter;
        }

        // Display list
        foreach ( $playersList as $letter => $playersLetter )
        {
            echo '<div class="letterList">';
            echo '<div class="letter">' . $letter . '</div>';
            
            echo '<div class="list">';
            foreach ( $playersLetter as $player )
            {
                echo '<span>';
                include('view/award/attributeAward.php');
                echo ' [' . $player->getTeam()->getAbbreviation() . ']';
                echo '</span>';
            }
            echo '</div>';
            echo '</div>';
        }
        
    ?>
    </div>
</section>