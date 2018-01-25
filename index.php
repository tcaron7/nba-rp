<?php

// Configuration
require( 'app/cfg/dev.php' ); // prod.php

// Session start
session_start();

// Default timezone
date_default_timezone_set( 'Europe/Paris' );

// Connexion to database
try
{
	$GLOBALS['db'] = new PDO(
		$GLOBALS['db']['options']['driver'] . ':host=' . $GLOBALS['db']['options']['host'] . '; dbname=' . $GLOBALS['db']['options']['dbname'],
		$GLOBALS['db']['options']['user'],
		$GLOBALS['db']['options']['password'],
		array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $GLOBALS['db']['options']['charset'] )
	);
	$db = $GLOBALS['db'];
}
catch ( PDOException $e )
{
	echo 'Unable to connect to database : ' . $e;
	exit();
}

// Import classes
require_once( 'app/classes.php' );

// Load routes
$GLOBALS['router'] = new Router( isset( $_GET['url'] ) ? $_GET['url'] : '', $GLOBALS['server'] );
require_once( 'app/routes.php' );

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<meta charset="iso-8859-1" />
		
		<!-- CSS -->
		<link href="<?php echo $GLOBALS['path']['css']; ?>default.css" rel="stylesheet" type="text/css" />
		
		<!-- JS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="<?php echo $GLOBALS['path']['js']; ?>navDropdown.js"></script>
		<script src="<?php echo $GLOBALS['path']['js']; ?>generateRandomDate.js"></script>
		<script src="<?php echo $GLOBALS['path']['js']; ?>tradeTeamSelect.js"></script>
		<script src="<?php echo $GLOBALS['path']['js']; ?>gameSheetTotal.js"></script>

		<!-- FAVICON -->
		<link rel="icon" type="image/png" href="<?php echo $GLOBALS['path']['img']; ?>favicon.png" />
		
		<!-- TITLE -->
		<?php
		$title = '';
		
		if (!isset($_GET['section']) OR $_GET['section'] == 'index' OR $_GET['section'] == 'next_day')
		{
			$title = 'Accueil NBA';
		}
		else if ($_GET['section'] == 'play')
		{
				$title = 'Fill NBA Games';
		}
		else if ($_GET['section'] == 'season_view' and isset($_GET['year']))
		{
			$title = 'NBA Saison';
		}
		else if ($_GET['section'] == 'team_view' and isset($_GET['id']))
		{
			$title = 'Team';
		}
		else if ($_GET['section'] == 'schedule')
		{
			$title = 'NBA Schedule';
		}
		else if ($_GET['section'] == 'player')
		{
			$title = 'NBA Players';
		}
		else if ($_GET['section'] == 'add_player')
		{
			$title = 'Add Players';
		}
		else if ($_GET['section'] == 'standing')
		{
			$title = 'NBA Standings';
		}
		else if ($_GET['section'] == 'stats')
		{
			$title = 'NBA Stats';
		}
		else if ($_GET['section'] == 'player_season_stats')
		{
			$title = 'NBA Player Stats';
		}
		else if ($_GET['section'] == 'prospects')
		{
			$title = 'NBA Prospects Ranking';
		}
		else if ($_GET['section'] == 'add_prospect')
		{
			$title = 'Add Players';
		}
			else if ($_GET['section'] == 'trade')
		{
			$title = 'Trade';
		}
			else if ($_GET['section'] == 'signature')
		{
			$title = 'Signature';
		}
			else if ($_GET['section'] == 'sign_player' or $_GET['section'] == 'sign_rookie')
		{
			$title = 'Sign Player';
		}
			else if ($_GET['section'] == 'lottery')
		{
			$title = 'Draft Lottery';
		}
			else if ($_GET['section'] == 'draft_subscription')
		{
			$title = 'Draft Prospect Subscription';
		}
			else if ($_GET['section'] == 'draft' || $_GET['section'] == 'select_prospect')
		{
			$title = 'NBA Draft';
		}
			else if ($_GET['section'] == 'season_transition')
		{
			$title = 'NBA Season Transition';
		}
			else if ($_GET['section'] == 'players_option')
		{
			$title = 'NBA Activate option';
		}
			else if ($_GET['section'] == 'restricted_players_option')
		{
			$title = 'NBA Activate restricted player option';
		}
			else if ( ($_GET['section'] == 'injuryDisplay') || ($_GET['section'] == 'transactionDisplay') )
		{
			$title = 'NBA News';
		}
		else
		{
			$title = 'Unknow Page';
		}
		
		echo "<title>" . $title . "</title>";
		?>
	</head>

	<body>
		<div id="wrap">
		
			<?php

			// Current Date
			$viewDate = getCurrentDate();

			// Header
			echo '<header id="pageHeader">';
				include_once( $GLOBALS['path']['views'] . 'header.php' );
			echo '</header>';
			
			// Content
			echo '<div id="pageContent">';

            if (isset($_GET['section']) and $_GET['section'] == 'play')
			{
				include_once('controller/play/menuPlay.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'team_view' and isset($_GET['id']))
			{
				include_once('controller/team/menuTeam.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'schedule')
			{
				include_once('controller/game/menuGames.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'season_view' and isset($_GET['year']))
			{
				include_once('controller/season/menuSeason.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'add_player')
			{
				include_once('controller/person/player/addPlayers.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'player')
			{
				include_once('controller/person/player/menuPlayers.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'standing')
			{
				include('controller/standing/menuStanding.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'stats')
			{
				include_once('controller/stat/menuStats.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'player_season_stats')
			{
				include_once('controller/person/player/menuPlayers.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'player_career_stats')
			{
				include_once('controller/person/player/menuPlayers.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'player_games_logs')
			{
				include_once('controller/person/player/menuPlayers.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'player_awards')
			{
				include_once('controller/person/player/menuPlayers.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'prospects')
			{
				include_once('controller/person/prospect/menuProspects.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'add_prospect')
			{
				include_once('controller/person/prospect/addProspects.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'signature')
			{
				include_once('controller/transaction/signature/menuSignature.php');
			}
			else if (isset($_GET['section']) and ( $_GET['section'] == 'sign_player' or $_GET['section'] == 'sign_rookie') )
			{
				include_once('controller/transaction/signature/menuSignature.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'trade')
			{
				include_once('controller/transaction/trade/menuTrade.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'lottery')
			{
				include_once('controller/draft/menuLotteryDraft.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'draft_subscription')
			{
				include_once('controller/draft/menuSubscriptionDraft.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'draft_history')
			{
				include_once('controller/draft/menuDraftHistory.php');
			}
			else if (isset($_GET['section']) and ( $_GET['section'] == 'draft' || $_GET['section'] == 'select_prospect') )
			{
				include_once('controller/draft/menuDraft.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'season_transition')
			{
				include_once('controller/season/menuSeasonTransition.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'players_option')
			{
				include_once('controller/person/player/menuActivatePlayersOption.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'restricted_players_option')
			{
				include_once('controller/person/player/menuActivateRestrictedFreeAgentOption.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'injury')
			{
				include_once('controller/injury/menuAddInjury.php');
			}
			else if (isset($_GET['section']) and ( ($_GET['section'] == 'injuryDisplay') || ($_GET['section'] == 'transactionDisplay')  || ($_GET['section'] == 'awardDisplay')))
			{
				include_once('controller/injury/menuNews.php');
			}
			else if (isset($_GET['section']) and $_GET['section'] == 'awards')
			{
				include_once('controller/award/menuAttributeAwards.php');
			}
			else
			{
				try
				{
					$GLOBALS['router']->run();
				}
				catch ( Exception $e )
				{
					echo '<b>Routing error:</b> ' . $e;
				}
			}
			echo '</div>';

			// Footer
			echo '<footer id="pageFooter">';
				include_once( $GLOBALS['path']['views'] . 'footer.php' );
			echo '</footer>';

			?>
		</div>

	</body>
</html>
