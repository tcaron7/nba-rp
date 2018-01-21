<?php
    if(!isset($_GET['award']) and $_GET['type'] == 'month')
    {
        $season = getCurrentSeason();
        if(getCurrentDay() == 1)
        {
            if(getCurrentMonth() == 1)
            {
                $month = 12;
            }
            else
            {
                $month = getCurrentMonth() - 1;
            }
        }
        elseif(getCurrentDay() != 1)
        {
            $month = getCurrentMonth();
        }
        
        if(!checkAwardAttribution($season, $month, 'Eastern Rookie of The Month'))
        {
            echo '<a href="index.php?section=awards&type=month&award=east_rookie">';
            echo 'Select Eastern Rookie of the month</br>';
            echo '</a>';
        }
        
        if(!checkAwardAttribution($season, $month, 'Western Rookie of The Month'))
        {
            echo '<a href="index.php?section=awards&type=month&award=west_rookie">';
            echo 'Select Western Rookie of the month</br>';
            echo '</a>';
        }
        
        if(!checkAwardAttribution($season, $month, 'Eastern Player of The Month'))
        {
            echo '<a href="index.php?section=awards&type=month&award=east_player">';
            echo 'Select Eastern Player of the month</br>';
            echo '</a>';
        }
        
        if(!checkAwardAttribution($season, $month, 'Western Player of The Month'))
        {
            echo '<a href="index.php?section=awards&type=month&award=west_player">';
            echo 'Select Western Player of the month</br>';
            echo '</a>';
        }        
    }
    elseif(!isset($_GET['award']) and $_GET['type'] == 'season')
    {
        $season = getCurrentSeason();
        $month  = 0;
        
        if(!checkAwardAttribution($season, $month, '6th Man of The Year'))
        {
            echo '<a href="index.php?section=awards&type=season&award=6thman">';
            echo 'Select 6th man</br>';
            echo '</a>';
        }
        
        if(!checkAwardAttribution($season, $month, 'MIP'))
        {
            echo '<a href="index.php?section=awards&type=season&award=mip">';
            echo 'Select MIP</br>';
            echo '</a>';
        }
        
        if(!checkAwardAttribution($season, $month, 'DPOY'))
        {
            echo '<a href="index.php?section=awards&type=season&award=dpoy">';
            echo 'Select DPOY</br>';
            echo '</a>';
        }
        
        if(!checkAwardAttribution($season, $month, 'ROY'))
        {
            echo '<a href="index.php?section=awards&type=season&award=roy">';
            echo 'Select ROY</br>';
            echo '</a>';
        }
        
        if(!checkAwardAttribution($season, $month, 'MVP'))
        {
            echo '<a href="index.php?section=awards&type=season&award=mvp">';
            echo 'Select MVP</br>';
            echo '</a>';
        }        
    }
    elseif(!isset($_GET['award']) and $_GET['type'] == 'submit')
    {
        $award = new Award(null,$_POST);
		
		$valid = updateAward($award);
    }
    elseif(isset($_GET['award']))
    {
        $players;
        $players = getAllCandidatesToAnAward($_GET['award']);
        include_once('view/award/attributeAwardPlayersList.php');
    }
?>