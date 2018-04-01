<section>
    <div class="sectionHeader">Free Agents</div>
    <div class="sectionBody">
        <dl>
        <?php
            $oldLetter = NULL;
            foreach($freeAgents as $freeAgent)
            {
                if(substr($freeAgent->getName(),0,1)!=$oldLetter)
                {
                    echo '<dt>';
                    echo substr($freeAgent->getName(),0,1);
                    echo '</dt>';
                    echo '<dd>';
                }
                echo '<a href="' . $GLOBALS['router']->generateUrl( 'player_display', array( 'id' => $player->getId() ) ) .'">';
                echo $freeAgent->getFullname();
                echo '</a>';
                
                $oldLetter = substr($freeAgent->getName(),0,1);
                if(substr($freeAgent->getName(),0,1)!=$oldLetter)
                {
                    echo '</dd>';
                }
                else
                {
                    echo '<br />';
                }
            }
        ?>
        </dl>
    </div>
</section>
