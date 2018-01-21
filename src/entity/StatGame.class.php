<?php
include_once('model/stat/read.php');
include_once('model/stat/write.php');

class StatsGame
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $gameId;
    private $teamsId;  
    private $teamsStats;
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($gameId, $data) 
    {
		if (isset($gameId) && !isset($data)) 
        {
            // Get stats of existing game in table
			$this->gameId = $gameId;
			$this->teamsId = getGameTeamsId($gameId);
			$playersGameStats = getGameTeamsStats($gameId, $this->teamsId['homeTeam'], $this->teamsId['visitorTeam']);
			
			$homeTeamIndex = 0;
            $visitorTeamIndex = 0;
            
            $sumHomeStats = null;
            $sumVisitorStats = null;
            foreach($playersGameStats as $index => $playerGameStats)
            {
				if($playerGameStats['playerTeamId'] == $this->teamsId['homeTeam'])
				{
					$playerId = $playerGameStats['playerId'];
					if($playerId != 0)
					{
						$this->teamsStats['homeTeam'][$homeTeamIndex] = new StatPlayer($playerId, null, null, $playerGameStats);
						$homeTeamIndex++;
					}
					else
					{
						$sumHomeStats = $playerGameStats;
					}
                }
                else if($playerGameStats['playerTeamId'] == $this->teamsId['visitorTeam'])
                {
					$playerId = $playerGameStats['playerId'];
					if($playerId != 0)
					{
						$this->teamsStats['visitorTeam'][$visitorTeamIndex] = new StatPlayer($playerId, null, null, $playerGameStats);
						$visitorTeamIndex++;
					}
					else
					{
						$sumVisitorStats = $playerGameStats;
					}
                }
            }
            $this->teamsStats['homeTeam']['Total']    = new StatPlayer('Total', null, null, $sumHomeStats);
            $this->teamsStats['visitorTeam']['Total'] = new StatPlayer('Total', null, null, $sumVisitorStats);
        }
        else
        {
            $this->gameId = array_keys($data)[0];
            $game = new Game($this->gameId,null,null,null);
            $this->teamsId['homeTeam']      = $game->getHomeTeam()->getId();
            $this->teamsId['visitorTeam']   = $game->getVisitorTeam()->getId();
            
            $playersId = array_keys($data[$this->gameId]);
            
            $homeTeamIndex = 0;
            $visitorTeamIndex = 0;
            
            $sumHomeStats = null;
            $sumVisitorStats = null;
                
            foreach($playersId as $playerId)
            {
                $player = null;
                $player = new Player($playerId);
                
                $playerTeamId = $player->getTeamId();
                if($playerTeamId == $this->teamsId['homeTeam'])
                {
                    $this->teamsStats['homeTeam'][$homeTeamIndex] = new StatPlayer($playerId, null, $data[$this->gameId][$playerId], null);
                    $homeTeamIndex++;
                    
                    foreach($data[$this->gameId][$playerId] as $stat => $playerStat)
                    {
                        if(!isset($sumHomeStats[$stat]))
                        {
                            $sumHomeStats[$stat] = 0;
                        }
                        $sumHomeStats[$stat] = $sumHomeStats[$stat] + $playerStat;
                    }
                }
                else if($playerTeamId == $this->teamsId['visitorTeam'])
                {
                    $this->teamsStats['visitorTeam'][$visitorTeamIndex] = new StatPlayer($playerId, null, $data[$this->gameId][$playerId], null);
                    $visitorTeamIndex++;
                    
                    foreach($data[$this->gameId][$playerId] as $stat => $playerStat)
                    {
                        if(!isset($sumVisitorStats[$stat]))
                        {
                            $sumVisitorStats[$stat] = 0;
                        }
                        $sumVisitorStats[$stat] = $sumVisitorStats[$stat] + $playerStat;
                    }
                }
            }
            $this->teamsStats['homeTeam']['Total']    = new StatPlayer('Total', null, $sumHomeStats, null);
            $this->teamsStats['visitorTeam']['Total'] = new StatPlayer('Total', null, $sumVisitorStats, null);
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/

	public function getGameId()
	{
		return $this->gameId;
	}

	public function getTeamsId()
	{
		return $this->teamsId;
	}
	
	public function getHomeTeamId()
	{
		return $this->teamsId['homeTeam'];
	}
	
	public function getVisitorTeamId()
	{
		return $this->teamsId['visitorTeam'];
	}
    
	public function getTeamsStats()
	{
		return $this->teamsStats;
	}
	
	public function getHomeTeamStats()
	{
		return $this->teamsStats['homeTeam'];
	}
	
	public function getVisitorTeamStats()
	{
		return $this->teamsStats['visitorTeam'];
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
    
    public function setGameId($newGameId)
	{
		$this->gameId = $newGameId;
	}
	
	public function setHomeTeamId($newHomeTeamId)
	{
		$this->teamsId['homeTeam'] = $newHomeTeamId;
	}
	
	public function setVisitorTeamId($newVisitorTeamId)
	{
		$this->teamsId['visitorTeam'] = $newVisitorTeamId;
	}
	
	public function setHomeTeamStats($newHomeTeamStats)
	{
		$this->teamsStats['homeTeam'] = $newHomeTeamStats;
	}
	
	public function setVisitorTeamStats($newVisitorTeamStats)
	{
		$this->teamsStats['visitorTeam'] = $newVisitorTeamStats;
	}
    
    
	/********************/
	/*    Functions     */
	/********************/
}