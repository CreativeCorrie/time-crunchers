<!-- Edit Profile
	0) get the user by first & last name or email
	1) restrict edits to email and phone number for non admin
	2) submit to user class and redirect back to main (calendar) -->
<div>
	<h2>Edit Your Profile</h2>

	<p class="text-danger">You can change your Email & Phone Number.  If you need to change your first or last name please contact an admin.</p>
	<form name="userEditProfileView" ng-submit="updateUser(userData, userEditProfileView.$valid);">
		<fieldset class="form-group">
			<label for="userPhoneInput">Phone Number</label>
			<input type="text" class="form-control" name="userPhone" id="userPhone"
					 placeholder="505-555-1212" ng-model="userData.userPhone"
					 ng-minlength="12" ng-maxlength="128" ng-required="false"/>
			<div class="alert alert-danger" role="alert" ng-messages="userEditProfileView.userPhone.$error"
				  ng-if="userEditProfileView.userPhone.$touched" ng-hide="userEditProfileView.userPhone.$valid">
				<p ng-message="minlength">Phone number is too short.</p>
				<p ng-message="maxlength">Phone number is too long.</p>
				<p ng-message="required">Please enter your phone number.</p>
			</div>
			<small class="text-muted">
				This field is optional.
			</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="userEmailInput">Employee Email Address</label>
			<input type="text" class="form-control" name="userEmail" id="userEmail"
					 placeholder="talia@luna.com" ng-model="userData.userEmail"
					 ng-minlength="12" ng-maxlength="128" ng-required="false"/>
			<div class="alert alert-danger" role="alert" ng-messages="userEditProfileView.userEmail.$error"
				  ng-if="userEditProfileView.userEmail.$touched" ng-hide="userEditProfileView.userEmail.$valid">
				<p ng-message="minlength">Email is too short.</p>
				<p ng-message="maxlength">Email is too long.</p>
				<p ng-message="required">Please enter your email address.</p>
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