<!-- Get Crew Form
	0) get the crew by crew Location
	1) restrict edits to admin only
	2) submit to user class and redirect back to main (calendar) -->
<div>
	<h2>Manage your Crews</h2>

	<p class="text-danger">Create New Crew</p>
	<form name="userSignUpForm" ng-submit="createCrew(crewData, getCrewForm.$valid);">
		<fieldset class="form-group">
			<label for="getCrewFormInput">Phone Number</label>
			<input type="text" class="form-control" name="userPhone" id="userPhone"
					 placeholder="505-555-1212" ng-model="crewData.userPhone"
					 ng-minlength="12" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="getCrewForm.userPhone.$error"
				  ng-if="getCrewForm.userPhone.$touched" ng-hide="getCrewForm.userPhone.$valid">
				<p ng-message="minlength">Phone number is too short.</p>
				<p ng-message="maxlength">Phone number name is too long.</p>
				<p ng-message="required">Please enter your phone number.</p>
			</div>
			<small class="text-muted">
				This field is optional.
			</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="userEmailInput">Employee Email Address</label>
			<input type="text" class="form-control" name="userEmail" id="userEmail"
					 placeholder="talia@luna.com" ng-model="crewData.userEmail"
					 ng-minlength="6" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="getCrewForm.userEmail.$error"
				  ng-if="getCrewForm.userEmail.$touched" ng-hide="getCrewForm.userEmail.$valid">
				<p ng-message="minlength">Email is too short.</p>
				<p ng-message="maxlength">Email name is too long.</p>
				<p ng-message="required">Please enter your email.</p>
			</div>
			<p class="text-danger">This is the email address the activation code will be sent to.</p>
		</fieldset>

		<!-- Submit Form or Reset Form -->
		<!--		TODO: add Angular.js here to connect to User API, upon submit - redirect to this page again-->
		<p>Great! When you have finished editing your information submit your form.</p>
		<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
		<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i>Reset Form</button>
	</form>
	<br>
	<a href="calendarView/">Return to Schedule View</a>
</div>