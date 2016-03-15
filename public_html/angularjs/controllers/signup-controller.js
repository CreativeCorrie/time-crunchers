app.controller("SignUpController", ["$scope", "ActivationService", "$window", function($scope, ActivationService, $window) {
	$scope.alerts = [];
	$scope.activationData = {};

	/**
	 * Method that uses the activation service to activate an account
	 *
	 * @param activationData will contain activation token and password
	 * @param validated true if form is valid, false if not
	 */

	$scope.sendActivation = function(activationData, validated) {
		if(validated === true) {
			ActivationService.create(activationData)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$window.location.href = "buildCrew/";
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);