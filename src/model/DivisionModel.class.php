<?php

class DivisionModel
{
	function __construct( ) { }

	public function findAll()
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM division
		');

		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$divisions = array();
		foreach ( $rows as $row )
		{
			$division = $this->buildDomainObject( $row );
			$divisions[$division->getId()] = $division;
		}

		return $divisions;
	}

	public function findById( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM division
			WHERE division.divisionId = :id
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
			throw new \Exception( sprintf( 'Unknown ID for division.' ), 404 );
		}
	}

	public function findByConference( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM division
			WHERE division.conferenceId = :id
		');

		$request->bindValue( ':id', $id, PDO::PARAM_INT );
		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$divisions = array();
		foreach ( $rows as $row )
		{
			$division = $this->buildDomainObject( $row );
			$divisions[$division->getId()] = $division;
		}

		return $divisions;
	}

	public function save( Division $division )
	{
		if ( !$division->getName() )
		{
			throw new \Exception( sprintf( 'Can not save division without a name.' ) );
		}
		
		if ( !$division->getConferenceId() )
		{
			throw new \Exception( sprintf( 'Can not save division without a conferenceId.' ) );
		}
		else
		{
			$conferenceModel = new ConferenceModel;
			$conference = $conferenceModel->findById( $division->getConferenceId() );
		}

		if ( !$division->getId() )
		{
			$request = $GLOBALS['db']->prepare('
				INSERT INTO division( name, conferenceId )
				VALUES ( :name, :conferenceId )
			');
			$request->bindValue( ':name', $division->getName(), PDO::PARAM_STR );
			$request->bindValue( ':conferenceId', $division->getConferenceId(), PDO::PARAM_INT );
			$request->execute();
			$division->setId( $GLOBALS['db']->lastInsertId() );
		}
		else
		{
			$request = $GLOBALS['db']->prepare('
				UPDATE division
				SET division.name = :name, division.conferenceId
				WHERE division.divisionId = :id
			');
			$request->bindValue( ':name', $division->getName(), PDO::PARAM_STR );
			$request->bindValue( ':conferenceId', $division->getConferenceId(), PDO::PARAM_INT );
			$request->bindValue( ':id', $division->getId(), PDO::PARAM_INT );
			$request->execute();
		}

		$request->closeCursor();
		return 1;
	}

	public function delete( Division $division )
	{
		if ( !$division->getId() )
		{
			throw new \Exception( sprintf( 'Can not delete division without ID.' ) );
		}
		
		$request = $GLOBALS['db']->prepare('
			DELETE FROM division
			WHERE division.divisionId = :id
		');

		$request->bindValue( ':id', $division->getId(), PDO::PARAM_INT );
		$request->execute();
		$request->closeCursor();
		return 1;
	}

	protected function buildDomainObject( array $row )
	{
		$division = new Division();
		$division->setId( $row['divisionId'] );
		$division->setName( $row['name'] );
		$division->setConferenceId( $row['conferenceId'] );
		return $division;
	}

}
