<?php

class InjuryController
{

	public function __construct() { }

	public function displayCurrentAction()
	{
		$injuries = getCurrentInjuries();
		include_once( $GLOBALS['path']['views'] . 'injury/displayCurrentInjuries.php' );
	}

	public function selectAction()
	{
		$players = getAllPlayersInTeamsOrderByName();
		include_once( $GLOBALS['path']['views'] . 'injury/addInjuryPlayersList.php' );
	}

	public function createAction( $playerId )
	{
		$player = new Player( $playerId );
		include_once( $GLOBALS['path']['views'] . 'injury/formAddInjury.php' );
	}

	public function insertAction()
	{
		$injury = new Injury( null, $_POST );
		updateInjury( $injury );

		$this->displayCurrentAction();
	}

}