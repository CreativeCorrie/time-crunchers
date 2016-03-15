<!-- Create employee Invites-->
<div>
	<h2>Now you're ready to invite users to your Time Crunch Schedule</h2>

	<p class="text-danger">Each user will be added to one of the crews you created previously.</p>
	<form name="userSignUpForm" ng-submit="sendActivation(signupData, userSignUpForm.$valid);">
		<fieldset class="form-group">
			<label for="userFirstNameInput">First Name</label>
			<input type="text" class="form-control" name="userFirstName" id="userFirstName"
					 placeholder="Talia" ng-model="signupData.userFirstName"
					 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userFirstName.$error"
				  ng-if="userSignUpForm.userFirstName.$touched" ng-hide="userSignUpForm.userFirstName.$valid">
				<p ng-message="minlength">Name is too short.</p>
				<p ng-message="maxlength">Name is too long.</p>
				<p ng-message="required">Please enter your name.</p>
			</div>
		</fieldset>

		<fieldset class="form-group">
			<label for="userLastNameInput">Last Name</label>
			<input type="text" class="form-control" name="userLastName" id="userLastName"
					 placeholder="Smith" ng-model="signupData.userLastName"
					 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userLastName.$error"
				  ng-if="userSignUpForm.userLastName.$touched" ng-hide="userSignUpForm.userLastName.$valid">
				<p ng-message="minlength">Name is too short.</p>
				<p ng-message="maxlength">Name is too long.</p>
				<p ng-message="required">Please enter your name.</p>
			</div>
		</fieldset>

		<fieldset class="form-group">
			<label for="userPhoneInput">Phone Number</label>
			<input type="text" class="form-control" name="userPhone" id="userPhone"
					 placeholder="505-555-1212" ng-model="signupData.userPhone"
					 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userPhone.$error"
				  ng-if="userSignUpForm.userPhone.$touched" ng-hide="userSignUpForm.userPhone.$valid">
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
					 placeholder="talia@luna.com" ng-model="signupData.userEmail"
					 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userEmail.$error"
				  ng-if="userSignUpForm.userEmail.$touched" ng-hide="userSignUpForm.userEmail.$valid">
				<p ng-message="minlength">Email number is too short.</p>
				<p ng-message="maxlength">Email number is too long.</p>
				<p ng-message="required">Please enter your email address.</p>
			</div>
			<p class="text-danger">This is the email address the activation code will be sent to.</p>
		</fieldset>

		<!-- Submit Form or Reset Form -->
		<!--		TODO: add Angular.js here to connect to User API, upon submit - redirect to this page again-->
		<p>Great! When you submit this form this user will receive an email from "Time Crunch" with an activation link to
			reset their password.</p>
		<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
		<button class="btn btn-info" type="reset"><i class="fa fa-ban"></i>Reset Form</button>

		<!--is user admin? code from http://www.bootply.com/0WvI1g4DEq-->
		<h3>Will this user be an administrator?</h3>
		<div class="input-group">
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-default">
					<input checked="checked" name="options" id="option1" type="radio"> Yes
				</label>
				<label class="btn btn-default">
					<input name="options" id="option2" type="radio"> No
				</label>
			</div>
		</div>
	</form>
	<br>
	<div class="col-md-6">
		<div class="button-container">
			<a href="calendarView/" class="btn btn-warning">Return to Schedule View</a>
		</div>
	</div>
</div>