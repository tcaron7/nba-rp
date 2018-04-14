<?php

class DateTest
{
	function __construct( ) { }

	public function launchTests()
	{
		$dateModel   = new DateModel();
		$currentDate = $dateModel->findCurrentDate();
		echo '<pre>';
		echo '<b>Current date object:</b> '; var_dump( $currentDate );
		echo '<b>Day:</b> '; var_dump( $currentDate->getDay() );
		echo '<b>Month:</b> '; var_dump( $currentDate->getMonth() );
		echo '<b>Year:</b> '; var_dump( $currentDate->getYear() );
		echo '<b>Century:</b> '; var_dump( $currentDate->getCentury() );
		echo '<b>Full year:</b> '; var_dump( $currentDate->getFullYear() );
		echo '<b>Season:</b> '; var_dump( $currentDate->getSeason() );
		echo '<b>Full date:</b> '; var_dump( $currentDate->getFullDate() );
		echo '<b>String day:</b> '; var_dump( $currentDate->getStringDay() );
		echo '<b>String month:</b> '; var_dump( $currentDate->getStringMonth() );
		echo '<b>Is leap year:</b> '; var_dump( $currentDate->isLeapYear() );

		$currentDate->incrementDay();
		echo '<b>Next day:</b> '; var_dump( $currentDate->getFullDate() );

		$currentDate->incrementDays( 16 );
		echo '<b>Next 16 days:</b> '; var_dump( $currentDate->getFullDate() );

		$currentDate->setDay( 1 );
		echo '<b>Set day:</b> '; var_dump( $currentDate->getFullDate() );

		$currentDate->setMonth( 4 );
		echo '<b>Set month:</b> '; var_dump( $currentDate->getFullDate() );

		$currentDate->setYear( 99 );
		echo '<b>Set year:</b> '; var_dump( $currentDate->getFullDate() );

		$currentDate->setCentury( 19 );
		echo '<b>Set century:</b> '; var_dump( $currentDate->getFullDate() );

		$currentDate->setFullYear( 2333 );
		echo '<b>Set full year:</b> '; var_dump( $currentDate->getFullDate() );

		$nextDate = $dateModel->findCurrentDate();
		$nextDate->incrementDay();
		$dateModel->saveCurrentDate( $nextDate );
		$currentDate = $dateModel->findCurrentDate();
		echo '<b>Save current date:</b> '; var_dump( $currentDate->getFullDate() );

		echo '</pre>';
	}
}