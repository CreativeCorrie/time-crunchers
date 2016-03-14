app.controller('CompanyController', function($scope) {

	$scope.alerts = [];
	$scope.companyData = [];
	$scope.editedCompany = {};

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

	// subscript to the update channel; this will update the schedules array on demand
	Pusher.subscribe("schedule", "update", function(schedule) {
		for(var i = 0; i < $scope.schedules.length; i++) {
			if($scope.schedules[i].scheduleId === schedule.scheduleId) {
				$scope.schedules[i] = schedule;
				break;
			}
		}
	});


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

	// subscribe to the delete channel; this will delete from the schedule array on demand
	Pusher.subscribe("schedule", "delete", function(schedule) {
		for(var i = 0; i < $scope.schedules.length; i++) {
			if($scope.schedules[i].scheduleId === schedule.scheduleId) {
				$scope.schedules.splice(i, 1);
				break;
			}
		}
	});

	// embedded modal instance controller to create deletion prompt
	var ModalInstanceCtrl = function($scope, $uibModalInstance) {
		$scope.yes = function() {
			$uibModalInstance.close();
		};

		$scope.no = function() {
			$uibModalInstance.dismiss('cancel');
		};
	};











});