<section>
    <div class="sectionHeader">Restricted Free Agents</div>
    <div class="sectionBody">
        <dl>
        <?php
            $oldLetter = NULL;
            foreach($restrictedFreeAgents as $restrictedFreeAgent)
            {
                if(substr($restrictedFreeAgent->getName(),0,1)!=$oldLetter)
                {
                    echo '<dt>';
                    echo substr($restrictedFreeAgent->getName(),0,1);
                    echo '</dt>';
                    echo '<dd>';
                }
                echo '<a href="' . $GLOBALS['router']->generateUrl( 'player_display', array( 'id' => $restrictedFreeAgent->getId() ) ) .'">';
                echo $restrictedFreeAgent->getFullname();
                echo '</a>';
                
                $oldLetter = substr($restrictedFreeAgent->getName(),0,1);
                if(substr($restrictedFreeAgent->getName(),0,1)!=$oldLetter)
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