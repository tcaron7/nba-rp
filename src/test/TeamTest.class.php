<?php

class TeamTest
{
	function __construct( ) { }

	public function launchTests()
	{
		$teamModel = new TeamModel();
		echo '<pre>';

		$all = $teamModel->findAll();
		//echo '<b>All teams:</b> '; var_dump( $all );

		$philadelphia = $teamModel->findById( 1 );
		echo '<b>Philadelphia team:</b> '; var_dump( $philadelphia );
		echo '<b>Id:</b> '; var_dump( $philadelphia->getId() );
		echo '<b>City:</b> '; var_dump( $philadelphia->getCity() );
		echo '<b>Name:</b> '; var_dump( $philadelphia->getName() );
		echo '<b>Abbreviation:</b> '; var_dump( $philadelphia->getAbbreviation() );
		echo '<b>Main color:</b> '; var_dump( $philadelphia->getMainColor() );
		echo '<b>Secondary color:</b> '; var_dump( $philadelphia->getSecondaryColor() );
		echo '<b>Full name:</b> '; var_dump( $philadelphia->getFullName() );
		echo '<b>DivisionId:</b> '; var_dump( $philadelphia->getDivisionId() );
		echo '<b>Division:</b> '; var_dump( $philadelphia->getDivision() );		
		echo '<b>ConferenceId:</b> '; var_dump( $philadelphia->getConferenceId() );
		echo '<b>Conference:</b> '; var_dump( $philadelphia->getConference() );

		/*$new = new Division();
		$new->setName( 'Unknown' );
		$new->setConferenceId( $philadelphia->getConferenceId() );
		$teamModel->save( $new );
		echo '<b>New division:</b> '; var_dump( $new );

		$new->setName( 'New' );
		$teamModel->save( $new );
		$new = $teamModel->findById( $new->getId() );
		echo '<b>New division:</b> '; var_dump( $new );

		$teamModel->delete( $new );
		$all = $teamModel->findAll();
		echo '<b>All divisions:</b> '; var_dump( $all );*/

		echo '</pre>';
	}
}