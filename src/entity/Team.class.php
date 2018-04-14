<?php

class Team
{


	/********************/
	/*    Attributes    */
	/********************/

	private $id;
	private $city;
	private $name;
	private $abbreviation;
	private $divisionId;
	private $mainColor;
	private $secondaryColor;
	//private $stats;
	//private $players;


	/********************/
	/*    Constructs    */
	/********************/

	function __construct( array $data = null )
	{
		if ( !is_null( $data ) )
		{
			$this->constructWithData( $data );
		}
		else
		{
			$this->constructWithNone();
		}
	}

	function constructWithNone()
	{
		$this->setCity( 'Total' );
		$this->setName( 'Total' );
		$this->setAbbreviation( 'ALL' );
	}

	function constructWithData( $data )
	{
		if ( $data['id'] )
		{
			$this->setId( $data['id'] );
		}

		if ( $data['city'] )
		{
			$this->setCity( $data['city'] );
		}

		if ( $data['name'] )
		{
			$this->setName( $data['name'] );
		}

		if ( $data['abbreviation'] )
		{
			$this->setAbbreviation( $data['abbreviation'] );
		}

		if ( $data['divisionId'] )
		{
			$this->setDivisionId( $data['divisionId'] );
		}

		if ( $data['mainColor'] )
		{
			$this->setMainColor( $data['mainColor'] );
		}

		if ( $data['secondaryColor'] )
		{
			$this->setSecondaryColor( $data['secondaryColor'] );
		}
	}


	/********************/
	/*     Getters      */
	/********************/

	public function getId()
	{
		return $this->id;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getAbbreviation()
	{
		return $this->abbreviation;
	}

	public function getDivisionId()
	{
		return $this->divisionId;
	}

	public function getMainColor()
	{
		return $this->mainColor;
	}

	public function getSecondaryColor()
	{
		return $this->secondaryColor;
	}


	/********************/
	/*     Setters      */
	/********************/

	public function setId( int $id )
	{
		$this->id = $id;
	}

	public function setCity( string $city )
	{
		$this->city = $city;
	}

	public function setName( string $name )
	{
		$this->name = $name;
	}

	public function setAbbreviation( string $abbreviation )
	{
		$this->abbreviation = $abbreviation;
	}

	public function setDivisionId( int $divisionId )
	{
		$this->divisionId = $divisionId;
	}

	public function setMainColor( string $mainColor = null )
	{
		$this->mainColor = $mainColor;
	}

	public function setSecondaryColor( string $secondaryColor = null )
	{
		$this->secondaryColor = $secondaryColor;
	}


	/********************/
	/*    Functions     */
	/********************/

	/**
	  * Returns the full name of the team (City followed by Name)
	  */
	public function getFullName()
	{
		return $this->getCity() . ' ' . $this->getName();
	}

	/**
	  * Returns the Division of the team
	  */
	public function getDivision()
	{
		$divisionModel = new DivisionModel();
		return $divisionModel->findById( $this->getDivisionId() );
	}

	/**
	  * Set the Division of the team
	  */
	public function setDivision( Division $division )
	{
		$this->setDivisionId( $division->getId() );
	}

	/**
	  * Returns the Conference ID of the team
	  */
	public function getConferenceId()
	{
		$divisionModel = new DivisionModel();
		return $divisionModel->findById( $this->getDivisionId() )->getConferenceId();
	}

	/**
	  * Returns the Conference of the team
	  */
	public function getConference()
	{
		$divisionModel = new DivisionModel();
		return $divisionModel->findById( $this->getDivisionId() )->getConference();
	}












	/*public function getPlayers()
	{
		if ( !$this->players ) 
		{
			$this->players = getAllPlayersOfTeam($this->getId());
		}
		return $this->players;
	}

	public function getStats()
	{
		if ( !$this->stats ) 
		{
			$this->stats = $this->setStats();
		}
		return $this->stats;
	}

	public function setStats()
	{
		$stat;
		$seasons = null;
		$season = getCurrentSeason();

		$stat = new StatTeam($this->getId());
			
		$this->stats[$season] = $stat;

		return $this->stats;
	}*/
	
	/**
	  * Returns all the next drafts of the team for the next $numberYear
	  */
	/*public function getNextDraftPick($numberYear)
	{
	   return getTeamNextDraftPick($numberYear, $this->id); 
	}*/
	
	/**
	  * Returns the number of players under contract in the team
	  */
	/*public function getNumberOfPlayersInTeam()
	{
		$numberOfPlayers = getNumberOfPlayersInATeam($this->id);
		return $numberOfPlayers; 
	}*/
	
	/**
	  * Returns the total salary of the team
	  */
	/*public function getTotalSalaryTeam()
	{
		$totalSalary = getTeamTotalSalary($this->id);
		return $totalSalary; 
	}*/
	
	/**
	  * Returns the total salary of the team
	  */
	/*public function getSalarialMarginTeam()
	{
		$currentSeason = getCurrentSeason();
		$season = new Season($currentSeason);
		$maxSalaryCap = $season->getSalaryCap();
		
		$totalSalary = $this->getTotalSalaryTeam();
		return $maxSalaryCap - $totalSalary; 
	}*/
	
	/**
	  * Get player stats for a given month and stats category 
	  */
	/*public function getSpecificSeasonStats($statCategory, $month)
	{
		$stats;
		$season  = getCurrentSeason();
		
		if($month == 'Season')
		{
			$stats = $this->getStats()[$season]->getCategoryStats($statCategory);
		}
		else
		{
			// TO DO : get Months stats function
			$stats = $this->getStats()[$season]->getCategoryStats($statCategory);
		}
		return $stats;
	}*/
}
