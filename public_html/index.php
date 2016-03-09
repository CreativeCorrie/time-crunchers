<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>

		<!-- IE Rendering Mode = Edge-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
				crossorigin="anonymous"/>

		<!-- Optional theme -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
				integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
				crossorigin="anonymous"/>

		<!--Font Awesome CSS-->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"
				integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">

		<!-- LOAD OUR CUSTOM STYLESHEET HERE!!! -->
		<link href="css/style1.css" type="text/css" rel="stylesheet"/>

		<!-- HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

		<!-- Latest compiled and minified Bootstrap JavaScript, all compiled plugins included -->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
				  integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
				  crossorigin="anonymous"></script>
	</head>

	<title>Welcome to Time Crunch</title>
	<body id="landingPage">
		<header id="landingHeader">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Welcome to Time Crunch</h1>
					</div>
				</div>
			</div>
		</header>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Let's get started</h2>
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

				</div>
				<!--end of Account Holder content-->

				<!-- empty div to separate buttons-->
				<div class="col-md-2"></div>

				<!-- New User sign up -->
<!--				TODO: make this button match the Account Holder button but make it say Sign Up, change the form action to SignUpForm.php-->
				<div class="row">
					<div class="col-md-5">
						<form action="initialSignUp.php">
							<input type="submit" value="Go to Google">
						</form>

						<!-- End of new user sign up -->

					</div>
				</div>
				<br>
				<!-- forgot password -->

				<!--end of forgot password modal-->

	</body>
</html>