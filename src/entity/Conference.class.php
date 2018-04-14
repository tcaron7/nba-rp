<?php

class Conference
{


	/********************/
	/*    Attributes    */
	/********************/

	private $id;
	private $name;


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


	/********************/
	/*    Functions     */
	/********************/

	/**
	  * Returns all divisions of a conference
	  */
	public function getDivisions()
	{
		$divisionModel = new DivisionModel();
		return $divisionModel->findByConference( $this->getId() );
	}

	/**
	  * Returns all teams of a conference
	  */
	public function getTeams()
	{
		$divisionModel = new TeamModel();
		return $divisionModel->findByConference( $this->getId() );
	}

}
