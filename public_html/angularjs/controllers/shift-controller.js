app.controller('ScheduleController', ["$scope", "$window", "$uibModal", "scheduleService", function($scope, $window, $uibModal, scheduleServiceService) {
	$scope.alerts = [];
	$scope.crewData = {};


	//TODO: get data from form


	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getShiftById = function() {
		shiftService.fetchShiftById(shiftId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.crewData = result.data.data;

				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getShiftByUserId = function() {
		shiftService.fetchShiftByUserId(shiftUserId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.shiftData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};



	/**
	 * creates a shift and sends it to the shift API
	 *
	 * @param shift the shift to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createShift = function(shift, validated) {
		if(validated === true) {
			ShiftService.create(shift)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newShift = {shiftId: null, attribution: "", shift: "", submitter: ""};
						$scope.addShiftForm.$setPristine();
						$scope.addShiftForm.$setUntouched();
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