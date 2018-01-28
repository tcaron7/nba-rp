<?php

class SignatureController
{

	public function __construct() { }

	public function chooseAction()
	{
		$freeAgents           = getAllUnrestrictedFreeAgentPlayersOrderByName();
		$restrictedFreeAgents = getAllRestrictedFreeAgentPlayersOrderByName();
		$retiredPlayers       = getAllRetiredPlayersOrderByName();

		if ( !empty( $freeAgents ) )
		{
			include_once( $GLOBALS['path']['views'] . 'person/player/freeAgentsList.php' );   
		}
		if ( !empty( $restrictedFreeAgents ) )
		{
			include_once( $GLOBALS['path']['views'] . 'person/player/restrictedFreeAgentsList.php' );   
		}
		if ( !empty( $retiredPlayers ) )
		{
			include_once( $GLOBALS['path']['views'] . 'person/player/retiredPlayersList.php' );    
		}
	}

	public function createAction( $playerId )
	{
		$freeAgent = new Player( $playerId );
		include_once( $GLOBALS['path']['views'] . 'transaction/signature/formSignPlayer.php' );
	}

	public function signPlayerAction()
	{
		$playerId = $_POST['playerId'];
		$teamId   = $_POST['teamId'];

		$freeAgent = new Player( $playerId );
		$newTeam   = new Team( $teamId );

		echo '<br />';
		echo $freeAgent->getFullName() . ' signed to the ' . $newTeam->getFullName();
		echo ' for ' . $_POST['guarantedYear'];
		if ( $_POST['guarantedYear'] > 1 )
		{
			echo ' years ';
		}
		else
		{
			echo ' year ';
		}
		echo 'with ' . $_POST['salary'] . '$' . '</br>';

		$signature = new SignatureFreeAgent( null, $freeAgent->getPersonId(), $_POST );
		$validity  = $signature->checkSignatureValidity();

		if ( ( $freeAgent->getContractType() != 'Rookie' ) or ( $freeAgent->getTeamId() == $teamId ) )
		{
			if ( ( $validity[0] == 1 or $freeAgent->getContractType() == 'Rookie' ) and $validity[1] == 1 )
			{
				updatePlayerSignature( $signature);            
			}
			if ( $freeAgent->getContractType() != 'Rookie' and $validity[0] == 0 )
			{
				echo 'This signature is not valid, team is above the max salary cap.<br />';
			}
			if ( $validity[1] == 0 )
			{
				echo 'This signature is not valid, team has too many players under contract.<br />';
			}
		}
		else
		{
			if ( !isset( $_POST['match'] ) )
			{
				include_once( $GLOBALS['path']['views'] . 'transaction/signature/formSignUnrestrictedPlayer.php' );  
			}
			else
			{
				if ( $validity[0] == 1 and $validity[1] == 1 )
				{
					updatePlayerSignature( $signature );            
				}
				
				if ( $_POST['match'] == 'no' and $validity[0] == 0 )
				{
					echo 'This signature is not valid, team is above the max salary cap.<br />';
				}
				if ( $validity[1] == 0 )
				{
					echo 'This signature is not valid, team has too many players under contract.<br />';
				}
			}
		}
	}

	public function signRookieAction()
	{
		echo 'Rookie Contract';
		$rookiePlayer = new Player( $_POST['playerId'] );
		updateRookieContract( $rookiePlayer );
	}

}