<?php	
	$prospectBirthYear4 = getCurrentSeason() - 22;
	$prospectBirthYear3 = getCurrentSeason() - 21;
	$prospectBirthYear2 = getCurrentSeason() - 20;
	$prospectBirthYear1 = getCurrentSeason() - 19;
	$prospectBirthYear0 = getCurrentSeason() - 18;
	
	echo 'Prospects ranking ... I LOVE THIS GAME !!!<br /><br />';
	
	echo '<li><a href="' . $GLOBALS['router']->generateUrl( 'prospect_list', array( 'selection' => 'seniors' ) ) . '">Seniors</a></li>';
	echo '<li><a href="' . $GLOBALS['router']->generateUrl( 'prospect_list', array( 'selection' => 'juniors' ) ) . '">Juniors</a></li>';
	echo '<li><a href="' . $GLOBALS['router']->generateUrl( 'prospect_list', array( 'selection' => 'sophomores' ) ) . '">Sophomores</a></li>';
	echo '<li><a href="' . $GLOBALS['router']->generateUrl( 'prospect_list', array( 'selection' => 'freshmen' ) ) . '">Freshmen</a></li>';
    echo '<li><a href="' . $GLOBALS['router']->generateUrl( 'prospect_list', array( 'selection' => 'international' ) ) . '">International</a>';
	echo '<ul>';
	echo '<li><a href="#">' . $prospectBirthYear4	. '</a></li>';
	echo '<li><a href="#">' . $prospectBirthYear3	. '</a></li>';
	echo '<li><a href="#">' . $prospectBirthYear2	. '</a></li>';
	echo '<li><a href="#">' . $prospectBirthYear1	. '</a></li>';
	echo '<li><a href="#">' . $prospectBirthYear0	. '</a></li>';
	echo '</ul>';
	echo '</li>';
?>

<a class="button" href="<?php echo $GLOBALS['router']->generateUrl( 'prospect_create' ); ?>">Add Prospect</a>