<?php

class ProspectController
{

	public function __construct() { }

	public function listAction( $selection )
	{
		$predictedDraftYear;
		$prospectsClass;

		if ( $selection == 'all' )
		{
			include_once( $GLOBALS['path']['views'] . 'person/prospect/displayProspectsRanking.php' );
		}
		else
		{
			if ( $selection == 'international' )
			{
				$predictedDraftYear = 'International';
				$prospectsClass     = getInternationalProspects();
			}
			else
			{
				if ( $selection == 'seniors' )
				{
					$predictedDraftYear = getCurrentSeason();
				}
				elseif ( $selection == 'juniors' )
				{
					$predictedDraftYear = getCurrentSeason() + 1;
				}
				elseif ( $selection == 'sophomores' )
				{
					$predictedDraftYear = getCurrentSeason() + 2;
				}
				elseif ( $selection == 'freshmen' )
				{
					$predictedDraftYear = getCurrentSeason() + 3;
				}
				$prospectsClass = getProspectsByAgeClass( $predictedDraftYear );
			}
			include_once( $GLOBALS['path']['views'] . 'person/prospect/displayOfPlayersRanking.php' );
		}
	}

	public function createAction()
	{
		include_once( $GLOBALS['path']['views'] . 'person/prospect/formAddProspect.php' );
	}

	public function insertAction()
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
	    
		if ( $_POST['cursusType'] == 'International' )
		{
			$prospect->setPredictedDraftYear( $_POST['birthdateYear'] + 22 );
		}
		else
		{
			$currentSeason   = getCurrentSeason();
			$yearBeforeDraft = $_POST['predictedDraftYear'];
			$prospect->setPredictedDraftYear( $currentSeason + $yearBeforeDraft );
		}
		$prospect->setCursusType( $_POST['cursusType'] );

		insertProspect( $prospect );

		$this->createAction();
	}

}