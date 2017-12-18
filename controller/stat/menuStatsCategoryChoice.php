<?php

if(isset($players))
{
  usort($players,'compare');
}
elseif(isset($teams))
{
  usort($teams,'compare');
}
    

function compare($a, $b) 
{
    if(isset($_POST['period']) and isset($_POST['stats']))
    {
        $period = $_POST['period'];
        $stats  = $_POST['stats'];
    }
    else
    {
        $period = 'Season';
        $stats  = 'points';
    }
    
    if( strpos($stats, 'Percentage') == false )
    {
        $games_a = max(1,$a->getSpecificSeasonStats('games', $period));
        $games_b = max(1,$b->getSpecificSeasonStats('games', $period));
        
        $compare = ($a->getSpecificSeasonStats($stats, $period) / $games_a) < ($b->getSpecificSeasonStats($stats, $period) / $games_b);
    }
    else
    {
        $compare = ($a->getSpecificSeasonStats($stats, $period)) < ($b->getSpecificSeasonStats($stats, $period));
    }

    return $compare;  
}