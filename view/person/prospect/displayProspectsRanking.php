<?php	
	$prospectBirthYear4 = getCurrentSeason() - 22;
	$prospectBirthYear3 = getCurrentSeason() - 21;
	$prospectBirthYear2 = getCurrentSeason() - 20;
	$prospectBirthYear1 = getCurrentSeason() - 19;
	$prospectBirthYear0 = getCurrentSeason() - 18;
	
	echo 'Prospects ranking ... I LOVE THIS GAME !!!<br /><br />';
	
	echo '<li><a href="index.php?section=prospects&prospect=Seniors">Seniors</a></li>';
	echo '<li><a href="index.php?section=prospects&prospect=Juniors">Juniors</a></li>';
	echo '<li><a href="index.php?section=prospects&prospect=Sophomores">Sophomores</a></li>';
	echo '<li><a href="index.php?section=prospects&prospect=Freshmen">Freshmen</a></li>';
    echo '<li><a href="index.php?section=prospects&prospect=International">International</a>';                    
	echo '<ul>';
	echo '<li><a href="index.php?section=prospects&prospect=International&birthyear=' . $prospectBirthYear4	. '">' . $prospectBirthYear4	. '</a></li>';
	echo '<li><a href="index.php?section=prospects&prospect=International&birthyear=' . $prospectBirthYear3	. '">' . $prospectBirthYear3	. '</a></li>';
	echo '<li><a href="index.php?section=prospects&prospect=International&birthyear=' . $prospectBirthYear2	. '">' . $prospectBirthYear2	. '</a></li>';
	echo '<li><a href="index.php?section=prospects&prospect=International&birthyear=' . $prospectBirthYear1	. '">' . $prospectBirthYear1	. '</a></li>';
	echo '<li><a href="index.php?section=prospects&prospect=International&birthyear=' . $prospectBirthYear0	. '">' . $prospectBirthYear0	. '</a></li>';
	echo '</ul>';
	echo '</li>';
?>

<a class="button" href="index.php?section=add_prospect">Add Prospect</a>