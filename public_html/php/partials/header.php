<header ng-controller="NavController">
	<bootstrap-breakpoint></bootstrap-breakpoint>

	<div id="topButtons" class="pull-right button-container">
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">Make Request</button> <!--TODO: put the modal here -->
		&nbsp;
		<a href="public_html/angularjs/templates/adminOnlyView.php" class="btn btn-warning">Admin</a> <!-- this should bring in the admin view -->
		&nbsp;
		<a href="public_html/angularjs/pages/landingPage.php" class="btn btn-danger">Logout</a>
		<!-- TODO:this should end the session and return you to the landing page -->
	</div>

	<div class="container-fluid" id="mainHeader">
		<h3>Welcome to Time Crunch</h3>
	</div>

	<!-- Begin navbar-->
	<nav class="navbar navbar-default navbar-inner">
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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
							aria-expanded="false" uib-dropdown-toggle>
							Add <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" uib-dropdown-menu>
							<li><a href="public_html/angularjs/templates/userSignUpForm.php">
									Add Member </a></li>
							<li><a href="public_html/angularjs/templates/buildCrewForm.php">
									Add Crew </a></li>
							<li><a href="public_html/angularjs/templates/addScheduleForm.php">
									Add Schedule</a></li>
						</ul>
					</li>

					<!--Edit-->
					<li class="dropdown" uib-dropdown>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
							aria-expanded="false" uib-dropdown-toggle>
							Edit <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" uib-dropdown-menu>
							<li><a href="public_html/angularjs/templates/userSignUpForm.php">
									Edit Member </a></li>
							<li><a href="public_html/angularjs/templates/buildCrewForm.php">
									Edit Crew </a></li>
							<li><a href="public_html/angularjs/templates/addScheduleForm.php">
									Edit Schedule</a></li>
						</ul>
					</li>
					<li><a href="public_html/angularjs/templates/userEditProfileView.php">
							Profile
						</a> <!-- this should bring in the user edit profile view-->
					</li>
					<li><a href="public_html/angularjs/templates/faqView.php">
							FAQ
						</a>
					</li>
				</ul>
			</div><!-- /.collapse-1 -->
		</div><!-- /.container-fluid -->
	</nav>
</header>


