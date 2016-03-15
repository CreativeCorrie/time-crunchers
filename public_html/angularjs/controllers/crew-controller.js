app.controller('CrewController', ["$scope", "$window", "$uibModal", "crewService", function($scope, $window, $uibModal, crewService) {
	$scope.alerts = [];
	$scope.crewData = {};

	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getCrewById = function() {
		crewService.fetchCrewById(crewId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.crewData = result.data.data;

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

	/**
	 * creates a crew and sends it to the crew API
	 *
	 * @param crew the crew to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createCrew = function(crew, validated) {
		if(validated === true) {
			crewService.create(crew)
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

	// embedded modal instance controller to create deletion prompt
	//var ModalInstanceCtrl = function($scope, $uibModalInstance) {
	//	$scope.yes = function() {
	//		$uibModalInstance.close();
	//	};
	//
	//	$scope.no = function() {
	//		$uibModalInstance.dismiss('cancel');
	//	};
	//};

}]);