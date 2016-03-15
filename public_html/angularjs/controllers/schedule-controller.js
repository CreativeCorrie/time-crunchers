app.controller('ScheduleController', ["$scope", "$window", "$uibModal", "scheduleService", function($scope, $window, $uibModal, scheduleService) {
	$scope.alerts = [];
	$scope.scheduleData = {};


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

	$scope.getScheduleByScheduleId = function() {
		scheduleService.fetchScheduleByScheduleId(scheduleScheduleId)
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


	/**
	 * creates a schedule and sends it to the schedule API
	 *
	 * @param schedule the schedule to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createSchedule = function(schedule, validated) {
		if(validated === true) {
			ScheduleService.create(schedule)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newSchedule = {scheduleId: null, attribution: "", schedule: "", submitter: ""};
						$scope.addScheduleForm.$setPristine();
						$scope.addScheduleForm.$setUntouched();
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	// embedded modal instance controller to create deletion prompt
	var ModalInstanceCtrl = function($scope, $uibModalInstance) {
		$scope.yes = function() {
			$uibModalInstance.close();
		};

		$scope.no = function() {
			$uibModalInstance.dismiss('cancel');
		};
	};











}]);