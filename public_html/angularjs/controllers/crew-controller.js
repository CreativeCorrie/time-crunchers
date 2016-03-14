app.controller('CrewController', function($scope) {
	$scope.alerts = [];
	$scope.crewData = [];
	$scope.editedCrew = {};


	//TODO: get data from form


	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getCrewById = function() {
		crewService.fetchCrewById(crewId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.crewData = result.data.data;  //TODO: is data.data correct.

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

	// subscript to the update channel; this will update the crews array on demand
	Pusher.subscribe("crew", "update", function(crew) {
		for(var i = 0; i < $scope.crews.length; i++) {
			if($scope.crews[i].crewId === shift.crewId) {
				$scope.crews[i] = crew;
				break;
			}
		}
	});


	/**
	 * creates a crew and sends it to the crew API
	 *
	 * @param crew the crew to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createCrew = function(crew, validated) {
		if(validated === true) {
			CrewService.create(crew)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newShift = {shiftId: null, attribution: "", crew: "", submitter: ""};
						$scope.addCrewForm.$setPristine();
						$scope.addCrewForm.$setUntouched();
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	// subscribe to the delete channel; this will delete from the crew array on demand
	Pusher.subscribe("crew", "delete", function(crew) {
		for(var i = 0; i < $scope.crews.length; i++) {
			if($scope.crews[i].crewId === shift.crewId) {
				$scope.crews.splice(i, 1);
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