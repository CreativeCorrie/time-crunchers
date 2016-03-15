<?php
/**
 * Get the relative path.
 * @see https://raw.githubusercontent.com/kingscreations/farm-to-you/master/php/lib/_header.php FarmToYou Header
 **/

// include the appropriate number of dirname() functions
// on line 8 to correctly resolve your directory's path
require_once(dirname(dirname(__DIR__)) . "/root-path.php");
$CURRENT_DEPTH = substr_count($CURRENT_DIR, "/");
$ROOT_DEPTH = substr_count($ROOT_PATH, "/");
$DEPTH_DIFFERENCE = $CURRENT_DEPTH - $ROOT_DEPTH;
$PREFIX = str_repeat("../", $DEPTH_DIFFERENCE);
?>

<!DOCTYPE html>
<html lang="en" ng-app="TimeCrunchers">
	<head>
		<meta charset="utf-8"/>

		<!-- IE Rendering Mode = Edge-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<base href="<?php echo dirname($_SERVER['PHP_SELF']) . "/" ?>">

		<!--Angular JS-->
		<?php $ANGULAR_VERSION = "1.5.0"; ?>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-route.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-messages.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-animate.js"></script>
		<script type="text/javascript"
				  src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.2.4/ui-bootstrap-tpls.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.4/interact.min.js"></script>
		<script type="text/javascript"
				  src="//mattlewis92.github.io/angular-bootstrap-calendar/dist/js/angular-bootstrap-calendar-tpls.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
				crossorigin="anonymous"/>

		<!-- Time Crunchers custom style sheet -->
		<link href="css/style1.css" type="text/css" rel="stylesheet"/>

		<!-- Calendar CSS -->
		<link href="//mattlewis92.github.io/angular-bootstrap-calendar/dist/css/angular-bootstrap-calendar.min.css"
				rel="stylesheet">

		<!--Font Awesome CSS-->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
				integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">

		<!--Angular application files must be mainjs, then services, then directives, then controllers-->
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/time-crunchers.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/page-route.js"></script>

		<!-- services -->
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/about-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/access-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/activation-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/company-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/crew-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/login-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/request-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/schedule-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/request-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/shift-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/signup-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/services/user-service.js"></script>

		<!-- directives-->
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/directives/bootstrap-breakpoint.js"></script>

		<!-- controllers -->
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/main-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/about-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/access-controller.js"></script>
		<script type="text/javascript"
				  src="<?php echo $PREFIX; ?>angularjs/controllers/activation-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/company-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/crew-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/login-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/request-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/schedule-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/shift-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/signup-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/user-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/nav-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/datepick-controller.js"></script>
		<script type="text/javascript"
				  src="<?php echo $PREFIX; ?>angularjs/controllers/calendarhelper-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/calendar-controller.js"></script>

		<title><?php echo $PAGE_TITLE; ?></title>
	</head>