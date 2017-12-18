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