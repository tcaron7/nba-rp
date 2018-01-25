<?php

class HomeController
{

	public function __construct() { }

	public function homeAction()
	{
		$currentDay    = getCurrentDate();
		$currentSeason = getCurrentSeason();
		$season        = new Season( $currentSeason );

		// Intro explaination
		include( $GLOBALS['path']['views'] . 'sectionExplain.php' );

		// Games of the day
		$sectionTitle = 'Play games of the day';
		$viewDay      = $currentDay;
		include( $GLOBALS['path']['views'] . 'game/displayGameOfDay.php' );

		// Individual awards
		if ( isAnAwardDay( $season ) )
		{
			$sectionTitle = 'Attribute Awards';
			include( $GLOBALS['path']['views'] . 'award/menuAwards.php' );
		}

		// Trade possibility
		$endTrade = $season->getTradeLimitDate();
		if ( $currentDay <= $endTrade )
		{
			$sectionTitle = 'Do a trade';
			include( $GLOBALS['path']['views'] . 'transaction/menuTransaction.php' );
		}

		// Signature possibility
		$endSignature = $season->getSignatureLimitDate();
		if ( $currentDay <= $endSignature )
		{
			$sectionTitle = 'Sign a player';
			include( $GLOBALS['path']['views'] . 'transaction/menuTransaction.php' );
		}

		// NBA draft
		$draftDay = $season->getDraftDate();
		if ( $currentDay == $draftDay )
		{
			include( $GLOBALS['path']['views'] . 'draft/menuDraftDay.php' );
		}

		// Season transition
		$endSeason = $season->getStopDate();
		if ( $currentDay == $endSeason )
		{
			include( $GLOBALS['path']['views'] . 'season/menuSeasonTransitionDay.php' );
			if ( !empty( $_POST ) )
			{
				$valid = insertNewSeason( $_POST );
			}
		}

		// Season start
		$startSeason = $season->getStartDate();
		if ( $currentDay == $startSeason )
		{
			include( $GLOBALS['path']['views'] . 'person/player/menuPlayerOption.php' );
		}

		// Restricted FA option activation
		$restrictedFreeAgentOptionDate = $season->getRestrictedFreeAgentOptionDate();
		if ( $currentDay == $restrictedFreeAgentOptionDate )
		{
			include( $GLOBALS['path']['views'] . 'person/player/menuRestrictedFreeAgentOption.php' );
		}

		// Injury status
		include( $GLOBALS['path']['views'] . 'injury/menuInjury.php' );
	}

	public function nextDayAction()
	{
		$viewDay       = getCurrentDate();
		$currentSeason = getCurrentSeason();
		$season        = new Season( $currentSeason );
		$endSeason     = $season->getStopDate();

		if ( $viewDay == $endSeason )
		{
			include( 'controller/season/generateSeasonTransition.php' );
		}

		preg_match( '/^(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})$/', $viewDay, $currentDay );
		$day = new Date( $currentDay['year'], $currentDay['month'], $currentDay['day'] );
		$day->incrementDay();
		writeCurrentDate( $day );

		$this->homeAction();
	}

	public function planAction()
	{
		include( $GLOBALS['path']['views'] . 'plan.php' );
	}

}