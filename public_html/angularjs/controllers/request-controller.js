app.controller('RequestController', ["$scope", "requestService", function($scope, requestService) {
	$scope.alerts = [];
	$scope.requestData = {};
	$scope.currentRequests = [];

	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */
	$scope.getRequestById = function(requestId) {
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
				//console.log(result);
				if(result.data.status === 200) {
					console.log("testing");
					console.log(result.data.data);
					$scope.currentRequests = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	/**
	 * creates a request and sends it to the request API
	 *
	 * @param request the request to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createRequest = function(request, validated) {
		if(validated === true) {
			requestService.create(request)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.requestData = {};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
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
// really not sure if this belongs
	if($scope.currentRequests.length <= 0) {
	$scope.getAllRequests();
	}

}]);
