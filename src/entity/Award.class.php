<?php
include_once('model/award/read.php');
include_once('model/award/write.php');

class Award
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $id;
    private $season;
    private $month;
    private $award;
	private $player;
    private $team;
	
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id,$data) {
        if ($id != null) {
			$award = getAwardById($id);

            $this->season   = $award['season'];
            $this->month    = $award['month'];
            $this->award    = $award['award'];
            $this->player   = new Player($award['playerId']);
            $this->team     = new Team($award['teamId']);
        }
        elseif ($data != null)
        {
            $player = new Player($data['playerId']);
            $award = $this->convertDataToAward($data['award']);
            $this->season   = $data['season'];
            $this->month    = $data['month'];
            $this->award    = $award;
            $this->player   = $player;
            $this->team     = new Team($player->getTeamId());
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
    
    public function getMonth()
	{
		return $this->month;
	}
    
    public function getAward()
	{
		return $this->award;
	}

    public function getPlayer()
	{
		return $this->player;
	}
    
	public function getTeam()
	{
		return $this->team;
	}	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setId($newId)
	{
		$this->id = $newId;
	}

    public function setSeason($newSeason)
	{
		$this->season = $newSeason;
	}
	
	public function setMonth($newMonth)
	{
		$this->month = $newMonth;
	}
	
	public function setAward($newAward)
	{
		$this->award = $newAward;
	}

	public function setPlayer($newPlayer)
	{
		$this->player = $newPlayer;
	}

	public function setTeam($newTeam)
	{
		$this->team = $newTeam;
	}
	
	/********************/
	/*    Functions     */
	/********************/
    
    public function convertDataToAward($data)
    {
        if($data == 'east_rookie')
        {
            $award = 'Eastern Rookie of The Month';
        }
        elseif($data == 'west_rookie')
        {
            $award = 'Western Rookie of The Month';
        }
        elseif($data == 'east_player')
        {
            $award = 'Eastern Player of The Month';
        }
        elseif($data == 'west_player')
        {
            $award = 'Western Player of The Month';
        }
        elseif($data == '6thman')
        {
            $award = '6th Man of The Year';
        }
        elseif($data == 'mip')
        {
            $award = 'MIP';
        }
        elseif($data == 'dpoy')
        {
            $award = 'DPOY';
        }
        elseif($data == 'roy')
        {
            $award = 'ROY';
        }
        elseif($data == 'mvp')
        {
            $award = 'MVP';
        }
        else
        {
            $award = '';
        }
        
        return $award;
    }
}