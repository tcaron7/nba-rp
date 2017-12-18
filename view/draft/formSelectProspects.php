<section id="selectProspects">
    <div class="sectionHeader">Select Prospects</div>
    
    <form action="#" method="post">
    <input type="submit" value="Submit Prospects &raquo;" />
    <div class="sectionBody">
    <?php
    echo 'Juniors';
    $prospects = getProspectsByAgeClass($year+1);
    include('view/draft/displayProspectsCheckbox.php');

    echo '</br>';
    echo 'Sophomores';
    $prospects = getProspectsByAgeClass($year+2);
    include('view/draft/displayProspectsCheckbox.php');
    echo '</br>';

    echo 'Freshmen';
    $prospects = getProspectsByAgeClass($year+3);
    include('view/draft/displayProspectsCheckbox.php');

    echo '</br>';
    echo 'International';
    $prospects = getInternationalProspects();
    include('view/draft/displayProspectsCheckbox.php');
    ?>
    </form>
    </div>
</section>