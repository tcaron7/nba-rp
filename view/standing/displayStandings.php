<section>
    <div class="sectionHeader">NBA Standing</div>
    <div class="sectionBody">
        <?php
        if ( !empty($teamStanding) )
        {
        ?>
        <table class="standingTable">
            <thead>
                <tr>
                    <th class="tableHeader" colspan="6">Eastern Conference</th>
                </tr>
                <tr>
                    <th>Rank</th>
                    <th class="team">Team</th>
                    <th>G</th>
                    <th>W</th>
                    <th>L</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rankEast = 1;
                foreach ($teamStanding as $eastTeam)
                {
                    if ($eastTeam->getConference()=='East')
                    {
                        $eastTeam->setConferenceRank($rankEast);
                        echo '<tr';
                        if ($rankEast == 8)
                        {
                            echo ' class="rankHeight"';
                        }
                        echo '>';
                        
                        echo '<td>' . $rankEast                           . '</td>';
                        echo '<td>' . $eastTeam->getTeam()->getFullname() . '</td>';
                        echo '<td>' . $eastTeam->getGames()               . '</td>';
                        echo '<td>' . $eastTeam->getWins()                . '</td>';
                        echo '<td>' . $eastTeam->getLosses()              . '</td>';
                        echo '<td>' . $eastTeam->getWinRate()             . '</td>';
                        echo '</tr>';
                        $rankEast = $rankEast + 1;
                    }
                }
                ?>
            </tbody>
        </table>

        <table class="standingTable">
            <thead>
                <tr>
                    <th class="tableHeader" colspan="6">Western Conference</th>
                </tr>
                <tr>
                    <th>Rank</th>
                    <th class="team">Team</th>
                    <th>G</th>
                    <th>W</th>
                    <th>L</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rankWest = 1;
                foreach($teamStanding as $westTeam)
                {
                    if($westTeam->getConference()=='West')
                    {
                        $westTeam->setConferenceRank($rankWest);
                        echo '<tr';
                        if ($rankWest == 8)
                        {
                            echo ' class="rankHeight"';
                        }
                        echo '>';

                        echo '<td>' . $rankWest                           . '</td>';
                        echo '<td>' . $westTeam->getTeam()->getFullname() . '</td>';
                        echo '<td>' . $westTeam->getGames()               . '</td>';
                        echo '<td>' . $westTeam->getWins()                . '</td>';
                        echo '<td>' . $westTeam->getLosses()              . '</td>';
                        echo '<td>' . $westTeam->getWinRate()             . '</td>';
                        echo '</tr>';
                        $rankWest = $rankWest + 1;
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        }
        ?>
    </div>
</section>