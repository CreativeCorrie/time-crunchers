app.controller('requestController', function($scope) {

	$scope.alerts = [];
	$scope.requestData = [];
	$scope.editedRequest = {};


	//TODO: get data from form


	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getRequestsById = function() {
		requestService.fetchRequestsById(requestId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.requestData = result.data.data;  //TODO: is data.data correct.
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getCrewByCompanyId = function() {
		crewService.fetchCrewByCompanyId(crewCompanyId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.crewData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getCrewByLocation = function() {
		crewService.fetchCrewByLocation(crewLocation)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.crewData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
});