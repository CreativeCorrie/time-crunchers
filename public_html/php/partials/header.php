<header ng-controller="NavController">
	<bootstrap-breakpoint></bootstrap-breakpoint>

	<div class="container-fluid" id="mainHeader">
		<h3>Welcome to Time Crunch</h3>
	</div>

	<div id="topButtons" class="pull-right button-container">
		<button type="button" class="btn btn-info" ng-click="openRequest();"">Request</button>
		&nbsp;
		<a href="calendarView/" class="btn btn-warning">Schedule</a> <!-- this should bring in the admin view -->
		&nbsp;
		<a href="landingPage/" class="btn btn-danger">Logout</a>
	</div>

</header>
	<!-- Begin navbar-->
	<nav class="navbar navbar-default navbar-static-top navbar-inner">
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
					<li><a href="adminOnlyPage/">
							Admin <!-- TODO:need to restrict this view to admin only -->
						</a>
					</li>

					<li><a href="userEditProfileView/">
							Profile
						</a> <!-- this should bring in the user edit profile view-->
					</li>
					<li><a href="faqView/">
							FAQ
						</a>
					</li>
				</ul>
			</div><!-- /.collapse-1 -->
		</div><!-- /.container-fluid -->
	</nav>



