<?php

class SeasonTest
{
	function __construct( ) { }

	public function launchTests()
	{
		$seasonModel = new SeasonModel();
		echo '<pre>';

		$all = $seasonModel->findAll();
		echo '<b>All seasons:</b> '; var_dump( $all );

		$last10 = $seasonModel->findAllLimit();
		echo '<b>Last 10 seasons:</b> '; var_dump( $last10 );

		$season2054 = $seasonModel->findByYear( 2054 );
		echo '<b>2054 season:</b> '; var_dump( $season2054 );

		echo '</pre>';
	}
}