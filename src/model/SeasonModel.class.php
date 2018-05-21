<?php

class SeasonModel
{
	function __construct( ) { }

	public function findAll()
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM season
			ORDER BY season.year DESC
		');

		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$seasons = array();
		foreach ( $rows as $row )
		{
			$season = $this->buildDomainObject( $row );
			$seasons[$season->getYear()] = $season;
		}

		return $seasons;
	}

	public function findAllLimit( $limit = 10 )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM season
			ORDER BY season.year DESC
			LIMIT :limit
		');

		$request->bindValue( ':limit', $limit, PDO::PARAM_INT );
		$request->execute();
		$rows = $request->fetchAll();
		$request->closeCursor();

		$seasons = array();
		foreach ( $rows as $row )
		{
			$season = $this->buildDomainObject( $row );
			$seasons[$season->getYear()] = $season;
		}

		return $seasons;
	}

	public function findByYear( int $year )
	{
		$request = $GLOBALS['db']->prepare('
			SELECT *
			FROM season
			WHERE season.year = :year
		');

		$request->bindValue( ':year', $year, PDO::PARAM_INT );
		$request->execute();
		$row = $request->fetch();
		$request->closeCursor();

		if ( $row )
		{
			return $this->buildDomainObject( $row );
		}
		else
		{
			throw new \Exception( sprintf( 'Unknown ID for season.' ), 404 );
		}
	}

	public function save( Season $season )
	{
		if ( !$season->getYear() )
		{
			$request = $GLOBALS['db']->prepare('
				INSERT INTO season (
					year,
					startDate,
					stopDate,
					draftDate,
					tradeLimitDate,
					signatureLimitDate,
					restrictedFreeAgentOptionLimitDate,
					allStarGameDate,
					regularSeasonAwardsDate,
					salaryCap,
					contractMax,
					maxPlayersInTeam,
					championTeamId,
					finalistTeamId
				)
				VALUES (
					:year,
					:startDate,
					:stopDate,
					:draftDate,
					:tradeLimitDate,
					:signatureLimitDate,
					:restrictedFreeAgentOptionLimitDate,
					:allStarGameDate,
					:regularSeasonAwardsDate,
					:salaryCap,
					:contractMax,
					:maxPlayersInTeam,
					:championTeamId,
					:finalistTeamId
				)
			');

			$request->bindValue( ':year', $season->getYear(), PDO::PARAM_INT);
			$request->bindValue( ':startDate', $season->getStartDate(), PDO::PARAM_STR );
			$request->bindValue( ':stopDate', $season->getStopDate(), PDO::PARAM_STR );
			$request->bindValue( ':draftDate', $season->getDraftDate(), PDO::PARAM_STR );
			$request->bindValue( ':tradeLimitDate', $season->getTradeLimitDate(), PDO::PARAM_STR );
			$request->bindValue( ':signatureLimitDate', $season->getSignatureLimitDate(), PDO::PARAM_STR );
			$request->bindValue( ':restrictedFreeAgentOptionLimitDate', $season->getRestrictedFreeAgentOptionLimiteDate(), PDO::PARAM_STR );
			$request->bindValue( ':allStarGameDate', $season->getAllStarGameDate(), PDO::PARAM_STR);
			$request->bindValue( ':regularSeasonAwardsDate', $season->getRegularSeasonAwardsDate(), PDO::PARAM_STR );
			$request->bindValue( ':salaryCap', $season->getSalaryCap(), PDO::PARAM_INT );
			$request->bindValue( ':contractMax', $season->getContractMax(), PDO::PARAM_INT );
			$request->bindValue( ':maxPlayersInTeam', $season->getMaxPlayersInTeam(), PDO::PARAM_INT );
			$request->bindValue( ':championTeamId', $season->getChampionTeamId(), PDO::PARAM_INT );
			$request->bindValue( ':finalistTeamId', $season->getFinalistTeamId(), PDO::PARAM_INT );

			$request->execute();
			$team->setId( $GLOBALS['db']->lastInsertId() );
		}
		else
		{
			$request = $GLOBALS['db']->prepare('
				UPDATE season
				SET
					startDate = :startDate,
					stopDate = :stopDate,
					draftDate = :draftDate,
					tradeLimitDate = :tradeLimitDate,
					signatureLimitDate = :signatureLimitDate,
					restrictedFreeAgentOptionLimitDate = :restrictedFreeAgentOptionLimitDate,
					allStarGameDate = :allStarGameDate,
					regularSeasonAwardsDate = :regularSeasonAwardsDate,
					salaryCap = :salaryCap,
					contractMax = :contractMax,
					maxPlayersInTeam = :maxPlayersInTeam,
					championTeamId = :championTeamId,
					finalistTeamId = :finalistTeamId
				WHERE season.year = :year
			');

			$request->bindValue( ':startDate', $season->getStartDate(), PDO::PARAM_STR );
			$request->bindValue( ':stopDate', $season->getStopDate(), PDO::PARAM_STR );
			$request->bindValue( ':draftDate', $season->getDraftDate(), PDO::PARAM_STR );
			$request->bindValue( ':tradeLimitDate', $season->getTradeLimitDate(), PDO::PARAM_STR );
			$request->bindValue( ':signatureLimitDate', $season->getSignatureLimitDate(), PDO::PARAM_STR );
			$request->bindValue( ':restrictedFreeAgentOptionLimitDate', $season->getRestrictedFreeAgentOptionLimiteDate(), PDO::PARAM_STR );
			$request->bindValue( ':allStarGameDate', $season->getAllStarGameDate(), PDO::PARAM_STR);
			$request->bindValue( ':regularSeasonAwardsDate', $season->getRegularSeasonAwardsDate(), PDO::PARAM_STR );
			$request->bindValue( ':salaryCap', $season->getSalaryCap(), PDO::PARAM_INT );
			$request->bindValue( ':contractMax', $season->getContractMax(), PDO::PARAM_INT );
			$request->bindValue( ':maxPlayersInTeam', $season->getMaxPlayersInTeam(), PDO::PARAM_INT );
			$request->bindValue( ':championTeamId', $season->getChampionTeamId(), PDO::PARAM_INT );
			$request->bindValue( ':finalistTeamId', $season->getFinalistTeamId(), PDO::PARAM_INT );
			$request->bindValue( ':year', $season->getYear(), PDO::PARAM_INT);

			$request->execute();
		}

		$request->closeCursor();
		return 1;
	}

	public function delete( Season $season )
	{
		if ( !$season->getYear() )
		{
			throw new \Exception( sprintf( 'Can not delete season without year.' ) );
		}

		$request = $GLOBALS['db']->prepare('
			DELETE FROM season
			WHERE season.year = :year
		');

		$request->bindValue( ':year', $season->getYear(), PDO::PARAM_INT );
		$request->execute();
		$request->closeCursor();
		return 1;
	}

	protected function buildDomainObject( array $row )
	{
		$season = new Season();

		foreach ( $row as $key => $value )
		{
			$method = 'set' . ucfirst( $key );
			if ( method_exists( $season, $method ) )
			{
				$season->$method( $value );
			}
		}

		return $season;
	}
}
