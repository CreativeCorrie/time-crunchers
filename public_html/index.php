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

	<title>Time Crunch Schedule View</title>
	<body>
		<header>

			<!--beginning of nav bar-->
			<body>

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
							<a class="navbar-brand" href="#">Test Nav bar 1</a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="active"><a href="#">Link</a></li>
								<li><a href="#">Link</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
										<li class="divider"></li>
										<li><a href="#">One more separated link</a></li>
									</ul>
								</li>
							</ul>

							<!--this is where the sign in and activate buttons are -->
							<form class="navbar-form navbar-left" role="search">
								<!--<div class="form-group">-->
								<!--<input type="text" class="form-control" placeholder="Search">-->
								<!--</div>-->
								<div class="button-container">
<!--									<button type="button" class="btn btn-info btn-lg" id="signIn" data-toggle="modal"-->
<!--											  data-target="#modal-lg"><a href="html_images.asp">Sign In</a>-->
<!---->
<!--									</button>-->
<!--									<button type="button" class="btn btn-info btn-lg" id="activate" data-toggle="modal"-->
<!--											  data-target="#modal-lg">Activate Account-->
<!--									</button>-->

									<!--Collapsible buttons-->
									<ul class="nav navbar-nav navbar-right">
										<li>
											<button type="button" class="btn btn-warning navbar-btn" id="activate" data-toggle="modal"
													  data-target="#modal-lg"><span
													class="glyphicon glyphicon-check"></span> Log In
											</button>
										</li>
										<li>
											<button type="button" class="btn btn-danger navbar-btn"><span
													class="glyphicon glyphicon-remove"></span> Log Out
											</button>
										</li>
										<li>
											<button type="button" class="btn btn-success navbar-btn id="signIn" data-toggle="modal"
											data-target="#modal-lg""><span
													class="glyphicon glyphicon-ok"></span> Activate
											</button>
										</li>
									</ul>
								</div>
							</form>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="#">Link</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</li>
							</ul>
						</div><!-- /.navbar-collapse -->


						<!--test area for modal buttons-->
						<!-- ========================== -->
						<!--  Large Modal               -->
						<!-- ========================== -->
						<div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
							  aria-hidden="true" data-keyboard="true">
							<!-- Modals have two optional sizes, available via class="modal-lg" or class="modal-sm" -->
							<div class="modal-dialog modal-lg">

								<!-- Begin modal content here -->
								<div class="modal-content">

									<div class="modal-header">
										<!-- close button -->
										<button type="button" class="close" data-dismiss="modal" aria-label="close">
											<span aria-hidden="true">×</span>
										</button>
										<h3 class="modal-title">This is a Large Modal Window!</h3>
									</div>

									<div class="modal-body">
										<p>This modal window has lots of stuff in it. Above, you can see an optional modal-header,
											followed by a modal-body section, and an optional modal-footer. I've even put a form in
											this modal window (inside the modal-body div) - very cool. See the small modal window
											for a simpler example, and don't forget to view the source code for this page. :D</p>
										<label for="modalLoginForm" class="control-label">Log In Here!</label>
										<form class="form-inline" id="modalLoginForm">
											<div class="form-group">
												<label for="txtLoginUsername" class="sr-only">Username: </label>
												<div class="input-group">
													<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
													</div>
													<input type="text" class="form-control" id="txtLoginUsername"
															 placeholder="enter username"/>
												</div>
											</div>
											<div class="form-group">
												<label for="emailLoginEmail" class="sr-only">Email: </label>
												<div class="input-group">
													<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
													</div>
													<input type="email" class="form-control" id="emailLoginEmail"
															 placeholder="enter email address"/>
												</div>
											</div>
											<button type="submit" class="btn btn-info">Log In</button>
										</form>
									</div>

									<div class="modal-footer">
										<div class="row">
											<div class="col-md-10 modal-footer-text">
												<p>This is the modal footer. This has been laid out using the Bootstrap grid. Thank
													you for clicking on this modal window. View the source code for more info.</p>
											</div>
											<div class="col-md-2">
												<button type="button" class="btn btn-info" data-dismiss="modal">× Close Me</button>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>

						<!--end of test area -->
					</nav>


					<!--this is another nav bar I am trying out-->
					<!--			this is the new test nav bar w tabs and drop down log in log out-->
					<div class="container">
						<h3>test nav bar 2</h3>
						<ul class="nav nav-tabs">
							<li class="active"><a href="#">Schedule View</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Log In/Out <span
										class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Log In</a></li>
									<li><a href="#">Log Out</a></li>
									<li><a href="#">Receive CupCake Consistent with Rank</a></li>
								</ul>
							</li>
							<li><a href="#">Request</a></li>
							<li><a href="#">Profile</a></li>
							<li><a href="#">Admin</a></li>
						</ul>
					</div>

		</header>
		<!-- Begin page content -->
		<!--		main box-->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">this is where the calendar will be</div>
						<div class="panel-body"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="page-header">
				<h1>Sticky footer</h1>
			</div>
			<p class="lead">These are just a bunch of place holder words.</p>
			<p>Use <a href="../sticky-footer-navbar">the sticky footer with a fixed navbar</a> if need be, too.
			</p>
		</div>
		</div>

		<div id="footer">
			<div class="container">
				<p class="text-muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a
						href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>
			</div>
		</div>
	</body>
</html>


<!--		this is my test area-->
<!--					moar test - buttons that collapse to a burger-->
<!-- Fixed navbar bottom -->
<!--<div class="navbar navbar-default navbar-fixed-top" role="navigation">-->
<!--	<div class="container-fluid">-->
<!---->
<!--		<div class="navbar-collapse collapse" id="navbar-footer">-->
<!---->
<!--			<ul class="nav navbar-nav navbar-right">-->
<!--				<li><button type="button" class="btn btn-warning navbar-btn"><span class="glyphicon glyphicon-check"></span> Log In</button></li>-->
<!--				<li><button type="button" class="btn btn-danger navbar-btn"><span class="glyphicon glyphicon-remove"></span> Log Out</button></li>-->
<!--				<li><button type="button" class="btn btn-success navbar-btn"><span class="glyphicon glyphicon-ok"></span> Activate</button></li>-->
<!--			</ul>-->
<!---->
<!--		</div><!--/.nav-collapse -->-->
<!---->
<!--		<div class="navbar-header">-->
<!--			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-footer">-->
<!--				<span class="sr-only">Toggle navigation</span>-->
<!--				<span class="icon-bar"></span>-->
<!--				<span class="icon-bar"></span>-->
<!--				<span class="icon-bar"></span>-->
<!--			</button>-->
<!---->
<!--		</div>-->
<!---->
<!--	</div>-->
<!--</div>-->

<!-- end of moar test-->


<!--		this is my test area-->
