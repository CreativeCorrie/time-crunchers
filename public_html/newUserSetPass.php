<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>

		<!-- IE Rendering Mode = Edge-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


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
		<script src="angularjs/services/changePassForm.js"></script>

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

	<title></title>
	<body>

		<?php
		$activation = filter_input(INPUT_GET, "emailActivation", FILTER_SANITIZE_STRING);
		if(ctype_xdigit($activation) === false) {
			throw(new InvalidArgumentException("invalid activation token", 405));
		}
		?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Choose a Password</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<p class="text-center">Use the form below to set your password. Your password cannot be the same as your
						username.</p>
					<form method="post" id="passwordForm">
						<input type="hidden" name="emailActivation" id="emailActivation" ng-model="passwordReset.emailActivation" value="<?php echo $activation; ?>"/>
						<input type="password" class="input-lg form-control" name="password1" id="password1"
								 placeholder="New Password" autocomplete="off">
						<div class="row">
							<div class="col-sm-6">
								<span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 Characters
								Long<br>
								<span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Uppercase
								Letter
							</div>
							<div class="col-sm-6">
								<span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Lowercase
								Letter<br>
								<span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Number
							</div>
						</div>
						<input type="password" class="input-lg form-control" name="password2" id="password2"
								 placeholder="Repeat Password" autocomplete="off">
						<div class="row">
							<div class="col-sm-12">
								<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Passwords
								Match
							</div>
						</div>
						<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"
								 data-loading-text="Changing Password..." value="Change Password">
					</form>
				</div><!--/col-sm-6-->
			</div><!--/row-->
		</div>
	</body>
</html>