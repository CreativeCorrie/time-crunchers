app.controller('AdminRequestViewController', ["$routeParams", "$scope", "requestService", function($routeParams, $scope, requestService) {
	$scope.requestData = null;
	$scope.alerts = [];

	$scope.getRequest = function() {
		requestService.fetch($routeParams.id)
			.then(function(result) {
				if(result.data.status === 200) {
					if(result.data.data !== undefined) {
						$scope.requestData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				}
			});
	};

	/**
	 * updates a request and sends it to the request API
	 *
	 * @param request the request to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.updateRequest = function(request, validated) {
		if(validated === true) {
			requestService.update(request.requestId, request)
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