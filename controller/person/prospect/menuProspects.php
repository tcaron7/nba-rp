<?php

if (!isset($_GET['prospect']))
{
	include_once('view/person/prospect/displayProspectsRanking.php');
}
else
{
    if($_GET['prospect'] != 'International')
    {
        if ($_GET['prospect'] == 'Seniors')
        {
            $predictedDraftYear = getCurrentSeason();
        }
        elseif ($_GET['prospect'] == 'Juniors')
        {
            $predictedDraftYear = getCurrentSeason() + 1;
        }
        elseif ($_GET['prospect'] == 'Sophomores')
        {
            $predictedDraftYear = getCurrentSeason() + 2;
        }
        elseif ($_GET['prospect'] == 'Freshmen')
        {
            $predictedDraftYear = getCurrentSeason() + 3;
        }
        $prospectsClass = getProspectsByAgeClass($predictedDraftYear);
    }
    else
    {
        $predictedDraftYear = 'International';
        $prospectsClass = getInternationalProspects();
    }
	include_once('view/person/prospect/displayOfPlayersRanking.php');
}
