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
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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