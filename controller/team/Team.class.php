<?php
include_once('model/team/read.php');

class Team
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $id;
	private $name;
    private $abbreviation;
    private $city;
    private $conference;
    private $division;
    private $mainColor;
    private $secondaryColor;
	private $stats;
	private $players;
	
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id) {
		// check id 
		
		if ($id) {
			$team = getTeamById($id);
			
			$this->id             = $team['teamId'];
			$this->city           = $team['city'];
			$this->name           = $team['name'];
            $this->abbreviation   = $team['abbreviation'];
			$this->conference     = $team['conference'];
            $this->division       = $team['division'];
			$this->mainColor      = $team['mainColor'];
            $this->secondaryColor = $team['secondaryColor'];
			
			// $this->setStats();
		}
		
		else if ($id == 0) {
            $this->id             = 0;
			$this->city           = '';
			$this->name           = '';
            $this->abbreviation   = '';
			$this->conference     = '';
            $this->division       = '';
			$this->mainColor      = '';
            $this->secondaryColor = '';
			
		}
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
    
	public function getAbbreviation()
	{
		return $this->abbreviation;
	}
    
	public function getCity()
	{
		return $this->city;
	}
	
	public function getConference()
	{
		return $this->conference;
	}
    
    public function getDivision()
	{
		return $this->division;
	}
    
	public function getMainColor()
	{
		return $this->mainColor;
	}
    
    public function getSecondaryColor()
	{
		return $this->secondaryColor;
	}
	
	public function getPlayers()
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
	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setName($newName)
	{
		$this->name = $newName;
	}

    public function setAbbreviation($newAbbreviation)
	{
		$this->abbreviation = $newAbbreviation;
	}
	
	public function setCity($newCity)
	{
		$this->city = $newCity;
	}

	public function setConference($newConference)
	{
		$this->conference = $newConference;
	}
    
    public function setDivision($newDivision)
	{
		$this->division = $newDivision;
	}
	
    public function setMainColor($newMainColor)
	{
		$this->mainColor = $newMainColor;
	}
    
    public function setSecondaryColor($newSecondaryColor)
	{
		$this->secondaryColor = $newSecondaryColor;
	}
    
	public function setStats()
	{
		$stat;
        $seasons = null;
		$season = getCurrentSeason();

		$stat = new StatTeam($this->getId());
			
		$this->stats[$season] = $stat;

		return $this->stats;
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
	  * Returns all the next drafts of the team for the next $numberYear
	  */
    public function getNextDraftPick($numberYear)
    {
       return getTeamNextDraftPick($numberYear, $this->id); 
    }
    
    /**
      * Returns the number of players under contract in the team
      */
    public function getNumberOfPlayersInTeam()
    {
        $numberOfPlayers = getNumberOfPlayersInATeam($this->id);
        return $numberOfPlayers; 
    }
    
    /**
      * Returns the total salary of the team
      */
    public function getTotalSalaryTeam()
    {
        $totalSalary = getTeamTotalSalary($this->id);
        return $totalSalary; 
    }
    
    /**
      * Returns the total salary of the team
      */
    public function getSalarialMarginTeam()
    {
        $currentSeason = getCurrentSeason();
        $season = new Season($currentSeason);
        $maxSalaryCap = $season->getSalaryCap();
        
        $totalSalary = $this->getTotalSalaryTeam();
        return $maxSalaryCap - $totalSalary; 
    }
    
    /**
      * Get player stats for a given month and stats category 
      */
    public function getSpecificSeasonStats($statCategory, $month)
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
    }
}
?>
