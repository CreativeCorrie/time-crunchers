<?php
$activation = filter_input(INPUT_GET, "emailActivation", FILTER_SANITIZE_STRING);
if(ctype_xdigit($activation) === false) {
	throw(new InvalidArgumentException("invalid activation token", 405));
}
?>

<div class="container">
	<div class="row" ng-controller="activationController">
		<div class="col-sm-8 col-sm-offset-3">
			<h2>Choose a Password</h2>
			<p class="text-center">Use the form below to set your password. Your password cannot be the same as your
				username.</p>
			<form name="activationForm" id="activationForm"
					ng-submit="sendActivation(activationData, activationForm.$valid);" novalidate>
				<input type="hidden" name="emailActivation" id="emailActivation"
						 ng-model="activationData.emailActivation" value="<?php echo $activation; ?>"/>
				<input type="password" class="input-lg form-control" name="password1" id="password1"
						 placeholder="New Password" autocomplete="off" ng-model="activationData.password" ng-minlength="8"
						 ng-required="true">
				<div class="row">
					<div class="col-sm-8">
						<span id="8char" class="glyphicon glyphicon-flag setPass"></span> 8 Characters
						Long<br>
						<span id="ucase" class="glyphicon glyphicon-flag setPass"></span> One Uppercase
						Letter
					</div>
					<div class="col-sm-8">
						<span id="num" class="glyphicon glyphicon-flag setPass"></span> One Number <br>
						<span id="lcase" class="glyphicon glyphicon-flag setPass"></span> One Lowercase
						Letter
					</div>
				</div>
				<input type="password" class="input-lg form-control" name="confirmPassword" id="confirmPassword"
						 placeholder="Repeat Password" autocomplete="off" ng-model="activationData.confirmPassword"
						 ng-minlength="8" ng-required="true">
				<!--						<div class="row">-->
				<!--							<div class="col-sm-12">-->
				<!--								<span id="pwmatch" class="glyphicon glyphicon-remove setPass"></span> Passwords-->
				<!--								Match-->
				<!--							</div>-->
				<!--						</div>-->
				<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"
						 data-loading-text="Changing Password..." value="Change Password">
			</form>
		</div><!--/col-sm-6-->
		<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg }}
		</uib-alert>
	</div><!--/row-->
</div>