app.controller('CrewController', function($scope) {
	$scope.alerts = [];
	$scope.shiftData = [];
	$scope.editedShift = {};


	//TODO: get data from form


	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getShiftById = function() {
		shiftService.fetchShiftById(shiftId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.crewData = result.data.data;  //TODO: is data.data correct.

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

	// subscript to the update channel; this will update the shifts array on demand
	Pusher.subscribe("shift", "update", function(shift) {
		for(var i = 0; i < $scope.shifts.length; i++) {
			if($scope.shifts[i].shiftId === shift.shiftId) {
				$scope.shifts[i] = shift;
				break;
			}
		}
	});


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

	// subscribe to the delete channel; this will delete from the shift array on demand
	Pusher.subscribe("shift", "delete", function(shift) {
		for(var i = 0; i < $scope.shifts.length; i++) {
			if($scope.shifts[i].shiftId === shift.shiftId) {
				$scope.shifts.splice(i, 1);
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