<?php

// Connexion to database
try
{
    $db = new PDO('mysql:host=localhost;dbname=nba', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
