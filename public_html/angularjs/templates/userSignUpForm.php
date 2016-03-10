<!-- Create employee Invites-->
<div>
	<h2>Now you're ready to invite users to your Time Crunch Schedule</h2>

	<p class="text-danger">Each user will be added to one of the crews you created previously.</p>
	<form>
		<fieldset class="form-group">
			<label for="userFirstNameInput">First Name</label>
			<input type="text" class="form-control" id="userFirstName" placeholder="Talia">
		</fieldset>

		<fieldset class="form-group">
			<label for="userLastNameInput">Last Name</label>
			<input type="text" class="form-control" id="userLastName" placeholder="Smith">
		</fieldset>

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
		<p>Great! When you submit this form this user will receive an email from "Time Crunch" with an activation link to
			reset their password.</p>
		<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
		<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i>Reset Form</button>

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
	<a href="scheduleView.php">Return to Schedule View</a>
</div>