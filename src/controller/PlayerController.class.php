<?php

class PlayerController
{

	public function __construct() { }

	public function listAllAction()
	{
		$players = getAllPlayersInTeamsOrderByName();
		include_once( $GLOBALS['path']['views'] . 'person/player/playersList.php' );
	}

	public function listOptionAction()
	{
		$players = getAllPlayersWithAContractOption();
		if ( !is_null( $players ) )
		{
			include( $GLOBALS['path']['views'] . 'person/player/displayActivatePlayersOption.php' );
		}
		else
		{
			echo 'No more players with option, you can pass to the next day !';
		}
	}

	public function listRestrictedAction()
	{
		$players = getAllRestrictedFreeAgentPlayersOrderByName();

		if ( !is_null( $players ) )
		{
			include( $GLOBALS['path']['views'] . 'person/player/displayActivateRestrictedContract.php' );
		}
		else
		{
			echo 'No more players with option, you can pass to the next day !';
		}
	}

	public function displayAction( $id )
	{
		$player = new Player( $id );
		include_once( $GLOBALS['path']['views'] . 'person/player/playerInfoNavigation.php' );
		include_once( $GLOBALS['path']['views'] . 'person/player/playerAction.php' );
		include_once( $GLOBALS['path']['views'] . 'person/player/playerGlobalInfo.php' );
	}

	public function statsAction( $id )
	{
		$player = new Player( $id );
		$this->displayAction( $player->getId() );
		
		$season = getCurrentSeason();
		if ( isset( $player->getStats()[$season] ) )
		{
			$stat = $player->getStats()[$season];
			include_once( $GLOBALS['path']['views'] . 'person/player/playerSeasonStats.php' );
			
			$homeRoadStats = $player->getHomeRoadSeasonStats();
			include_once( $GLOBALS['path']['views'] . 'person/player/playerHomeRoadSeasonStats.php' );
			
			$winsLossesStats = $player->getWinsLossesSeasonStats();
			include_once( $GLOBALS['path']['views'] . 'person/player/playerWinsLossesSeasonStats.php' );
			
			$monthsStats = $player->getMonthsSeasonStats();
			include_once( $GLOBALS['path']['views'] . 'person/player/playerMonthsSeasonStats.php' );
		}
		else {
			echo 'This player has no stats for this season.';
		}
	}

	public function careerAction( $id )
	{
		$player = new Player( $id );
		$this->displayAction( $player->getId() );

		$careerStats = $player->getStats();
		include_once( $GLOBALS['path']['views'] . 'person/player/playerCareerStats.php' );
	}

	public function gamesAction( $id )
	{
		$player = new Player( $id );
		$this->displayAction( $player->getId() );

		$season          = getCurrentSeason();
		$playerGamesLogs = getPlayerGamesLogsOfASeason( $player->getId(), $season );
		include_once( $GLOBALS['path']['views'] . 'person/player/playerGamesLogs.php' );
	}

	public function awardsAction( $id )
	{
		$player = new Player( $id );
		$this->displayAction( $player->getId() );

		include_once( $GLOBALS['path']['views'] . 'person/player/playerAwards.php' );
	}

	public function retireAction( $id )
	{
		$player = new Player( $id );
		$this->displayAction( $player->getId() );

		updatePlayerRetirement( $player->getId() );
		echo $player->getFullName() . ' retires';
	}

	public function optionActivateAction( $id )
	{
		activateContractOption( $id );
	}

	public function optionDeclineAction( $id )
	{
		declineContractOption( $id );
	}

	public function restrictedActivateAction( $id )
	{
		activateRestrictedContractOption( $id );
	}

	public function restrictedDeclineAction( $id )
	{
		declineContractOption( $id );
	}

	public function createAction()
	{
		include_once( $GLOBALS['path']['views'] . 'person/player/formAddPlayer.php' );
	}

	public function insertAction()
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
		
		$id = insertPlayer( $player, null );
		$this->displayAction( $id );
	}
}