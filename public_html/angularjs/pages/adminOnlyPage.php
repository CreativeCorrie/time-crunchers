<!--this page will contain Admin functions including

0 - create, get and update
a - company this user is an admin of
b - crews this user has created (get an array of crews)
c - employee invites this user has sent (get an array of employees)

1 - read and respond to requests from the user's employees

2 - create, get and update user profiles this user is an admin of

3 - return to schedule view (link to scheduleView)
-->
<div class="row">
	<div class="col-xs-12">
		<h1>Administrator's View</h1>
	</div>
</div>

<!-- Users -->
	<div class="row">
		<div class="col-md-6">
			<h3>Manage Members</h3>
			<ul class="">
				<li><a href="userSignUpForm/">Create and Invite New Member</a></li> <!--need angular to load userSignUpForm-->
				<li><a href="memberSearchForm/">Find/Edit Member</a></li> <!--TODO: can we make this a wildcard search ?-->
<!--				<li><a href="#"></a></li>-->
			</ul>
		</div> <!-- /of users' -->

		<!-- Create Schedules and Shift-->

		<h3>Manage Crews</h3>
		<div class="col-md-6">
			<ul class="">
				<li><a href="buildCrewForm/">Create a Crew</a></li>  <!-- ??-->
				<ul>
					<li><a href="addScheduleForm/">Create Shifts</a></li> <!-- ??-->
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
				<li><a href="adminRequestView/">See Requests</a></li>
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
		<br>
		<div class="col-md-6">
			<div class="button-container">
				<a href="calendarView/" class="btn btn-warning">Return to Schedule View</a>
			</div>
		</div>
	</div> <!-- /row -->





