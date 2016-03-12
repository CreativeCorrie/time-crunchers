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
						<form class="form-inline" id="modalLoginForm">
							<div class="form-group">
								<label for="emailLoginEmail" class="sr-only">Email: </label>
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
									</div>
									<input type="email" class="form-control" id="emailLoginEmail"
											 placeholder="enter email address"/>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="sr-only">Password: </label>
								<div class="input-group">
									<div class="input-group-addon"><span class="glyphicon glyphicon-plus-sign"></span>
									</div>
									<input type="text" class="form-control" id="password"
											 placeholder="enter password"/>
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
