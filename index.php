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
	echo '<b>Unable to connect to database:</b> ' . $e;
	exit();
}

// Import classes
require_once( 'app/classes.php' );

// Utils functions
require_once( 'app/functions.php' );

// Load routes
$GLOBALS['router'] = new Router( isset( $_GET['url'] ) ? $_GET['url'] : '', $GLOBALS['server'] );
require_once( 'app/routes.php' );

?>

<!DOCTYPE html>
<html>
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
		<title>Play NBA!</title>
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
				try
				{
					$GLOBALS['router']->run();
				}
				catch ( Exception $e )
				{
					echo '<b>Routing error:</b> ' . $e;
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
