<?php

class ConferenceModel
{
	function __construct( ) { }

	public function findAll()
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM conference
		');

		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$conferences = array();
		foreach ( $rows as $row )
		{
			$conference = $this->buildDomainObject( $row );
			$conferences[$conference->getId()] = $conference;
		}

		return $conferences;
	}

	public function findById( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM conference
			WHERE conference.conferenceId = :id
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
			throw new \Exception( sprintf( 'Unknown ID for conference.' ), 404 );
		}
	}

	public function save( Conference $conference )
	{
		if ( !$conference->getName() )
		{
			throw new \Exception( sprintf( 'Can not save conference without a name.' ) );
		}

		if ( !$conference->getId() )
		{
			$request = $GLOBALS['db']->prepare('
				INSERT INTO conference( name )
				VALUES ( :name )
			');
			$request->bindValue( ':name', $conference->getName(), PDO::PARAM_STR );
			$request->execute();
			$conference->setId( $GLOBALS['db']->lastInsertId() );
		}
		else
		{
			$request = $GLOBALS['db']->prepare('
				UPDATE conference
				SET conference.name = :name
				WHERE conference.conferenceId = :id
			');
			$request->bindValue( ':name', $conference->getName(), PDO::PARAM_STR );
			$request->bindValue( ':id', $conference->getId(), PDO::PARAM_INT );
			$request->execute();
		}

		$request->closeCursor();
		return 1;
	}

	public function delete( Conference $conference )
	{
		if ( !$conference->getId() )
		{
			throw new \Exception( sprintf( 'Can not delete conference without ID.' ) );
		}

		$request = $GLOBALS['db']->prepare('
			DELETE FROM conference
			WHERE conference.conferenceId = :id
		');

		$request->bindValue( ':id', $conference->getId(), PDO::PARAM_INT );
		$request->execute();
		$request->closeCursor();
		return 1;
	}

	protected function buildDomainObject( array $row )
	{
		$conference = new Conference();
		$conference->setId( $row['conferenceId'] );

		foreach ( $row as $key => $value )
		{
			$method = 'set' . ucfirst( $key );
			if ( method_exists( $conference, $method ) )
			{
				$conference->$method( $value );
			}
		}

		return $conference;
	}
}
