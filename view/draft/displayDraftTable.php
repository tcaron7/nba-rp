<table class="draftTable">
    <thead>
        <tr>
            <th colspan="6">
            <?php
                switch ($round)
                {
                    case 1:
                        echo '1<sup>st</sup>&nbsp;Round';
                        break;
                    case 2:
                        echo '2<sup>nd</sup>&nbsp;Round';
                        break;
                }
            ?>
            </th>
        </tr>
        <tr>
            <th class="pick">Pick</th>
            <th class="team">Team</th>
            <th class="player">Player</th>
            <th class="position">Pos.</th>
            <th class="formation">Formation</th>
            <th class="nationality">Nationality</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if(isset($draftPicks))
        {
            foreach($draftPicks as $draftPick)
            {
                if($draftPick->getDraftRound() == $round)
                {
                    echo '<tr>';
                    echo '<td class="pick">' . $draftPick->getDraftPick()                                 . '</td>';
                    echo '<td class="team">' . $draftPick->getCurrentOwnerTeam()->getName();
                    if($draftPick->getCurrentOwnerTeam()->getId() != $draftPick->getOriginalOwnerTeam()->getId())
                    {
                        echo ' <br />(via ' . $draftPick->getOriginalOwnerTeam()->getAbbreviation() . ')</td>';
                    }
                    echo '<td class="player">' . $draftPick->getPlayer()->getFullname() . '</td>';
                    echo '<td class="position"></td>';//' . $draftPick->getPlayer()->getPosition() . '
                    echo '<td class="formation">' . $draftPick->getPlayer()->getFormation() . '</td>';
                    echo '<td class="nationality">' . $draftPick->getPlayer()->getNationality() . '</td>';
                    echo '</tr>';
                }
            }
        }
        ?>
    </tbody>
</table>
