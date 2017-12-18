<form action="nba.php" method="post">
<p>
    <section>
        <div class="sectionHeader">Next season parameter</div>
        
        <div class="sectionBody">
            <dl>
                <dt>All Star Date (Y / M / D):</dt>
                <dd>
                    <input type="number" name="allStarYear" id="randomAllStarYear" class="size4" min="2000" required /> /
                    <input type="number" name="allStarMonth" id="randomAllStarMonth" class="size2" min="1" max="12" required /> /
                    <input type="number" name="allStarDay" id="randomAllStarDay" class="size2" min="1" max="31" required />
                </dd>
                <dt>Salary cap ($) :</dt>
                <dd><input type="number" name="salaryCap" class="size3" required /></dd>
                <dt>Contract max ($) :</dt>
                <dd><input type="number" name="contractMax" class="size3" required /></dd>
                <dt>Max players in a team :</dt>
                <dd><input type="number" name="maxPlayersInTeam" class="size3" required /></dd>
            </dl>
        </div>
    </section>
	<input type="submit" value="Generate New Season"/> 
</p>
</form>
