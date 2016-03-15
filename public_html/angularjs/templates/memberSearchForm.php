<!-- Search for Members by First & Last Name or Email-->
<div>
	<h2>Search for Member</h2>

	<p class="text-danger">Please enter Member's First <em>AND</em> Last Name.</p>
	<form name="memberSearchForm" ng-submit="sendActivation(signupData, userSignUpForm.$valid);">
		<fieldset class="form-group">
			<label for="userFirstNameInput">Member First Name</label>
			<input type="text" class="form-control" name="userFirstName" id="userFirstName"
					 placeholder="Bob" ng-model="memberSearchForm.userFirstName"
					 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="memberSearchForm.userFirstName.$error"
				  ng-if="memberSearchForm.userFirstName.$touched" ng-hide="memberSearchForm.userFirstName.$valid">
				<p ng-message="minlength">Name is too short.</p>
				<p ng-message="maxlength">Name is too long.</p>
				<p ng-message="required">Please enter your name.</p>
			</div>
		</fieldset>
		<fieldset class="form-group">
			<label for="userLastNameInput">Member Last Name</label>
			<input type="text" class="form-control" name="userLastName" id="userLastName"
					 placeholder="Dobbs" ng-model="memberSearchForm.userLastName"
					 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="memberSearchForm.userLastName.$error"
				  ng-if="memberSearchForm.userLastName.$touched" ng-hide="memberSearchForm.userLastName.$valid">
				<p ng-message="minlength">Name is too short.</p>
				<p ng-message="maxlength">Name is too long.</p>
				<p ng-message="required">Please enter your name.</p>
			</div>
		</fieldset>

		<h3><em>Or</em></h3>
		<fieldset class="form-group">  <!-- get user by email address -->
			<label for="userEmailInput">Member Email Address</label>
			<input type="text" class="form-control" name="userEmail" id="userEmail"
					 placeholder="bob@cosg.com" ng-model="memberSearchForm.userEmail"
					 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="memberSearchForm.userEmail.$error"
				  ng-if="memberSearchForm.userEmail.$touched" ng-hide="memberSearchForm.userEmail.$valid">
				<p ng-message="minlength">Email is too short.</p>
				<p ng-message="maxlength">Email is too long.</p>
				<p ng-message="required">Please enter your email.</p>
			</div>
		</fieldset>


		<!-- Submit Form or Reset Form -->
		<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
		<button class="btn btn-info" type="reset"><i class="fa fa-ban"></i>Reset Form</button>
	</form>
	<br>

	<!--show results here-->


	<br>
	<div class="col-md-6">
		<div class="button-container">
			<a href="calendarView/" class="btn btn-warning">Return to Schedule View</a>
		</div>
	</div>
</div>