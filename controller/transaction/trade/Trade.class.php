<?php
// include_once('model/transaction/trade/read.php');
// include_once('model/transaction/trade/write.php');

class Trade extends Transaction
{
	/********************/
	/*    Attributes    */
	/********************/
	
    private $tradeId;
    private $listTradeElements;	
	
    
	/********************/
	/*    Constructs    */
	/********************/
	
	function __construct($id,$data) {
		if ($id != null)
        {
			$this->tradeId           = $id;
			$this->listTradeElements = 0;
		}
        else
        {
            parent::__construct(null);
            
			$this->tradeId             = 0;
            if(isset($data['areTradedPlayers']))
            {
                foreach($data['areTradedPlayers'] as $tradedPlayerId => $enableTrade)
                {
                    if($enableTrade[0] == 'true')
                    {
                        $this->listTradeElements[] = new TradeElementPlayer($tradedPlayerId, $data);
                    }
                }
            }
            if(isset($data['areTradedPicks']))
            {
                foreach($data['areTradedPicks'] as $tradedPickId => $enableTrade)
                {
                    if($enableTrade[0] == 'true')
                    {
                        $this->listTradeElements[] = new TradeElementDraftPick($tradedPickId, $data);
                    }
                }
            }
        }
    }
	
	
	/********************/
	/*     Getters      */
	/********************/
	
	public function getId()
	{
		return $this->tradeId;
	}
	
	public function getListTradeElements()
	{
		return $this->listTradeElements;
	}
	
	
	/********************/
	/*     Setters      */
	/********************/
	
	public function setListTradeElements($newListTradeElements)
	{
		$this->listTradeElements = $newListTradeElements;
	}
	
    
	/********************/
	/*    Functions     */
	/********************/
    public function getTradeValidityData()
	{
        $validityData=null;
		foreach($this->listTradeElements as $tradeElement)
        {
            if($tradeElement->getContent() == 'player')
            {
                if(!isset($validityData[$tradeElement->getReceiver()->getId()]))
                {
                    $validityData[$tradeElement->getReceiver()->getId()]['nbPlayer'] = 1;
                    $validityData[$tradeElement->getReceiver()->getId()]['totalSalary'] = $tradeElement->getPlayer()->getSalary();
                }
                else
                {
                    $validityData[$tradeElement->getReceiver()->getId()]['nbPlayer']++;
                    $validityData[$tradeElement->getReceiver()->getId()]['totalSalary'] += $tradeElement->getPlayer()->getSalary();
                }
                
                if(!isset($validityData[$tradeElement->getGiver()->getId()]))
                {
                    $validityData[$tradeElement->getGiver()->getId()]['nbPlayer'] = -1;
                    $validityData[$tradeElement->getGiver()->getId()]['totalSalary'] = -$tradeElement->getPlayer()->getSalary();
                }
                else
                {
                    $validityData[$tradeElement->getGiver()->getId()]['nbPlayer']--;
                    $validityData[$tradeElement->getGiver()->getId()]['totalSalary'] -= $tradeElement->getPlayer()->getSalary();
                }
            }
        }
        return $validityData;
	}
    
    public function checkTradeValidity()
	{
        $validity = null;
        
        $validityData = $this->getTradeValidityData();
        foreach($validityData as $teamId => $teamValidityData)
        {
            $team = new Team($teamId);
            $validity[$teamId][0] = 1;
            if($team->getSalarialMarginTeam() < $teamValidityData['totalSalary'] and $teamValidityData['totalSalary'] > 2)
            {
                $validity[$teamId][0] = 0; 
            }
            
            $validity[$teamId][1] = 1;
            $currentSeason = getCurrentSeason();
            $season = new Season($currentSeason);
            $newNbOfPlayer = $team->getNumberOfPlayersInTeam() + $teamValidityData['nbPlayer'];
            if($newNbOfPlayer > $season->getMaxPlayersInTeam())
            {
                $validity[$teamId][1] = 0; 
            }
        }
        return $validity;
	}
}