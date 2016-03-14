
<!--this is the form for creating a crew-->

<!-- Crew Sign Up-->
<!--		TODO: add Angualar.js here to connect to Crew API-->
<h2>Now, create your first Crew for this company.</h2>

<form>

	<fieldset class="form-group">
		<label for="crewLocationInput">Crew Location</label>
		<input type="text" class="form-control" id="crewLocation" placeholder="Managers Only">
		<small class="text-muted">
			This name is how you will differentiate your crews.
		</small>
	</fieldset>


	<fieldset class="form-group">
		<label for="crewAddress1Input">Crew Address 1</label>
		<input type="text" class="form-control" id="crewAddress1" placeholder="1920 Grand Plaza NW">
	</fieldset>

	<fieldset class="form-group">
		<label for="crewAddress2Input">Crew Address 2</label>
		<input type="text" class="form-control" id="crewAddress2" placeholder="Section 31">
		<small class="text-muted">
			This field is optional.
		</small>
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
		<input type="text" class="form-control" id="userFirstName" placeholder="Talia">

		<label for="userLastNameInput">Employee Last Name</label>
		<input type="text" class="form-control" id="userLastName" placeholder="Martinez">
	</fieldset>

	<fieldset class="form-group">
		<label for="userPhoneInput">Employee Phone Number</label>
		<input type="text" class="form-control" id="userPhone" placeholder="999-888-7777">
		<small class="text-muted">
			This field is optional.
		</small>
	</fieldset>

	<fieldset class="form-group">
		<label for="userEmailInput">Employee Email Address</label>
		<input type="text" class="form-control" id="userEmail" placeholder="taliamartinez@tacos.com">
		<p class="text-danger">This is the email address your activation code will be sent to.</p>
	</fieldset>
	<br>
	<hr>

	<!-- Submit Form or Reset Form -->
	<!--		TODO: add Angular.js here to connect to User API-->
	<p>Great! When you submit this form you and your employees will receive an email from "Time Crunch". Your employees will recieve an email with an activation link to
		reset their password. However, your email is just a comfirmation.</p>
	<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
	<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i> Reset Form</button>



</form>