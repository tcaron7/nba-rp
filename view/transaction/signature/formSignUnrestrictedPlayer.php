<?php
echo $freeAgent->getFullName() . ' is unrestricted free agent, the ';
echo $freeAgent->getTeam()->getFullName() . ' can match the offer</br></br>';

$team = new Team($freeAgent->getTeamId());
$teamPlayers = getAllPlayersOfTeam($team->getId());
include('view/team/displayRoster.php');

echo 'Does the ' . $freeAgent->getTeam()->getFullName() . ' desire to match the offer ?';
?>
<form action="<?php echo $GLOBALS['router']->generateUrl( 'signature_player' ); ?>" method="post">
    <input type="hidden" name="playerId"        value="<?php echo $_POST['playerId'];?>"        >
    <input type="hidden" name="teamId"          value="<?php echo $freeAgent->getTeamId();?>"   >
    <input type="hidden" name="salary"          value="<?php echo $_POST['salary'];?>"          >
    <input type="hidden" name="guarantedYear"   value="<?php echo $_POST['guarantedYear'];?>"   >
    <input type="hidden" name="optionalYear"    value="<?php echo $_POST['optionalYear'];?>"    >
    <input type="hidden" name="contractType"    value="<?php echo $_POST['contractType'];?>"    >
    <input type="hidden" name="match"           value="yes"                                     >

    <input type="submit" value="Yes"/> 
</form>
<form action="<?php echo $GLOBALS['router']->generateUrl( 'signature_player' ); ?>" method="post">
    <input type="hidden" name="playerId"        value="<?php echo $_POST['playerId'];?>"        >
    <input type="hidden" name="teamId"          value="<?php echo $_POST['teamId'];?>"          >
    <input type="hidden" name="salary"          value="<?php echo $_POST['salary'];?>"          >
    <input type="hidden" name="guarantedYear"   value="<?php echo $_POST['guarantedYear'];?>"   >
    <input type="hidden" name="optionalYear"    value="<?php echo $_POST['optionalYear'];?>"    >
    <input type="hidden" name="contractType"    value="<?php echo $_POST['contractType'];?>"    >
    <input type="hidden" name="match"           value="no"                                      >

    <input type="submit" value="No"/> 
</form>
