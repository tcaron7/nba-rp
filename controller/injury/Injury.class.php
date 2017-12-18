<?php
include_once('model/injury/read.php');
include_once('model/injury/write.php');

class Injury
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $id;
    private $playerId;
    private $injuryDate;
    private $recoveryDate;
	private $severity;
	
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id,$data) {
		if ($data != null) {
			
			$injuryDate = getCurrentDate();
			preg_match('/^(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})$/', $injuryDate, $tempDate);
			$objectDate = new Date($tempDate['year'], $tempDate['month'], $tempDate['day']);
			
			for($i=0;$i<$data['recovery'];$i++)
			{
				$objectDate->incrementDay();
			}
			
			$recoveryDate = $objectDate->getStringDate();
			
			$this->id			= 0;
			$this->playerId		= intval($data['playerId']);
			$this->injuryDate  	= $injuryDate;
			$this->recoveryDate	= $recoveryDate;
			$this->severity		= $data['severity'];
		}
        else
        {
			$injury = getInjuryById($id);
			
			$this->id			= $id;
			$this->playerId		= $injury['playerId'];
			$this->injuryDate  	= $injury['injuryDate'];
			$this->recoveryDate	= $injury['recoveryDate'];
			$this->severity		= $injury['injurySeverity'];
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
	
	public function getInjuryDate()
	{
		return $this->injuryDate;
	}
	
	public function getRecoveryDate()
	{
		return $this->recoveryDate;
	}
	
	public function getSeverity()
	{
		return $this->severity;
	}	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setId($newId)
	{
		$this->id = $newId;
	}

	public function setPlayerId($newPlayerId)
	{
		$this->playerId = $newPlayerId;
	}
	
	public function setInjuryDate($newInjuryDate)
	{
		$this->injuryDate = $newInjuryDate;
	}
	
	public function setRecoveryDate($newRecoveryDate)
	{
		$this->recoveryDate = $newRecoveryDate;
	}
	
	public function setSeverity($newSeverity)
	{
		$this->severity = $newSeverity;
	}
	
	/********************/
	/*    Functions     */
	/********************/
}