<?php

/**
  * Returns the raw information of a prospect using the prospectId
  */
function getProspectById($id)
{
    global $db;
	$request;
    $prospect;
	
	$request = $db->prepare('
		SELECT * FROM prospect
		LEFT JOIN person ON prospect.personId = person.personId
		WHERE prospectId = :id
	');
	$request->bindParam(':id', $id, PDO::PARAM_INT);
	$request->execute();
	$prospect = $request->fetch();

	$request->closeCursor();
    return $prospect;
}

/**
  * Returns the array of prospect object for a given class of age
  */
function getProspectsByAgeClass($class)
{
    global $db;
	$request;
    $prospects=null;
	
	$request = $db->prepare("
		SELECT * FROM prospect
		LEFT JOIN person ON prospect.personId = person.personId
		WHERE actualDraftYear = :class
        AND cursusType = 'NCAA'
		ORDER BY ranking");
		
	$request->bindParam(':class', $class, PDO::PARAM_INT);
	$request->execute();
	$getProspects = $request->fetchAll();
	
	$id;
	foreach ($getProspects as $key => $prospect) {
		$id = $prospect['prospectId'];
		$prospects[$id] = new Prospect($id);
	}
	
	$request->closeCursor();
    return $prospects;
}

/**
  * Returns the array of prospect object for international prospects
  */
function getInternationalProspects()
{
    $year = getCurrentYear();
    
    global $db;
	$request;
    $prospects=null;
	
	$request = $db->prepare("
		SELECT * FROM prospect
		LEFT JOIN person ON prospect.personId = person.personId
		WHERE cursusType = 'International'
        AND actualDraftYear != :currentYear
		ORDER BY ranking");
		
    $request->bindValue(':currentYear', $year, PDO::PARAM_INT);
    
	$request->execute();
	$getProspects = $request->fetchAll();
	
	$id;
	foreach ($getProspects as $key => $prospect) {
		$id = $prospect['prospectId'];
		$prospects[$id] = new Prospect($id);
	}
	
	$request->closeCursor();
    return $prospects;
}

/**
  * Returns the array of prospect object from a given class which has not been drafted yet
  */
function getAvailableProspectsByAgeClass($class)
{
    $year = getCurrentYear();
    
    global $db;
	$request;
    $prospects=null;
	
	$request = $db->prepare("
		SELECT * FROM prospect
		LEFT JOIN person    ON prospect.personId   = person.personId
        LEFT JOIN draftpick ON prospect.prospectId = draftpick.playerId
		WHERE draftpick.playerId is NULL
        AND   prospect.actualDraftYear = :year
        AND   prospect.predictedDraftYear = :class
        AND   prospect.cursusType = 'NCAA'
        ORDER BY ranking");
		
    $request->bindParam(':class', $class, PDO::PARAM_INT);
    $request->bindValue(':year',  $year,  PDO::PARAM_INT);
    
	$request->execute();
	$getProspects = $request->fetchAll();
	
	$id;
	foreach ($getProspects as $key => $prospect) {
		$id = $prospect['prospectId'];
		$prospects[$id] = new Prospect($id);
	}
	
	$request->closeCursor();
    return $prospects;
}

/**
  * Returns the array of prospect object from a given class which has not been drafted yet
  */
function getInternationalAvailableProspects()
{
    $year = getCurrentYear();
    
    global $db;
	$request;
    $prospects=null;
	
	$request = $db->prepare("
		SELECT * FROM prospect
		LEFT JOIN person    ON prospect.personId   = person.personId
        LEFT JOIN draftpick ON prospect.prospectId = draftpick.playerId
		WHERE draftpick.playerId is NULL
        AND   prospect.actualDraftYear = :year
        AND   prospect.cursusType = 'International'
        ORDER BY ranking");
		
    $request->bindValue(':year',  $year,  PDO::PARAM_INT);
    
	$request->execute();
	$getProspects = $request->fetchAll();
	
	$id;
	foreach ($getProspects as $key => $prospect) {
		$id = $prospect['prospectId'];
		$prospects[$id] = new Prospect($id);
	}
	
	$request->closeCursor();
    return $prospects;
}

/**
  * Returns the array of prospect object for a given class of age
  */
function getDraftPromotionByYear($year)
{
    global $db;
	$request;
    $prospects=null;
	
	$request = $db->prepare("
		SELECT * FROM prospect
		LEFT JOIN person ON prospect.personId = person.personId
		WHERE actualDraftYear = :year
		ORDER BY ranking");
		
	$request->bindParam(':year', $year, PDO::PARAM_INT);
	$request->execute();
	$getProspects = $request->fetchAll();
	
	$id;
	foreach ($getProspects as $key => $prospect) {
		$id = $prospect['prospectId'];
		$prospects[$id] = new Prospect($id);
	}
	
	$request->closeCursor();
    return $prospects;
}