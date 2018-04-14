<?php

class ConferenceTest
{
	function __construct( ) { }

	public function launchTests()
	{
		$conferenceModel = new ConferenceModel();
		echo '<pre>';

		$all = $conferenceModel->findAll();
		echo '<b>All conferences:</b> '; var_dump( $all );

		$east = $conferenceModel->findById( 1 );
		echo '<b>East conference:</b> '; var_dump( $east );
		echo '<b>Id:</b> '; var_dump( $east->getId() );
		echo '<b>Name:</b> '; var_dump( $east->getName() );
		echo '<b>Divisions:</b> '; var_dump( $east->getDivisions() );

		$new = new Conference();
		$new->setName( 'Unknown' );
		$conferenceModel->save( $new );
		echo '<b>New conference:</b> '; var_dump( $new );

		$new->setName( 'New' );
		$conferenceModel->save( $new );
		$new = $conferenceModel->findById( $new->getId() );
		echo '<b>New conference:</b> '; var_dump( $new );

		$conferenceModel->delete( $new );
		$all = $conferenceModel->findAll();
		echo '<b>All conferences:</b> '; var_dump( $all );

		echo '</pre>';
	}
}