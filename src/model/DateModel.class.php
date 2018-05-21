<?php

class DateModel
{
	function __construct( ) { }

	public function findCurrentDate()
	{
		$request = $GLOBALS['db']->prepare('
			SELECT currentDate
			FROM environment
			WHERE environment.name = :name
		');

		$request->bindParam( ':name', $GLOBALS['environment'], PDO::PARAM_STR );
		$request->execute();
		$row = $request->fetch();
		$request->closeCursor();

		if ( $row )
		{
			return $this->buildDomainObject( $row );
		}
		else
		{
			throw new \Exception( sprintf( 'Enable to retrieve current date.' ), 404 );
		}
	}

	public function saveCurrentDate( $date )
	{
		$request = $GLOBALS['db']->prepare('
			UPDATE environment
			SET currentDate = :date
			WHERE environment.name = :name
		');

		$request->bindParam( ':name', $GLOBALS['environment'], PDO::PARAM_STR );
		$request->bindValue( ':date', $date->getFullDate(), PDO::PARAM_STR );
	    $request->execute();
		$request->closeCursor();
	    return 1;
	}

	protected function buildDomainObject( array $row )
	{
		list( $fullYear, $month, $day ) = explode( '-', $row['currentDate'] );

		$date = new Date();
		$date->setFullYear( $fullYear );
		$date->setMonth( $month );
		$date->setDay( $day );

		return $date;
	}
}
