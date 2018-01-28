<?php

$gameId = $_GET['id'];
$game = new Game($gameId, null, null, null);

$index[0] = 'homeTeam';
$index[1] = 'visitorTeam'; 
  
if($_GET['option'] == 'fillScore')
{
    $homeTeamId = $game->getHomeTeam()->getId();
    $visitorTeamId = $game->getVisitorTeam()->getId();
    
    // Get team Players
    $teams['homeTeam']          = new Team ($homeTeamId);
    $teams['visitorTeam']       = new Team ($visitorTeamId);
    
    // On affiche la page (vue)
    include_once('view/game/formFillScore.php');
}
elseif($_GET['option'] == 'preGame')
{
    $homeTeamId = $game->getHomeTeam()->getId();
    $visitorTeamId = $game->getVisitorTeam()->getId();
    
    // Get team Players
    $teams['homeTeam']          = new Team ($homeTeamId);
    $teamPlayers['homeTeam']    = getAllPlayersOfTeam($homeTeamId);

    $teams['visitorTeam']       = new Team ($visitorTeamId);
    $teamPlayers['visitorTeam'] = getAllPlayersOfTeam($visitorTeamId);
    
    $scoreHomeTeam    = $_POST[$gameId]['homeTeam']['score'];
    $scoreVisitorTeam = $_POST[$gameId]['visitorTeam']['score'];

    $gameController = new GameController();
    $gameTeamsStats = $gameController->generateGameTeamsStats( $gameId, $scoreHomeTeam, $scoreVisitorTeam );
    $playersMinutes = $gameController->generatePlayersMinutesPlayed( $gameId );

    // On affiche la page (vue)
    include_once('view/game/formPreGame.php');
}
else if($_GET['option'] == 'fillGame')
{
    $homeTeamId = $game->getHomeTeam()->getId();
    $visitorTeamId = $game->getVisitorTeam()->getId();
    
    // Get team Players
    $teams['homeTeam']          = new Team ($homeTeamId);
    $teamPlayers['homeTeam']    = getAllPlayersOfTeam($homeTeamId);

    $teams['visitorTeam']       = new Team ($visitorTeamId);
    $teamPlayers['visitorTeam'] = getAllPlayersOfTeam($visitorTeamId);
    
    // On affiche la page (vue)
    include_once('view/game/formGameStats.php');
}
else if($_GET['option'] == 'recapGame')
{
    $statsGame = new StatGame(null,$_POST);
    
    $homeTeamId     = $statsGame->getHomeTeamId();
    $visitorTeamId  = $statsGame->getVisitorTeamId();
    
    // Get team Players
    $teams['homeTeam']           = new Team ($homeTeamId);
    $playersStats['homeTeam']    = $statsGame->getHomeTeamStats();

    $teams['visitorTeam']        = new Team ($visitorTeamId);
    $playersStats['visitorTeam'] = $statsGame->getVisitorTeamStats();
    
    $serializeStatsGame = serialize($statsGame);
    file_put_contents( $GLOBALS['path']['store'] . 'game_' . $gameId, $serializeStatsGame );
  
    // On affiche la page (vue)
    include_once('view/game/recapGameStats.php');
}
else if($_GET['option'] == 'submitGame')
{
    $serializeStatsGame = file_get_contents( $GLOBALS['path']['store'] . 'game_' . $gameId );
    $statsGame = unserialize($serializeStatsGame);
    
	updateStatPlayer($statsGame);
    insertStatsGame($statsGame);
    updateGameResult($statsGame);

    unlink( $GLOBALS['path']['store'] . 'game_' . $gameId );
}
