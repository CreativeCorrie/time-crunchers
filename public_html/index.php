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

	<title>Time Crunch</title>
	<body>
		<header>
			<!-- A simplified navbar -->
			<nav class="navbar navbar-default navbar-fixed-top" id="hello"> <!--use navbar-default for lighter bg-->
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<!--					<h3>Schedule</h3>-->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
							  data-target="#top-nav" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-nav">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#schedule">Schedule<span class="sr-only">(current)</span></a></li>
						<li><a href="#request">Request</a></li>
						<li><a href="#profile">Profile</a></li>
						<li><a href="#admin">Admin</a></li>
					</ul>
				</div>
			</nav>
		</header>

<!--		Jumbotron-->
		<div class="jumbotron">
			<h1>Time Crunch</h1>
			<div class="pull-right">
				<p id="today">today's date</p>
			</div>
		</div>

<!--		aside for future use-->
		<div id="wrapper">
			<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li class="sidebar-brand"><a href="#">Home</a></li>
					<li><a href="#">Another link</a></li>
					<li><a href="#">Next link</a></li>
					<li><a href="#">Last link</a></li>
				</ul>
			</div>
			<div id="page-content-wrapper">
				<div class="page-content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">

<!--		main box-->
		<div class="container">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel panel-default pull-right">
						<div class="panel-heading">this is where the calendar will be</div>
						<div class="panel-body"></div>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</body>
</html>


<!--		this is my test area-->

<div class="container-fluid">
	<p>This is some text for no reason.</p>
</div>

<!--		this is my test area-->
