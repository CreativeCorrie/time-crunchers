<!-- Get Crew Form
	0) get the crew by crew Location
	1) restrict edits to admin only
	2) submit to user class and redirect back to main (calendar) -->
<div>
	<h2>Manage your Crews</h2>

	<p class="text-danger">You can change your Email & Phone Number.  If you need to change your first or last name please contact an admin.</p>
	<form name="userEditProfileView">
		<fieldset class="form-group">
			<label for="userPhoneInput">Phone Number</label>
			<input type="text" class="form-control" id="userPhone" placeholder="505-555-1212">
			<small class="text-muted">
				This field is optional.
			</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="userEmailInput">Employee Email Address</label>
			<input type="text" class="form-control" id="userEmail" placeholder="talia@luna.com">
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