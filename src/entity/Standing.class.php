<?php
include_once('model/standing/read.php');

class Standing
{
	/********************/
	/*    Attributes    */
	/********************/

	private $team;
	private $wins;
	private $losses;
	private $games;
	private $winRate;
	private $conference;
	private $conferenceRank;


	/********************/
	/*    Constructs    */
	/********************/
	
	public function __construct( $teamId, $wins, $losses )
	{
		$team;
		if ($teamId <= 30 and $teamId > 0) {
			$team = new Team ($teamId);
		}
		else {
			$team = null;
		}
		
		// A verifier \\
		if ($teamId != NULL and $wins == NULL and $losses == NULL)
		{
			$this->team			= $team;
			$this->wins       	= 0;
			$this->losses     	= 0;
			$this->games	  	= 0;
			$this->winRate	  	= 0;
			$this->conference 	= $team->getConference();
		}
		else if ($teamId != NULL and ($wins != NULL or $losses != NULL))
		{
			$this->team			= $team;
			$this->wins		  	= $wins;
			$this->losses     	= $losses;
			$this->games	  	= $wins + $losses;
			$this->winRate	  	= round($this->wins / ($this->wins + $this->losses),2);
			$this->conference 	= $team->getConference();
		}
		else
		{
			$this->team			= 0;
			$this->wins			= 0;
			$this->losses		= 0;
			$this->games		= 0;
			$this->winRate    	= 0;
			$this->conference 	= 0;
		}
	}


	/********************/
	/*     Getters      */
	/********************/
	
	public function getTeam()
	{
		return $this->team;
	}	
	
	public function getWins()
	{
		return $this->wins;
	}
	
	public function getLosses()
	{
		return $this->losses;
	}
	
	public function getGames()
	{
		return $this->games;
	}
	
	public function getWinRate()
	{
		return $this->winRate;
	}
	
	public function getConference()
	{
		return $this->conference;
	}
	
	public function getConferenceRank()
	{
		return $this->conferenceRank;
	}


	/********************/
	/*     Setters      */
	/********************/
	
	public function setTeam($newTeam)
	{
		$this->team = $newTeam;
	}
	
	public function setWins($newWins)
	{
		$this->wins     = $newWins;
		$this->games	= $this->wins + $this->losses;
		$this->winRate	= $this->wins / ($this->wins + $this->losses);
	}
	
	public function setLosses($newLosses)
	{
		$this->losses  = $newLosses;
		$this->games   = $this->wins + $this->losses;
		$this->winRate = $this->wins / ($this->wins + $this->losses);
	}
	
	public function setConferenceRank($newConferenceRank)
	{
		$this->conferenceRank = $newConferenceRank;
	}


	/********************/
	/*    Functions     */
	/********************/
	
	static function compare( $standing1, $standing2 )
	{
		return $standing1->getWinRate() < $standing2->getWinRate();
	}

	public function addLoss() { }

}