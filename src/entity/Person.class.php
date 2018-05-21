<?php

class Person
{


	/********************/
	/*    Attributes    */
	/********************/

	private $id;
	private $firstName;
	private $lastName;
	private $middleName;
	private $nickName;
	private $birthdate;
	private $birthplace;
	private $nationality;
	private $formation;
	private $height;
	private $weight;


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

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function getMiddleName()
	{
		return $this->lastName;
	}

	public function getNickName()
	{
		return $this->lastName;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function getBirthplace()
	{
		return $this->birthplace;
	}

	public function getNationality()
	{
		return $this->nationality;
	}

	public function getFormation()
	{
		return $this->formation;
	}

	public function getHeight()
	{
		return $this->height;
	}

	public function getWeight()
	{
		return $this->weight;
	}


	/********************/
	/*     Setters      */
	/********************/

	public function setId( $id )
	{
		$this->id = $id;
	}

	public function setFirstName( $firstName )
	{
		$this->firstName = $firstName;
	}

	public function setLastName( $lastName )
	{
		$this->lastName = $lastName;
	}

	public function setMiddleName( $middleName )
	{
		$this->middleName = $middleName;
	}

	public function setNickName( $nickName )
	{
		$this->nickName = $nickName;
	}

	public function setBirthdate( $birthdate )
	{
		$this->birthdate = $birthdate;
	}

	public function setBirthplace( $birthplace )
	{
		$this->birthplace = $birthplace;
	}

	public function setNationality( $nationality )
	{
		$this->nationality = $nationality;
	}

	public function setFormation( $formation )
	{
		$this->formation = $formation;
	}

	public function setHeight( $height )
	{
		$this->height = $height;
	}
	
	public function setWeight( $weight )
	{
		$this->weight = $weight;
	}


	/********************/
	/*    Functions     */
	/********************/

	/**
	  * Returns the full name a person (first and last name).
	  */
	public function getFullName()
	{
		return $this->getFirstName() . ' ' . $this->getLastName();
	}

	/**
	  * Returns the age of a person on current date or "unknown" if birthdate is not given.
	  */
	public function getAge()
	{
		if ( !$this->getBirthdate() )
		{
			return 'unknown';
		}

		$dateModel   = new DateModel();
		$currentDate = $dateModel->findCurrentDate();

		$birthDate = new Date();
		$birthDate->setFullYear( $this->getBirthdate() );

		$age = $currentDate->getYear() - $birthDate->getYear();

		if ( $currentDate->getMonth() < $birthDate->getMonth() )
		{
			$age--;
		}
		else if ( $currentDate->getMonth() == $birthDate->getMonth() && $currentDate->getDay() < $birthDategetDay() )
		{
			$age--;
		}

		return $age;
	}
}
