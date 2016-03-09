<?php
require_once("php/lib/xsrf.php");

//if session is not active start session
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
setXsrfCookie();
?>

<!DOCTYPE html>
<html lang="en" ng-app="TimeCrunchers">
	<head>
		<meta charset="utf-8"/>

		<!-- IE Rendering Mode = Edge-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<!-- Angular Core-->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-messages.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.2.1/ui-bootstrap-tpls.min.js"></script>

		<!--		Custom Angular - these script tags must be in order: services, directives, controllers-->
		<script type="text/javascript" src="angularjs/time-crunchers.js"></script>
		<script type="text/javascript" src="angularjs/services/activation-service.js"></script>
		<script type="text/javascript" src="angularjs/controllers/activation-controller.js"></script>

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

	</head>

	<title>Choose Your Password</title>
	<body>

		<?php
		$activation = filter_input(INPUT_GET, "emailActivation", FILTER_SANITIZE_STRING);
		if(ctype_xdigit($activation) === false) {
			throw(new InvalidArgumentException("invalid activation token", 405));
		}
		?>

		<div class="container">
			<div class="row" ng-controller="ActivationController">
				<div class="col-sm-6 col-sm-offset-3">
					<h2>Choose a Password</h2>
					<p class="text-center">Use the form below to set your password. Your password cannot be the same as your
						username.</p>
					<form name="activationForm" id="activationForm" ng-submit="sendActivation(activationData, activationForm.$valid);" novalidate>
						<input type="hidden" name="emailActivation" id="emailActivation"
								 ng-model="activationData.emailActivation" value="<?php echo $activation; ?>"/>
						<input type="password" class="input-lg form-control" name="password1" id="password1"
								 placeholder="New Password" autocomplete="off" ng-model="activationData.password" ng-minlength="8" ng-required="true">
						<div class="row">
							<div class="col-sm-6">
								<span id="8char" class="glyphicon glyphicon-remove setPass"></span> 8 Characters
								Long<br>
								<span id="ucase" class="glyphicon glyphicon-remove setPass"></span> One Uppercase
								Letter
							</div>
							<div class="col-sm-6">
								<span id="lcase" class="glyphicon glyphicon-remove setPass"></span> One Lowercase
								Letter<br>
								<span id="num" class="glyphicon glyphicon-remove setPass"></span> One Number
							</div>
						</div>
						<input type="password" class="input-lg form-control" name="confirmPassword" id="confirmPassword"
								 placeholder="Repeat Password" autocomplete="off" ng-model="activationData.confirmPassword" ng-minlength="8" ng-required="true">
						<div class="row">
							<div class="col-sm-12">
								<span id="pwmatch" class="glyphicon glyphicon-remove setPass"></span> Passwords
								Match
							</div>
						</div>
						<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"
								 data-loading-text="Changing Password..." value="Change Password">
					</form>
				</div><!--/col-sm-6-->
				<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg }}</uib-alert>
			</div><!--/row-->
		</div>
	</body>
</html>