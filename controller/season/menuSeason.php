<?php

// Recuperation des parametres
$year;
$year = $_GET['year'];
$season;
$season = new Season($year);

// On affiche la page (vue)
include_once('view/season/displaySeasonsRecap.php');

