<div class="row">
	<div class="col-md-12">
		<h1>Let's get started!</h1>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
	<!-- sign up button -->
	<h4>Sign Up Your Company/Group for Time Crunch</h4>
	<br>
		<div class="button-container">
			<a href="adminSignUpForm/" class="btn btn-lg btn-success">Sign Up</a>
		</div>
	</div>

	<!-- Account Holder controls-->
	<h4>Already Have an Account?</h4>
	<div class="col-md-6">
		<!-- Log in modal trigger button -->
		<br>
		<div class="button-container">
			<button type="button" class="btn btn-info btn-lg" ng-click="openLogin();">
				Log In
			</button>
		</div>
	</div> <!-- end of column-->

	<!--Log In Modal -->
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
					<label for="modalLoginForm" class="control-label">Enter your email address and password
						here</label>
				</div>
			</div>
		</div>
	</div> <!-- End of Log in modal-->


</div> <!--end of row-->


<div class="row">
	<div class="col-md-12">
		<a href="setPassForm/">Forgot Password?</a>
	</div>


</div>


