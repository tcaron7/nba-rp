<?php
if(isset($_POST['period']))
{
    $period = $_POST['period'];
}
else
{
    $period = 'Season';
}

if(isset($_POST['players']))
{
    $playersType = $_POST['players'];
}
else
{
    $playersType = 'All';
}

if(isset($_POST['stats']))
{
	$stats  = $_POST['stats'];
}
else
{
	$stats  = 'points';
}