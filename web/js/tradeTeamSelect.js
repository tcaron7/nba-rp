jQuery(document).ready(function(){

	// Initialisation
    //$(".tradingTeam").hide();
    $(".receivingTeamSelect").hide();
    $(".receivingTeamOption").hide();
    $('section#selectTeams input[name="selectedTeams[]"]').prop('checked', false);
    $('section#tradingTeams input[name^="areTradedPlayers"]').prop('checked', false);
    $('section#tradingTeams input[name^="areTradedPicks"]').prop('checked', false);

    // Display of team box depending on selected teams
    $('section#selectTeams input[name="selectedTeams[]').change(function(){
        var teamId  = $(this).val();
        var teamBox = $('section#tradingTeams div#tradingTeam' + teamId);
        var receivingTeamPlayer = '.receivingTeamOption[id^="receivingTeam' + teamId + 'P"]';

        if( $(this).is(':checked') ){
            teamBox.show();
            $(receivingTeamPlayer).show();
        } else {
            teamBox.hide();
            $(receivingTeamPlayer).hide();
        }
    });

    // Display new team select if trade element selected
    $('section#tradingTeams input[name^="areTradedPlayers"]').change(function(){
        var playerId = $(this).attr('id').substring(12);
        var select   = $('section#tradingTeams #receivingTeamsPlayers' + playerId);

        if( $(this).is(':checked') ){
            select.show();
        } else {
            select.hide();
        }
    });

    $('section#tradingTeams input[name^="areTradedPicks"]').change(function(){
        var pickId = $(this).attr('id').substring(10);
        var select = $('section#tradingTeams #receivingTeamsPicks' + pickId);

        if( $(this).is(':checked') ){
            select.show();
        } else {
            select.hide();
        }
    });
});