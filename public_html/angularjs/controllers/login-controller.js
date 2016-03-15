app.controller("LoginController", ["$scope", "$window", "$uibModal", "loginService", function($scope, $window, $uibModal, loginService) {
	$scope.alerts = [];
	$scope.loginData = {};

	$scope.openLoginModal = function(){
		var loginModalInstance = $uibModal.open({
			template: modalHtml,
			controller: ModalInstanceCtrl
		});
	};


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
						console.log ("we got here");
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$window.location.href = '/';
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);