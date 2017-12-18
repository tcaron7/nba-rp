<?php

$viewDay = getCurrentDate();

$currentSeason = getCurrentSeason();
$season = new Season($currentSeason);

// Intro explaination
include_once('view/sectionExplain.php');

// Games of the day
$sectionTitle = 'Play games of the day';
include_once('view/game/displayGameOfDay.php');

// Individual awards
if (isAnAwardDay($season)){
    $sectionTitle = 'Attribute Awards';
    include('controller/award/menuAwards.php');
}

// Trade possibility
$endTrade = $season->getTradeLimitDate();
if ($viewDay <= $endTrade) {
    $sectionTitle = 'Do a trade';
    include('controller/transaction/menuTransaction.php');
}

// Signature possibility
$endSignature = $season->getSignatureLimitDate();
if ($viewDay <= $endSignature) {
    $sectionTitle = 'Sign a player';
    include('controller/transaction/menuTransaction.php');
}

// NBA draft
$draftDay = $season->getDraftDate();
if ($viewDay == $draftDay) {
    include('controller/draft/menuDraftDay.php');
}

// Season transition
$endSeason = $season->getStopDate();
if ($viewDay == $endSeason) {
    include('controller/season/menuSeasonTransitionDay.php');
    if(!empty($_POST))
    {
        $valid = insertNewSeason($_POST);
    }
}

// Season start
$startSeason = $season->getStartDate();
if ($viewDay == $startSeason) {
    include('controller/person/player/menuPlayerOption.php');
}

// Restricted FA option activation
$restrictedFreeAgentOptionDate = $season->getRestrictedFreeAgentOptionDate();
if ($viewDay == $restrictedFreeAgentOptionDate) {
    include('controller/person/player/menuRestrictedFreeAgentOption.php');
}

// Injury status
include('controller/injury/menuInjury.php');