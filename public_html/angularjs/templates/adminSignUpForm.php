<!-- Company Sign Up-->
<h2>First, sign up your Company or Group</h2>

<form name="adminSignUpForm" ng-submit="sendActivation(signupData, adminSignUpForm.$valid);">
	<fieldset class="form-group">
		<label for="companyNameInput">Company Name</label>
		<input type="text" class="form-control" name="companyName" id="companyName"
				 placeholder="Findley's Tacos" ng-model="signupData.companyName"
				 ng-minlength="6" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyName.$error"
			  ng-if="adminSignUpForm.companyName.$touched" ng-hide="adminSignUpForm.companyName.$valid">
			<p ng-message="minlength">Name is too short.</p>
			<p ng-message="maxlength">Name is too long.</p>
			<p ng-message="required">Please enter your name.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyAttnInput">Attention Line</label>
		<input type="text" class="form-control" name="companyAttn" id="companyAttn"
				 placeholder="Tacos Findley, CEO" ng-model="signupData.companyAttn"
				 ng-minlength="6" ng-maxlength="128" ng-required="false"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyAttn.$error"
			  ng-if="adminSignUpForm.companyAttn.$touched" ng-hide="adminSignUpForm.companyAttn.$valid">
			<p ng-message="minlength">Attention name is too short.</p>
			<p ng-message="maxlength">Attention name is too long.</p>
			<p ng-message="required">Please enter your Attention name.</p>
		</div>
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyAddress1Input">Company Address 1</label>
		<input type="text" class="form-control" name="companyAddress1" id="companyAddress1"
				 placeholder="1600 Pennsylvania Ave NW" ng-model="signupData.companyAddress1"
				 ng-minlength="6" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyAddress1.$error"
			  ng-if="adminSignUpForm.companyAddress1.$touched" ng-hide="adminSignUpForm.companyAddress1.$valid">
			<p ng-message="minlength">Address is too short.</p>
			<p ng-message="maxlength">Address name is too long.</p>
			<p ng-message="required">Please enter your address.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyAddress2Input">Company Address 2</label>
		<input type="text" class="form-control" name="companyAddress2" id="companyAddress2"
				 placeholder="Section 31" ng-model="signupData.companyAddress2"
				 ng-minlength="6" ng-maxlength="128" ng-required="false"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyAddress2.$error"
			  ng-if="adminSignUpForm.companyAddress2.$touched" ng-hide="adminSignUpForm.companyAddress2.$valid">
			<p ng-message="minlength">Address is too short.</p>
			<p ng-message="maxlength">Address name is too long.</p>
			<p ng-message="required">Please enter your address.</p>
		</div>
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyCityInput">City</label>
		<input type="text" class="form-control" name="companyCity" id="companyCity"
				 placeholder="Albuquerque" ng-model="signupData.companyCity"
				 ng-minlength="6" ng-maxlength="32" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyCity.$error"
			  ng-if="adminSignUpForm.companyCity.$touched" ng-hide="adminSignUpForm.companyCity.$valid">
			<p ng-message="minlength">City is too short.</p>
			<p ng-message="maxlength">City name is too long.</p>
			<p ng-message="required">Please enter your city.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyStateInput">State abbreviation</label>
		<input type="text" class="form-control" name="companyState" id="companyState"
				 placeholder="NM" ng-model="signupData.companyState"
				 ng-minlength="2" ng-maxlength="2" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyState.$error"
			  ng-if="adminSignUpForm.companyState.$touched" ng-hide="adminSignUpForm.companyState.$valid">
			<p ng-message="minlength">State is too short.</p>
			<p ng-message="maxlength">State name is too long.</p>
			<p ng-message="required">Please enter your state.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyZipInput">Zip Code</label>
		<input type="text" class="form-control" name="companyZip" id="companyZip"
				 placeholder="87102" ng-model="signupData.companyZip"
				 ng-minlength="5" ng-maxlength="10" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyZip.$error"
			  ng-if="adminSignUpForm.companyZip.$touched" ng-hide="adminSignUpForm.companyZip.$valid">
			<p ng-message="minlength">Zip code is too short.</p>
			<p ng-message="maxlength">Zip code name is too long.</p>
			<p ng-message="required">Please enter your zip code.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyUrlInput">Company URL</label>
		<input type="text" class="form-control" name="companyUrl" id="companyUrl"
				 placeholder="www.example.com" ng-model="signupData.companyUrl"
				 ng-minlength="6" ng-maxlength="128" ng-required="false"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyUrl.$error"
			  ng-if="adminSignUpForm.companyUrl.$touched" ng-hide="adminSignUpForm.companyUrl.$valid">
			<p ng-message="minlength">Url is too short.</p>
			<p ng-message="maxlength">Url name is too long.</p>
			<p ng-message="required">Please enter your url.</p>
		</div>
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyEmailInput">Company Email address</label>
		<input type="text" class="form-control" name="companyEmail" id="companyEmail"
				 placeholder="tacosFindley@wat.com" ng-model="signupData.companyEmail"
				 ng-minlength="6" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.companyEmail.$error"
			  ng-if="adminSignUpForm.companyEmail.$touched" ng-hide="adminSignUpForm.companyEmail.$valid">
			<p ng-message="minlength">Email is too short.</p>
			<p ng-message="maxlength">Email name is too long.</p>
			<p ng-message="required">Please enter your email.</p>
		</div>
	</fieldset>


	<br>
	<hr>
	<!-- Crew creation-->
	<!--		TODO: add Angular.js here to connect to Crew API-->
	<h2>Next, create your first crew.</h2>
	<p class="text-danger">
		This will be <em>your</em> crew and the crew for any additional administrators.
	</p>


	<fieldset class="form-group">
		<label for="crewLocationInput">Crew Location</label>
		<input type="text" class="form-control" name="crewLocation" id="crewLocation"
				 placeholder="Managers Only" ng-model="signupData.crewLocation"
				 ng-minlength="6" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.crewLocation.$error"
			  ng-if="adminSignUpForm.crewLocation.$touched" ng-hide="adminSignUpForm.crewLocation.$valid">
			<p ng-message="minlength">Location name is too short.</p>
			<p ng-message="maxlength">Location name is too long.</p>
			<p ng-message="required">Please enter a loction for this crew.</p>
		</div>
		<small class="text-muted">
			This name is how you will differentiate your crews.
		</small>
	</fieldset>


	<!-- Admin sign up = user sign up-->
	<!--		TODO: add Angualar.js here to connect to User API-->
	<br>
	<hr>
	<h2>Ok, let's create <em>your</em> user profile</h2>
	<p class="text-danger">
		You shall be granted admin access.
	</p>

	<fieldset class="form-group">
		<label for="userFirstNameInput">Manager First Name</label>
		<input type="text" class="form-control" name="userFirstName" id="userFirstName"
				 placeholder="Suzy" ng-model="signupData.userFirstName"
				 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.userFirstName.$error"
			  ng-if="adminSignUpForm.userFirstName.$touched" ng-hide="adminSignUpForm.userFirstName.$valid">
			<p ng-message="minlength">First name is too short.</p>
			<p ng-message="maxlength">First name is too long.</p>
			<p ng-message="required">Please enter your first name.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="userLastNameInput">Manager Last Name</label>
		<input type="text" class="form-control" name="userLastName" id="userLastName"
				 placeholder="Hughes" ng-model="signupData.userLastName"
				 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.userLastName.$error"
			  ng-if="adminSignUpForm.userLastName.$touched" ng-hide="adminSignUpForm.userLastName.$valid">
			<p ng-message="minlength">Last name is too short.</p>
			<p ng-message="maxlength">Last name is too long.</p>
			<p ng-message="required">Please enter your last name.</p>
		</div>
	</fieldset>

	<fieldset class="form-group">
		<label for="userPhoneInput">Manager Phone Number</label>
		<input type="text" class="form-control" name="userPhone" id="userPhone"
				 placeholder="505-555-1212" ng-model="signupData.userPhone"
				 ng-minlength="10" ng-maxlength="32" ng-required="false"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.userPhone.$error"
			  ng-if="adminSignUpForm.userPhone.$touched" ng-hide="adminSignUpForm.userPhone.$valid">
			<p ng-message="minlength">Phone number is too short.</p>
			<p ng-message="maxlength">Phone number is too long.</p>
			<p ng-message="required">Please enter your phone number.</p>
		</div>
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="userEmailInput">Manager Email Address</label>
		<input type="text" class="form-control" name="userEmail" id="userEmail"
				 placeholder="suzyHughes@tacos.com" ng-model="signupData.userEmail"
				 ng-minlength="6" ng-maxlength="128" ng-required="true"/>
		<div class="alert alert-danger" role="alert" ng-messages="adminSignUpForm.userEmail.$error"
			  ng-if="adminSignUpForm.userEmail.$touched" ng-hide="adminSignUpForm.userEmail.$valid">
			<p ng-message="minlength">Email is too short.</p>
			<p ng-message="maxlength">Email is too long.</p>
			<p ng-message="required">Please enter your email.</p>
		</div>

		<p class="text-danger">This is the email address your activation code will be sent to.</p>
	</fieldset>
	<br>
	<hr>

	<!-- Submit Form or Reset Form -->
	<!--		TODO: add Angular.js here to connect to User API-->
	<p>Great! When you submit this form you will receive an email from "Time Crunch" with an activation link to
		reset your password.</p>
	<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
	<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i> Reset Form</button>

</form>