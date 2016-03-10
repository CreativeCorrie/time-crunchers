<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>

		<!-- IE Rendering Mode = Edge-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

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
		<title><?php echo $PAGE_TITLE;?></title>
	</head>

<header id="landingHeader">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Welcome to Time Crunch</h1>
			</div>
		</div>

		<!--beginning of nav bar-->
		<!-- Wrap all page content here -->
		<div id="wrap">
			<nav class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
							  data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<h2>Manage Your Schedule</h2>
					</a>
				</div>
				<!--this is where the sign in and activate buttons are -->
				<form class="navbar-form navbar-right" role="search">
					<div class="button-container">
						<!--Collapsible buttons-->
						<ul class="nav navbar-nav navbar-right">
							<li>
								<button type="button" class="btn btn-primary navbar-btn" id="#buttonSpacer">
									<span class="glyphicon glyphicon-user"></span> Profile
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-success navbar-btn" id="#buttonSpacer">
									<span class="glyphicon glyphicon-cog"></span> Admin
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-info navbar-btn" id="#buttonSpacer">
									<span class="glyphyicon glyphicon-pencil"></span> Request
								</button>
							</li>
							<li>
								<!--TODO: Need angular here to end session and log user out-->
							<li>
								<button type="button" class="btn btn-danger navbar-btn" id="#buttonSpacer">
									<span class="glyphicon glyphicon-remove"></span> Log Out
								</button>
							</li>
						</ul>
					</div>
				</form>
			</nav>
		</div>
</header>