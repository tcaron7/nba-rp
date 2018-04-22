<?php

class Season
{


	/********************/
	/*    Attributes    */
	/********************/
	private $year;
	private $startDate;
	private $stopDate;
	private $draftDate;
	private $tradeLimitDate;
	private $signatureLimitDate;
	private $restrictedFreeAgentOptionLimitDate;
	private $allStarGameDate;
	private $regularSeasonAwardsDate;
	private $salaryCap;
	private $contractMax;
	private $maxPlayersInTeam;
	private $championTeamId;
	private $finalistTeamId;


	/********************/
	/*    Constructs    */
	/********************/

	function __construct() { }


	/********************/
	/*     Getters      */
	/********************/

	public function getYear()
	{
		return $this->year;
	}

	public function getStartDate()
	{
		return $this->startDate;
	}

	public function getStopDate()
	{
		return $this->stopDate;
	}

	public function getDraftDate()
	{
		return $this->draftDate;
	}

	public function getTradeLimitDate()
	{
		return $this->tradeLimitDate;
	}

	public function getSignatureLimitDate()
	{
		return $this->signatureLimitDate;
	}

	public function getRestrictedFreeAgentOptionLimitDate()
	{
		return $this->restrictedFreeAgentOptionLimitDate;
	}

	public function getAllStarGameDate()
	{
		return $this->allStarGameDate;
	}

	public function getRegularSeasonAwardsDate()
	{
		return $this->regularSeasonAwardsDate;
	}

	public function getSalaryCap()
	{
		return $this->salaryCap;
	}

	public function getContractMax()
	{
		return $this->contractMax;
	}

	public function getMaxPlayersInTeam()
	{
		return $this->maxPlayersInTeam;
	}

	public function getChampionTeamId()
	{
		return $this->championTeamId;
	}

	public function getFinalistTeamId()
	{
		return $this->finalistTeamId;
	}


	/********************/
	/*     Setters      */
	/********************/
	
	public function setYear( int $year )
	{
		$this->year = $year;
	}

	public function setStartDate( string $startDate = null )
	{
		$this->startDate = $startDate;
	}

	public function setStopDate( string $stopDate = null )
	{
		$this->stopDate = $stopDate;
	}

	public function setDraftDate( string $draftDate = null )
	{
		$this->draftDate = $draftDate;
	}

	public function setTradeLimitDate( string $tradeLimitDate = null )
	{
		$this->tradeLimitDate = $tradeLimitDate;
	}

	public function setSignatureLimitDate( string $signatureLimitDate = null )
	{
		$this->signatureLimitDate = $signatureLimitDate;
	}

	public function setRestrictedFreeAgentOptionLimitDate( string $restrictedFreeAgentOptionLimitDate = null )
	{
		$this->restrictedFreeAgentOptionLimitDate = $restrictedFreeAgentOptionLimitDate;
	}

	public function setAllStarGameDate( string $allStarGameDate = null )
	{
		$this->allStarGameDate = $allStarGameDate;
	}

	public function setRegularSeasonAwardsDate( string $regularSeasonAwardsDate = null )
	{
		$this->regularSeasonAwardsDate = $regularSeasonAwardsDate;
	}

	public function setSalaryCap( int $salaryCap = null )
	{
		$this->salaryCap = $salaryCap;
	}

	public function setContractMax( int $contractMax = null )
	{
		$this->contractMax = $contractMax;
	}

	public function setMaxPlayersInTeam( int $maxPlayersInTeam = null )
	{
		$this->maxPlayersInTeam = $maxPlayersInTeam;
	}

	public function setChampionTeamId( int $championTeamId = null )
	{
		$this->championTeamId = $championTeamId;
	}
	
	public function setFinalistTeamId( int $finalistTeamId = null )
	{
		$this->finalistTeamId = $finalistTeamId;
	}


	/********************/
	/*    Functions     */
	/********************/

	/**
	  * Returns 1 if the season is finished, 0 else.
	  */
	public function isFinished()
	{
		$dateModel     = new DateModel();
		$currentSeason = $dateModel->findCurrentDate()->getFullDate();

		if ( strtotime( $this->getStopDate() ) > strtotime( $currentSeason ) )
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}

	/**
	  * Returns the champion Team.
	  */
	public function getChampionTeam( Team $championTeam )
	{
		$teamModel = new TeamModel();
		return $teamModel->findById( $this->getChampionTeamId() );
	}

	/**
	  * Sets the championTeamId from a Team.
	  */
	public function setChampionTeam( Team $championTeam )
	{
		$this->setChampionTeamId( $championTeam->getId() );
	}

	/**
	  * Returns the finalist Team.
	  */
	public function getFinalistTeam( Team $finalistTeam )
	{
		$teamModel = new TeamModel();
		return $teamModel->findById( $finalistTeam->getId() );
	}

	/**
	  * Sets the finalistTeamId from a Team.
	  */
	public function setFinalistTeam( Team $finalistTeam )
	{
		$this->setFinalistTeamId( $finalistTeam->getId() );
	}

}
