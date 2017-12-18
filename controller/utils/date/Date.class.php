<?php
include_once('model/utils/date/readCurrentDate.php');
include_once('model/utils/date/writeCurrentDate.php');

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
	
	function __construct($year, $month, $day) {
        $this->month = $month;
        $this->day = $day;
        
		if ( $year < 99 )
        {	
			$this->century = 20;
            $this->year    = $year;
		}
        else if ($year > 2000)
        {
            $this->century = substr($year, 0, 2);
            $this->year    = substr($year, 2);
        }
        else
        {
			$this->century = 20;
            $this->year    = 50;
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getCentury()
	{
		return $this->century;
	}
	
	public function getYearFromCentury()
	{
		return $this->year;
	}
    
    public function getYear()
	{
		return $this->century . $this->year;
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

	public function setCentury($newCentury)
	{
		$this->century = $newCentury;
	}
	
	public function setYearFromCentury($newYearFromCentury)
	{
		$this->year = $newYearFromCentury;
	}
    
    public function setYear($newYear)
	{
		if ( $newYear < 99 )
        {	
            $this->year    = $newYear;
		}
        else if ($newYear > 2000)
        {
            $this->century = substr($newYear, 0, 2);
            $this->year    = substr($newYear, 2);
        }
	}
	
	public function setMonth($newMonth)
	{
		$this->month = $newMonth;
	}
	
	public function setDay($newDay)
	{
		$this->day = $newDay;
	}
	
	/********************/
	/*    Functions     */
	/********************/
    
    /**
      * Returns the string of the day (Monday, Tuesday, etc.)
      */
    public function getStringDay()
	{
        $codeCentury;
        $codeYear;
        $codeMonth;
        $codeDay;
        $stringDay;
        
        // Get codeCentury
        switch($this->getCentury())
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
        $codeYear = (int) $this->getYearFromCentury();

        // Get codeMonth
        $months = array(
            '01' => 0,
            '02' => 3,
            '03' => 3,
            '04' => 6,
            '05' => 1,
            '06' => 4,
            '07' => 6,
            '08' => 2,
            '09' => 5,
            '10' => 0,
            '11' => 3,
            '12' => 5,
        );
        $codeMonth = $months[$this->getMonth()];

        // Calculate codeDay
        $codeDay = ($codeCentury + $codeYear + floor($codeYear / 4) + $codeMonth + $this->getDay()) % 7;
        
        // Get stringDay
        switch($codeDay)
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

        switch ($this->getMonth())
        {
            case '01':
                $stringMonth = 'January';
                break;
            case '02':
                $stringMonth = 'Febuary';
                break;
            case '03':
                $stringMonth = 'March';
                break;
            case '04':
                $stringMonth = 'April';
                break;
            case '05':
                $stringMonth = 'May';
                break;
            case '06':
                $stringMonth = 'June';
                break; 
            case '07':
                $stringMonth = 'July';
                break;
            case '08':
                $stringMonth = 'August';
                break;
            case '09':
                $stringMonth = 'September';
                break;
            case '10':
                $stringMonth = 'October';
                break;
            case '11':
                $stringMonth = 'November';
                break;
            case '12':
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
        if ( ( ( year % 4 == 0   ) and ( year % 100 != 0 ) ) 
            or ( year % 400 == 0 ) )
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
        
        if( $month == '12' and $day == '31' )
        {
            $this->setYear($year + 1);
            $this->setMonth('01');
            $this->setDay('01');
        }
        else
        {
            if ( ( ($month == '01' or $month == '03' or $month == '05' or $month == '07' or $month == '08' or $month == '10') and $day == '31' )
              or ( ($month == '04' or $month == '06' or $month == '09' or $month == '11') and $day == '30' )
              or ( ($month == '02' and $this->isLeapYear())  and $day == '29' )
              or ( ($month == '02' and !$this->isLeapYear()) and $day == '28' ) )
            {
                $this->setMonth($month + 1);
                $this->setDay('01');     
            }
            else
            {
                $this->setDay($day + 1);
            }
        }
    }
	
	/**
      * Returns the day incremented by one
      */
    public function getStringDate()
	{
		if($this->year < 10)
		{
			$year = $this->century . '0' . $this->year;	
		}
		else
		{
			$year = $this->century . $this->year;
		}
		
		$month = $this->month;
		
		if($this->day < 9)
		{
			$day = '0' . $this->day;	
		}
		else
		{
			$day = $this->day;
		}
		
		$stringDate = $year . '-' . $month . '-' . $day;
		return $stringDate;
	}
} 
?>
