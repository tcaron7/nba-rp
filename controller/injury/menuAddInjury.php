<?php

	// Recuperation des parametres
	$players;
	$players = getAllPlayersInTeamsOrderByName();
	if(isset($_GET['player_id']) and !isset($_GET['submit']))
	{
		$player = new Player($_GET['player_id']);
		$id = $player->getId();
		include_once('view/injury/formAddInjury.php');
	}
	elseif(isset($_GET['submit']) and $_GET['submit'] == 'yes')
	{
		include_once('view/injury/addInjuryPlayersList.php');
		
		$injury = new Injury(null,$_POST);
		
		$valid = updateInjury($injury);
	}
	else
	{
		include_once('view/injury/addInjuryPlayersList.php');
	}
?>