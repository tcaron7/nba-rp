<?php
if(isset($_POST['stats']) and $_POST['stats'] == 'FTPercentage')
{
    if(isset($players))
    {
      usort($players,'compareFTPercentage');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareFTPercentage');
    }
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'FGPercentage')
{
    if(isset($players))
    {
      usort($players,'compareFGPercentage');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareFGPercentage');
    }   
}
else if(isset($_POST['stats']) and $_POST['stats'] == '3FGPercentage')
{
    if(isset($players))
    {
      usort($players,'compare3FGPercentage');
    } 
    elseif(isset($teams))
    {
      usort($teams,'compare3FGPercentage');
    }
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'defRebounds')
{
    if(isset($players))
    {
      usort($players,'compareDefRebounds');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareDefRebounds');
    }   
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'offRebounds')
{
    if(isset($players))
    {
      usort($players,'compareOffRebounds');
    } 
    elseif(isset($teams))
    {
      usort($teams,'compareOffRebounds');
    }
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'rebounds')
{
    if(isset($players))
    {
      usort($players,'compareRebounds');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareRebounds');
    }
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'assists')
{
    if(isset($players))
    {
      usort($players,'compareAssists');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareAssists');
    }   
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'turnovers')
{
    if(isset($players))
    {
      usort($players,'compareTurnovers');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareTurnovers');
    }
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'steals')
{
    if(isset($players))
    {
      usort($players,'compareSteals');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareSteals');
    }   
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'blocks')
{
    if(isset($players))
    {
      usort($players,'compareBlocks');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareBlocks');
    }   
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'efficiency')
{
    if(isset($players))
    {
      usort($players,'compareEfficiency');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareEfficiency');
    }   
}
else if(isset($_POST['stats']) and $_POST['stats'] == 'minutes')
{
    if(isset($players))
    {
      usort($players,'compareMinutes');
    }
    elseif(isset($teams))
    {
      usort($teams,'compareMinutes');
    }   
}
else
{
    if(isset($players))
    {
        usort($players,'comparePoints');
    }
    elseif(isset($teams))
    {
      usort($teams,'comparePoints');
    }
}

function compareMinutes($a, $b) 
{
    $season  = getCurrentSeason();
    $games_a = max(1,$a->getStats()[$season]->getGames());
    $games_b = max(1,$b->getStats()[$season]->getGames());
  
    return ($a->getStats()[$season]->getMinutes() / $games_a) < ($b->getStats()[$season]->getMinutes() / $games_b);  
}
function compareFTPercentage($a, $b) 
{
    $season  = getCurrentSeason();
    return ($a->getStats()[$season]->getFreeThrowsPercentage()) < ($b->getStats()[$season]->getFreeThrowsPercentage());  
}
function compareFGPercentage($a, $b) 
{
    $season  = getCurrentSeason();
    return ($a->getStats()[$season]->getFieldGoalPercentage()) < ($b->getStats()[$season]->getFieldGoalPercentage());  
} 
function compare3FGPercentage($a, $b) 
{
  $season  = getCurrentSeason();
  return ($a->getStats()[$season]->getThreePointsPercentage()) < ($b->getStats()[$season]->getThreePointsPercentage());  
} 
function compareAssists($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getAssists() / $games_a) < ($b->getStats()[$season]->getAssists() / $games_b);  
} 
function compareTurnovers($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getTurnovers() / $games_a) < ($b->getStats()[$season]->getTurnovers() / $games_b);  
} 
function compareEfficiency($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getEvaluation() / $games_a) < ($b->getStats()[$season]->getEvaluation() / $games_b);  
} 
function comparePoints($a, $b) 
{
    $season  = getCurrentSeason();
    $games_a = max(1,$a->getStats()[$season]->getGames());
    $games_b = max(1,$b->getStats()[$season]->getGames());
    
    return ($a->getStats()[$season]->getPoints() / $games_a) < ($b->getStats()[$season]->getPoints() / $games_b); 
} 
function compareRebounds($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getRebounds() / $games_a) < ($b->getStats()[$season]->getRebounds() / $games_b);  
}
function compareDefRebounds($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getDefensiveRebounds() / $games_a) < ($b->getStats()[$season]->getDefensiveRebounds() / $games_b);  
}
function compareOffRebounds($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getOffensiveRebounds() / $games_a) < ($b->getStats()[$season]->getOffensiveRebounds() / $games_b);  
}
function compareSteals($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getSteals() / $games_a) < ($b->getStats()[$season]->getSteals() / $games_b);  
}
function compareBlocks($a, $b) 
{
  $season  = getCurrentSeason();
  $games_a = max(1,$a->getStats()[$season]->getGames());
  $games_b = max(1,$b->getStats()[$season]->getGames());
  
  return ($a->getStats()[$season]->getBlocks() / $games_a) < ($b->getStats()[$season]->getBlocks() / $games_b);  
}