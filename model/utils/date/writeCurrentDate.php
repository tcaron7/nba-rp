<?php

/**
  * Modify the current date
  */
function writeCurrentDate($newDate)
{
    global $db;
    $year = $newDate->getYear();
    
    if(strlen($newDate->getMonth()) == 2)
    {
        $month = $newDate->getMonth();  
    }
    else
    {
        $month = '0' . $newDate->getMonth();
    }
    
    if(strlen($newDate->getDay()) == 2)
    {
        $day = $newDate->getDay();  
    }
    else
    {
        $day = '0' . $newDate->getDay();
    }
    
    $newStringDate = $year . '-' . $month . '-' . $day;
    
	$request = $db->prepare('UPDATE nbaCurrentDate SET nbaDate = :nbaDate');
	$request->bindValue(':nbaDate', $newStringDate, PDO::PARAM_STR);
    $request->execute();
    
	$request->closeCursor();
    return 1;
}