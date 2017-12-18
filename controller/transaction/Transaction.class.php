<?php
// include_once('model/transaction/read.php');
include_once('model/transaction/write.php');

class Transaction
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $id;
    private $transactionDate;	
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id) {
		if ($id != null)
        {
			$this->id               = $id;
			$this->transactionDate  = 0;
		}
        else
        {
			$this->id               = 0;
			$this->transactionDate  = getCurrentDate();
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getTransactionDate()
	{
		return $this->transactionDate;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setTransactionDate($newTransactionDate)
	{
		$this->transactionDate = $newTransactionDate;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}