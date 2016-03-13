<!--this page will contain Admin functions including

0 - create, get and update
a - company this user is an admin of
b - crews this user has created (get an array of crews)
c - employee invites this user has sent (get an array of employees)

1 - read and respond to requests from the user's employees

2 - create, get and update user profiles this user is an admin of

3 - return to schedule view (link to scheduleView)
-->
<h1>Administrator's View</h1>

<!-- Users -->
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h3>Employees / Group Members</h3>
			<ul class="">
				<li><a href="#">Create and Invite a New Member</a></li> <!--need angular to load userSignUpForm-->
				<li><a href="#">Get Member by First & Last Name</a></li>    <!--must add first & last name-->
				<li><a href="#">Get Crew by Crew Location</a></li>  <!--TODO: can we make this a wildcard search ?-->
			</ul>
		</div> <!-- /of users' -->

		<!-- Create Schedules and Shift-->

		<h3>Create a Schedule & Shifts</h3>
		<div class="col-md-6">
			<ul class="">
				<li><a href="#">Create a Schedule</a></li>  <!-- ??-->
				<ul>
					<li><a href="#">Create Shifts for the Schedule</a></li> <!-- ??-->
				</ul>
				<li><a href="#">Assign Members to Shifts</a></li> <!--?? -->
			</ul>
		</div> <!-- /schedules & shifts -->

	</div>  <!-- /row -->

	<!-- requests -->
	<div class="row">
		<div class="col-md-6">
			<h3>Schedule Change Requests</h3>
			<ul class="">
				<li><a href="#">See Requests</a></li> <!-- Get all requests -->a table with check boxes?
			</ul>
		</div> <!-- /requests -->

		<!-- View all the things-->
		<h3>View All..</h3>
		<div class="col-md-6">
			<ul class="">
				<li><a href="#">View All of your Crews</a></li>  <!-- get all crews by company id-->
				<ul>
					<li><a href="#">View All Members of a Crew</a></li> <!-- get users by crew id -->
				</ul>
				<li><a href="#">View All of your Members</a></li>
				<!--get all users by (company injection) & crew id -->
			</ul>
		</div> <!-- /of all the things (oh noes!) -->

		<br>
		<a href="../pages/calendarView.php">Return to Schedule View</a>
	</div> <!-- /row -->
</div> <!-- /container-->




