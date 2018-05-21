<?php

class Game
{


	/********************/
	/*    Attributes    */
	/********************/

	private $id;
	private $date;
	private $seasonId;
	private $homeTeamId;
	private $visitorTeamId;
	private $homeTeamScore;
	private $visitorTeamScore;
	private $overtime;
	private $comment;


	/********************/
	/*    Constructs    */
	/********************/

	function __construct() { }


	/********************/
	/*     Getters      */
	/********************/

	public function getId()
	{
		return $this->id;
	}

	public function getDate()
	{
		return $this->gameDate;
	}

	public function getSeasonId()
	{
		return $this->seasonId;
	}

	public function getHomeTeamId()
	{
		return $this->homeTeamId;
	}

	public function getVisitorTeamId()
	{
		return $this->visitorTeamId;
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

	public function getComment()
	{
		return $this->comment;
	}


	/********************/
	/*     Setters      */
	/********************/

	public function setId( int $id )
	{
		$this->id = $id;
	}

	public function setDate( string $date )
	{
		$this->date = $date;
	}

	public function setSeasonId( int $seasonId )
	{
		$this->seasonId = $seasonId;
	}

	public function setHomeTeamId( int $homeTeamId )
	{
		$this->homeTeamId = $homeTeamId;
	}

	public function setVisitorTeamId( int $visitorTeamId )
	{
		$this->visitorTeamId = $visitorTeamId;
	}

	public function setHomeTeamScore( int $homeTeamScore = null )
	{
		$this->homeTeamScore = $homeTeamScore;
	}

	public function setVisitorTeamScore( int $visitorTeamScore = null )
	{
		$this->visitorTeamScore = $visitorTeamScore;
	}

	public function setOvertime( int $overtime = null )
	{
		$this->overtime = $overtime;
	}

	public function setComment( string $comment = null )
	{
		$this->comment = $comment;
	}


	/********************/
	/*    Functions     */
	/********************/

	public function getSeason()
	{
		$seasonModel = new SeasonModel();
		return $seasonModel->findById( $this->getSeasonId() );
	}

	public function setSeason( Season $season )
	{
		$this->setSeasonId( $season->getYear() );
	}

	public function getHomeTeam()
	{
		$teamModel = new TeamModel();
		return $teamModel->findById( $this->getHomeTeamId() );
	}

	public function setHomeTeam( Team $homeTeam )
	{
		$this->setHomeTeamId( $homeTeam->getId() );
	}

	public function getVisitorTeam()
	{
		$teamModel = new TeamModel();
		return $teamModel->findById( $this->getVisitorTeamId() );
	}

	public function setVisitorTeam( Team $visitorTeam )
	{
		$this->setVisitorTeamId( $visitorTeam->getId() );

	}

	public function isFinished()
	{
		if ( $this->getHomeTeamScore() and $this->getVisitorTeamScore() )
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function getWinnerTeamId()
	{
		if ( !$this->isFinished() )
		{
			return null;
		}

		if ( $this->getHomeTeamScore() > $this->getVisitorTeamScore() )
		{
			return $this->getHomeTeamId();
		}

		return $this->getVisitorTeamId();
	}

	public function getLoserTeamId()
	{
		if ( !$this->isFinished() )
		{
			return null;
		}

		if ( $this->getHomeTeamScore() < $this->getVisitorTeamScore() )
		{
			return $this->getHomeTeamId();
		}

		return $this->getVisitorTeamId();
	}

	public function getWinnerTeam()
	{
		if ( !$this->isFinished() )
		{
			return null;
		}

		if ( $this->getHomeTeamScore() > $this->getVisitorTeamScore() )
		{
			return $this->getHomeTeam();
		}

		return $this->getVisitorTeam();
	}

	public function getLoserTeam()
	{
		if ( !$this->isFinished() )
		{
			return null;
		}

		if ( $this->getHomeTeamScore() < $this->getVisitorTeamScore() )
		{
			return $this->getHomeTeam();
		}

		return $this->getVisitorTeam();
	}

}
