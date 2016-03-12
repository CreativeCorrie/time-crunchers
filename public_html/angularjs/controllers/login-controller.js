app.controller("loginController", ["$scope", "loginService", function($scope, loginService) {
	$scope.alerts = [];
	$scope.loginData = {};

	/**
	 * Method that uses the login service to login to an account
	 *
	 * @param loginData will contain login email and password
	 * @param validated true if form is valid, false if not
	 */

	$scope.sendLogin = function(loginData, validated) {
		if(validated === true) {
			loginService.create(loginData)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);