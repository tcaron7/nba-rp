<?php
if($player->getInjuryStatus() == 'Healthy' or $player->getInjuryStatus() == 'Weakened')
{    
    $minutes          = $statsGame[$teamIndex][$playerId]['minutes'];
	$ftm              = $statsGame[$teamIndex][$playerId]['ftm'];
	$fta              = $statsGame[$teamIndex][$playerId]['fta'];
	$fgm              = $statsGame[$teamIndex][$playerId]['fgm'];
	$fga              = $statsGame[$teamIndex][$playerId]['fga'];
	$fgm3             = $statsGame[$teamIndex][$playerId]['3fgm'];
	$fga3             = $statsGame[$teamIndex][$playerId]['3fga'];
	$offensive_boards = $statsGame[$teamIndex][$playerId]['offensive_boards'];
	$defensive_boards = $statsGame[$teamIndex][$playerId]['defensive_boards'];
	$assists          = $statsGame[$teamIndex][$playerId]['assists'];
	$turnovers        = $statsGame[$teamIndex][$playerId]['turnovers'];
	$steals           = $statsGame[$teamIndex][$playerId]['steals'];
	$blocks           = $statsGame[$teamIndex][$playerId]['blocks'];
?>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-minutes"          type="number" name="<?php echo $gameId . '[' . $playerId . '][minutes]'; ?>"          min="0"    value="<?php echo $minutes;             ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-ftm"              type="number" name="<?php echo $gameId . '[' . $playerId . '][ftm]'; ?>"              min="0"    value="<?php echo $ftm;                 ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-fta"              type="number" name="<?php echo $gameId . '[' . $playerId . '][fta]'; ?>"              min="0"    value="<?php echo $fta;                 ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-fgm"              type="number" name="<?php echo $gameId . '[' . $playerId . '][fgm]'; ?>"              min="0"    value="<?php echo $fgm;                 ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-fga"              type="number" name="<?php echo $gameId . '[' . $playerId . '][fga]'; ?>"              min="0"    value="<?php echo $fga;                 ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-3fgm"             type="number" name="<?php echo $gameId . '[' . $playerId . '][3fgm]'; ?>"             min="0"    value="<?php echo $fgm3;                ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-3fga"             type="number" name="<?php echo $gameId . '[' . $playerId . '][3fga]'; ?>"             min="0"    value="<?php echo $fga3;                ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-offensive_boards" type="number" name="<?php echo $gameId . '[' . $playerId . '][offensive_boards]'; ?>" min="0"    value="<?php echo $offensive_boards;    ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-defensive_boards" type="number" name="<?php echo $gameId . '[' . $playerId . '][defensive_boards]'; ?>" min="0"    value="<?php echo $defensive_boards;    ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-assists"          type="number" name="<?php echo $gameId . '[' . $playerId . '][assists]'; ?>"          min="0"    value="<?php echo $assists;             ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-turnovers"        type="number" name="<?php echo $gameId . '[' . $playerId . '][turnovers]'; ?>"        min="0"    value="<?php echo $turnovers;           ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-steals"           type="number" name="<?php echo $gameId . '[' . $playerId . '][steals]'; ?>"           min="0"    value="<?php echo $steals;              ?>"></td>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-blocks"           type="number" name="<?php echo $gameId . '[' . $playerId . '][blocks]'; ?>"           min="0"    value="<?php echo $blocks;              ?>"></td>
<?php
}
elseif($player->getInjuryStatus() == 'Unavailable')
{
?>
	<td colspan="13">Did Not Play</td>
<?php
}
?>