<!-- Company Sign Up-->
<h2>First, sign up your Company or Group</h2>

<form name="adminSignUpForm" ng-submit="sendActivation();">
	<fieldset class="form-group">
		<label for="companyNameInput">Company Name</label>
		<input type="text" class="form-control" id="companyName" placeholder="Findley's Tacos" ng-model="signupData.companyName">
	</fieldset>

	<fieldset class="form-group">
		<label for="companyAttnInput">Attention Line</label>
		<input type="text" class="form-control" id="companyAttn" placeholder="Tacos Findley, CEO">
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyAddress1Input">Company Address 1</label>
		<input type="text" class="form-control" id="companyAddress1" placeholder="1600 Pennsylvania Ave NW">
	</fieldset>

	<fieldset class="form-group">
		<label for="companyAddress2Input">Company Address 2</label>
		<input type="text" class="form-control" id="companyAddress2" placeholder="Section 31">
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyCityInput">City</label>
		<input type="text" class="form-control" id="companyCity" placeholder="Albuquerque">
	</fieldset>

	<fieldset class="form-group">
		<label for="companyStateInput">State abbreviation</label>
		<input type="text" class="form-control" id="companyState" placeholder="NM">
	</fieldset>

	<fieldset class="form-group">
		<label for="companyZipInput">Zip Code</label>
		<input type="text" class="form-control" id="companyZip" placeholder="87102">
	</fieldset>

	<fieldset class="form-group">
		<label for="companyUrlInput">Company URL</label>
		<input type="text" class="form-control" id="companyUrl" placeholder="www.example.com">
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="companyEmailInput">Company Email address</label>
		<input type="text" class="form-control" id="companyEmail" placeholder="tacosFindley@wat.com">
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
		<input type="text" class="form-control" id="crewLocation" placeholder="Managers Only">
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
		<input type="text" class="form-control" id="userFirstName" placeholder="Suzy">
	</fieldset>

	<fieldset class="form-group">
		<label for="userLastNameInput">Manager Last Name</label>
		<input type="text" class="form-control" id="userLastName" placeholder="Hughes">
	</fieldset>

	<fieldset class="form-group">
		<label for="userPhoneInput">Manager Phone Number</label>
		<input type="text" class="form-control" id="userPhone" placeholder="505-555-1212">
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="userEmailInput">Manager Email Address</label>
		<input type="text" class="form-control" id="userEmail" placeholder="suzyHughes@tacos.com">
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