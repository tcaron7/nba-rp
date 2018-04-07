<?php
include_once('model/person/prospect/read.php');
include_once('model/person/prospect/write.php');

class Prospect extends Person
{
	/********************/
	/*    Attributes    */
	/********************/
	
	private $position;
	private $ranking;
	private $predictedDraftYear;
    private $cursusType;
	
    
	/********************/
	/*    Constructs    */
	/********************/
	function __construct($id) {
		if ($id) {
			$prospect = getProspectById($id);
			parent::__construct($prospect['personId']);
			$this->setId($prospect['prospectId']);
			
			$this->position            = $prospect['position'];
			$this->ranking             = $prospect['ranking'];
			$this->predictedDraftYear  = $prospect['predictedDraftYear'];
            $this->cursusType          = $prospect['cursusType'];
		}
    }
	
    
	/********************/
	/*     Getters      */
	/********************/
	
	public function getPosition()
	{
		return $this->position;
	}
	
	public function getRanking()
	{
		return $this->ranking;
	}
	
	public function getPredictedDraftYear()
	{
		return $this->predictedDraftYear;
	}
    
    public function getCursusType()
	{
		return $this->cursusType;
	}
    
    public function getPersonId()
	{
        $prospect = getProspectById($this->getId());
		return $prospect['personId'];
	}
	
    
	/********************/
	/*     Setters      */
	/********************/
	
	public function setPosition($newPosition)
	{
		$this->position = $newPosition;
	}
	
	public function setRanking($newRanking)
	{
		$this->ranking = $newRanking;
	}
	
	public function setPredictedDraftYear($newPredictedDraftYear)
	{
		$this->predictedDraftYear = $newPredictedDraftYear;
	}
    
    public function setCursusType($newCursusType)
	{
		$this->cursusType = $newCursusType;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}