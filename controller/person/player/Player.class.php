<?php
include_once('model/person/player/read.php');
include_once('model/person/player/write.php');

class Player extends Person
{
	/********************/
	/*    Attributes    */
	/********************/
	
	private $teamId;
	private $position;
	private $salary;
	private $guarantedYear;
	private $optionalYear;
	private $contractType;
	private $experience;
	private $draftPromotion;
	private $draftPosition;
	private $stats;
	private $injuryStatus;
	
	
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id) {
		if ( $id == 0 ) {
			$this->teamId         = 0;
			$this->position       = 'C';
			$this->salary         = 0.0;
			$this->guarantedYear  = 0;
			$this->optionalYear   = 0;
			$this->contractType   = NULL;
			$this->experience     = 0;
			$this->draftPromotion = 0;
			$this->draftPosition  = 0;
			$this->injuryStatus  = 'Healthy';
		}
		else if ( $id ) {
			$player = getPlayerById($id);
			parent::__construct($player['personId']);
			$this->setId($player['playerId']);
			// $this->setStats();
			$this->setInjuryStatus();
			
			$this->teamId         = $player['teamId'];
			$this->position       = $player['position'];
			$this->salary         = $player['salary'];
			$this->guarantedYear  = $player['guarantedYear'];
			$this->optionalYear   = $player['optionalYear'];
			$this->contractType   = $player['contractType'];
			$this->experience     = $player['experience'];
			$this->draftPromotion = $player['draftPromotion'];
			$this->draftPosition  = $player['draftPosition'];
		}
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getTeamId()
	{
		return $this->teamId;
	}
	
	public function getPosition()
	{
		return $this->position;
	}
	
	public function getSalary()
	{
		return $this->salary;
	}
	
	public function getGuarantedYear()
	{
		return $this->guarantedYear;
	}
	
	public function getOptionalYear()
	{
		return $this->optionalYear;
	}
	
	public function getContractType()
	{
		return $this->contractType;
	}
	
	public function getExperience()
	{
		return $this->experience;
	}
		
	public function getDraftPromotion()
	{
		return $this->draftPromotion;
	}
		
	public function getDraftPosition()
	{
		return $this->draftPosition;
	}
	
	public function getStats()
	{
		if ( !$this->stats ) 
		{
			$this->stats = $this->setStats();
		}
		return $this->stats;
	}
	
	public function getInjuryStatus()
	{
		return $this->injuryStatus;
	}
    
    public function getPersonId()
	{
        $player = getPlayerById($this->getId());
		return $player['personId'];
	}
	
    
	/********************/
	/*     Setters      */
	/********************/
	
	public function setTeamId($newTeamId)
	{
		$this->teamId = $newTeamId;
	}
		
	public function setPosition($newPosition)
	{
		$this->position = $newPosition;
	}
		
	public function setSalary($newSalary)
	{
		$this->salary = $newSalary;
	}
		
	public function setGuarantedYear($newGuarantedYear)
	{
		$this->guarantedYear = $newGuarantedYear;
	}
		
	public function setOptionalYear($newOptionalYear)
	{
		$this->OptionalYear = $newOptionalYear;
	}
		
	public function setContractType($newContractType)
	{
		$this->contractType = $newContractType;
	}
		
	public function setExperience($newExperience)
	{
		$this->experience = $newExperience;
	}	
	
	public function setDraftPromotion($newDraftPromotion)
	{
		$this->draftPromotion = $newDraftPromotion;
	}	
	
	public function setDraftPosition($newDraftPosition)
	{
		$this->draftPosition = $newDraftPosition;
	}
	
	public function setStats()
	{
		$stat;
        $seasons = null;
		$seasons = getSeasonsPlayedByPlayers($this->getId());
		
		$idx = 0;
        if($seasons!=null)
        {
            foreach($seasons as $season)
            {
                $year = $season->getYear();
				$teams = getTeamsPlayedByPlayersInASeason($this->getId(),$year);
				
				foreach($teams as $team)
				{
					$seasonAndTeam['season'] = $year;
					$seasonAndTeam['teamId'] = $team->getId();
					$stat = new StatPlayer($this->getId(), $seasonAndTeam, null, null);

					$id = $stat->getId();
					
					if (isset($id)) {
					$idx++;
					$this->stats[$idx] = $stat;
					}
				}
            }
        }
		$currentYear = getCurrentSeason();
		$seasonAndTeam['season'] = $currentYear;
		$seasonAndTeam['teamId'] = 0;
		$stat = new StatPlayer($this->getId(), $seasonAndTeam, null, null);
		$id = $stat->getId();
		if (isset($id))
		{
			$this->stats[$currentYear] = $stat;
		}
		return $this->stats;
	}
	
	
	/********************/
	/*    Functions     */
	/********************/
	
	/**
	  * Returns the team of the player
	  */
	public function getTeam()
	{
		return new Team ($this->getTeamId());
	}
    
    /**
      * Returns the full name of the player
      */
	public function getFullName()
	{
		return $this->getFirstname() . ' ' . $this->getName();
	}
	
	/**
      * Returns the important stat of the player (pts,reb,ass)
      */
	public function getRoughStats()
	{
		$currentSeason = getCurrentSeason();
		
		if(isset($this->getStats()[$currentSeason]) && ($this->getStats()[$currentSeason]->getGames()>0))
		{
			$games = $this->getStats()[$currentSeason]->getGames();
			
			$points = $this->getStats()[$currentSeason]->getPoints();
			$rebounds = $this->getStats()[$currentSeason]->getRebounds();
			$assists = $this->getStats()[$currentSeason]->getAssists();
			
			$roughStats['games'] = $games;
			$roughStats['points'] = $points/$games;
			$roughStats['rebounds'] = $rebounds/$games;
			$roughStats['assists'] = $assists/$games;
		}
		else
		{
			$roughStats['games'] = 0;
			$roughStats['points'] = 0;
			$roughStats['rebounds'] = 0;
			$roughStats['assists'] = 0;
		}
		
		return $roughStats;
	}
	
	/**
      * Get stats sorted by home and road games
      */
	public function getHomeRoadSeasonStats()
	{
		$statsHomeAwaySeasonStats;
        $currentSeason = getCurrentSeason();
		
		$statsHomeAwaySeasonStats['Home'] = new StatPlayer($this->getId(),null,null,getHomeStatPlayerByIdAndSeason($this->getId(), $currentSeason));
		$statsHomeAwaySeasonStats['Road'] = new StatPlayer($this->getId(),null,null,getRoadStatPlayerByIdAndSeason($this->getId(), $currentSeason));
		return $statsHomeAwaySeasonStats;
	}
	
	/**
      * Get stats sorted by wins and losses games
      */
	public function getWinsLossesSeasonStats()
	{
		$statsWinsLossesSeasonStats;
        $currentSeason = getCurrentSeason();
		
		$statsWinsLossesSeasonStats['Wins']	  = new StatPlayer($this->getId(),null,null,getWinsStatPlayerByIdAndSeason($this->getId(), $currentSeason));
		$statsWinsLossesSeasonStats['Losses'] = new StatPlayer($this->getId(),null,null,getLossesStatPlayerByIdAndSeason($this->getId(), $currentSeason));
		return $statsWinsLossesSeasonStats;
	}
	
	/**
      * Get stats sorted by months games
      */
	public function getMonthsSeasonStats()
	{
		$statsMonthsSeasonStats=null;
        $currentSeason = getCurrentSeason();
		$monthsStats = getMonthsStatPlayerByIdAndSeason($this->getId(), $currentSeason);
		
		foreach($monthsStats as $monthStats)
		{
			switch($monthStats['month'])
			{
				case 10:
					$month = 'October';
					break;
				case 11:
					$month = 'November';
					break;
				case 12:
					$month = 'December';
					break;
				case 01:
					$month = 'January';
					break;
				case 02:
					$month = 'February';
					break;
				case 03:
					$month = 'March';
					break;
				case 04:
					$month = 'April';
					break;
			}  
			$statsMonthsSeasonStats[$month]	  = new StatPlayer($this->getId(),null,null,$monthStats);
		}
		return $statsMonthsSeasonStats;
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
            $stats = $this->getMonthsSeasonStats()[$month]->getCategoryStats($statCategory);
        }
        return $stats;
    }
    
	/**
      * Set player injury status 
      */
	public function setInjuryStatus()
	{
		$this->injuryStatus = getPlayerInjuryStatus($this->getId());
	}
}
?>
