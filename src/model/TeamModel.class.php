<?php

class TeamModel
{
	function __construct( ) { }

	public function findAll()
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM team
			ORDER BY team.name
		');

		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$teams = array();
		foreach ( $rows as $row )
		{
			$team = $this->buildDomainObject( $row );
			$teams[$team->getId()] = $team;
		}

		return $teams;
	}

	public function findById( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM team
			WHERE team.teamId = :id
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
			throw new \Exception( sprintf( 'Unknown ID for team.' ), 404 );
		}
	}

	public function findByDivision( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM team
			WHERE team.divisionId = :id
		');

		$request->bindValue( ':id', $id, PDO::PARAM_INT );
		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$teams = array();
		foreach ( $rows as $row )
		{
			$team = $this->buildDomainObject( $row );
			$teams[$team->getId()] = $team;
		}

		return $teams;
	}

	public function findByConference( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT team.*
			FROM team
			LEFT JOIN division ON team.divisionId = division.divisionId
			WHERE division.conferenceId = :id
		');

		$request->bindValue( ':id', $id, PDO::PARAM_INT );
		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$teams = array();
		foreach ( $rows as $row )
		{
			$team = $this->buildDomainObject( $row );
			$teams[$team->getId()] = $team;
		}

		return $teams;
	}

	public function save( Team $team )
	{
		if ( !$team->getCity() )
		{
			throw new \Exception( sprintf( 'Can not save team without a city.' ) );
		}

		if ( !$team->getName() )
		{
			throw new \Exception( sprintf( 'Can not save team without a name.' ) );
		}

		if ( !$team->getAbbreviation() )
		{
			throw new \Exception( sprintf( 'Can not save team without an abbreviation.' ) );
		}

		if ( !$division->getDivisionId() )
		{
			throw new \Exception( sprintf( 'Can not save team without a divisionId.' ) );
		}
		else
		{
			$divisionModel = new DivisionModel;
			$division = $divisionModel->findById( $team->getDivisionId() );
		}

		if ( !$team->getId() )
		{
			$request = $GLOBALS['db']->prepare('
				INSERT INTO team( city, name, abbreviation, divisionId, mainColor, secondaryColor )
				VALUES ( :city, :name, :abbreviation, :divisionId, :mainColor, :secondaryColor )
			');

			$request->bindValue( ':city', $team->getCity(), PDO::PARAM_STR );
			$request->bindValue( ':name', $team->getName(), PDO::PARAM_STR );
			$request->bindValue( ':abbreviation', $team->getAbbreviation(), PDO::PARAM_STR );
			$request->bindValue( ':divisionId', $team->getDivisionId(), PDO::PARAM_INT );
			$request->bindValue( ':mainColor', $team->getMainColor(), PDO::PARAM_STR );
			$request->bindValue( ':secondaryColor', $team->getSecondaryColor(), PDO::PARAM_STR );

			$request->execute();
			$team->setId( $GLOBALS['db']->lastInsertId() );
		}
		else
		{
			$request = $GLOBALS['db']->prepare('
				UPDATE team
				SET
					team.city = :city,
					team.name = :name,
					team.abbreviation = :abbreviation,
					team.divisionId = :divisionId,
					team.mainColor = :mainColor,
					team.secondaryColor = :secondaryColor
				WHERE team.teamId = :id
			');

			$request->bindValue( ':city', $team->getCity(), PDO::PARAM_STR );
			$request->bindValue( ':name', $team->getName(), PDO::PARAM_STR );
			$request->bindValue( ':abbreviation', $team->getAbbreviation(), PDO::PARAM_STR );
			$request->bindValue( ':divisionId', $team->getDivisionId(), PDO::PARAM_INT );
			$request->bindValue( ':mainColor', $team->getMainColor(), PDO::PARAM_STR );
			$request->bindValue( ':secondaryColor', $team->getSecondaryColor(), PDO::PARAM_STR );
			$request->bindValue( ':id', $division->getId(), PDO::PARAM_INT );

			$request->execute();
		}

		$request->closeCursor();
		return 1;
	}

	public function delete( Team $team )
	{
		if ( !$team->getId() )
		{
			throw new \Exception( sprintf( 'Can not delete team without ID.' ) );
		}

		$request = $GLOBALS['db']->prepare('
			DELETE FROM team
			WHERE team.teamId = :id
		');

		$request->bindValue( ':id', $team->getId(), PDO::PARAM_INT );
		$request->execute();
		$request->closeCursor();
		return 1;
	}

	protected function buildDomainObject( array $row )
	{
		$team = new Team();
		$team->setId( $row['teamId'] );

		foreach ( $row as $key => $value )
		{
			$method = 'set' . ucfirst( $key );
			if ( method_exists( $team, $method ) )
			{
				$team->$method( $value );
			}
		}

		return $team;
	}
}
