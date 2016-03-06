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
	</head>

	<title>Welcome to Time Crunch</title>
	<body>
		<header></header>
		<div class="container">
		</div>
		<!-- form-->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Welcome to Time Crunch</h1>
					<h2>Let's get started</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<h4>Already Have An Account?</h4>
					<br>
					<!-- Our Special dropdown has class show-on-hover -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							I want to: <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Log In</a></li>
							<li><a href="#">Reset My Password</a></li>
							<li class="divider"></li>
							<li><a href="#">Get a Cupcake</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-5">
					<h4>New User?</h4>
					<br>
					<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							Select: <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">I have my activation email</a></li>
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
							<li class="divider"></li>
							<li><a href="#">I need to sign up my company/group for Time Crunch</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!--form-->
		<div class="dropdown">
			<button type="button" class="btn btn-lg btn-warning dropdown-toggle" data-toggle="dropdown">By industries <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#activate" data-toggle="modal">I have my activation email</a></li>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
				<li class="divider"></li>
				<li><a href="#">I need to sign up my company/group for Time Crunch</a></li>
			</ul>
		</div>
		<div class="modal fade" id="activate" data-target="#activate">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header orange">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
						</button>
						<!--this is the modal-->
						<h4 class="modal-title"><strong></strong>Consumer goods</h4>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>