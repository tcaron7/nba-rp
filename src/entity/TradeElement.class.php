<?php
// include_once('model/transaction/trade/tradeElement/read.php');
// include_once('model/transaction/trade/tradeElement/write.php');

class TradeElement
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $giver;
    private $receiver;
    private $content;	
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id, $data, $content) {
        if ($id != null and $data != null and $content != null)
        {
            if($content == 'player')
            { 
                $player = new Player($id);
                $this->giver    = $player->getTeam();
                $this->receiver = new Team($data['tradedPlayers'][$id][0]);    
            }
            elseif($content == 'pick')
            {
                $a = strpos($id, '-', 0);
                $b = strpos($id, '-', $a+1);
                $pickOriginalOwnerTeam = new Team(intval(substr($id,0,$a)));
                $pickYear              = intval(substr($id,$a+1,$b-$a-1));
                $pickRound             = intval(substr($id,$b+1,1));
                
                $pick = getDraftPickFromPickData($pickOriginalOwnerTeam->getId(), $pickYear, $pickRound);
            
                $this->giver    = $pick->getCurrentOwnerTeam();
                $this->receiver = new Team($data['tradedPicks'][$id][0]);    
            }
            $this->content  = $content;
		}
        else
        {
			$this->giver    = 0;
			$this->receiver = 0;
            $this->content  = 0;
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getGiver()
	{
		return $this->giver;
	}
    
    public function getReceiver()
	{
		return $this->receiver;
	}
	
	public function getContent()
	{
		return $this->content;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setGiver($newGiver)
	{
		$this->giver = $newGiver;
	}
    	
    public function setReceiver($newReceiver)
	{
		$this->receiver = $newReceiver;
	}
    	
    public function setContent($newContent)
	{
		$this->content = $newContent;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}