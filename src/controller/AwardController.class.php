<?php

class AwardController
{

	public function __construct() { }

	public function newsAction()
	{
		$season = getCurrentSeason();
		include_once( $GLOBALS['path']['views'] . 'award/displaySeasonAwards.php' );
	}

	public function chooseTypeAction( $period )
	{
		$season = getCurrentSeason();
		$month  = 0;

		if ( $period == 'month' )
		{
			if ( getCurrentDay() == 1 )
			{
				if ( getCurrentMonth() == 1 )
				{
					$month = 12;
				}
				else
				{
					$month = getCurrentMonth() - 1;
				}
			}
			else if ( getCurrentDay() != 1 )
			{
				$month = getCurrentMonth();
			}

			if ( !checkAwardAttribution( $season, $month, 'Eastern Rookie of The Month' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'month', 'name' => 'east_rookie' ) ) . '">';
				echo 'Select Eastern Rookie of the month</br>';
				echo '</a>';
			}
			if ( !checkAwardAttribution( $season, $month, 'Western Rookie of The Month' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'month', 'name' => 'west_rookie' ) ) . '">';
				echo 'Select Western Rookie of the month</br>';
				echo '</a>';
			}
			if ( !checkAwardAttribution( $season, $month, 'Eastern Player of The Month' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'month', 'name' => 'east_player' ) ) . '">';
				echo 'Select Eastern Player of the month</br>';
				echo '</a>';
			}
			if ( !checkAwardAttribution( $season, $month, 'Western Player of The Month' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'month', 'name' => 'west_player' ) ) . '">';
				echo 'Select Western Player of the month</br>';
				echo '</a>';
			}
		}
		else if ( $period == 'season' )
		{
			if ( !checkAwardAttribution( $season, $month, '6th Man of The Year' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'season', 'name' => '6thman' ) ) . '">';
				echo 'Select 6th man</br>';
				echo '</a>';
			}
			if ( !checkAwardAttribution( $season, $month, 'MIP' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'season', 'name' => 'mip' ) ) . '">';
				echo 'Select MIP</br>';
				echo '</a>';
			}
			if ( !checkAwardAttribution( $season, $month, 'DPOY' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'season', 'name' => 'dpoy' ) ) . '">';
				echo 'Select DPOY</br>';
				echo '</a>';
			}
			if ( !checkAwardAttribution( $season, $month, 'ROY' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'season', 'name' => 'roy' ) ) . '">';
				echo 'Select ROY</br>';
				echo '</a>';
			}
			if ( !checkAwardAttribution( $season, $month, 'MVP' ) )
			{
				echo '<a href="' . $GLOBALS['router']->generateUrl( 'award_nominees', array( 'period' => 'season', 'name' => 'mvp' ) ) . '">';
				echo 'Select MVP</br>';
				echo '</a>';
			}
		}
	}

	public function seeNomineesAction( $period, $name )
	{
		$month = 0;
		if ( $period == 'month' )
		{
			if ( getCurrentDay() == 1 )
			{
				if ( getCurrentMonth() == 1 )
				{
					$month = 12;
				}
				else
				{
					$month = getCurrentMonth() - 1;
				}
			}
			else
			{
				$month = getCurrentMonth();
			}
		}
		$players = getAllCandidatesToAnAward( $name );
		include_once( $GLOBALS['path']['views'] . 'award/attributeAwardPlayersList.php' );
	}

	public function attributeAction()
	{
		$award = new Award( null, $_POST );
		insertAward( $award );
		$this->chooseTypeAction( 'month' );
	}

}