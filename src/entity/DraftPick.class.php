<?php
include_once('model/draft/read.php');
include_once('model/draft/write.php');

class DraftPick
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $id;
    private $year;
    private $draftRound;
    private $draftPick;
    private $player;
    private $originalOwnerTeam;
    private $currentOwnerTeam;
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($data, $year, $draftRound, $ownerTeamId, $originalTeamId, $draftPick) {
        
        if(!is_null($data))
        {
            $this->id                   = $data['draftPickId'];
            $this->year                 = $data['year'];
            $this->draftRound           = $data['round'];
            $this->draftPick            = $data['choiceNumber'];
            $this->player               = new Person($data['playerId']);
            $this->originalOwnerTeam    = new Team($data['originalOwnerTeamId']);
            $this->currentOwnerTeam     = new Team($data['currentOwnerTeamId']);
        }
        elseif(!is_null($year) and !is_null($draftRound) and !is_null($ownerTeamId) and !is_null($originalTeamId) and !is_null($draftPick))
        {
            $this->id                   = 0;
            $this->year                 = $year;
            $this->draftRound           = $draftRound;
            $this->draftPick            = $draftPick;
            $this->player               = 0;
            $this->originalOwnerTeam    = new Team($originalTeamId);
            $this->currentOwnerTeam     = new Team($ownerTeamId);
        }
        else
        {
            $this->id                   = 0;
            $this->year                 = 0;
            $this->draftRound           = 0;
            $this->draftPick            = 0;
            $this->player               = 0;
            $this->originalOwnerTeam    = new Team(0);
            $this->currentOwnerTeam     = new Team(0);
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getId()
	{
		return $this->id;
	}
    
    public function getYear()
	{
		return $this->year;
	}
    
    public function getDraftRound()
	{
		return $this->draftRound;
	}
    
    public function getDraftPick()
	{
		return $this->draftPick;
	}
    
    public function getGlobalDraftPick()
	{
        if($this->draftPick == 0 or $this->draftRound == 0)
        {
            $globalPick = 0;
        }
        else
        {
            $globalPick = ($this->draftPick + 30*($this->draftRound - 1));
        }
		return $globalPick;
	}
    
    public function getPlayer()
	{
    return $this->player;
	}
    
    public function getOriginalOwnerTeam()
	{
		return $this->originalOwnerTeam;
	}
    
    public function getCurrentOwnerTeam()
	{
		return $this->currentOwnerTeam;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
    	
    public function setYear($newYear)
	{
		$this->year = $newYear;
	}
    
    public function setDraftRound($newDraftRound)
	{
		$this->draftRound = $newDraftRound;
	}
    
    public function setDraftPick($newDraftPick)
	{
		$this->draftPick = $newDraftPick;
	}
    
    public function setPlayer($newPlayer)
	{
		$this->player = $newPlayer;
	}
    
    public function setOriginalOwnerTeam($newOriginalOwnerTeam)
	{
		$this->originalOwnerTeam = $newOriginalOwnerTeam;
	}
    
    public function setCurrentOwnerTeam($newCurrentOwnerTeam)
	{
		$this->currentOwnerTeam = $newCurrentOwnerTeam;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}