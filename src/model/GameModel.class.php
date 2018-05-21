<?php

class GameModel
{
	function __construct( ) { }

	public function findAll()
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM game
		');

		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$games = array();
		foreach ( $rows as $row )
		{
			$game = $this->buildDomainObject( $row );
			$games[$game->getId()] = $game;
		}

		return $games;
	}

	public function findAllBySeasonId( int $seasonId )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM game
			WHERE game.seasonId = :seasonId
		');

		$request->bindParam( ':seasonId', $seasonId, PDO::PARAM_INT );
		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$games = array();
		foreach ( $rows as $row )
		{
			$game = $this->buildDomainObject( $row );
			$games[$game->getId()] = $game;
		}

		return $games;
	}

	public function findAllByDate( $date )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM game
			WHERE game.date = :date
		');

		$request->bindParam( ':date', $date, PDO::PARAM_INT );
		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$games = array();
		foreach ( $rows as $row )
		{
			$game = $this->buildDomainObject( $row );
			$games[$game->getId()] = $game;
		}

		return $games;
	}

	public function findAllOfCurrentSeason()
	{
		$dateModel = new DateModel();
		return $this->findAllBySeasonId( $dateModel->findCurrentDate()->getSeason() );
	}

	public function findAllOfCurrentDate()
	{
		$dateModel = new DateModel();
		return $this->findAllByDate( $dateModel->findCurrentDate()->getFullDate() );
	}

	public function findAllBySeasonIdAndTeamId( int $seasonId, int $teamId )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM game
			WHERE game.seasonId = :seasonId
			AND ( game.homeTeamId = :teamId OR game.visitorTeamId = :teamId )
		');

		$request->bindParam( ':seasonId', $seasonId, PDO::PARAM_INT );
		$request->bindParam( ':teamId', $teamId, PDO::PARAM_INT );
		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$games = array();
		foreach ( $rows as $row )
		{
			$game = $this->buildDomainObject( $row );
			$games[$game->getId()] = $game;
		}

		return $games;
	}

	public function findById( int $id )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM game
			WHERE game.gameId = :id
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
			throw new \Exception( sprintf( 'Unknown ID for game.' ), 404 );
		}
	}

	public function save( Game $game )
	{
		if ( !$game->getDate() )
		{
			throw new \Exception( sprintf( 'Can not save game without a date.' ) );
		}
		if ( !$game->getSeasonId() )
		{
			throw new \Exception( sprintf( 'Can not save game without a season.' ) );
		}
		if ( !$game->getHomeTeamId() )
		{
			throw new \Exception( sprintf( 'Can not save game without a home team.' ) );
		}
		if ( !$game->getVisitorTeamId() )
		{
			throw new \Exception( sprintf( 'Can not save game without a visitor team.' ) );
		}

		if ( !$game->getId() )
		{
			$request = $GLOBALS['db']->prepare('
				INSERT INTO game( date, seasonId, homeTeamId, visitorTeamId, homeTeamScore, visitorTeamScore, overtime, comment )
				VALUES ( :date, :seasonId, :homeTeamId, :visitorTeamId, :homeTeamScore, :visitorTeamScore, :overtime, :comment )
			');
			$request->bindValue( ':date', $game->getDate(), PDO::PARAM_STR );
			$request->bindValue( ':seasonId', $game->getSeasonId(), PDO::PARAM_INT );
			$request->bindValue( ':homeTeamId', $game->getHomeTeamId(), PDO::PARAM_INT );
			$request->bindValue( ':visitorTeamId', $game->getVisitorTeamId(), PDO::PARAM_INT );
			$request->bindValue( ':homeTeamScore', $game->getHomeTeamScore(), PDO::PARAM_INT );
			$request->bindValue( ':visitorTeamScore', $game->getVisitorTeamScore(), PDO::PARAM_INT );
			$request->bindValue( ':overtime', $game->getOvertime(), PDO::PARAM_INT );
			$request->bindValue( ':comment', $game->getComment(), PDO::PARAM_STR );
			$request->execute();
			$game->setId( $GLOBALS['db']->lastInsertId() );
		}
		else
		{
			$request = $GLOBALS['db']->prepare('
				UPDATE game
				SET
					game.date = :date,
					game.seasonId = :seasonId,
					game.homeTeamId = :homeTeamId,
					game.visitorTeamId = :visitorTeamId,
					game.homeTeamScore = :homeTeamScore,
					game.visitorTeamScore = :visitorTeamScore,
					game.overtime = :overtime,
					game.comment = :comment
				WHERE game.gameId = :id
			');
			$request->bindValue( ':date', $game->getDate(), PDO::PARAM_STR );
			$request->bindValue( ':seasonId', $game->getSeasonId(), PDO::PARAM_INT );
			$request->bindValue( ':homeTeamId', $game->getHomeTeamId(), PDO::PARAM_INT );
			$request->bindValue( ':visitorTeamId', $game->getVisitorTeamId(), PDO::PARAM_INT );
			$request->bindValue( ':homeTeamScore', $game->getHomeTeamScore(), PDO::PARAM_INT );
			$request->bindValue( ':visitorTeamScore', $game->getVisitorTeamScore(), PDO::PARAM_INT );
			$request->bindValue( ':overtime', $game->getOvertime(), PDO::PARAM_INT );
			$request->bindValue( ':comment', $game->getComment(), PDO::PARAM_STR );
			$request->bindValue( ':id', $game->getId(), PDO::PARAM_INT );
			$request->execute();
		}

		$request->closeCursor();
		return 1;
	}

	public function delete( Game $game )
	{
		if ( !$game->getId() )
		{
			throw new \Exception( sprintf( 'Can not delete game without ID.' ) );
		}

		$request = $GLOBALS['db']->prepare('
			DELETE FROM game
			WHERE game.gameId = :id
		');

		$request->bindValue( ':id', $game->getId(), PDO::PARAM_INT );
		$request->execute();
		$request->closeCursor();

		return 1;
	}

	protected function buildDomainObject( array $row )
	{
		$game = new Game();
		$game->setId( $row['gameId'] );
		$game->setDate( $row['date'] );
		$game->setSeasonId( $row['seasonId'] );
		$game->setHomeTeamId( $row['homeTeamId'] );
		$game->setVisitorTeamId( $row['visitorTeamId'] );
		$game->setHomeTeamScore( $row['homeTeamScore'] );
		$game->setVisitorTeamScore( $row['visitorTeamScore'] );
		$game->setOvertime( $row['overtime'] );
		$game->setComment( $row['comment'] );
		return $game;
	}

}
