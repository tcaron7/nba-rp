<section>
    <div class="sectionHeader">Welcome to Thibault's NBA Fantasy Game !</div>
    
	<div class="sectionBody">
        <p>This site exists to allow Thibault to manage his RPG NBA Game.</p>
        
        <p>From this index, you can play the games of the day, do new transactions or update the injury status of your players, whatever pleases you !</p>
    </div>
</section>



<?php
$currentDate = getCurrentDate();

$seasonStart = '2053-10-27'; ///////////////
if ($currentDate == $seasonStart)
{
    ?>
    <section>
        <div class="sectionHeader">It's the first day of the season !</div>
        <div class="sectionBody">Players are fresh and ready to start a new season !</div>
    </section>
    <?php
}

$seasonEnd = '2054-06-28'; ///////////////
if ($currentDate == $seasonEnd)
{
    ?>
    <section>
        <div class="sectionHeader">It's the last day of the season !</div>
        <div class="sectionBody">Players are ready to go on vacation.</div>
    </section>
    <?php
}
?>
