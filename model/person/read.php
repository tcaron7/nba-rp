<?php

/**
  * Returns a raw person using the personId
  */
function getPersonById($id)
{
    global $db;
	$request;
    $person;
	
	$request = $db->prepare('SELECT * FROM person WHERE personId = :id');
	$request->bindParam(':id', $id, PDO::PARAM_INT);
	$request->execute();
	$character = $request->fetch();
	
	$request->closeCursor();
    return $character;
}

/**
  * Returns an array of all known persons ordered by name
  */
function getAllPersonsOrderByName()
{
    global $db;
	$request;
    $personsInfo;
	$personsObject;
	
	$request = $db->prepare('SELECT personId FROM person ORDER BY name');
	$request->execute();
	$personsInfo = $request->fetchAll();
	
	$id;
	foreach ($personsInfo as $key => $person) {
		$id = $person['personId'];
		$personsObject[$id] = new Person($id);
	}
	
	$request->closeCursor();
    return $personsObject;
}