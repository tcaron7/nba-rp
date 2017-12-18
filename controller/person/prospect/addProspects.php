<?php

// Ajout
if ( isset( $_GET['submit'] ) )
{
	$prospect = new Prospect (0);
    
    // Convert special caracters
    foreach ( $_POST as $name => $value ) {
        $_POST[$name] = htmlspecialchars($value);
    }
	
	// Setter depuis $_POST
	$birthdate = $_POST['birthdateYear'] . "-" . $_POST['birthdateMonth'] . "-" . $_POST['birthdateDay'];
	$prospect->setBirthdate($birthdate);
	
	$prospect->setFirstname($_POST['firstname']);
	$prospect->setName($_POST['name']);
	$prospect->setNationality($_POST['nationality']);
	$prospect->setFormation($_POST['formation']);
	$prospect->setHeight($_POST['height']);
	$prospect->setWeight($_POST['weight']);
	
	$prospect->setPosition($_POST['position']);
    $prospect->setRanking($_POST['ranking']);
    
    if($_POST['cursusType'] == 'International')
    {
        $prospect->setPredictedDraftYear($_POST['birthdateYear'] + 22);
    }
    else
    {
        $currentSeason = getCurrentSeason();
        $yearBeforeDraft = $_POST['predictedDraftYear'];
        $prospect->setPredictedDraftYear($currentSeason + $yearBeforeDraft);
    }
    $prospect->setCursusType($_POST['cursusType']);
    
	$id = insertProspect($prospect);
}

// Formulaire
include_once('view/person/prospect/formAddProspect.php');

