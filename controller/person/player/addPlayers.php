<?php

// Ajout
if ( isset( $_GET['submit'] ) )
{
	$player = new Player (0);
    
    // Convert special caracters
    foreach ( $_POST as $name => $value ) {
        $_POST[$name] = htmlspecialchars($value);
    }
	
	// Setter depuis $_POST
	$birthdate = $_POST['birthdateYear'] . "-" . $_POST['birthdateMonth'] . "-" . $_POST['birthdateDay'];
	$player->setBirthdate($birthdate);
	
	$player->setFirstname($_POST['firstname']);
	$player->setName($_POST['name']);
	$player->setNationality($_POST['nationality']);
	$player->setFormation($_POST['formation']);
	$player->setHeight($_POST['height']);
	$player->setWeight($_POST['weight']);
	
	$player->setTeamId($_POST['teamId']);
	$player->setPosition($_POST['position']);
	$player->setSalary($_POST['salary']);
	$player->setGuarantedYear($_POST['guarantedYear']);
	$player->setOptionalYear($_POST['optionalYear']);
	$player->setContractType($_POST['contractType']);
	$player->setExperience($_POST['experience']);
	$player->setDraftPromotion($_POST['draftPromotion']);
	$player->setDraftPosition($_POST['draftPosition']);
	
	$id = insertPlayer($player, null);
}

// Formulaire
include_once('view/person/player/formAddPlayer.php');

