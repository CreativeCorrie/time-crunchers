<div class="row">
	<div class="col-md-12">
		<h2>Let's get started!</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-5">

		<!-- Account Holder controls-->
		<h4>Already Have an Account?</h4>

		<!-- modal trigger button -->
		<br>
		<div class="button-container">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-lg">Log In
			</button>
		</div>

		<!--Log In Modal -->
		<!--					TODO: this modal needs to hook up with the login API-->
		<div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
			  aria-hidden="true" data-keyboard="true">
			<!-- Modals have two optional sizes, available via class="modal-lg" or class="modal-sm" -->
			<div class="modal-dialog modal-lg">
				<!-- Begin modal content here -->
				<div class="modal-content">
					<div class="modal-header">
						<!-- close button -->
						<button type="button" class="close" data-dismiss="modal" aria-label="close">
							<span aria-hidden="true">×</span>
						</button>
						<h3 class="modal-title">Take me to Time Crunch!</h3>
					</div>
					<div class="modal-body">
						<!--									<p>Come to Time Crunch LOL</p>-->
						<label for="modalLoginForm" class="control-label">Enter your email address and password
							here</label>
						<form class="form-inline" id="modalLoginForm" name="modalLoginForm" ng-submit="sendLogin(loginData, loginData.$valid);">
							<div class="form-group">
								<label for="emailLoginEmail" class="sr-only">Email: </label>
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
									</div>
									<input type="email" class="form-control" id="loginEmail" name="loginEmail"
											 placeholder="enter email address" ng-model="loginData.userEmail" ng-minlength="6" ng-maxlength="64" ng-required="true"/>
									<div class="alert alert-danger" role="alert" ng-messages="modalLoginForm.loginEmail.$error" ng-if="modalLoginForm.loginEmail.$touched" ng-hide="modalLoginForm.loginEmail.$valid">
										<p ng-message="minlength">Email is too short.</p>
										<p ng-message="maxlength">Email is too long.</p>
										<p ng-message="required">Please enter your email.</p>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="sr-only">Password: </label>
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-plus-sign"></span>
									</div>
									<input type="password" class="form-control" id="userPassword" name="userPassword"
											 placeholder="enter password" ng-model="loginData.userPassword" ng-minlength="8" ng-required="true"/>
									<div class="alert alert-danger" role="alert" ng-messages="modalLoginForm.userPassword.$error" ng-if="modalLoginForm.userPassword.$touched" ng-hide="modalLoginForm.userPassword.$valid">
										<p ng-message="minlength">Password is too short.</p>
										<p ng-message="required">Please enter your password.</p>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-info">Log In</button>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- End of Log in modal-->
		<div class="col-md-12"></div>
		<div class="row">
			<!-- sign up -->
			<div class="container">
				<a id="buttonSpacer" href="../templates/adminSignUpForm.php">Sign Up</a>
				<!-- forgot password-->
				<a href="setPassForm.php">Forgot my password</a>
			</div>
		</div>
	</div>
	<!--end of Account Holder content-->
</div>
