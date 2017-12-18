<?php
include_once('model/game/read.php');
include_once('model/game/write.php');

class Game
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $id;
    private $season;
    private $gameDate;
    private $homeTeam;
	private $visitorTeam;
    private $homeTeamScore;
    private $visitorTeamScore;
    private $overtime;
	private $winnerId;
	private $loserId;
    private $status;
	
	
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id,$homeTeamId,$visitorTeamId,$season) {
		if ($id != null) {
			$game = getGameById($id);
			
			$this->id               = $game['gameId'];
			$this->season           = $game['season'];
			$this->gameDate         = $game['date'];
			$this->homeTeam         = new Team ($game['homeTeamId']);
			$this->visitorTeam      = new Team ($game['visitorTeamId']);
			$this->homeTeamScore    = $game['homeTeamScore'];
			$this->visitorTeamScore = $game['visitorTeamScore'];
			$this->overtime         = $game['overtime'];
			$this->winnerId         = new Team ($game['winnerId']);
			$this->loserId          = new Team ($game['loserId']);
			$this->status           = $game['status'];
		}
        elseif ($homeTeamId != null and $visitorTeamId != null and $season != null)
        {
			$this->season           = $season;
			$this->homeTeam         = new Team ($homeTeamId);
			$this->visitorTeam      = new Team ($visitorTeamId);
			$this->homeTeamScore    = 0;
			$this->visitorTeamScore = 0;
			$this->overtime         = 0;
			$this->status           = 0;
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getSeason()
	{
		return $this->season;
	}
	
	public function getGameDate()
	{
		return $this->gameDate;
	}
	
	public function getHomeTeam()
	{
		return $this->homeTeam;
	}
	
	public function getVisitorTeam()
	{
		return $this->visitorTeam;
	}
	
	public function getHomeTeamScore()
	{
		return $this->homeTeamScore;
	}
	
	public function getVisitorTeamScore()
	{
		return $this->visitorTeamScore;
	}
	
	public function getOvertime()
	{
		return $this->overtime;
	}
	
	public function getWinnerId()
	{
		return $this->winnerId;
	}
	
	public function getLoserId()
	{
		return $this->loserId;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setSeason($newSeason)
	{
		$this->season = $newSeason;
	}
	
	public function setGameDate($newGameDate)
	{
		$this->gameDate = $newGameDate;
	}
	
	public function setHomeTeam($newHomeTeam)
	{
		$this->homeTeam = $newHomeTeam;
	}
	
	public function setVisitorTeam($newVisitorTeam)
	{
		$this->visitorTeam = $newVisitorTeam;
	}
	
	public function setHomeTeamScore($newHomeTeamScore)
	{
		$this->homeTeamScore = $newHomeTeamScore;
	}
	
	public function setVisitorTeamScore($newVisitorTeamScore)
	{
		$this->visitorTeamScore = $newVisitorTeamScore;
	}
	
	public function setOvertime($newOvertime)
	{
		$this->overtime = $newOvertime;
	}
	
	public function setWinnerId($newWinnerId)
	{
		$this->winnerId = $newWinnerId;
	}
    
	public function setLoserId($newLoserId)
	{
		$this->loserId = $newLoserId;
	}
	
	public function setStatus($newStatus)
	{
		$this->status = $newStatus;
	}
	
	
	/********************/
	/*    Functions     */
	/********************/
}