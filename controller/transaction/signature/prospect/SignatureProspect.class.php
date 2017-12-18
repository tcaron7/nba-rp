<?php
// include_once('model/transaction/signature/prospect/read.php');
// include_once('model/transaction/signature/prospect/write.php');

class SignatureProspect extends Signature
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $prospect;
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct()
    {
        $this->prospect  = 0;
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
    
	public function getProspect()
	{
		return $this->prospect;
	}
	
    
	/********************/
	/*     Setters      */
	/********************/
	
	public function setProspect($newProspect)
	{
		$this->prospect = $newProspect;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}