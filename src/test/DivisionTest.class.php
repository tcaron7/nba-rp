<?php

class DivisionTest
{
	function __construct( ) { }

	public function launchTests()
	{
		$divisionModel = new DivisionModel();
		echo '<pre>';

		$all = $divisionModel->findAll();
		echo '<b>All divisions:</b> '; var_dump( $all );

		$atlantic = $divisionModel->findById( 1 );
		echo '<b>Atlantic division:</b> '; var_dump( $atlantic );
		echo '<b>Id:</b> '; var_dump( $atlantic->getId() );
		echo '<b>Name:</b> '; var_dump( $atlantic->getName() );
		echo '<b>ConferenceId:</b> '; var_dump( $atlantic->getConferenceId() );
		echo '<b>Conference:</b> '; var_dump( $atlantic->getConference() );
		echo '<b>Teams:</b> '; var_dump( $atlantic->getTeams() );

		/*$new = new Division();
		$new->setName( 'Unknown' );
		$new->setConferenceId( $atlantic->getConferenceId() );
		$divisionModel->save( $new );
		echo '<b>New division:</b> '; var_dump( $new );

		$new->setName( 'New' );
		$divisionModel->save( $new );
		$new = $divisionModel->findById( $new->getId() );
		echo '<b>New division:</b> '; var_dump( $new );

		$divisionModel->delete( $new );
		$all = $divisionModel->findAll();
		echo '<b>All divisions:</b> '; var_dump( $all );*/

		echo '</pre>';
	}
}