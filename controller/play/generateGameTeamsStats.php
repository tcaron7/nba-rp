<?php
function nrand($mean, $sd){
    $x = mt_rand()/mt_getrandmax();
    $y = mt_rand()/mt_getrandmax();
    return sqrt(-2*log($x))*cos(2*pi()*$y)*$sd + $mean;
}

$season = getCurrentSeason();

$homeTeamStats    = $teams['homeTeam']->getStats()[$season];
$visitorTeamStats = $teams['visitorTeam']->getStats()[$season];

// Tir home team
$randomCoeff1 = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff2 = max(0.8,min(1.2,nrand(1,0.05)));
 
$gamesHomeTeam = $homeTeamStats->getGames();
$pointsPerGameHomeTeam   = $homeTeamStats->getPoints() / $gamesHomeTeam;
$twoFgmPerGameHomeTeam   = $homeTeamStats->getTwoPointsMade()   / $gamesHomeTeam;
$threeFgmPerGameHomeTeam = $homeTeamStats->getThreePointsMade() / $gamesHomeTeam;

$gameTeamsStats[$homeTeamId]['2fgm'] = round($randomCoeff1 * $twoFgmPerGameHomeTeam   * $scoreHomeTeam / $pointsPerGameHomeTeam);
$gameTeamsStats[$homeTeamId]['3fgm'] = round($randomCoeff2 * $threeFgmPerGameHomeTeam * $scoreHomeTeam / $pointsPerGameHomeTeam);

$gameTeamsStats[$homeTeamId]['ftm']  = max(0,$scoreHomeTeam - (2*$gameTeamsStats[$homeTeamId]['2fgm'] + 3*$gameTeamsStats[$homeTeamId]['3fgm']));

// Tir visitor team
$randomCoeff3 = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff4 = max(0.8,min(1.2,nrand(1,0.05)));
 
$gamesVisitorTeam = $visitorTeamStats->getGames();
$pointsPerGameVisitorTeam   = $visitorTeamStats->getPoints() / $gamesVisitorTeam;
$twoFgmPerGameVisitorTeam   = $visitorTeamStats->getTwoPointsMade()   / $gamesVisitorTeam;
$threeFgmPerGameVisitorTeam = $visitorTeamStats->getThreePointsMade() / $gamesVisitorTeam;

$gameTeamsStats[$visitorTeamId]['2fgm'] = round($randomCoeff3 * $twoFgmPerGameVisitorTeam   * $scoreVisitorTeam / $pointsPerGameVisitorTeam);
$gameTeamsStats[$visitorTeamId]['3fgm'] = round($randomCoeff4 * $threeFgmPerGameVisitorTeam * $scoreVisitorTeam / $pointsPerGameVisitorTeam);

$gameTeamsStats[$visitorTeamId]['ftm']  = max(0,$scoreVisitorTeam - (2*$gameTeamsStats[$visitorTeamId]['2fgm'] + 3*$gameTeamsStats[$visitorTeamId]['3fgm']));

// Tir manqué home team
$randomCoeff5 = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff6 = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff7 = max(0.8,min(1.2,nrand(1,0.05)));

$ftaPerGameHomeTeam      = $homeTeamStats->getFreeThrowsAttempt()  / $gamesHomeTeam;
$twoFgaPerGameHomeTeam   = $homeTeamStats->getTwoPointsAttempt()   / $gamesHomeTeam;
$threeFgaPerGameHomeTeam = $homeTeamStats->getThreePointsAttempt() / $gamesHomeTeam;

$ftPercentageHomeTeam       = $homeTeamStats->getFreeThrowsPercentage()  / 100;
$twoFgaPercentageHomeTeam   = $homeTeamStats->getTwoPointsPercentage()   / 100;
$threeFgaPercentageHomeTeam = $homeTeamStats->getThreePointsPercentage() / 100;

$gameTeamsStats[$homeTeamId]['fta']  = max($gameTeamsStats[$homeTeamId]['ftm'],  round( $randomCoeff5*(0.5 * $ftaPerGameHomeTeam      + 0.5 * $gameTeamsStats[$homeTeamId]['ftm']  / $ftPercentageHomeTeam)));
$gameTeamsStats[$homeTeamId]['2fga'] = max($gameTeamsStats[$homeTeamId]['2fgm'], round( $randomCoeff6*(0.5 * $twoFgaPerGameHomeTeam   + 0.5 * $gameTeamsStats[$homeTeamId]['2fgm'] / $twoFgaPercentageHomeTeam)));
$gameTeamsStats[$homeTeamId]['3fga'] = max($gameTeamsStats[$homeTeamId]['3fgm'], round( $randomCoeff7*(0.5 * $threeFgaPerGameHomeTeam + 0.5 * $gameTeamsStats[$homeTeamId]['3fgm'] / $threeFgaPercentageHomeTeam)));

// Tir manqué visitor team
$randomCoeff8  = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff9  = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff10 = max(0.8,min(1.2,nrand(1,0.05)));

$ftaPerGameVisitorTeam      = $visitorTeamStats->getFreeThrowsAttempt()  / $gamesVisitorTeam;
$twoFgaPerGameVisitorTeam   = $visitorTeamStats->getTwoPointsAttempt()   / $gamesVisitorTeam;
$threeFgaPerGameVisitorTeam = $visitorTeamStats->getThreePointsAttempt() / $gamesVisitorTeam;

$ftPercentageVisitorTeam       = $visitorTeamStats->getFreeThrowsPercentage()  / 100;
$twoFgaPercentageVisitorTeam   = $visitorTeamStats->getTwoPointsPercentage()   / 100;
$threeFgaPercentageVisitorTeam = $visitorTeamStats->getThreePointsPercentage() / 100;

$gameTeamsStats[$visitorTeamId]['fta']  = max($gameTeamsStats[$visitorTeamId]['ftm'],  round( $randomCoeff8 *((0.5 * $ftaPerGameVisitorTeam     ) + (0.5 * $gameTeamsStats[$visitorTeamId]['ftm']  / $ftPercentageVisitorTeam))));
$gameTeamsStats[$visitorTeamId]['2fga'] = max($gameTeamsStats[$visitorTeamId]['2fgm'], round( $randomCoeff9 *((0.5 * $twoFgaPerGameVisitorTeam  ) + (0.5 * $gameTeamsStats[$visitorTeamId]['2fgm'] / $twoFgaPercentageVisitorTeam))));
$gameTeamsStats[$visitorTeamId]['3fga'] = max($gameTeamsStats[$visitorTeamId]['3fgm'], round( $randomCoeff10*((0.5 * $threeFgaPerGameVisitorTeam) + (0.5 * $gameTeamsStats[$visitorTeamId]['3fgm'] / $threeFgaPercentageVisitorTeam))));

// Rebonds
$randomCoeff11  = max(0.6,min(1,nrand(0.8,0.05)));
$randomCoeff12  = max(0.6,min(1,nrand(0.8,0.05)));

$randomCoeff13 = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff14 = max(0.8,min(1.2,nrand(1,0.05)));

$missedShotHomeTeam    = ($gameTeamsStats[$visitorTeamId]['fta'] - $gameTeamsStats[$visitorTeamId]['ftm']) + ($gameTeamsStats[$visitorTeamId]['2fga'] - $gameTeamsStats[$visitorTeamId]['2fgm']) + ($gameTeamsStats[$visitorTeamId]['3fga'] - $gameTeamsStats[$visitorTeamId]['3fgm']);
$missedShotVisitorTeam = ($gameTeamsStats[$homeTeamId]['fta']    - $gameTeamsStats[$homeTeamId]['ftm']   ) + ($gameTeamsStats[$homeTeamId]['2fga']    - $gameTeamsStats[$homeTeamId]['2fgm']   ) + ($gameTeamsStats[$homeTeamId]['3fga']    - $gameTeamsStats[$homeTeamId]['3fgm']   );

$availableReboundsHomeTeam    = round($randomCoeff11*$missedShotHomeTeam);
$availableReboundsVisitorTeam = round($randomCoeff12*$missedShotVisitorTeam);

$roPerGameHomeTeam    = $visitorTeamStats->getOffensiveRebounds()  / $gamesHomeTeam;
$rdPerGameHomeTeam    = $visitorTeamStats->getDefensiveRebounds()  / $gamesHomeTeam;
$roPerGameVisitorTeam = $visitorTeamStats->getOffensiveRebounds()  / $gamesVisitorTeam;
$rdPerGameVisitorTeam = $visitorTeamStats->getDefensiveRebounds()  / $gamesVisitorTeam;

$gameTeamsStats[$homeTeamId]['ro']    = round(($roPerGameHomeTeam / ($roPerGameHomeTeam+$rdPerGameVisitorTeam)) * $availableReboundsHomeTeam * $randomCoeff13);
$gameTeamsStats[$visitorTeamId]['rd'] = $availableReboundsHomeTeam - $gameTeamsStats[$homeTeamId]['ro'];

$gameTeamsStats[$visitorTeamId]['ro'] = round(($roPerGameVisitorTeam / ($roPerGameVisitorTeam+$rdPerGameHomeTeam)) * $availableReboundsVisitorTeam * $randomCoeff14);
$gameTeamsStats[$homeTeamId]['rd']    = $availableReboundsVisitorTeam - $gameTeamsStats[$visitorTeamId]['ro'];

// Assist
$passAvailableHomeTeam    = $gameTeamsStats[$homeTeamId]['2fgm']    + $gameTeamsStats[$homeTeamId]['3fgm'];
$passAvailableVisitorTeam = $gameTeamsStats[$visitorTeamId]['2fgm'] + $gameTeamsStats[$visitorTeamId]['3fgm'];

$assistPerGameHomeTeam    = $homeTeamStats->getAssists()          / $gamesHomeTeam;
$assistPerGameVisitorTeam = $visitorTeamStats->getAssists()       / $gamesVisitorTeam;
$fgmPerGameHomeTeam       = $homeTeamStats->getFieldGoalMade()    / $gamesHomeTeam;
$fgmPerGameVisitorTeam    = $visitorTeamStats->getFieldGoalMade() / $gamesVisitorTeam;

$passPercentHomeTeam    = $assistPerGameHomeTeam    / $fgmPerGameHomeTeam;
$passPercentVisitorTeam = $assistPerGameVisitorTeam / $fgmPerGameVisitorTeam;

$randomCoeff15 = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff16 = max(0.8,min(1.2,nrand(1,0.05)));

$gameTeamsStats[$homeTeamId]['assist']    = round( $randomCoeff15 * $passPercentHomeTeam * $passAvailableHomeTeam);
$gameTeamsStats[$visitorTeamId]['assist'] = round( $randomCoeff16 * $passPercentVisitorTeam * $passAvailableVisitorTeam);

// Turnovers
$randomCoeff17 = max(0.8,min(1.2,nrand(1,0.05)));
$randomCoeff18 = max(0.8,min(1.2,nrand(1,0.05)));

$shotHomeTeam    = $gameTeamsStats[$homeTeamId]['2fga']    + $gameTeamsStats[$homeTeamId]['3fga']    + 0.5*$gameTeamsStats[$homeTeamId]['fta'];
$shotVisitorTeam = $gameTeamsStats[$visitorTeamId]['2fga'] + $gameTeamsStats[$visitorTeamId]['3fga'] + 0.5*$gameTeamsStats[$visitorTeamId]['fta'];

$deltaTirs = $shotHomeTeam - $shotVisitorTeam;
$deltaRebOff = $gameTeamsStats[$homeTeamId]['ro'] - $gameTeamsStats[$visitorTeamId]['ro'];
$deltaTurnovers = ($deltaTirs - $deltaRebOff);

$turnoverPerGameHomeTeam    = $homeTeamStats->getTurnovers()    / $gamesHomeTeam;
$turnoverPerGameVisitorTeam = $visitorTeamStats->getTurnovers() / $gamesVisitorTeam;

if((mt_rand()/mt_getrandmax())<0.5)
{
  $gameTeamsStats[$homeTeamId]['turnover']    = round($randomCoeff17*$turnoverPerGameHomeTeam);
  $gameTeamsStats[$visitorTeamId]['turnover'] = round($gameTeamsStats[$homeTeamId]['turnover'] + $randomCoeff18*$deltaTurnovers);
}
else
{
  $gameTeamsStats[$visitorTeamId]['turnover'] = round($randomCoeff18*$turnoverPerGameVisitorTeam);
  $gameTeamsStats[$homeTeamId]['turnover']    = round($gameTeamsStats[$visitorTeamId]['turnover'] + $randomCoeff17*$deltaTurnovers);
}

// Steals
  $randomCoeff19 = max(0.8,min(1.2,nrand(1,0.05)));
  $randomCoeff20 = max(0.8,min(1.2,nrand(1,0.05)));
  $randomCoeff21 = max(0.8,min(1.2,nrand(1,0.05)));
  $randomCoeff22 = max(0.8,min(1.2,nrand(1,0.05)));
  
  $stealPerGameHomeTeam    = $homeTeamStats->getSteals()    / $gamesHomeTeam;
  $stealPerGameVisitorTeam = $visitorTeamStats->getSteals() / $gamesVisitorTeam;
  
  $gameTeamsStats[$homeTeamId]['steal']    = round($randomCoeff19*0.5*0.5*$gameTeamsStats[$visitorTeamId]['turnover'] + $randomCoeff21*0.5*$stealPerGameHomeTeam);
  $gameTeamsStats[$visitorTeamId]['steal'] = round($randomCoeff20*0.5*0.5*$gameTeamsStats[$homeTeamId]['turnover']    + $randomCoeff22*0.5*$stealPerGameVisitorTeam);
  
// Blocks
  $randomCoeff23 = max(0.8,min(1.2,nrand(1,0.05)));
  $randomCoeff24 = max(0.8,min(1.2,nrand(1,0.05)));
  
  $blockPerGameHomeTeam    = $homeTeamStats->getBlocks()    / $gamesHomeTeam;
  $blockPerGameVisitorTeam = $visitorTeamStats->getBlocks() / $gamesVisitorTeam;
  
  $gameTeamsStats[$homeTeamId]['block']    = round($randomCoeff21*$blockPerGameHomeTeam);
  $gameTeamsStats[$visitorTeamId]['block'] = round($randomCoeff22*$blockPerGameVisitorTeam); 
?>