<?php
// include_once('model/transaction/signature/read.php');
// include_once('model/transaction/signature/write.php');

class Signature extends Transaction
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $team;
    private $salary;
    private $guarantedYear;
    private $optionalYear;
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id, $data)
    {
		if ($id != null)
        {
			$this->signatureId   = $id;
			$this->team          = 0;
			$this->salary        = 0;
            $this->guarantedYear = 0;
			$this->optionalYear  = 0;
		}
        else
        {
            parent::__construct(null);
            
			$this->team          = new Team($data['teamId']);
			$this->salary        = $data['salary'];
            $this->guarantedYear = $data['guarantedYear'];
			$this->optionalYear  = $data['optionalYear'];
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
    
	public function getTeam()
	{
		return $this->team;
	}
	
	public function getSalary()
	{
		return $this->salary;
	}
	
	public function getGuarantedYear()
	{
		return $this->guarantedYear;
	}
	
	public function getOptionalYear()
	{
		return $this->optionalYear;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setTeam($newTeam)
	{
		$this->team = $newTeam;
	}
		
	public function setSalary($newSalary)
	{
		$this->salary = $newSalary;
	}
		
	public function setGuarantedYear($newGuarantedYear)
	{
		$this->guarantedYear = $newGuarantedYear;
	}
		
	public function setOptionalYear($newOptionalYear)
	{
		$this->OptionalYear = $newOptionalYear;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}