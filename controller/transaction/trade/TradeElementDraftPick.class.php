<?php
// include_once('model/transaction/trade/tradeElementDraftPick/read.php');
// include_once('model/transaction/trade/tradeElementDraftPick/write.php');

class TradeElementDraftPick extends TradeElement
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $draftPick;	
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($draftPickId, $data) {
		if ($data != null)
        {
            $a = strpos($draftPickId, '-', 0);
            $b = strpos($draftPickId, '-', $a+1);
            $pickOriginalOwnerTeam = new Team(intval(substr($draftPickId,0,$a)));
            $pickYear              = intval(substr($draftPickId,$a+1,$b-$a-1));
            $pickRound             = intval(substr($draftPickId,$b+1,1));
            
            $this->draftPick = getDraftPickFromPickData($pickOriginalOwnerTeam->getId(), $pickYear, $pickRound);
		}
        else
        {
            $this->draftPick  = 0;
        }
        parent::__construct($draftPickId, $data, 'pick');
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getDraftPick()
	{
		return $this->draftPick;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
    	
    public function setDraftPick($newDraftPick)
	{
		$this->draftPick = $newDraftPick;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}