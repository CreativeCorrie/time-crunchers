<!-- this form is for an employee that needs to request time off. -->

<!--<h2>Make your Request</h2>-->
<!---->
<!--<div class="container">-->
<!--	<div class="row">-->
<!--		<div class="col-md-8">-->
<!--			<form>-->
<!---->
<!--				<fieldset class="form-group">-->
<!--					<label for="userFirstNameInput">Employee First Name</label>-->
<!--					<input type="text" class="form-control" id="userFirstName" placeholder="Talia">-->
<!---->
<!--					<label for="userLastNameInput">Employee Last Name</label>-->
<!--					<input type="text" class="form-control" id="userLastName" placeholder="Martinez">-->
<!--				</fieldset>-->
<!---->
<!--				<fieldset class="form-group">-->
<!--					<label for="userPhoneInput">Employee Phone Number</label>-->
<!--					<input type="text" class="form-control" id="userPhone" placeholder="999-888-7777">-->
<!--					<small class="text-muted">-->
<!--						This field is optional.-->
<!--					</small>-->
<!--				</fieldset>-->
<!---->
<!--				<fieldset class="form-group">-->
<!--					<label for="userEmailInput">Employee Email Address</label>-->
<!--					<input type="text" class="form-control" id="userEmail" placeholder="taliamartinez@tacos.com">-->
<!--					<p class="text-danger">This is the email address your activation code will be sent to.</p>-->
<!--				</fieldset>-->
<!---->
<!--				<fieldset class="form-group">-->
<!--					<label for="crewLocationInput">Crew Location</label>-->
<!--					<input type="text" class="form-control" id="crewLocation" placeholder="Managers Only">-->
<!--					<label for="companyNameInput">Company Name</label>-->
<!--					<input type="text" class="form-control" id="companyName" placeholder="Findley's Tacos">-->
<!--				</fieldset>-->
<!---->
<!--				<hr>-->
<!---->
<!--				<legend>Choose type of Request</legend>-->
<!--				<p>-->
<!--					<select id="myList">-->
<!--						<option value 0>select the type of Request you would like to make</option>-->
<!--						<option value 1>Vacation Time</option>-->
<!--						<option value 2>Sick/Maturnity Leave</option>-->
<!--						<option value 3>Emergency</option>-->
<!--						<option value 4>Transfer</option>-->
<!--					</select>-->
<!--				</p>-->
<!---->
<!--				<fieldset class="form-group">-->
<!--					<label for="userRequest">Leave your Request</label>-->
<!--					</br>-->
<!--					<textarea class="form-control" rows="8" columns="20" id="userRequest" name="request" placeholder="To whom it may concern..."></textarea>-->
<!--				</fieldset>-->
<!---->
<!--				<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>-->
<!--				<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i> Reset Form</button>-->
<!---->
<!---->
<!--			</form>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->


<form class="form-inline" id="modalRequestForm" name="modalRequestForm" ng-submit="ok();" novalidate>
	<div>
		<div class="form-group">
			<label class="form-inline" for="modalRequestForm"></label>
			<div class="input-group">
				<input type="text" class="form-control" id="userRequest" name="userRequest"
						 placeholder="Make your Request"
						 ng-required="true"/>
				<div class="alert alert-danger" role="alert" ng-messages="modalRequestForm.userRequest.$error"
					<p ng-message="required">Please leave a brief message to explain your request.</p>
				</div>
			</div>
		</div>
	</div>

</form>