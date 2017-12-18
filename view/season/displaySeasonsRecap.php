
<?php
	echo '<h1>NBA Season ' . ($year-1) . '/' . $year . '</h1>';
	echo '<p>';
	
	if($season->getStatus() == 0)
	{
		echo 'La saison est terminée. <br />';
		echo 'Le champion NBA ' . ($year-1) . '/' . $year . " est l'equipe " . $season->getChampion()->getName() . '. <br />';
		echo "Le finaliste est l'equipe " . $season->getFinalist()->getName() . '. </br >';
	}
	else
	{
		?>
			La saison est en cours.<br />
			Le resume de la saison sera disponible quand celle ci sera terminee.<br />
		<?php
	}
	
	echo '</p>';
?>