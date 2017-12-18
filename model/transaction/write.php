<?php

/**
  * Update a player after signature
  */
function updatePlayerSignature($signature)
{
	global $db;
	$request;
    
    $request = $db->prepare('
        UPDATE player
        SET
            teamId         = :teamId ,
            salary         = :salary ,
            guarantedYear  = :guarantedYear ,
            optionalYear   = :optionalYear ,
            contractType   = :contractType
        WHERE personId = :personId
    ');
    $request->bindValue(':teamId',        $signature->getTeam()->getId(),   PDO::PARAM_INT);
    $request->bindValue(':salary',        $signature->getSalary(),          PDO::PARAM_INT);
    $request->bindValue(':guarantedYear', $signature->getGuarantedYear(),   PDO::PARAM_INT);
    $request->bindValue(':optionalYear',  $signature->getOptionalYear(),    PDO::PARAM_INT);
    $request->bindValue(':contractType',  $signature->getContractType(),    PDO::PARAM_INT);
    $request->bindValue(':personId',      $signature->getPerson()->getId(), PDO::PARAM_INT);

    $request->execute();
    $request->closeCursor();
    
    updateTransaction($signature,'signature');
    return 1;
}

/**
  * Update elements after a trade
  */
function updateElementsTrade($trade)
{
    foreach($trade->getListTradeElements() as $element)
    {
        global $db;
        $request;
        if($element->getContent() == 'player')
        {
            $request = $db->prepare('
            UPDATE player
            SET
                teamId         = :teamId
            WHERE playerId = :playerId
            ');
            $request->bindValue(':teamId',        $element->getReceiver()->getId(), PDO::PARAM_INT);
            $request->bindValue(':playerId',      $element->getPlayer()->getId(),   PDO::PARAM_INT);    
        }
        
        if($element->getContent() == 'pick')
        {
            $originalOwnerTeamId = intval($element->getDraftPick()->getOriginalOwnerTeam()->getId());
            $year = intval($element->getDraftPick()->getYear());
            $round = intval($element->getDraftPick()->getDraftRound());
            
            $id = checkDraftPickExistence($originalOwnerTeamId, $year, $round);

            if(empty($id))
            {
                $request = $db->prepare('
                    INSERT INTO draftpick (
                        year,
                        round,
                        originalOwnerTeamId,
                        currentOwnerTeamId
                    )
                    VALUES (
                        :year,
                        :round,
                        :originalOwnerTeamId,
                        :currentOwnerTeamId
                    )
                ');
                $request->bindValue(':year',                $year,                              PDO::PARAM_INT);
                $request->bindValue(':round',               $round,                             PDO::PARAM_INT);
                $request->bindValue(':originalOwnerTeamId', $originalOwnerTeamId,               PDO::PARAM_INT);
                $request->bindValue(':currentOwnerTeamId',  $element->getReceiver()->getId(),   PDO::PARAM_INT);
            }
            else
            {
                $id = intval($id);
                $request = $db->prepare('
                UPDATE draftpick
                SET
                    currentOwnerTeamId         = :currentOwnerTeamId
                WHERE 
                    draftPickId = :draftPickId
                ');
                $request->bindValue(':currentOwnerTeamId',  $element->getReceiver()->getId(),   PDO::PARAM_INT);
                $request->bindValue(':draftPickId',         $id,                                PDO::PARAM_INT);
            }    
        }

        $request->execute();
        $request->closeCursor();
    }
    updateTransaction($trade,'trade');
    return 1;
}

/**
  * Adds a new transaction
  */
function updateTransaction($data, $type)
{
    global $db;
	$request;
    
    $request = $db->prepare('INSERT INTO transaction (date) VALUES (:date)');
    $request->bindValue(':date', $data->getTransactionDate(), PDO::PARAM_INT);
    
    $request->execute();
    $transactionId = $db->lastInsertId();
    $request->closeCursor();
    
    if($type == 'signature')
    {
        updateSignature($transactionId, $data);         
    }
    elseif($type == 'trade')
    {
        updateTrade($transactionId, $data);         
    }
    
    return 1;
}

/**
  * Adds a new player signature
  */
function updateSignature($transactionId, $data)
{
    global $db;
	$request;
    
    $request = $db->prepare('
        INSERT INTO signature (
            transactionId,
            teamId,
            personId,
            salary,
            guarantedYear,
            optionalYear,
            contractType
        )
        VALUES (
            :transactionId,
            :teamId,
            :personId,
            :salary,
            :guarantedYear,
            :optionalYear,
            :contractType
        )
    ');
    $request->bindValue(':transactionId', $transactionId,              PDO::PARAM_INT);
    $request->bindValue(':teamId',        $data->getTeam()->getId(),   PDO::PARAM_INT);
    $request->bindValue(':personId',      $data->getPerson()->getId(), PDO::PARAM_INT);
    $request->bindValue(':salary',        $data->getSalary(),          PDO::PARAM_INT);
    $request->bindValue(':guarantedYear', $data->getGuarantedYear(),   PDO::PARAM_INT);
    $request->bindValue(':optionalYear',  $data->getOptionalYear(),    PDO::PARAM_INT);
    $request->bindValue(':contractType',  $data->getContractType(),    PDO::PARAM_INT);
    
    $request->execute();
    $request->closeCursor();
    
    return 1;
}

/**
  * Adds a new trade
  */
function updateTrade($transactionId, $data)
{
    foreach($data->getListTradeElements() as $element)
    {
        global $db;
        $request;
        if($element->getContent() == 'player')
        {
            $request = $db->prepare('
                INSERT INTO tradeelement (
                    transactionId,
                    giverTeamId,
                    receiverTeamId,
                    tradeElement,
                    tradeElementType
                )
                VALUES (
                    :transactionId,
                    :giverTeamId,
                    :receiverTeamId,
                    :tradeElement,
                    "player"
                )
            ');
            $request->bindValue(':transactionId',   $transactionId,                     PDO::PARAM_INT);
            $request->bindValue(':giverTeamId',     $element->getGiver()->getId(),      PDO::PARAM_INT);
            $request->bindValue(':receiverTeamId',  $element->getReceiver()->getId(),   PDO::PARAM_INT);
            $request->bindValue(':tradeElement',    $element->getPlayer()->getId(),     PDO::PARAM_INT);
        }
        
        if($element->getContent() == 'pick')
        {
            $originalOwnerTeamId = intval($element->getDraftPick()->getOriginalOwnerTeam()->getId());
            $year = intval($element->getDraftPick()->getYear());
            $round = intval($element->getDraftPick()->getDraftRound());
            
            $id = checkDraftPickExistence($originalOwnerTeamId, $year, $round);
            
            $request = $db->prepare('
                INSERT INTO tradeelement (
                    transactionId,
                    giverTeamId,
                    receiverTeamId,
                    tradeElement,
                    tradeElementType
                )
                VALUES (
                    :transactionId,
                    :giverTeamId,
                    :receiverTeamId,
                    :tradeElement,
                    "pick"
                )
            ');

            $request->bindValue(':transactionId',   $transactionId,                     PDO::PARAM_INT);
            $request->bindValue(':giverTeamId',     $element->getGiver()->getId(),      PDO::PARAM_INT);
            $request->bindValue(':receiverTeamId',  $element->getReceiver()->getId(),   PDO::PARAM_INT);
            $request->bindValue(':tradeElement',    $id,                                PDO::PARAM_INT);
        }
        $request->execute();
        $request->closeCursor();
    }
    
    return 1;
}

/**
  * Sign rookie contract
  */
function updateRookieContract($rookiePlayer)
{
	global $db;
	$request;
    
    $request = $db->prepare('
        SELECT *
        FROM rookieContract
        WHERE pick = :pick
    ');
    $request->bindValue(':pick', $rookiePlayer->getDraftPosition(),   PDO::PARAM_INT);

    $request->execute();
    
    $rookieContract = $request->fetch();
    
    var_dump($rookieContract);
    var_dump($rookieContract['salary']);
    
    $request = $db->prepare('
        UPDATE player
        SET
            salary         = :salary ,
            guarantedYear  = :guarantedYear ,
            optionalYear   = :optionalYear ,
            contractType   = :contractType
        WHERE playerId     = :playerId
    ');
    $request->bindValue(':salary',        $rookieContract['salary'],        PDO::PARAM_STR);
    $request->bindValue(':guarantedYear', $rookieContract['guarantedYear'], PDO::PARAM_INT);
    $request->bindValue(':optionalYear',  $rookieContract['optionalYear'],  PDO::PARAM_INT);
    $request->bindValue(':contractType',  $rookieContract['contractType'],  PDO::PARAM_STR);
    $request->bindValue(':playerId',      $rookiePlayer->getId(),           PDO::PARAM_INT);

    $request->execute();
    $request->closeCursor();
    
    return 1;
}