<?php

class DraftController
{

	public function __construct() { }

	public function lotteryAction()
	{
		$year        = getCurrentSeason();
		$lotteryDone = checkLottery( $year );
		if ( $lotteryDone == 0 )
		{
			echo 'Lottery is done for the year!';
			return;
		}

		echo "It's lottery time !<br/><br/>";
		$teamStanding = getTeamStandingWithRankForCurrentSeason();
		include( $GLOBALS['path']['views'] . 'standing/displayStandings.php' );

		$lotteryTeams         = array();
		$nonLotteryTeams      = array();
		$indexLotteryTeams    = 1;
		$indexNonLotteryTeams = 1;
		foreach ( $teamStanding as $standing )
		{
			if ( $standing->getConferenceRank() >= 9 )
			{
				$lotteryTeams[$indexLotteryTeams] = $standing;
				$indexLotteryTeams = $indexLotteryTeams + 1;
			}
			else
			{
				$nonLotteryTeams[$indexNonLotteryTeams] = $standing;
				$indexNonLotteryTeams = $indexNonLotteryTeams + 1;
			}
		}
		usort( $lotteryTeams,    'Standing::compare' );
		usort( $nonLotteryTeams, 'Standing::compare' );

		$lotteryPicks;
		$indexLotteryPicks = 1;
		while ( $indexLotteryPicks <= 3 )
		{
			$rand = mt_rand( 1, 1000 );
			if ( $rand >= 1 and $rand <= 250 and ( empty( $lotteryPicks ) or !in_array( 1, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 1;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 251 and $rand <= 449 and ( empty( $lotteryPicks ) or !in_array( 2, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 2;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 450 and $rand <= 605 and ( empty( $lotteryPicks ) or !in_array( 3, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 3;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 606 and $rand <= 724 and ( empty( $lotteryPicks ) or !in_array( 4, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 4;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 725 and $rand <= 812 and ( empty( $lotteryPicks ) or !in_array( 5, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 5;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 813 and $rand <= 875 and ( empty( $lotteryPicks ) or !in_array( 6, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 6;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 876 and $rand <= 918 and ( empty( $lotteryPicks ) or !in_array( 7, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 7;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 919 and $rand <= 946 and ( empty( $lotteryPicks ) or !in_array( 8, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 8;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 947 and $rand <= 963 and ( empty( $lotteryPicks ) or !in_array( 9, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 9;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 964 and $rand <= 974 and ( empty( $lotteryPicks ) or !in_array( 10, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 10;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 975 and $rand <= 982 and (empty( $lotteryPicks ) or !in_array( 11, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 11;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 983 and $rand <= 989 and ( empty( $lotteryPicks ) or !in_array( 12, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 12;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 990 and $rand <= 995 and ( empty( $lotteryPicks ) or !in_array( 13, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 13;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
			if ( $rand >= 996 and $rand <= 1000 and ( empty( $lotteryPicks ) or !in_array( 14, $lotteryPicks ) ) )
			{
				$lotteryPicks[$indexLotteryPicks] = 14;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
		}

		for ( $i = 1; $i <= 14; $i++ )
		{
			if ( !in_array( $i, $lotteryPicks ) )
			{
				$lotteryPicks[$indexLotteryPicks] = $i;
				$indexLotteryPicks = $indexLotteryPicks + 1;
			}
		}

		for ( $i = 1; $i <= 30; $i++ )
		{
			if ( $i <= 14 )
			{
				$draftPick[$i]      = new DraftPick( null, $year, 1, 0, $lotteryTeams[$lotteryPicks[$i] - 1]->getTeam()->getId(), $i );
				$draftPick[30 + $i] = new DraftPick( null, $year, 2, 0, $lotteryTeams[$i - 1]->getTeam()->getId(), $i );
			}
			else
			{
				$draftPick[$i]      = new DraftPick( null, $year, 1, 0, $nonLotteryTeams[$i - 15]->getTeam()->getId(), $i );
				$draftPick[30 + $i] = new DraftPick( null, $year, 2, 0, $nonLotteryTeams[$i - 15]->getTeam()->getId(), $i );
			}
		}

		for ( $i = 1; $i <= 60; $i++ )
		{
			echo $i . '. ' . $draftPick[$i]->getOriginalOwnerTeam()->getFullname() . '</br>';
			updateDraftChoice( $draftPick[$i] );
		}
	}

	public function selectProspectsAction()
	{
		$year = intval( getCurrentSeason() );
		include( $GLOBALS['path']['views'] . 'draft/formSelectProspects.php' );
	}

	public function subscribeProspectsAction()
	{
		if ( empty( $_POST['selectedProspects'] ) )
		{
			return;
		}

		foreach ( $_POST['selectedProspects'] as $selectedProspect )
		{
			updateProspectDraftYear( intval( $selectedProspect ) );
		}

		$prospects = getDraftPromotionByYear( getCurrentSeason() );
		include( $GLOBALS['path']['views'] . 'draft/displayProspects.php' );
	}

	public function doAction()
	{
		$year       = getCurrentSeason();
		$nextPick   = getNextDraftPick();
		$draftPicks = getDraftPickByYear( $year );
		$viewYear   = $year;
		$section    = 'draft';
		include( $GLOBALS['path']['views'] . 'draft/displayDraftOfYear.php');
	}

	public function chooseAction()
	{
		$year        = getCurrentSeason();
		$nextPick    = getNextDraftPick();
		$pickNumber  = $nextPick->getGlobalDraftPick();
		$team        = $nextPick->getCurrentOwnerTeam();
		$teamPlayers = getAllPlayersOfTeam( $team->getId() );

		if ( $pickNumber == 1 )
		{
			$suffix = 'st';
		}
		else if ( $pickNumber == 2 )
		{
			$suffix = 'nd';
		}
		else if ( $pickNumber == 3 )
		{
			$suffix = 'rd';
		}
		else
		{
			$suffix = 'th';
		}

		echo 'With the ' . $pickNumber . $suffix . ' of the ' . $year . ' NBA Draft, ';
		echo 'the ' . $team->getFullname() . ' selects: <br/> <br/>';

		include( $GLOBALS['path']['views'] . 'team/displayRoster.php' );
		include( $GLOBALS['path']['views'] . 'draft/formSelectAvailableProspects.php' );
	}

	public function pickAction()
	{
		$nextPick = getNextDraftPick();
		if ( count( $_POST['selectedProspects'] ) == 1 )
		{
			updateSelectedPlayerInPick( $nextPick, $_POST['selectedProspects'][0] );
			$this->doAction();
		}
		else if ( empty( $_POST['selectedProspects'] ) )
		{
			echo 'Missing prospect to pick, try again!';
			$this->chooseAction();
		}
		else
		{
			echo 'You can only select one prospect, try again!';
			$this->chooseAction();
		}
	}

	public function historyChooseYearAction()
	{
		$draftYears = getPreviousDraftYear();

		foreach ( $draftYears as $draftYear )
		{
			echo '<a href="' . $GLOBALS['router']->generateUrl( 'draft_year', array( 'year' => $draftYear['year'] ) ) .'">';
			echo $draftYear['year'] . ' Draft</br>';
			echo '</a>';
		}
	}

	public function historyDisplayAction( $year )
	{
		$this->historyChooseYearAction();
		$draftPicks = getDraftPickByYear( $year );
		$viewYear   = $year;
		$section    = 'draft_history';
		include( $GLOBALS['path']['views'] . 'draft/displayDraftOfYear.php' );
	}

}