app.controller('scheduleController', function($scope) {

	$scope.alerts = [];
	$scope.scheduleData = [];
	$scope.editedSchedule = {};

	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getScheduleById = function() {
		scheduleService.fetchScheduleById(scheduleId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.scheduleData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getScheduleByCrewId = function() {
		scheduleService.fetchScheduleByCrewId(scheduleCrewId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.scheduleData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAllSchedules = function() {
		scheduleService.fetchAllSchedules()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.scheduleData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

});