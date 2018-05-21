<?php

class PersonModel
{
	function __construct( ) { }

	public function findAll()
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM person
			ORDER BY lastName
		');

		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$persons = array();
		foreach ( $rows as $row )
		{
			$person = $this->buildDomainObject( $row );
			$persons[$person->getId()] = $person;
		}

		return $persons;
	}

	public function findById( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM person
			WHERE person.personId = :id
		');

		$request->bindValue( ':id', $id, PDO::PARAM_INT );
		$request->execute();
		$row = $request->fetch();
		$request->closeCursor();

		if ( $row )
		{
			return $this->buildDomainObject( $row );
		}
		else
		{
			throw new \Exception( sprintf( 'Unknown ID for person.' ), 404 );
		}
	}

	public function save( Person $person )
	{
		if ( !$person->getFirstName() )
		{
			throw new \Exception( sprintf( 'Can not save person without a first name.' ) );
		}
		if ( !$person->getLastName() )
		{
			throw new \Exception( sprintf( 'Can not save person without a last name.' ) );
		}

		if ( !$person->getId() )
		{
			$request = $GLOBALS['db']->prepare('
				INSERT INTO person( firstName, lastName, middleName, nickName, birthdate, birthplace, nationality, formation, height, weight )
				VALUES ( :firstName, :lastName, :middleName, :nickName, :birthdate, :birthplace, :nationality, :formation, :height, :weight )
			');

			$request->bindValue( ':firstName', $person->getFirstName(), PDO::PARAM_STR );
			$request->bindValue( ':lastName', $person->getLastName(), PDO::PARAM_STR );
			$request->bindValue( ':middleName', $person->getMiddleName(), PDO::PARAM_STR );
			$request->bindValue( ':nickName', $person->getNickName(), PDO::PARAM_STR );
			$request->bindValue( ':birthdate', $person->getBirthdate(), PDO::PARAM_STR );
			$request->bindValue( ':birthplace', $person->getBirthplace(), PDO::PARAM_STR );
			$request->bindValue( ':nationality', $person->getNationality(), PDO::PARAM_STR );
			$request->bindValue( ':formation', $person->getFormation(), PDO::PARAM_STR );
			$request->bindValue( ':height', $person->getHeight(), PDO::PARAM_STR );
			$request->bindValue( ':weight', $person->getWeight(), PDO::PARAM_STR );

			$request->execute();
			$person->setId( $GLOBALS['db']->lastInsertId() );
		}
		else
		{
			$request = $GLOBALS['db']->prepare('
				UPDATE person
				SET
					person.firstName = :firstName,
					person.lastName = :lastName,
					person.middleName = :middleName,
					person.nickName = :nickName,
					person.birthdate = :birthdate,
					person.birthplace = :birthplace,
					person.nationality = :nationality,
					person.formation = :formation,
					person.height = :height,
					person.weight = :weight
				WHERE person.personId = :id
			');

			$request->bindValue( ':firstName', $person->getFirstName(), PDO::PARAM_STR );
			$request->bindValue( ':lastName', $person->getLastName(), PDO::PARAM_STR );
			$request->bindValue( ':middleName', $person->getMiddleName(), PDO::PARAM_STR );
			$request->bindValue( ':nickName', $person->getNickName(), PDO::PARAM_STR );
			$request->bindValue( ':birthdate', $person->getBirthdate(), PDO::PARAM_STR );
			$request->bindValue( ':birthplace', $person->getBirthplace(), PDO::PARAM_STR );
			$request->bindValue( ':nationality', $person->getNationality(), PDO::PARAM_STR );
			$request->bindValue( ':formation', $person->getFormation(), PDO::PARAM_STR );
			$request->bindValue( ':height', $person->getHeight(), PDO::PARAM_STR );
			$request->bindValue( ':weight', $person->getWeight(), PDO::PARAM_STR );
			$request->bindValue( ':id', $person->getId(), PDO::PARAM_INT );

			$request->execute();
		}

		$request->closeCursor();
		return 1;
	}

	public function delete( Person $person )
	{
		if ( !$person->getId() )
		{
			throw new \Exception( sprintf( 'Can not delete person without ID.' ) );
		}

		$request = $GLOBALS['db']->prepare('
			DELETE FROM person
			WHERE person.personId = :id
		');

		$request->bindValue( ':id', $person->getId(), PDO::PARAM_INT );
		$request->execute();
		$request->closeCursor();
		return 1;
	}

	protected function buildDomainObject( array $row )
	{
		$person = new Person();
		$person->setId( $row['personId'] );

		foreach ( $row as $key => $value )
		{
			$method = 'set' . ucfirst( $key );
			if ( method_exists( $person, $method ) )
			{
				$person->$method( $value );
			}
		}

		return $person;
	}
}
