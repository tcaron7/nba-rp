<?php
if($player->getInjuryStatus() == 'Healthy' or $player->getInjuryStatus() == 'Weakened')
{
?>
	<td><input class="size2 player-<?php echo $teamIndex; ?>-minutes" type="number" name="<?php echo $gameId . '[' . $playerId . '][minutes]'; ?>"min="0" value="<?php echo $playerMinutes; ?>"></td>
    <td colspan="12"></td>
<?php
}
elseif($player->getInjuryStatus() == 'Unavailable')
{
?>
	<td colspan="13">Did Not Play</td>
<?php
}
?>