<?php
include_once('model/person/read.php');
include_once('model/person/write.php');

class Person
{
	/********************/
	/*    Attributes    */
	/********************/
	
	private $id;
    private $firstname;
	private $name;
	private $birthdate;
	private $nationality;
	private $formation;
	private $height;
	private $weight;
	
	
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id) {
		if ( $id == 0 ) {	
			$this->id         	= 0;
			$this->firstname	= '';
			$this->name         = '';
			$this->birthdate  	= '01-01-2000';
			$this->nationality	= '';
			$this->formation	= '';
			$this->height		= 0.0;
			$this->weight		= 0;
		}
		else if ( $id ) {
			$person = getPersonById($id);
			
			$this->id          = $person['personId'];
			$this->firstname   = $person['firstname'];
			$this->name        = $person['name'];
			$this->birthdate   = $person['birthdate'];
			$this->nationality = $person['nationality'];
			$this->formation   = $person['formation'];
			$this->height      = $person['height'];
			$this->weight      = $person['weight'];
		}
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getFirstname()
	{
		return $this->firstname;
	}
	
	public function getName()
	{
		return $this->name;
	}
    
    public function getFullName()
	{
        $playerFullName = $this->getFirstname() . ' ' . $this->getName();
		return $playerFullName;
	}
	
	public function getBirthdate()
	{
		return $this->birthdate;
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

	public function setId($newId)
	{
		$this->id = $newId;
	}
	
	public function setFirstname($newFirstname)
	{
		$this->firstname = $newFirstname;
	}
	
	public function setName($newName)
	{
		$this->name = $newName;
	}
	
	public function setBirthdate($newBirthdate)
	{
		$this->birthdate = $newBirthdate;
	}

	public function setNationality($newNationality)
	{
		$this->nationality = $newNationality;
	}
	
	public function setFormation($newFormation)
	{
		$this->formation = $newFormation;
	}

	public function setHeight($newHeight)
	{
		$this->height = $newHeight;
	}
	
	public function setWeight($newWeight)
	{
		$this->weight = $newWeight;
	}
	
	
	/********************/
	/*    Functions     */
	/********************/
	
	/**
	  * Returns the age of a person on current date
	  */
	public function getAge()
	{
		$age;
		$current;
		$birth;
		
		if ( $this->getBirthdate() == '0000-00-00')
		{
			return 'Non communiqué';
		}
		
		preg_match('/^(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})$/', getCurrentDate(), $current);
		preg_match('/^(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})$/', $this->getBirthdate(), $birth);
		
		$age = $current['year'] - $birth['year'];
		
		if ($current['month'] < $birth['month'])
		{
			$age--;
		}
		
		if ( $current['month'] == $birth['month'] && $current['day'] < $birth['day'])
		{
			$age--;
		}
		
		return $age;
	}
	
}
?>
