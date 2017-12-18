<?php
// include_once('model/transaction/trade/tradeElementPlayer/read.php');
// include_once('model/transaction/trade/tradeElementPlayer/write.php');

class TradeElementPlayer extends TradeElement
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $player;	
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($playerId, $data) {
		if ($playerId != null and $data != null)
        {
            $player = new Player($playerId);
            $this->player  = $player;
		}
        else
        {
            $this->player  = 0;
        }
        parent::__construct($playerId, $data, 'player');
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getPlayer()
	{
		return $this->player;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
    	
    public function setPlayer($newPlayer)
	{
		$this->player = $newPlayer;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
}