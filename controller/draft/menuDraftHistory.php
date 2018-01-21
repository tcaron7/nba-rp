<?php

$draftYears = getPreviousDraftYear();

foreach($draftYears as $draftYear)
{
	echo '<a href="index.php?section=draft_history&draft=' . $draftYear['year'] .'">';
	echo $draftYear['year'] . ' Draft</br>';
	echo '</a>';
}
	
if(isset($_GET['draft']))
{
	$draftPicks = getDraftPickByYear($_GET['draft']);
    $viewYear = $_GET['draft'];
    include('view/draft/displayDraftOfYear.php');
}
?>