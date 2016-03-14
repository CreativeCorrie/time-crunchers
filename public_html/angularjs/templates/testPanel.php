<!--this panel is just for injecting views and forms for testing-->

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
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-route.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-messages.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-animate.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.2.4/ui-bootstrap-tpls.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
				crossorigin="anonymous"/>

		<!-- Time Crunchers custom style sheet -->
		<link href="/public_html/css/style1.css" type="text/css" rel="stylesheet"/>

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
		<script type="text/javascript" src="<?php echo $PREFIX; ?>angularjs/controllers/activation-controller.js"></script>
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

		<title><?php echo $PAGE_TITLE; ?></title>
	</head>
	<body>
	<header ng-controller="NavController">
		<bootstrap-breakpoint></bootstrap-breakpoint>

		<div id="topButtons" class="pull-right button-container">
			<!--			<div class="button-container">-->
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">Request</button>
			<!--			</div>-->
			&nbsp;
			<a href="/angularjs/templates/adminOnlyView.php" class="btn btn-warning">Admin</a> <!-- this should bring in the admin view -->
			&nbsp;
			<a href="/angularjs/pages/landingPage.php" class="btn btn-danger">Logout</a> <!-- TODO:this should end the session and return you to the landing page -->
		</div>

		<div class="container-fluid" id="mainHeader">
			<h3>Welcome to Time Crunch</h3>
		</div>

		<!-- Begin navbar-->
		<nav class="navbar navbar-default navbar-fixed-top navbar-inner">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1"
							  aria-expanded="false" ng-click="navCollapsed = !navCollapsed">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Manage Your Schedule</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div id="collapse-1" uib-collapse="navCollapsed">
					<ul class="nav navbar-nav navbar-right">

						<!-- Add -->
						<li class="dropdown" uib-dropdown>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" uib-dropdown-toggle>
								Add <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" uib-dropdown-menu>
								<li ng-repeat="page in pages"><a href="/public_html/angularjs/templates/userSignUpForm.php">Add Member </a></li>
								<li ng-repeat="page in pages"><a href="/public_html/angularjs/templates/buildCrewForm.php">Add Crew </a></li>
								<li ng-repeat="page in pages"><a href="/public_html/angularjs/templates/addScheduleForm.php">Add Schedule</a></li>
							</ul>
						</li>

						<!--Edit-->
						<li class="dropdown" uib-dropdown>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" uib-dropdown-toggle>
								Edit
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" uib-dropdown-menu>
								<li ng-repeat="page in pages"><a href="{{ page.href }}">{{ page.name }}</a></li>
							</ul>
						</li>
						<li><a href="/angularjs/templates/userEditProfileView.php">
								Profile
							</a> <!-- this should bring in the user edit profile view-->
						</li>
						<li><a href="/public_html/angularjs/templates/faqView.php">
								FAQ
							</a>
						</li>
					</ul>
				</div><!-- /.collapse-1 -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
		<main class="MainController">
			<div class="row">
				<div class="col-md-6">
					<form>
						<div ng-controller="DatepickerDemoCtrl">
							<h4>Popup</h4>
							<div class="row">
								<div class="col-md-6">
									<p class="input-group">
										<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="dt"
												 is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true"
												 close-text="Close" alt-input-formats="altInputFormats"/>
          <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="open1()"><i
						class="glyphicon glyphicon-calendar"></i></button>
          </span>
									</p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</main>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-6 m-b-2 text-left-md-up">
						<a href="/public_html/angularjs/pages/aboutView.php">About Time Crunch</a>
						<!--				<img src="/public_html/images/taco.jpg" id="logo" alt="taco" />-->
						<!--		Taco by stolkramaker from the Noun Project - creative commons-->

						<!--				branding here-->
					</div>
					<div class="col-md-6 m-b-2 text-right-md-up">
						&copy herp derp 2016
					</div>
				</div>
			</div>
		</footer>
	</body>
	</html>
