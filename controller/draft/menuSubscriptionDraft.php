<?php

if(isset($_POST['selectedProspects']))
{
    foreach($_POST['selectedProspects'] as $selectedProspect)
    {
        updateProspectDraftYear(intval($selectedProspect));
    }    
}

$year = intval(getCurrentSeason());

include('view/draft/formSelectProspects.php');