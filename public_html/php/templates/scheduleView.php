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

									<!--Collapsible buttons-->
									<ul class="nav navbar-nav navbar-right">
										<li>
											<button type="button" class="btn btn-warning navbar-btn" id="activate"
													  data-toggle="modal"
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
											<button type="button" class="btn btn-success navbar-btn id=" signIn
											" data-toggle="modal"
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
												<button type="button" class="btn btn-info" data-dismiss="modal">Close Me</button>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>

					</nav>


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
					<p>
						We shall say 'Ni' again to you, if you do not appease us.

						How do you know she is a witch? …Are you suggesting that coconuts migrate? Well, we did do the nose.
						Listen. Strange women lying in ponds distributing swords is no basis for a system of government.
						Supreme executive power derives from a mandate from the masses, not from some farcical aquatic
						ceremony.

						I am your king. Shh! Knights, I bid you welcome to your new home. Let us ride to Camelot! You don't
						frighten us, English pig-dogs! Go and boil your bottoms, sons of a silly person! I blow my nose at
						you, so-called Ah-thoor Keeng, you and all your silly English K-n-n-n-n-n-n-n-niggits!
						Why?

						Shh! Knights, I bid you welcome to your new home. Let us ride to Camelot! Be quiet! Well, we did do
						the nose. Did you dress her up like this? And the hat. She's a witch!

						Bloody Peasant!
						Shut up! Will you shut up?!
						Why?

						How do you know she is a witch?

						Burn her! I don't want to talk to you no more, you empty-headed animal food trough water! I fart in
						your general direction! Your mother was a hamster and your father smelt of elderberries! Now leave
						before I am forced to taunt you a second time!

						She looks like one.
						It's only a model.
						Listen. Strange women lying in ponds distributing swords is no basis for a system of government.
						Supreme executive power derives from a mandate from the masses, not from some farcical aquatic
						ceremony.

						The Lady of the Lake, her arm clad in the purest shimmering samite, held aloft Excalibur from the
						bosom of the water, signifying by divine providence that I, Arthur, was to carry Excalibur. That is
						why I am your king. Well, I didn't vote for you.

						We want a shrubbery!! I don't want to talk to you no more, you empty-headed animal food trough water!
						I fart in your general direction! Your mother was a hamster and your father smelt of elderberries! Now
						leave before I am forced to taunt you a second time!

						Where'd you get the coconuts? The Knights Who Say Ni demand a sacrifice! Shut up! Will you shut up?!
						Burn her!

						And this isn't my nose. This is a false one. Why? You can't expect to wield supreme power just 'cause
						some watery tart threw a sword at you! Shh! Knights, I bid you welcome to your new home. Let us ride
						to Camelot!

						Burn her! Ni! Ni! Ni! Ni! On second thoughts, let's not go there. It is a silly place. We shall say
						'Ni' again to you, if you do not appease us. And this isn't my nose. This is a false one. I don't want
						to talk to you no more, you empty-headed animal food trough water! I fart in your general direction!
						Your mother was a hamster and your father smelt of elderberries! Now leave before I am forced to taunt
						you a second time!

						You don't vote for kings. What do you mean? Bloody Peasant! I am your king. Well, I didn't vote for
						you. Oh! Come and see the violence inherent in the system! Help, help, I'm being repressed!

						Bloody Peasant! Ni! Ni! Ni! Ni! Found them? In Mercia?! The coconut's tropical! Now, look here, my
						good man. I dunno. Must be a king.
					</p>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="page-header">
				<h1>Sticky footer</h1>
			</div>
			<p class="lead">These are just a bunch of place holder words.</p>
		</div>

		<div id="footer">
			<div class="container">
					<a href="mailto:timecrunch@timecrunch.com">Contact the authors of Time Crunch</a></p>
			</div>
		</div>
	</body>
</html>



