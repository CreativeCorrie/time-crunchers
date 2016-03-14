app.controller('AccessController', function($scope) {
	$scope.alerts = [];
	$scope.accessData = {};

	$scope.getAccessById = function() {
		accessService.fetchAccessById(accessId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.accessData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAccessByUser = function() {
		accessService.fetchAccessByName(accessName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.accessData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAllAccesses = function() {
		accessService.fetchAllAccesses()
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.accessData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
});