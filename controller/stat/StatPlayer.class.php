<?php
include_once('model/stat/read.php');
include_once('model/stat/write.php');

class StatPlayer
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $playerId;
	private $season;
	
	private $id;
	private $team;
    private $games;
	private $minutes;
	private $points;
    private $freeThrowsMade;
    private $freeThrowsAttempt;
	private $twoPointsMade;
    private $twoPointsAttempt;
	private $threePointsMade;
    private $threePointsAttempt;
	private $fieldGoalMade;
    private $fieldGoalAttempt;
	private $offensiveRebounds;
    private $defensiveRebounds;
	private $rebounds;
	private $assists;
	private $turnovers;
	private $steals;
	private $blocks;
	private $evaluation;
	
	
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($playerId, $seasonAndTeam, $dataSubmit, $dataRecap)
    {
		if (($playerId and $seasonAndTeam) or ($playerId and ($dataSubmit or $dataRecap))) 
        {
            if ($playerId and $dataSubmit)
            {
                if ( isset($dataSubmit) )
                {
                    $this->playerId           = (int) $playerId;
                    $this->season             = 0;
                    
                    $this->id                 = 0;
					$this->teamId          	  = 0;
                    $this->games              = (int)($dataSubmit['minutes']>0);
                    $this->minutes            = (int)$dataSubmit['minutes'];
                    $this->points             = (int)$dataSubmit['ftm'] + 2 * $dataSubmit['fgm'] + 3 * $dataSubmit['3fgm'];
                    $this->freeThrowsMade     = (int)$dataSubmit['ftm'];
                    $this->freeThrowsAttempt  = (int)$dataSubmit['fta'];
                    $this->twoPointsMade      = (int)$dataSubmit['fgm'];
                    $this->twoPointsAttempt   = (int)$dataSubmit['fga'];
                    $this->threePointsMade    = (int)$dataSubmit['3fgm'];
                    $this->threePointsAttempt = (int)$dataSubmit['3fga'];
					$this->fieldGoalMade   	  = (int)$dataSubmit['fgm'] + (int)$dataSubmit['3fgm'];
                    $this->fieldGoalAttempt   = (int)$dataSubmit['fga'] + (int)$dataSubmit['3fga'];
                    $this->offensiveRebounds  = (int)$dataSubmit['offensive_boards'];
                    $this->defensiveRebounds  = (int)$dataSubmit['defensive_boards'];
                    $this->rebounds           = (int)$dataSubmit['offensive_boards'] + $dataSubmit['defensive_boards'];
                    $this->assists            = (int)$dataSubmit['assists'];
                    $this->turnovers          = (int)$dataSubmit['turnovers'];
                    $this->steals             = (int)$dataSubmit['steals'];
                    $this->blocks             = (int)$dataSubmit['blocks'];
                    $this->evaluation         = (int)$this->points + $this->rebounds + $this->assists + $this->steals + $this->blocks - $this->turnovers - ($this->freeThrowsAttempt - $this->freeThrowsMade) - ($this->twoPointsAttempt - $this->twoPointsMade) - ($this->threePointsAttempt - $this->threePointsMade);
                }
            }
			elseif ($playerId and $dataRecap)
            {
                if ( isset($dataRecap) )
                {
                    $this->playerId           = (int)$playerId;
                    $this->season             = (int)$dataRecap['season'];
                    
                    $this->id              	  = (int)$dataRecap['statsId'];
					$this->team          	  = 0;
					if(isset($dataRecap['games']))
					{
						$this->games 		  = (int)$dataRecap['games'];
					}
					else
					{
						$this->games    	  = (int)($dataRecap['minutes']>0);
					}
                    $this->minutes            = (int)$dataRecap['minutes'];
                    $this->points             = (int)$dataRecap['points'];
                    $this->freeThrowsMade     = (int)$dataRecap['freeThrowsMade'];
                    $this->freeThrowsAttempt  = (int)$dataRecap['freeThrowsAttempt'];
                    $this->twoPointsMade      = (int)$dataRecap['twoPointsMade'];
                    $this->twoPointsAttempt   = (int)$dataRecap['twoPointsAttempt'];
                    $this->threePointsMade    = (int)$dataRecap['threePointsMade'];
                    $this->threePointsAttempt = (int)$dataRecap['threePointsAttempt'];
					$this->fieldGoalMade   	  = (int)$dataRecap['twoPointsMade'] + (int)$dataRecap['threePointsMade'];
                    $this->fieldGoalAttempt   = (int)$dataRecap['twoPointsAttempt'] + (int)$dataRecap['threePointsAttempt'];
                    $this->offensiveRebounds  = (int)$dataRecap['offensiveRebounds'];
                    $this->defensiveRebounds  = (int)$dataRecap['defensiveRebounds'];
                    $this->rebounds           = (int)$dataRecap['rebounds'];
                    $this->assists            = (int)$dataRecap['assists'];
                    $this->turnovers          = (int)$dataRecap['turnovers'];
                    $this->steals             = (int)$dataRecap['steals'];
                    $this->blocks             = (int)$dataRecap['blocks'];
                    $this->evaluation         = (int)$dataRecap['evaluation'];
                }
            }
            else if ($playerId and $seasonAndTeam)
            {
				$season = $seasonAndTeam['season'];
				$teamId = $seasonAndTeam['teamId'];
                $stats = getStatPlayerByIdAndSeasonAndTeamId($playerId, $season, $teamId);
                if ( isset($stats['statsId']) )
                {
                    $this->playerId           = $stats['playerId'];
					$this->team          	  = new Team($stats['teamId']);
                    $this->season             = $stats['season'];
                    
                    $this->id                 = $stats['statsId'];
                    $this->games              = $stats['games'];
                    $this->minutes            = $stats['minutes'];
                    $this->points             = $stats['points'];
                    $this->freeThrowsMade     = $stats['freeThrowsMade'];
                    $this->freeThrowsAttempt  = $stats['freeThrowsAttempt'];
                    $this->twoPointsMade      = $stats['twoPointsMade'];
                    $this->twoPointsAttempt   = $stats['twoPointsAttempt'];
                    $this->threePointsMade    = $stats['threePointsMade'];
                    $this->threePointsAttempt = $stats['threePointsAttempt'];
					$this->fieldGoalMade   	  = $stats['twoPointsMade'] + $stats['threePointsMade'];
                    $this->fieldGoalAttempt   = $stats['twoPointsAttempt'] + $stats['threePointsAttempt'];
                    $this->offensiveRebounds  = $stats['offensiveRebounds'];
                    $this->defensiveRebounds  = $stats['defensiveRebounds'];
                    $this->rebounds           = $stats['rebounds'];
                    $this->assists            = $stats['assists'];
                    $this->turnovers          = $stats['turnovers'];
                    $this->steals             = $stats['steals'];
                    $this->blocks             = $stats['blocks'];
                    $this->evaluation         = $stats['evaluation'];
                }
                else
                {
                    $this->playerId           = $playerId;
					$this->team          	  = 0;
                    $this->season             = $season;
                    
                    $this->id                 = 0;
                    $this->games              = 0;
                    $this->minutes            = 0;
                    $this->points             = 0;
                    $this->freeThrowsMade     = 0;
                    $this->freeThrowsAttempt  = 0;
                    $this->twoPointsMade      = 0;
                    $this->twoPointsAttempt   = 0;
                    $this->threePointsMade    = 0;
                    $this->threePointsAttempt = 0;
					$this->fieldGoalMade   	  = 0;
                    $this->fieldGoalAttempt   = 0;
                    $this->offensiveRebounds  = 0;
                    $this->defensiveRebounds  = 0;
                    $this->rebounds           = 0;
                    $this->assists            = 0;
                    $this->turnovers          = 0;
                    $this->steals             = 0;
                    $this->blocks             = 0;
                    $this->evaluation         = 0;
                }
            }
		}
    }
	
	
	/********************/
	/*     Getters      */
	/********************/

	public function getId()
	{
		return $this->id;
	}
	
	public function getPlayerId()
	{
		return $this->playerId;
	}
	
	public function getTeam()
	{
		return $this->team;
	}
	
	public function getSeason()
	{
		return $this->season;
	}
	
	public function getGames()
	{
		return $this->games;
	}
	
	public function getMinutes()
	{
		return $this->minutes;
	}
	
	public function getPoints()
	{
		return $this->points;
	}
	
	public function getFreeThrowsMade()
	{
		return $this->freeThrowsMade;
	}
	
	public function getFreeThrowsAttempt()
	{
		return $this->freeThrowsAttempt;
	}
	
	public function getTwoPointsMade()
	{
		return $this->twoPointsMade;
	}
	
	public function getTwoPointsAttempt()
	{
		return $this->twoPointsAttempt;
	}
	
	public function getThreePointsMade()
	{
		return $this->threePointsMade;
	}
	
	public function getThreePointsAttempt()
	{
		return $this->threePointsAttempt;
	}
	
	public function getFieldGoalMade()
	{
		return $this->fieldGoalMade;
	}
	
	public function getFieldGoalAttempt()
	{
		return $this->fieldGoalAttempt;
	}
	
	public function getOffensiveRebounds()
	{
		return $this->offensiveRebounds;
	}
	
	public function getDefensiveRebounds()
	{
		return $this->defensiveRebounds;
	}
	
	public function getRebounds()
	{
		return $this->rebounds;
	}
	
	public function getAssists()
	{
		return $this->assists;
	}
	
	public function getTurnovers()
	{
		return $this->turnovers;
	}
	
	public function getSteals()
	{
		return $this->steals;
	}
	
	public function getBlocks()
	{
		return $this->blocks;
	}
	
	public function getEvaluation()
	{
		return $this->evaluation;
	}
	
    public function getCategoryStats($statCategory)
    {
        if($statCategory == 'games')
        {
            $stats = $this->getGames();
        }
        elseif($statCategory == 'minutes')
        {	
            $stats = $this->getMinutes();
        }
        elseif($statCategory == 'points')
        {        
            $stats = $this->getPoints();
        }
        elseif($statCategory == 'FTPercentage')
        {        
            $stats = $this->getFreeThrowsPercentage();
        }
        elseif($statCategory == 'FGPercentage')
        {        
            $stats = $this->getFieldGoalPercentage();
        }
        elseif($statCategory == '3FGPercentage')
        {        
            $stats = $this->getThreePointsPercentage();
        }
        elseif($statCategory == 'offRebounds')
        {       
            $stats = $this->getOffensiveRebounds();
        }
        elseif($statCategory == 'defRebounds')
        {        
            $stats = $this->getDefensiveRebounds();
        }
        elseif($statCategory == 'rebounds')
        {        
            $stats = $this->getRebounds();
        }
        elseif($statCategory == 'assists')
        {        
            $stats = $this->getAssists();
        }
        elseif($statCategory == 'turnovers')
        {        
            $stats = $this->getTurnovers();
        }
        elseif($statCategory == 'steals')
        {        
            $stats = $this->getSteals();
        }
        elseif($statCategory == 'blocks')
        {        
            $stats = $this->getBlocks();
        }
        elseif($statCategory == 'efficiency')
        {        
            $stats = $this->getEvaluation();
        }
        return $stats;
    }
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setSeason($newSeason)
	{
		$this->season = $newSeason;
	}
	
	public function setGames($newGames)
	{
		$this->games = $newGames;
	}
	
	public function setMinutes($newMinutes)
	{
		$this->minutes = $newMinutes;
	}
	
	public function setPoints($newPoints)
	{
		$this->points = $newPoints;
	}
	
	public function setFreeThrowsMade($newFreeThrowsMade)
	{
		$this->freeThrowsMade = $newFreeThrowsMade;
	}
	
	public function setFreeThrowsAttempt($newFreeThrowsAttempt)
	{
		$this->freeThrowsAttempt = $newFreeThrowsAttempt;
	}
	
	public function setTwoPointsMade($newTwoPointsMade)
	{
		$this->twoPointsMade = $newTwoPointsMade;
	}
	
	public function setTwoPointsAttempt($newTwoPointsAttempt)
	{
		$this->twoPointsAttempt = $newTwoPointsAttempt;
	}
	
	public function setThreePointsMade($newThreePointsMade)
	{
		$this->threePointsMade = $newThreePointsMade;
	}
	
	public function setThreePointsAttempt($newThreePointsAttempt)
	{
		$this->threePointsAttempt = $newThreePointsAttempt;
	}
	
	public function setFieldGoalMade($newFieldGoalMade)
	{
		$this->fieldGoalMade = $newFieldGoalMade;
	}
	
	public function setFieldGoalAttempt($newFieldGoalAttempt)
	{
		$this->fieldGoalAttempt = $newFieldGoalAttempt;
	}
	
	public function setOffensiveRebounds($newOffensiveRebounds)
	{
		$this->offensiveRebounds = $newOffensiveRebounds;
	}
	
	public function setDefensiveRebounds($newDefensiveRebounds)
	{
		$this->defensiveRebounds = $newDefensiveRebounds;
	}
	
	public function setRebounds($newRebounds)
	{
		$this->rebounds = $newRebounds;
	}
	
	public function setAssists($newAssists)
	{
		$this->assists = $newAssists;
	}
	
	public function setTurnovers($newTurnovers)
	{
		$this->turnovers = $newTurnovers;
	}
	
	public function setSteals($newSteals)
	{
		$this->steals = $newSteals;
	}
	
	public function setBlocks($newBlocks)
	{
		$this->blocks = $newBlocks;
	}
	
	public function setEvaluation($newEvaluation)
	{
		$this->evaluation = $newEvaluation;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
    
    public function getFreeThrowsPercentage()
	{
        if($this->freeThrowsAttempt>0)
        {
            $percentage = 100*$this->freeThrowsMade/$this->freeThrowsAttempt;
            $percentage = round($percentage, 1);
        }
        else
        {
            $percentage = 0;
        }
		return $percentage;
	}
    
    public function getTwoPointsPercentage()
	{
        if($this->twoPointsAttempt>0)
        {
            $percentage = 100*$this->twoPointsMade/$this->twoPointsAttempt;
        }
        else
        {
            $percentage = 0;
        }
		return $percentage; 
	}
    
    public function getThreePointsPercentage()
	{
        if($this->threePointsAttempt>0)
        {
            $percentage = 100*$this->threePointsMade/$this->threePointsAttempt;
        }
        else
        {
            $percentage = 0;
        }
		return $percentage;
	}
	
	public function getFieldGoalPercentage()
	{
        if($this->fieldGoalAttempt>0)
        {
            $percentage = 100*$this->fieldGoalMade/$this->fieldGoalAttempt;
        }
        else
        {
            $percentage = 0;
        }
		return $percentage;
	}
}