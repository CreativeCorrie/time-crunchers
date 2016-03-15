<form class="form-inline" id="modalLoginForm" name="modalLoginForm" ng-submit="ok();" novalidate>
	<div class="form-group">

		<label for="emailLoginEmail" class="sr-only">Email: </label>
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
			</div>
			<input type="email" class="form-control" id="loginEmail" name="loginEmail"
					 placeholder="enter email address" ng-model="loginData.userEmail" ng-minlength="6"
					 ng-maxlength="64" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="modalLoginForm.loginEmail.$error"
				  ng-if="modalLoginForm.loginEmail.$touched" ng-hide="modalLoginForm.loginEmail.$valid">
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
					 placeholder="enter password" ng-model="loginData.userPassword" ng-minlength="8"
					 ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="modalLoginForm.userPassword.$error"
				  ng-if="modalLoginForm.userPassword.$touched"
				  ng-hide="modalLoginForm.userPassword.$valid">
				<p ng-message="required">Please enter your password.</p>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-info" ng-disabled="signinForm.$invalid">Log In</button>
	<button type="reset" class="btn btn-warning" ng-click="cancel();">Cancel</button>
</form>