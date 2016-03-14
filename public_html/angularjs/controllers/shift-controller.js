app.controller('ShiftController', function($scope) {
	$scope.alerts = [];
	$scope.shiftData = [];
	$scope.editedShift = {};

	$scope.getShiftById = function() {
		shiftService.fetchShiftById(shiftId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.shiftData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getShiftById = function() {
		shiftService.fetchShiftByUserId(shiftUserId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.shiftData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAllShifts = function() {
		shiftService.fetchAllShifts()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.shiftData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
});