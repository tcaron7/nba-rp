<?php

/**
  * Inserts a raw person in database
  * Returns personId
  */
function insertPerson($person)
{
	global $db;
    $request;
	$personId;
	
	$request = $db->prepare('
		INSERT INTO person (
			firstname,
			name,
			birthdate,
			nationality,
			formation,
			height,
			weight
		)
		VALUES (
			:firstname,
			:name,
			:birthdate,
			:nationality,
			:formation,
			:height,
			:weight
		)
	');

	$request->bindValue(':firstname',   $person->getFirstname(),   PDO::PARAM_STR);
	$request->bindValue(':name',        $person->getName(),        PDO::PARAM_STR);
	$request->bindValue(':birthdate',   $person->getBirthdate(),   PDO::PARAM_STR);
	$request->bindValue(':nationality', $person->getNationality(), PDO::PARAM_STR);
	$request->bindValue(':formation',   $person->getFormation(),   PDO::PARAM_STR);
	$request->bindValue(':height',      $person->getHeight(),      PDO::PARAM_STR);
	$request->bindValue(':weight',      $person->getWeight(),      PDO::PARAM_INT);

    $request->execute();
	$personId = $db->lastInsertId();
	$request->closeCursor();
    return $personId;
}

/**
  * Updates a person in database
  */
function updatePerson($person)
{
	global $db;
	$request;
    $ok = 0;
	
	$request = $db->prepare('');

	$request->bindParam(':id',          $person->getId,          PDO::PARAM_INT);
	$request->bindParam(':firstname',   $person->getFirstname,   PDO::PARAM_STR, 25);
	$request->bindParam(':name',        $person->getName,        PDO::PARAM_STR, 25);
	$request->bindParam(':birthdate',   $person->getBirthdate,   PDO::PARAM_STR, 10);
	$request->bindParam(':nationality', $person->getNationality, PDO::PARAM_STR, 25);
	$request->bindParam(':formation',   $person->getFormation,   PDO::PARAM_STR, 25);
	$request->bindParam(':height',      $person->getHeight,      PDO::PARAM_STR, 10);
	$request->bindParam(':weight',      $person->getWeight,      PDO::PARAM_INT);

	$ok = $request->execute();
	$request->closeCursor();
	
    return $ok;
}