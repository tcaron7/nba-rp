<?php
	/** Description
	  * Team selected for Trade
	  */
	  
	/** Parameters
	  * $allTeams
	  */
?>
<section id="tradingTeams">
    <form action="index.php?section=trade&submit=yes" method="post">
        <div class="sectionHeader">
            Trading Teams
            <input type="submit" value="Submit Transaction &raquo;" />
        </div>
        
        <div class="sectionBody">
        <?php
        foreach ($allTeams as $keyTeam => $team)
        {
        ?>
            <div id="<?php echo 'tradingTeam' . $team->getId(); ?>" class="tradingTeam">
                
                <div class="header">
                    <span class="icon-team-<?php echo preg_replace('/\s+/', '', strtolower($team->getName()))?>">&nbsp;</span>
                    <?php echo $team->getFullName(); ?>
                </div>
                
                <div class="body">
                    <div class="subheader">Trade Player</div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th style="width:30px;">&nbsp;</th>
                                <th>Pos.</th>
                                <th class="tradedPlayerName">Player</th>
                                <th>Salary</th>
                                <th>Year</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        foreach ($team->getPlayers() as $keyPlayer => $player)
                        {
							$playerId = $player->getId();
                            echo '<tr>';

                            echo '<td>';
                            echo '<input
                                type  = "checkbox"
                                id    = "tradedPlayer' . $playerId . '"
                                name  = "areTradedPlayers[' . $playerId . '][]"
                                value = "true"
                            />';
                            echo '</td>';
                            
                            echo '<td>' . $player->getPosition() . '</td>';
                            
                            echo '<td class="tradedPlayerName">';
                            echo '<label for="tradedPlayer' . $playerId . '">';
                            echo $player->getFullName();
                            echo '</label>';
                            echo '</td>';
                            
                            echo '<td>' . $player->getSalary() . '</td>';
                            echo '<td>' . $player->getGuarantedYear() . '</td>';
                            echo '<td>' . $player->getContractType() . '</td>';
                            
                            echo '</tr>';
                            
                            echo '<tr
                                class   = "receivingTeamSelect"
                                id      = "receivingTeamsPlayers'. $playerId .'"
                            >';
                            echo '<td>&nbsp;</td>';
                            echo '<td colspan = "5">';
                            echo 'Choose New Team : ';
                            echo '<select name  = "tradedPlayers[' . $playerId . '][]" >';
                            $allTeams = getAllTeamOrderByName();
                            echo '<option 
                                id    = "receivingTeam0Player' . $playerId . '"
                                value = "0"> None
                            </option>';
                            foreach ($allTeams as $key => $teamList)
                            {
                                if ( $teamList->getId() != $team->getId() )
                                {
                                    echo '<option
                                        class = "receivingTeamOption"
                                        id    = "receivingTeam' . $teamList->getId() . 'Player' . $player->getId() . '"                               
                                        value = "' . $teamList->getId() . '">
                                        ' . $teamList->getName() . '
                                    </option>';   
                                }
                            }
                            echo '</select>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>

                    
                    <div class="subheader">Trade Drafts</div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th style="width:30px;">&nbsp;</th>
                                <th>Year</th>
                                <th>Round</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                            $drafts = $team->getNextDraftPick(5);
                            foreach ($drafts as $key => $draft)
                            {
                                $pickId = $draft->getOriginalOwnerTeam()->getId() . '-' . $draft->getYear() . '-' . $draft->getDraftRound();
                                echo '<tr>';
                                
                                echo '<td>';
                                echo '<input
                                    type  ="checkbox"
                                    id    ="tradedPick' . $pickId .'"
                                    name  ="areTradedPicks[' . $pickId . '][]"
                                    value ="true"
                                />';
                                echo '</td>';
                                
                                echo '<td>';
                                echo '<label for="tradedPick' . $pickId . '">';
                                echo $draft->getYear();
                                echo '</label>';
                                echo '</td>';
                                
                                echo '<td>';
                                echo $draft->getDraftRound();
                                switch ($draft->getDraftRound())
                                {
                                    case 1:
                                        echo '<sup>st</sup>&nbsp;';
                                        break;
                                    case 2:
                                        echo '<sup>nd</sup>&nbsp;';
                                        break;
                                }
                                echo '</td>';
                                
                                echo '</tr>';
                                
                                echo '<tr
                                    class   = "receivingTeamSelect"
                                    id      = "receivingTeamsPicks' . $pickId . '"
                                >';
                                echo '<td>&nbsp;</td>';
                                echo '<td colspan = "2">';
                                echo 'Choose New Team : ';
                                echo '<select name  = "tradedPicks[' . $pickId . '][]">';
                                $allTeams = getAllTeamOrderByName();
                                echo '<option 
                                    id    = "receivingTeam0Pick' . $pickId . '"
                                    value = "0">
                                    None
                                </option>';
                                foreach ($allTeams as $key => $teamList)
                                {
                                    if ( $teamList->getId() != $team->getId() )
                                    {
                                        echo '<option
                                            class = "receivingTeamOption"
                                            id    = "receivingTeam' . $teamList->getId() . 'Pick' . $pickId . '"
                                            value = "' . $teamList->getId() . '">
                                            ' . $teamList->getName() . '
                                        </option>';
                                    }
                                }
                                echo '</select>';
                                echo '</td>';

                                echo '</tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                    
                    <input type="button" value="More Drafts" class="moreDrafts" />
                </div>
            </div>


        <?php } ?>
        </div>
    </form>
</section>

<br class="clear"/>