<?php

if(empty($_POST))
{
	$allTeams = getAllTeamsWithPlayersOrderByName();
    include_once('view/transaction/trade/formSelectTeams.php');
	
	// var_dump($allTeams);
	include_once('view/transaction/trade/formTradeTeams.php');  
}
else
{
    echo '<ul>';
    if(isset($_POST['areTradedPlayers']))
    {
        foreach($_POST['areTradedPlayers'] as $tradedPlayerId => $enableTrade)
        {
            if($enableTrade[0] == 'true')
            {
                $newTeam = new Team($_POST['tradedPlayers'][$tradedPlayerId][0]);
                $tradedPlayer = new Player($tradedPlayerId);
                echo '<li>';
                echo 'The ' . $tradedPlayer->getTeam()->getName() . ' send ' . $tradedPlayer->getFullName() . ' to the ' . $newTeam->getName();
                echo '</li>';
            }
        }
    }
    if(isset($_POST['areTradedPicks']))
    {
        foreach($_POST['areTradedPicks'] as $tradedPickId => $enablePick)
        {
            if($enablePick[0] == 'true')
            {
                $a = strpos($tradedPickId, '-', 0);
                $b = strpos($tradedPickId, '-', $a+1);
                $pickOriginalOwnerTeam = new Team(intval(substr($tradedPickId,0,$a)));
                $pickYear              = intval(substr($tradedPickId,$a+1,$b-$a-1));
                $pickRound             = intval(substr($tradedPickId,$b+1,1));
                $pick                  = getDraftPickFromPickData($pickOriginalOwnerTeam->getId(), $pickYear, $pickRound);
                
                $newTeam = new Team($_POST['tradedPicks'][$tradedPickId][0]);
                switch ($pickRound)
                {
                    case 1:
                        $suffix = 'st';
                        break;
                    case 2:
                        $suffix = 'nd';
                        break;
                }
                
                echo '<li>';
                echo 'The ' . $pick->getCurrentOwnerTeam()->getName() . ' ';
                if($pick->getOriginalOwnerTeam() == $pick->getCurrentOwnerTeam())
                { 
                    echo 'send their ' . $pickYear . ' ' . $pickRound . $suffix . ' round ';
                }
                else
                {
                    echo 'send the ' . $pickYear . ' ' . $pickRound . $suffix . ' round ';
                    echo 'from the ' . $pick->getOriginalOwnerTeam()->getName() . ' ';                
                }
                
                echo 'to the ' . $newTeam->getName();
                echo '</li>';
            }
        }
    }
    echo '</ul>';  
    $trade            = new Trade(null, $_POST);
    $teamsValidity = $trade->checkTradeValidity();
    $validity = 1;
    
    foreach($teamsValidity as $teamId => $teamValidity)
    {
        $team = new Team($teamId);
        if($teamValidity[0] == 0)
        {
            $validity = 0;
            echo 'This trade is not valid, ' . $team->getFullname() . ' is above the max salary cap.</br>';
        }
        if($teamValidity[1] == 0)
        {
            $validity = 0;
            echo 'This signature is not valid, ' . $team->getFullname() . ' has too many players under contract.</br>';
        }
    }
    
    if($validity == 1)
    {
        $validTransaction = updateElementsTrade($trade);  
    }
    
}