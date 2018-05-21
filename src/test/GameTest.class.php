<?php

class GameTest
{
	function __construct( ) { }

	public function launchTests()
	{
		$gameModel = new GameModel();
		echo '<pre>';

		$all = $gameModel->findAllBySeasonIdAndTeamId( 2054, 1 );
		echo '<b>All games:</b> '; var_dump( $all );

		$game = $gameModel->findById( 25 );
		echo '<b>Game:</b> '; var_dump( $game );
		echo '<b>Id:</b> '; var_dump( $game->getId() );

		/*$new = new Conference();
		$new->setName( 'Unknown' );
		$gameModel->save( $new );
		echo '<b>New conference:</b> '; var_dump( $new );

		$new->setName( 'New' );
		$gameModel->save( $new );
		$new = $gameModel->findById( $new->getId() );
		echo '<b>New conference:</b> '; var_dump( $new );

		$gameModel->delete( $new );
		$all = $gameModel->findAll();
		echo '<b>All conferences:</b> '; var_dump( $all );*/

		echo '</pre>';
	}
}