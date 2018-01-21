<section id="selectProspects">
    <div class="sectionHeader">Select Prospects</div>
    
    <form action="index.php?section=draft" method="post">
    <input type="submit" value="Submit Prospects &raquo;" />
    <div class="sectionBody">
    <?php

    $prospects = getAvailableProspectsByAgeClass($year);
    if(!empty($prospects))
    {
        echo 'Seniors';
        include('view/draft/displayProspectsCheckbox.php');
    }
    
    $prospects = getAvailableProspectsByAgeClass($year+1);
    if(!empty($prospects))
    {
        echo 'Juniors';
        include('view/draft/displayProspectsCheckbox.php');
    }

    $prospects = getAvailableProspectsByAgeClass($year+2);
    if(!empty($prospects))
    {
        echo 'Sophomores';
        include('view/draft/displayProspectsCheckbox.php');
    }

    $prospects = getAvailableProspectsByAgeClass($year+3);
    if(!empty($prospects))
    {
        echo 'Freshmen';
        include('view/draft/displayProspectsCheckbox.php');
    }

    $prospects = getInternationalAvailableProspects();
    if(!empty($prospects))
    {
        echo 'International';
        include('view/draft/displayProspectsCheckbox.php');
    }
    ?>
    </form>
    </div>
</section>