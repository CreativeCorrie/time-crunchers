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

<!-- Members and Crews-->
<div class="row">
	<div class="col-md-4">
		<h3>Manage Members & Crews</h3>
		<ul class="">
			<li><a href="userSignUpForm/">Create New Members & Crews</a></li>
			<li><a href="buildCrewForm/">Create a Crew</a></li>
		</ul>
	</div> <!-- /of users' -->

	<!--Schedule change requests-->
	<div class="col-md-4">
		<h3>Schedule Change Requests</h3>
		<ul class="">
			<li><a href="listRequests/">See Requests</a></li>
		</ul>
	</div> <!-- /requests -->

	<!-- View all the things-->
	<h3>Coming Soon</h3>
	<div class="col-md-4">
		<ul class="">
			<!--<li><a href="#">View All of your Crews</a></li>   get all crews by company id-->
			<!-- <li><a href="#">View All Members of a Crew</a></li> get users by crew id -->
<!--			<li><a href="#">View All of your Members</a></li>-->
			<!--get all users by (company injection) & crew id -->
		</ul>
	</div> <!-- /of all the things (oh noes!) -->
</div> <!-- end of row -->
<br>

<div class="row">
	<div class="col-md-4">
		<div class="button-container">
			<a href="calendarView/" class="btn btn-warning">Return to Schedule View</a>
		</div>
	</div>
</div> <!-- /row -->





