<?php

if(isset($_GET['activate']) and $_GET['activate'] == 'yes')
{
    $valid = activateContractOption($_POST['playerId']);
}
elseif(isset($_GET['activate']) and $_GET['activate'] == 'no')
{
    $valid = declineContractOption($_POST['playerId']);
}

$playersWithOption = getAllPlayersWithAContractOption();

if(!is_null($playersWithOption))
{
    include('view/person/player/displayActivatePlayersOption.php');
}
else
{
    echo 'No more players with option, you can pass to the next day !';
}
