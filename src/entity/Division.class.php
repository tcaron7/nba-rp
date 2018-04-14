<?php

class Division
{


	/********************/
	/*    Attributes    */
	/********************/

	private $id;
	private $name;
	private $conferenceId;


	/********************/
	/*    Constructs    */
	/********************/

	function __construct( array $data = null )
	{
		if ( !is_null( $data ) )
		{
			$this->constructWithData( $data );
		}
		else
		{
			$this->constructWithNone();
		}
	}

	function constructWithNone() { }

	function constructWithData( $data )
	{
		if ( $data['id'] )
		{
			$this->setId( $data['id'] );
		}

		if ( $data['name'] )
		{
			$this->setName( $data['name'] );
		}

		if ( $data['conferenceId'] )
		{
			$this->setConferenceId( $data['conferenceId'] );
		}
	}


	/********************/
	/*     Getters      */
	/********************/

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getConferenceId()
	{
		return $this->conferenceId;
	}


	/********************/
	/*     Setters      */
	/********************/

	public function setId( int $id = null )
	{
		$this->id = $id;
	}

	public function setName( string $name = null )
	{
		$this->name = $name;
	}

	public function setConferenceId( int $conferenceId = null )
	{
		$this->conferenceId = $conferenceId;
	}


	/********************/
	/*    Functions     */
	/********************/

	/**
	  * Return the conference object parent of a division
	  */
	public function getConference()
	{
		$conferenceModel = new ConferenceModel();
		return $conferenceModel->findById( $this->getConferenceId() );
	}

	/**
	  * Sets the conference object parent of a division
	  */
	public function setConference( Conference $conference = null )
	{
		$this->setConferenceId( $conference->getId() );
	}

	/**
	  * Returns all teams of a division
	  */
	public function getTeams()
	{
		$teamModel = new TeamModel();
		return $teamModel->findByDivision( $this->getId() );
	}

}
