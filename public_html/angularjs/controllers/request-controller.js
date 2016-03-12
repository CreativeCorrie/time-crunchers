app.controller('requestController', function($scope) {

	$scope.alerts = [];
	$scope.requestData = [];
	$scope.editedRequest = {};

	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getRequestById = function() {
		requestService.fetchRequestById(requestId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.requestData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAllRequests = function() {
		requestService.fetchAllRequests()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.requestData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

});