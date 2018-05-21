<?php

class PersonTest
{
	function __construct( ) { }

	public function launchTests()
	{
		$personModel = new PersonModel();
		echo '<pre>';

		$all = $personModel->findAll();
		//echo '<b>All persons:</b> '; var_dump( $all );

		$one = $personModel->findById( 42 );
		echo '<b>One person:</b> '; var_dump( $one );
		echo '<b>Age:</b> '; var_dump( $one->getAge() );

		/*$new = new Conference();
		$new->setName( 'Unknown' );
		$conferenceModel->save( $new );
		echo '<b>New conference:</b> '; var_dump( $new );

		$new->setName( 'New' );
		$conferenceModel->save( $new );
		$new = $conferenceModel->findById( $new->getId() );
		echo '<b>New conference:</b> '; var_dump( $new );

		$conferenceModel->delete( $new );
		$all = $conferenceModel->findAll();
		echo '<b>All conferences:</b> '; var_dump( $all );*/

		echo '</pre>';
	}
}