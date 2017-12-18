<?php

$year = getCurrentSeason();
$nextPick = getNextDraftPick();

if($_GET['section'] == 'draft')
{
    if(!empty($_POST['selectedProspects']))
    {
        if(count($_POST['selectedProspects']) == 1)
        {
            $valid = updateSelectedPlayerInPick($nextPick, $_POST['selectedProspects'][0]);
        }
        else
        {
            echo 'You can only select one prospect, try again !';
        }
    }
    $draftPicks = getDraftPickByYear($year);
    $viewYear = $year;
    include('view/draft/displayDraftOfYear.php');
}

elseif($_GET['section'] == 'select_prospect')
{
    $team = $nextPick->getCurrentOwnerTeam();
    $teamPlayers = getAllPlayersOfTeam($team->getId());
    
    $pickNumber = $nextPick->getGlobalDraftPick();
    if($pickNumber == 1)
    {
        $suffix = 'st';
    }
    elseif($pickNumber == 2)
    {
        $suffix = 'nd';
    }
    elseif($pickNumber == 3)
    {
        $suffix = 'rd';
    }
    else
    {
        $suffix = 'th';
    }
    
    echo 'With the ' . $pickNumber . $suffix . ' of the ' . $year . ' NBA Draft, ';
    echo 'the ' . $team->getFullname() . ' selects : <br/> <br/>';
    
    include('view/team/displayRoster.php');
    include('view/draft/formSelectAvailableProspects.php');
}
?>