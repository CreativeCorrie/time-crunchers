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

		<base href="<?php echo dirname($_SERVER['PHP_SELF']) . "/" ?>"

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
				crossorigin="anonymous"/>

		<!-- Optional theme -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
				integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
				crossorigin="anonymous"/>

		<!--Font Awesome CSS-->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
				integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">

		<!-- LOAD OUR CUSTOM STYLESHEET HERE!!! -->
		<link href="css/style1.css" type="text/css" rel="stylesheet"/>

		<!--Angular JS-->
		<?php $ANGULAR_VERSION = "1.5.0";?>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-route.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-messages.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.2.4/ui-bootstrap-tpls.min.js"></script>

		<!--Angular application files must be mainjs, then services, then directives, then controllers-->
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/time-crunchers.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/page-route.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/about-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/access-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/activation-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/company-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/crew-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/login-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/request-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/schedule-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/request-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/shift-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/signup-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/services/user-service.js"></script>


		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/main-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/about-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/access-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/activation-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/company-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/crew-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/login-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/request-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/schedule-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/shift-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/signup-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angularjs/controllers/user-controller.js"></script>
		<title><?php echo $PAGE_TITLE;?></title>
	</head>