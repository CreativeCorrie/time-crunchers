<!DOCTYPE html>
<html>
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
		<?php $ANGULAR_VERSION = "1.5.0"; ?>
		<script type="text/javascript"
				  src="//cdnjs.cloudflare.com/ajax/libs/angular.js/<?php echo $ANGULAR_VERSION; ?>/angular.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-route.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-messages.min.js"></script>
		<script type="text/javascript"
				  src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/<?php echo $ANGULAR_VERSION; ?>/ui-bootstrap-tpls.min.js"></script>

		<!--Angular application files must be mainjs, then services, then directives, then controllers-->
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/time-crunchers.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/main-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/about-controller.js"></script>
		<script type="text/javascript"
				  src="<?php echo $PREFIX; ?>angularjs/controllers/activation-controller.js"></script>

		<!-- HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

		<!-- Latest compiled and minified Bootstrap JavaScript, all compiled plugins included -->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
				  integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
				  crossorigin="anonymous"></script>
		<title><?php echo $PAGE_TITLE; ?></title>
	</head>

	<header>
		<div class="container" id="mainHeader">
			<div class="row">
				<div class="col-md-12">
					<h1>Welcome to Time Crunch</h1>
				</div>
			</div>
		</div>

		<div class="container">
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/~rlewis37/ng-template-example/public_html/">Manage Your Schedule</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/public_html/angularjs/templates/userEditProfileView.php">Profile</a></li>
						<li><a href="/public_html/angularjs/templates/requestView.php">Request</a></li>
						<li><a href="/public_html/angularjs/templates/adminOnlyView.php">Admin</a></li>
						<li><a href="/public_html/angularjs/pages/about.php">About</a></li>
						<li><a href="#GTFO">Logout</a></li>
						<li><a href="https://senator-arlo.bowtied.io/" target="_blank">Feel the Fuzzy</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div><!--/.container-->

	</header>
</html>

