<?php

class SeasonController
{

	public function __construct() { }

	public function displayAction( $year )
	{
		$season = new Season( $year );
		include( $GLOBALS['path']['views'] . 'season/displaySeasonsRecap.php' );
	}

	public function createAction()
	{
		include( $GLOBALS['path']['views'] . 'season/formNewSeason.php' );
	}

	public function insertAction()
	{
		insertNewSeason( $_POST );
		$this->generateSeasonSchedule();
		$this->generateSeasonTransition();
		echo 'Start of a new season!';
	}

	public function generateSeasonSchedule()
	{
		$arrayOfTen = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
		$allTeams   = getAllTeamOrderByName();
		$nextSeason = getCurrentSeason() + 1;
		$season     = new Season( $nextSeason );
		$gamesCount = 1;

		foreach ( $allTeams as $key => $homeTeam )
		{
			$loopCounter = 1;
			if ( !isset( $teamCount[$homeTeam->getDivision()] ) )
			{
				$teamCount[$homeTeam->getDivision()] = 0;
			}
			$homeTeamId = $homeTeam->getId();
	
			foreach ( $allTeams as $key => $visitorTeam )
			{
				$visitorTeamId = $visitorTeam->getId();
				if ( $homeTeamId!=$visitorTeamId )
				{
					if ( $homeTeam->getDivision()==$visitorTeam->getDivision() )
					{
						$newSeasonGames[$gamesCount] = new Game( null, $homeTeamId, $visitorTeamId, $nextSeason );
						$gamesCount = $gamesCount + 1;
						$newSeasonGames[$gamesCount] = new Game( null, $homeTeamId, $visitorTeamId, $nextSeason );
						$gamesCount = $gamesCount + 1;
					}
					else if ( $homeTeam->getConference() != $visitorTeam->getConference() )
					{
						$newSeasonGames[$gamesCount] = new Game( null, $homeTeamId, $visitorTeamId, $nextSeason );
						$gamesCount = $gamesCount + 1;
					}
					else
					{
						if ( !isset( $randomArray[$homeTeam->getDivision()] ) )
						{
							shuffle( $arrayOfTen );
							$randomArray[$homeTeam->getDivision()] = $arrayOfTen;
						}
						if (
							$randomArray[$homeTeam->getDivision()][$teamCount[$homeTeam->getDivision()]] != $loopCounter and
							$randomArray[$homeTeam->getDivision()][$teamCount[$homeTeam->getDivision()] + 1] != $loopCounter
						)
						{
							$newSeasonGames[$gamesCount] = new Game( null, $homeTeamId, $visitorTeamId, $nextSeason );
							$gamesCount = $gamesCount + 1;
							$newSeasonGames[$gamesCount] = new Game( null, $homeTeamId, $visitorTeamId, $nextSeason );
							$gamesCount = $gamesCount + 1;
						}
						else
						{
							$newSeasonGames[$gamesCount] = new Game( null, $homeTeamId, $visitorTeamId, $nextSeason );
							$gamesCount = $gamesCount + 1;
						}

						if ( $loopCounter == 10 )
						{
							$teamCount[$homeTeam->getDivision()] = $teamCount[$homeTeam->getDivision()] + 2;
						}
						$loopCounter = $loopCounter + 1;
					}
				}
			}
		}

		shuffle( $newSeasonGames );

		$startDate = '2053-10-27';
		$endDate   = '2054-04-12';
		$check     = null;
		$day       = DateInterval::createFromDateString( '1 day' ); 
		$date      = new DateTime( $startDate );

		// Assign date to games
		foreach($newSeasonGames as $newSeasonGame)
		{
			$enableToExitLoop = 0;
			$initDate         = $date->format( 'Y-m-d' );
			if ( $this->checkValidDate( new DateTime( $endDate ), $newSeasonGame, $check, $season ) )
			{
				$newSeasonGame->setGameDate( $endDate );
				$check[$endDate][$newSeasonGame->getHomeTeam()->getId()]    = 1;
				$check[$endDate][$newSeasonGame->getVisitorTeam()->getId()] = 1;
			}
			else
			{
				$i = 0;
				while (
					!$this->checkValidDate( $date, $newSeasonGame,$check, $season ) and
					( ( $date->format('Y-m-d') != $initDate ) or ( $enableToExitLoop == 0 ) )
				)
				{
					$i++;
					if ( $date->format( 'Y-m-d' ) == $endDate )
					{
						$date = new DateTime( $startDate );
					}
					else
					{
						$date->add( $day );
					}
					$enableToExitLoop = 1;
				}
				if ( ( $enableToExitLoop == 1 ) and ( $date->format( 'Y-m-d' ) == $initDate ) )
				{
					echo $i . '<br />';
					echo $enableToExitLoop . '<br />';
					echo $initDate . '<br />';
					echo $date->format( 'Y-m-d' ) . '<br /><br />';
					$newSeasonGame->setGameDate( '2000-01-01' );
				}
				else
				{
					$newSeasonGame->setGameDate( $date->format( 'Y-m-d' ) );
				}

				$check[$date->format( 'Y-m-d' )][$newSeasonGame->getHomeTeam()->getId()]    = 1;
				$check[$date->format( 'Y-m-d' )][$newSeasonGame->getVisitorTeam()->getId()] = 1;
				
				if ( $date->format('Y-m-d') == '2054-04-12' )
				{
					$date = new DateTime( $startDate );
				}
				else
				{
					$date->add( $day );
				}
			}
		}

		insertSeasonSchedule($newSeasonGames);
	}

	public function generateSeasonTransition()
	{
		$currentSeason = getCurrentSeason();
		$valid         = updatePlayerAtSeasonEnd();
		$teams         = getAllTeamOrderByName();

		foreach ( $teams as $team )
		{
			$idRound1 = checkDraftPickExistence( $team->getId(), $currentSeason + 1, 1 );
			if ( empty( $idRound1 ) )
			{
				insertDraftPick( $currentSeason + 1, 1, $team->getId() );
			}
			$idRound2 = checkDraftPickExistence( $team->getId(), $currentSeason + 1, 2 );
			if ( empty( $idRound2 ) )
			{
				insertDraftPick( $currentSeason + 1, 2, $team->getId() );
			}
		}

		// Transit from prospect to player
		$oldProspects = getDraftPromotionByYear( $currentSeason );
		foreach ( $oldProspects as $oldProspect )
		{
			$draftPosition = getDraftPositionOfGivenProspectInGivenDraft( $oldProspect->getId(), $currentSeason );
			
			$newPlayer = new Player( 0 );
			$newPlayer->setBirthdate( $oldProspect->getBirthdate() );

			$newPlayer->setFirstname( $oldProspect->getFirstname() );
			$newPlayer->setName( $oldProspect->getName() );
			$newPlayer->setNationality( $oldProspect->getNationality() );
			$newPlayer->setFormation( $oldProspect->getFormation() );
			$newPlayer->setHeight( $oldProspect->getHeight() );
			$newPlayer->setWeight( $oldProspect->getWeight() );
			
			$newPlayer->setTeamId( $draftPosition->getCurrentOwnerTeam()->getId() );
			$newPlayer->setPosition( $oldProspect->getPosition() );
			$newPlayer->setSalary( 0 );
			$newPlayer->setGuarantedYear( 0 );
			$newPlayer->setOptionalYear( 0 );
			$newPlayer->setContractType( '' );
			$newPlayer->setExperience( 0 );
			$newPlayer->setDraftPromotion( $currentSeason );
			$newPlayer->setTeamId( $draftPosition->getCurrentOwnerTeam()->getId() );
			$newPlayer->setDraftPosition( $draftPosition->getGlobalDraftPick() );
			
			$personId = $oldProspect->getPersonId();
			insertPlayer( $newPlayer, $personId );
		}
	}

	public function checkValidDate( $date, $game, $check, $season )
	{
		$homeTeam      = $game->getHomeTeam()->getId();
		$visitorTeam   = $game->getVisitorTeam()->getId();
		$day           = DateInterval::createFromDateString( '1 day' );
		$strDate       = $date->format( 'Y-m-d' );
		$strDatePlus1  = $date->add( $day )->format( 'Y-m-d' );
		$strDatePlus2  = $date->add( $day )->format( 'Y-m-d' );
		$strDateMinus1 = $date->sub( $day )->sub( $day )->sub( $day )->format( 'Y-m-d' );
		$strDateMinus2 = $date->sub( $day )->format( 'Y-m-d' );
		$date->add( $day )->add( $day )->format( 'Y-m-d' );

		$allStarDate          = new DateTime( $season->getAllStarDate() );
		$strAllStarDate       = $allStarDate->format( 'Y-m-d' );
		$strAllStarDatePlus1  = $allStarDate->add( $day )->format( 'Y-m-d' );
		$strAllStarDateMinus1 = $allStarDate->sub( $day )->sub( $day )->format( 'Y-m-d' );
		
		if ( isset( $check[$strDate][$homeTeam] ) or isset( $check[$strDate][$visitorTeam] ) )
		{
			return false;
		}
		else if ( isset( $check[$strDatePlus1][$homeTeam] ) and isset( $check[$strDatePlus2][$homeTeam] ) )
		{
			return false;
		}
		else if ( isset( $check[$strDateMinus1][$homeTeam] ) and isset( $check[$strDateMinus2][$homeTeam] ) )
		{
			return false;
		}
		else if ( isset( $check[$strDateMinus1][$homeTeam] ) and isset( $check[$strDatePlus1][$homeTeam] ) )
		{
			return false;
		}
		else if ( isset( $check[$strDatePlus1][$visitorTeam] ) and isset( $check[$strDatePlus2][$visitorTeam] ) )
		{
			return false;
		}
		else if ( isset( $check[$strDateMinus1][$visitorTeam] ) and isset( $check[$strDateMinus2][$visitorTeam] ) )
		{
			return false;
		}
		else if ( isset( $check[$strDateMinus1][$visitorTeam] ) and isset( $check[$strDatePlus1][$visitorTeam] ) )
		{
			return false;
		}
		else if ( $strDate == $strAllStarDateMinus1 or $strDate == $strAllStarDate or $strDate == $strAllStarDatePlus1 )
		{
			return false;
		}
		else
		{
			return true;
		}
	}

}