<!-- Search for Members by First & Last Name or Email-->
<div>
	<h2>Search for Member</h2>

	<p class="text-danger">Please enter Member's First <em>AND</em> Last Name.</p>
	<form>
		<fieldset class="form-group">
			<label for="userFirstNameInput">Member First Name</label>
			<input type="text" class="form-control" id="userFirstName" placeholder="Bob">
		</fieldset>
		<fieldset class="form-group">
			<label for="userLastNameInput">Member Last Name</label>
			<input type="text" class="form-control" id="userLastName" placeholder="Dobbs">
		</fieldset>

		<h3><em>Or</em></h3>
		<fieldset class="form-group">  <!-- get user by email address -->
			<label for="userEmailInput">Member Email Address</label>
			<input type="text" class="form-control" id="userLastName" placeholder="bob@cosg.com">
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