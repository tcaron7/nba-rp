<?php
include_once('model/season/read.php');
include_once('model/season/write.php');

class Season
{
	/********************/
	/*    Attributes    */
	/********************/
    private $year;
    private $champion;
    private $finalist;
    private $status;
	private $startDate;
	private $stopDate;
    private $tradeLimitDate;
	private $signatureLimitDate;
    private $restrictedFreeAgentOptionDate;
    private $allStarDate;
	private $regularSeasonAwardsDate;
    private $maxPlayersInTeam;
	private $salaryCap;
    private $contractMax;
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($year) {
		if ($year) {
			$season = getSeasonByYear($year);
			$this->year                             = $season['year'];
			$this->champion                         = new Team($season['champion']);
			$this->finalist                         = new Team($season['finalist']);
			$this->status                           = $season['status'];
			$this->startDate                        = $season['startDate'];
			$this->stopDate                         = $season['stopDate'];
            $this->tradeLimitDate                   = $season['tradeLimitDate'];
			$this->signatureLimitDate               = $season['signatureLimitDate'];
            $this->restrictedFreeAgentOptionDate    = $season['restrictedFreeAgentOptionDate'];
			$this->allStarDate                      = $season['allStarDate'];
            $this->regularSeasonAwardsDate          = $season['regularSeasonAwardsDate'];
            $this->draftDate                        = $season['draftDate'];
			$this->maxPlayersInTeam                 = $season['maxPlayersInTeam'];
			$this->salaryCap                        = $season['salaryCap'];
            $this->contractMax                      = $season['contractMax'];
		}
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getYear()
	{
		return $this->year;
	}
	
	public function getChampion()
	{
		return $this->champion;
	}
	
	public function getFinalist()
	{
		return $this->finalist;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getStartDate()
	{
		return $this->startDate;
	}
	
	public function getStopDate()
	{
		return $this->stopDate;
	}
    
	public function getTradeLimitDate()
	{
		return $this->tradeLimitDate;
	}
	
	public function getSignatureLimitDate()
	{
		return $this->signatureLimitDate;
	}
    
    public function getRestrictedFreeAgentOptionDate()
	{
		return $this->restrictedFreeAgentOptionDate;
	}
	
	public function getAllStarDate()
	{
		return $this->allStarDate;
	}
    
	public function getRegularSeasonAwardsDate()
	{
		return $this->regularSeasonAwardsDate;
	}
    
    public function getDraftDate()
	{
		return $this->draftDate;
	}
	
	public function getMaxPlayersInTeam()
	{
		return $this->maxPlayersInTeam;
	}
	
	public function getSalaryCap()
	{
		return $this->salaryCap;
	}
	
	public function getContractMax()
	{
		return $this->contractMax;
	}
    
	/********************/
	/*     Setters      */
	/********************/
	
	public function setYear($newYear)
	{
		$this->year = $newYear;
	}
	
	public function setChampion($newChampion)
	{
		$this->champion = $newChampion;
	}
	
	public function setFinalist($newFinalist)
	{
		$this->finalist = $newFinalist;
	}
	
	public function setStatus($newStatus)
	{
		$this->status = $newStatus;
	}
	
	public function setStartDate($newStartDate)
	{
		$this->startDate = $newStartDate;
	}
	
	public function setStopDate($newStopDate)
	{
		$this->stopDate = $newStopDate;
	}
	
	
	/********************/
	/*    Functions     */
	/********************/
}