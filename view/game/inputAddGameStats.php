<?php
if($player->getInjuryStatus() == 'Healthy' or $player->getInjuryStatus() == 'Weakened')
{    
    $minutes          = $preStats[$teamIndex][$playerId]['minutes'];
	$ftm              = round($_POST[$gameId][$teamIndex]['ftm'] * $preStats[$teamIndex][$playerId]['ftm']/max(1,$preStats[$teamIndex]['total']['ftm']));
	$fta              = round($_POST[$gameId][$teamIndex]['fta'] * $preStats[$teamIndex][$playerId]['fta']/max(1,$preStats[$teamIndex]['total']['fta']));
	$fgm              = round($_POST[$gameId][$teamIndex]['fgm'] * $preStats[$teamIndex][$playerId]['fgm']/max(1,$preStats[$teamIndex]['total']['fgm']));
	$fga              = round($_POST[$gameId][$teamIndex]['fga'] * $preStats[$teamIndex][$playerId]['fga']/max(1,$preStats[$teamIndex]['total']['fga']));
	$fgm3             = round($_POST[$gameId][$teamIndex]['3fgm'] * $preStats[$teamIndex][$playerId]['3fgm']/max(1,$preStats[$teamIndex]['total']['3fgm']));
	$fga3             = round($_POST[$gameId][$teamIndex]['3fga'] * $preStats[$teamIndex][$playerId]['3fga']/max(1,$preStats[$teamIndex]['total']['3fga']));
	$offensive_boards = round($_POST[$gameId][$teamIndex]['offensive_boards'] * $preStats[$teamIndex][$playerId]['offensive_boards']/max(1,$preStats[$teamIndex]['total']['offensive_boards']));
	$defensive_boards = round($_POST[$gameId][$teamIndex]['defensive_boards'] * $preStats[$teamIndex][$playerId]['defensive_boards']/max(1,$preStats[$teamIndex]['total']['defensive_boards']));
	$assists          = round($_POST[$gameId][$teamIndex]['assists'] * $preStats[$teamIndex][$playerId]['assists']/max(1,$preStats[$teamIndex]['total']['assists']));
	$turnovers        = round($_POST[$gameId][$teamIndex]['turnovers'] * $preStats[$teamIndex][$playerId]['turnovers']/max(1,$preStats[$teamIndex]['total']['turnovers']));
	$steals           = round($_POST[$gameId][$teamIndex]['steals'] * $preStats[$teamIndex][$playerId]['steals']/max(1,$preStats[$teamIndex]['total']['steals']));
	$blocks           = round($_POST[$gameId][$teamIndex]['blocks'] * $preStats[$teamIndex][$playerId]['blocks']/max(1,$preStats[$teamIndex]['total']['blocks']));
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