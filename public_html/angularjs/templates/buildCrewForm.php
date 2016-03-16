<!--this is the form for creating a crew-->

<!-- Crew Sign Up-->

<h2>Create a New Crew</h2>

<form name="buildCrewForm" ng-submit="createCrew(crewData, buildCrewForm.$valid);">

	<fieldset class="form-group">
		<label for="crewLocationInput">Crew Location</label>
		<input type="text" class="form-control" name="crewLocation" id="crewLocation"
				 placeholder="Rio Rancho #4" ng-model="crewData.crewLocation"
				 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="buildCrewForm.crewLocation.$error"
			  ng-if="buildCrewForm.crewLocation.$touched" ng-hide="buildCrewForm.crewLocation.$valid">
			<p ng-message="minlength">Location of the crew is too short.</p>
			<p ng-message="maxlength">Location of the crew is too long.</p>
			<p ng-message="required">Please enter the location of the crew.</p>
		</div>
		<p class="text-danger">
			This name should be unique so you can distinguish one crew from another.
		</p>
	</fieldset>
	</br>

	<hr>

	<!--add angular so that this affects how many of the last section shows up-->
	<label for="crewMemberInput">
		<h4>Choose the size of your Crew</h4>
	</label>
	<legend>Add employees to this crew</legend>
	<p>
		<select id="myList">
			<option value 0>select the amount you would like to add</option>
			<option value 1>5 employees</option>
			<option value 2>10 employees</option>
			<option value 3>20 employees</option>
			<option value 4>40 employees</option>
		</select>
	</p>

	<hr>
	</br>

	<!--add angular to create multiple of this section for multiple employees-->
	<fieldset class="form-group">
		<label for="userFirstNameInput">Employee First Name</label>
		<input type="text" class="form-control" name="userFirstName" id="userFirstName"
				 placeholder="Talia" ng-model="crewData.userFirstName"
				 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="buildCrewForm.userFirstName.$error"
			  ng-if="buildCrewForm.userFirstName.$touched" ng-hide="buildCrewForm.userFirstName.$valid">
			<p ng-message="minlength">First name is too short.</p>
			<p ng-message="maxlength">First name is too long.</p>
			<p ng-message="required">Please enter your first name.</p>
		</div>

		<label for="userLastNameInput">Employee Last Name</label>
		<input type="text" class="form-control" name="userLastName" id="userLastName"
				 placeholder="Martinez" ng-model="crewData.userLastName"
				 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="buildCrewForm.userLastName.$error"
			  ng-if="buildCrewForm.userLastName.$touched" ng-hide="buildCrewForm.userLastName.$valid">
			<p ng-message="minlength">Last name is too short.</p>
			<p ng-message="maxlength">Last name is too long.</p>
			<p ng-message="required">Please enter your last name.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="userPhoneInput">Employee Phone Number</label>
		<input type="text" class="form-control" name="userPhone" id="userPhone"
				 placeholder="999-888-7777" ng-model="crewData.userPhone"
				 ng-minlength="12" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="buildCrewForm.userPhone.$error"
			  ng-if="buildCrewForm.userPhone.$touched" ng-hide="buildCrewForm.userPhone.$valid">
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
		<input type="text" class="form-control" id="userEmail"
				 placeholder="taliamartinez@tacos.com" ng-model="crewData.userEmail"
				 ng-minlength="6" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="buildCrewForm.userEmail.$error"
			  ng-if="buildCrewForm.userEmail.$touched" ng-hide="buildCrewForm.userEmail.$valid">
			<p ng-message="minlength">Email is too short.</p>
			<p ng-message="maxlength">Email name is too long.</p>
			<p ng-message="required">Please enter your email.</p>
		</div>
		<p class="text-danger">This is the email address your activation code will be sent to.</p>
	</fieldset>
	<br>
	<hr>

	<!-- Submit Form or Reset Form -->
	<!--		TODO: add Angular.js here to connect to User API-->
	<p>Great! When you submit this form you and your employees will receive an email from "Time Crunch". Your employees
		will recieve an email with an activation link to
		reset their password. However, your email is just a comfirmation.</p>
	<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
	<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i> Reset Form</button>


</form>