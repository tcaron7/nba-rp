<table class="monthAwards">
    <thead>
        <tr>
            <th colspan="6">
				Player of the month Awards 
            </th>
        </tr>
        <tr>
            <th>Season</th>
            <th>Month</th>
            <th>Western Player of the month</th>
            <th>Eastern Player of the month</th>
            <th>Western Rookie of the month</th>
            <th>Eastern Rookie of the month</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $months = array(11 =>'November',
                        12 =>'December', 
                        1  =>'January',
                        2  =>'February',
                        3  =>'March',
                        4  =>'April');
                        
        foreach($months as $month => $monthStr)
        {
            echo '<tr>';
            echo '<td>' . $season                                                               . '</td>';
            echo '<td>' . $monthStr                                                             . '</td>';
            echo '<td>' . getMonthAwardWinner($season, $month, 'Western Player of The Month')   . '</td>';
            echo '<td>' . getMonthAwardWinner($season, $month, 'Eastern Player of The Month')   . '</td>';
            echo '<td>' . getMonthAwardWinner($season, $month, 'Western Rookie of The Month')   . '</td>';
            echo '<td>' . getMonthAwardWinner($season, $month, 'Eastern Rookie of The Month')   . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<table class="SeasonAwards">
    <thead>
        <tr>
            <th colspan="6">
				Season Awards 
            </th>
        </tr>
        <tr>
            <th>Season</th>
            <th>MVP</th>
            <th>ROY</th>
            <th>DPOY</th>
            <th>MIP</th>
            <th>6th Men of the Year</th>
        </tr>
    </thead>

    <tbody>
        <?php
            echo '<tr>';
            echo '<td>' . $season                                               . '</td>';
            echo '<td>' . getSeasonAwardWinner($season, 'MVP')                   . '</td>';
            echo '<td>' . getSeasonAwardWinner($season, 'ROY')                   . '</td>';
            echo '<td>' . getSeasonAwardWinner($season, 'DPOY')                  . '</td>';
            echo '<td>' . getSeasonAwardWinner($season, 'MIP')                   . '</td>';
            echo '<td>' . getSeasonAwardWinner($season, '6th Man of The Year')   . '</td>';
            echo '</tr>';
        ?>
    </tbody>
</table>