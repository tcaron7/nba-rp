<?php
$freeAgents = getAllUnrestrictedFreeAgentPlayersOrderByName();
$restrictedFreeAgents = getAllRestrictedFreeAgentPlayersOrderByName();
$retiredPlayers = getAllRetiredPlayersOrderByName();

if($_GET['section'] == 'signature')
{
    if(!empty($freeAgents))
    {
        include_once('view/person/player/freeAgentsList.php');   
    }
    if(!empty($restrictedFreeAgents))
    {
        include_once('view/person/player/restrictedFreeAgentsList.php');   
    }
    if(!empty($retiredPlayers))
    {
        include_once('view/person/player/retiredPlayersList.php');    
    } 
}

else if ($_GET['section'] == 'sign_player' and isset($_GET['id']) and !isset($_GET['submit']))
{
    $freeAgent = new Player($_GET['id']);
    include_once('view/transaction/signature/formSignPlayer.php');
}

else if ($_GET['section'] == 'sign_player' and isset($_GET['id']) and isset($_GET['submit']))
{
    $player    = getPlayerById($_GET['id']);
    $freeAgent = new Player($player['playerId']);
    $newTeam   = new Team($_POST['teamId']);
    
    echo '<br />';
    echo $freeAgent->getFullName() . ' signed to the ' . $newTeam->getFullName();
    echo ' for ' . $_POST['guarantedYear'];
    
    if ($_POST['guarantedYear'] > 1)
    {
        echo ' years ';
    }
    else
    {
        echo ' year ';
    }
    
    echo 'with ' . $_POST['salary'] . '$' . '</br>';
    
    if ( ( $freeAgent->getContractType() != 'Rookie' ) or ( $freeAgent->getTeamId() == $_POST['teamId'] ) )
    {
        $signature        = new SignatureFreeAgent(null, $player['personId'], $_POST);
        $validity = $signature->checkSignatureValidity();
        if( ($validity[0] == 1 or $freeAgent->getContractType() == 'Rookie') and $validity[1] == 1)
        {
            $validTransaction = updatePlayerSignature($signature);            
        }
        
        if($freeAgent->getContractType() != 'Rookie')
        {
            if($validity[0] == 0)
            {
                echo 'This signature is not valid, team is above the max salary cap.</br>';
            }
        }
        if($validity[1] == 0)
        {
            echo 'This signature is not valid, team has too many players under contract.</br>';
        }
    }
    else
    {
        if(!isset($_GET['match']))
        {
            include_once('view/transaction/signature/formSignUnrestrictedPlayer.php');  
        }
        else
        {
            $signature        = new SignatureFreeAgent(null, $player['personId'], $_POST);
            $validity = $signature->checkSignatureValidity();
            if($validity[0] == 1 and $validity[1] == 1)
            {
                $validTransaction = updatePlayerSignature($signature);            
            }
            
            if($_GET['match'] == 'no')
            {
                if($validity[0] == 0)
                {
                    echo 'This signature is not valid, team is above the max salary cap.</br>';
                }
            }
            if($validity[1] == 0)
            {
                echo 'This signature is not valid, team has too many players under contract.</br>';
            }
        }
    }
}
else if ($_GET['section'] == 'sign_rookie')
{
    echo 'Rookie Contract';
    $rookiePlayer = new Player($_GET['id']);
    
    $valid = updateRookieContract($rookiePlayer);
}