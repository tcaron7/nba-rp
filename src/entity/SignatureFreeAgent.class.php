<?php
// include_once('model/transaction/signature/freeAgent/read.php');
// include_once('model/transaction/signature/freeAgent/write.php');

class SignatureFreeAgent extends Signature
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $person;
    private $contractType;
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id, $playerId, $data)
    {
        if ($id != null)
        {
            $this->person       = 0;
            $this->contractType = 0;
        }
        else
        {
            parent::__construct(null, $data);
        
            $this->person       = new Person($playerId);
            $this->contractType = $data['contractType'];
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
    
	public function getPerson()
	{
		return $this->person;
	}
	
	public function getContractType()
	{
		return $this->contractType;
	}
	
    
	/********************/
	/*     Setters      */
	/********************/
	
	public function setPerson($newPerson)
	{
		$this->person = $newPerson;
	}
		
	public function setContractType($newContractType)
	{
		$this->contractType = $newContractType;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
    
    public function checkSignatureValidity()
	{
        $validity[0] = 1;
        $validity[1] = 1;
        
        if($this->getTeam()->getSalarialMarginTeam() < $this->getSalary() and $this->getSalary() > 2)
        {
            $validity[0] = 0; 
        }
        
        $currentSeason = getCurrentSeason();
        $season = new Season($currentSeason);
        if($this->getTeam()->getNumberOfPlayersInTeam() >= $season->getMaxPlayersInTeam())
        {
            $validity[1] = 0; 
        }
		return $validity;
	}
}