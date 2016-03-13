<header>
	<div id="topButtons" class="pull-right">
		<a href="" class="btn btn-primary">Profile</a> <!-- this should bring in the user edit profile view
		<a href="" class="btn btn-warning">Admin</a> <!-- this should bring in the admin view -->
		<a href="/public_html/angularjs/pages/landingPage.php" class="btn btn-danger">Logout</a> <!-- TODO:this should end the session and return you to the landing page -->
	</div>

	<div id="mainHeader">
		<h1>Welcome to Time Crunch</h1>
	</div>

	<!-- Begin navbar-->
	<nav class="navbar navbar-default navbar-fixed-top navbar-inner">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
						  data-target="#bs-example-navbar-collapse-1" aria-expanded="false"
						  ng-click="navCollapsed = !navCollapsed">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Manage Your Schedule</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div id="bs-example-navbar-collapse-1" uib-collapse="navCollapsed">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown" uib-dropdown>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
							aria-expanded="false" uib-dropdown-toggle>Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu" uib-dropdown-menu>
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
				<!-- we don't need this searc box here afaik -->
<!--				<form class="navbar-form navbar-left" role="search">-->
<!--					<div class="form-group">-->
<!--						<input type="text" class="form-control" placeholder="Search">-->
<!--					</div>-->
<!--					<button type="submit" class="btn btn-default">Submit</button>-->
<!--				</form>-->
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#">Link 0<span class="sr-only">(current)</span></a></li>
					<li><a href="#">Link 1</a></li>
					<li><a href="#">FAQ</a></li>
					<li class="dropdown" uib-dropdown>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
							aria-expanded="false" uib-dropdown-toggle>Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu" uib-dropdown-menu>
							<li ng-repeat="page in pages"><a href="{{ page.href }}">{{ page.name }}</a></li>

						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

</header>