<?php

class Date
{


	/********************/
	/*    Attributes    */
	/********************/

	private $century; /* century minus one */
	private $year;    /* year from century */
	private $month;
	private $day;


	/********************/
	/*    Constructs    */
	/********************/

	function __construct( array $data = null ) {
		if ( !is_null( $data ) )
		{
			$this->constructWithData( $data );
		}
		else
		{
			$this->constructWithNone();
		}
	}

	function constructWithNone() { }

	function constructWithData( $data )
	{
		if ( $data['year'] >= 100 and $data['century'] )
		{
			throw new Exception( 'Century given twice.' );
		}

		if ( $data['day'] )
		{
			$this->setDay( $data['day'] );
		}

		if ( $data['month'] )
		{
			$this->setMonth( $data['month'] );
		}

		if ( $data['year'] >= 100 )
		{
			$this->setFullYear( $data['year'] );
		}
		else if ( $data['year'] )
		{
			$this->setYear( $data['year'] );
		}

		if ( $data['century'] )
		{
			$this->setCentury( $data['century'] );
		}
	}


	/********************/
	/*     Getters      */
	/********************/

	public function getCentury()
	{
		return $this->century;
	}

	public function getYear()
	{
		return $this->year;
	}

	public function getMonth()
	{
		return $this->month;
	}

	public function getDay()
	{
		return $this->day;
	}


	/********************/
	/*     Setters      */
	/********************/

	public function setCentury( int $century = null )
	{
		if ( $century < 0 )
		{
			throw new Exception( 'Years BC are not accepted.' );
		}
		$this->century = $century;
	}

	public function setYear( int $year = null )
	{
		if ( $year < 0 )
		{
			throw new Exception( 'Incorrect year.' );
		}
		else if ( $year > 99 )
		{
			throw new Exception( 'Years over 99 are not accepted (consider using "setFullYear").' );
		}
		$this->year = $year;
	}

	public function setMonth( int $month = null )
	{
		if ( !is_null( $month ) and ( $month <= 0 or $month > 12 ) )
		{
			throw new Exception( 'Incorrect month.' );
		}
		$this->month = $month;
	}

	public function setDay( int $day = null )
	{
		if ( $day <= 0 or $day > 31 )
		{
			throw new Exception( 'Incorrect day.' );
		}
		$this->day = $day;
	}


	/********************/
	/*    Functions     */
	/********************/

	/**
	  * Returns the century and year
	  */
	public function getFullYear()
	{
		$century;
		if ( is_null( $this->getCentury() ) )
		{
			$century = 'XX';
		}
		else
		{
			$century = $this->getCentury();
		}

		$year;
		if ( is_null( $this->getYear() ) )
		{
			$year = 'XX';
		}
		else if ( $this->getYear() < 10 )
		{
			$year = '0' . $this->getYear();
		}
		else
		{
			$year = $this->getYear();
		}

		$fullYear = $century . $year;
		if ( !is_null( $this->getCentury() ) and !is_null( $this->getYear() ) )
		{
			$fullYear = (int) $fullYear;
		}

		return $fullYear;
	}

	/**
	  * Returns the century and year
	  */
	public function setFullYear( int $fullYear = null )
	{
		if ( $fullYear < 0 )
		{
			throw new Exception( 'Years BC are not accepted.' );
		}

		if ( is_null( $fullYear ) )
		{
			$this->setCentury();
			$this->setYear();
		}
		else
		{
			$century;
			if ( $fullYear < 99 )
			{
				$century = null;
			}
			else if ( $fullYear < 1000 )
			{
				$century = substr( $fullYear, 0, 1 );
			}
			else
			{
				$century = substr( $fullYear, 0, 2 );
				
			}

			$year = substr( $fullYear, -2 );

			$this->setCentury( $century );
			$this->setYear( $year );
		}
	}

	/**
	  * Returns the season of a Date
	  */
	public function getSeason()
	{
		$season = $this->getFullYear();
		if ( $this->getMonth() >= 7 ) {
			$season++;
		}
		return $season;
	}

	/**
	  * Returns the Date as a string 'year-month-day'
	  */
	public function getFullDate()
	{
		$day;
		if ( is_null( $this->getDay() ) )
		{
			$day = 'XX';
		}
		else if ( $this->getDay() < 9 )
		{
			$day = '0' . $this->getDay();
		}
		else
		{
			$day = $this->getDay();
		}

		$month;
		if ( is_null( $this->getMonth() ) )
		{
			$month = 'XX';
		}
		else if ( $this->getMonth() < 9 )
		{
			$month = '0' . $this->getMonth();
		}
		else
		{
			$month = $this->getMonth();
		}

		return $this->getFullYear() . '-' . $month . '-' . $day;
	}

	/**
	  * Returns the string of the day (Monday, Tuesday, etc.)
	  */
	public function getStringDay()
	{
		// Get codeCentury
		$codeCentury;
		switch( $this->getCentury() )
		{
			case 20:
				$codeCentury = 6;
				break;
			case 21:
				$codeCentury = 4;
				break;
			case 22:
				$codeCentury = 2;
				break;
			case 23:
				$codeCentury = 0;
				break;
			default:
				return NULL;
				break;
		}

		// Get codeYear
		$codeYear = $this->getYear();

		// Get codeMonth
		$months = array(
			1  => 0,
			2  => 3,
			3  => 3,
			4  => 6,
			5  => 1,
			6  => 4,
			7  => 6,
			8  => 2,
			9  => 5,
			10 => 0,
			11 => 3,
			12 => 5,
		);
		$codeMonth = $months[ $this->getMonth() ];

		// Get codeDay
		$codeDay = ( $codeCentury + $codeYear + floor( $codeYear / 4 ) + $codeMonth + $this->getDay() ) % 7;
		
		// Get stringDay
		$stringDay;
		switch ( $codeDay )
		{
			case 0:
				$stringDay = 'Sunday';
				break;
			case 1:
				$stringDay = 'Monday';
				break;
			case 2:
				$stringDay = 'Tuesday';
				break;
			case 3:
				$stringDay = 'Wednesday';
				break;
			case 4:
				$stringDay = 'Thursday';
				break;
			case 5:
				$stringDay = 'Friday';
				break;
			case 6:
				$stringDay = 'Saturday';
				break;
			default:
				$stringDay = NULL;
				break;
		}
		return $stringDay;
	}

	/**
	  * Returns the string of the month (January, Febuary, etc.)
	  */
	public function getStringMonth()
	{
		$stringMonth;
		switch ( $this->getMonth() )
		{
			case 1:
				$stringMonth = 'January';
				break;
			case 2:
				$stringMonth = 'Febuary';
				break;
			case 3:
				$stringMonth = 'March';
				break;
			case 4:
				$stringMonth = 'April';
				break;
			case 5:
				$stringMonth = 'May';
				break;
			case 6:
				$stringMonth = 'June';
				break; 
			case 7:
				$stringMonth = 'July';
				break;
			case 8:
				$stringMonth = 'August';
				break;
			case 9:
				$stringMonth = 'September';
				break;
			case 10:
				$stringMonth = 'October';
				break;
			case 11:
				$stringMonth = 'November';
				break;
			case 12:
				$stringMonth = 'December';
				break;
			default:
				$stringMonth = NULL;
				break;
		}
		return $stringMonth;
	}

	/**
	  * Returns true if Date is in a leap year
	  */
	public function isLeapYear()
	{
		$year = $this->getFullYear();
		if ( ( ( $year % 4 == 0 ) and ( $year % 100 != 0 ) ) or ( $year % 400 == 0 ) )
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

	/**
	  * Returns the day incremented by one
	  */
	public function incrementDay()
	{
		$year  = $this->getYear();
		$month = $this->getMonth();
		$day   = $this->getDay();

		if ( $month == 12 and $day == 31 )
		{
			$this->setYear( $year + 1 );
			$this->setMonth( 1 );
			$this->setDay( 1 );
		}
		else
		{
			if (
				( in_array( $month, array( 1, 3, 5, 7, 8, 10 ) ) and $day == 31 ) or
				( in_array( $month, array( 4, 6, 9, 11 ) )       and $day == 30 ) or
				( ( $month == 2 and $this->isLeapYear()  )       and $day == 29 ) or
				( ( $month == 2 and !$this->isLeapYear() )       and $day == 28 )
			)
			{
				$this->setMonth( $month + 1 );
				$this->setDay( 1 );     
			}
			else
			{
				$this->setDay( $day + 1 );
			}
		}
	}

	/**
	  * Returns the day incremented by a given number of times
	  */
	public function incrementDays( int $times = 1 )
	{
		if ( $times < 0 )
		{
			throw new Exception( 'Negative number not authorised' );
		}

		for ( $i = 0; $i < $times; $i++ )
		{
			$this->incrementDay();
		}
	}

}
