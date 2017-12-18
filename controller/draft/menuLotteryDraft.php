<?php

// Recuperation des parametres

// On affiche la page (vue)

$year = getCurrentSeason();
$lotteryDone = checkLottery($year);

if($lotteryDone != 0)
{
    include('controller/standing/menuStanding.php');
    
    echo "It's lottery time !</br></br>";
    
    $lotteryTeams;
    $nonLotteryTeams;
    
    $indexLotteryTeams = 1;
    $indexNonLotteryTeams = 1;
    foreach($teamStanding as $team)
    {
        if($team->getConferenceRank()>= 9)
        {
            $lotteryTeams[$indexLotteryTeams] = $team;
            $indexLotteryTeams = $indexLotteryTeams + 1;
        }
        else
        {
            $nonLotteryTeams[$indexNonLotteryTeams] = $team;
            $indexNonLotteryTeams = $indexNonLotteryTeams + 1;
        }
    }
    
    usort($lotteryTeams,'compare');
    usort($nonLotteryTeams,'compare');
    
    $lotteryPicks;
    $indexLotteryPicks = 1;
    while($indexLotteryPicks <= 3)
    {
        $rand = mt_rand(1,1000);
        if($rand >= 1 and $rand<=250 and (empty($lotteryPicks) or !in_array(1, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 1;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 251 and $rand<=449 and (empty($lotteryPicks) or !in_array(2, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 2;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 450 and $rand<=605 and (empty($lotteryPicks) or !in_array(3, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 3;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 606 and $rand<=724 and (empty($lotteryPicks) or !in_array(4, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 4;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 725 and $rand<=812 and (empty($lotteryPicks) or !in_array(5, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 5;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 813 and $rand<=875 and (empty($lotteryPicks) or !in_array(6, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 6;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 876 and $rand<=918 and (empty($lotteryPicks) or !in_array(7, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 7;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 919 and $rand<=946 and (empty($lotteryPicks) or !in_array(8, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 8;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 947 and $rand<=963 and (empty($lotteryPicks) or !in_array(9, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 9;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 964 and $rand<=974 and (empty($lotteryPicks) or !in_array(10, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 10;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 975 and $rand<=982 and (empty($lotteryPicks) or !in_array(11, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 11;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 983 and $rand<=989 and (empty($lotteryPicks) or !in_array(12, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 12;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 990 and $rand<=995 and (empty($lotteryPicks) or !in_array(13, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 13;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
        if($rand >= 996 and $rand<=1000 and (empty($lotteryPicks) or !in_array(14, $lotteryPicks)))
        {
            $lotteryPicks[$indexLotteryPicks] = 14;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
    }
    
    for ($i = 1; $i <= 14; $i++)
    {
        if(!in_array($i, $lotteryPicks))
        {
            $lotteryPicks[$indexLotteryPicks] = $i;
            $indexLotteryPicks = $indexLotteryPicks+1;
        }
    }
    
    for ($i = 1; $i <= 30; $i++)
    {
        if($i <= 14)
        {
            $draftPick[$i] = new DraftPick(null, $year, 1, 0, $lotteryTeams[$lotteryPicks[$i]-1]->getTeam()->getId(), $i);
            $draftPick[30+$i] = new DraftPick(null, $year, 2, 0, $lotteryTeams[$i-1]->getTeam()->getId(), $i);
        }
        else
        {
            $draftPick[$i] = new DraftPick(null, $year, 1, 0, $nonLotteryTeams[$i-15]->getTeam()->getId(), $i);
            $draftPick[30+$i] = new DraftPick(null, $year, 2, 0, $nonLotteryTeams[$i-15]->getTeam()->getId(), $i);
        }
    }
    
    for ($i = 1; $i <= 60; $i++)
    {
        echo $i . '. ' . $draftPick[$i]->getOriginalOwnerTeam()->getFullname() . '</br>';
        // $valid = updateDraftChoice($draftPick[$i]);
    }
    
}