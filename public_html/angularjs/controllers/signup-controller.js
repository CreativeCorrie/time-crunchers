app.controller("SignupController", ["$scope", "SignupService", "$window", function($scope, SignupService, $window) {
	$scope.alerts = [];
	$scope.activationData = {};

	/**
	 * Method that uses the activation service to activate an account
	 *
	 * @param signUpData will contain activation token and password
	 * @param validated true if form is valid, false if not
	 */

	$scope.sendActivation = function(signUpData, validated) {
		console.log("line 13 controller");
		if(validated === true) {
			SignupService.create(signUpData)
				.then(function(result) {
					console.log("line 17 controller")
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$window.location.href = "userSignUpForm/";
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);