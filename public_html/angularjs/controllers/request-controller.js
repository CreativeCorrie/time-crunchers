app.controller('RequestController', function($scope) {
	$scope.alerts = [];
	$scope.requestData = {};
	$scope.editedRequest = {};

	/**
	 * START METHOD(S): FETCH/GET
	 *
	 */

	$scope.getRequestById = function() {
		requestService.fetchRequestById(requestId)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.requestData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAllRequests = function() {
		requestService.fetchAllRequests()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.requestData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	/**
	 * updates a request and sends it to the misquote API
	 *
	 * @param request the request to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.updateRequest = function(request, validated) {
		if(validated === true) {
			requestService.update(request.requestId, request)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	/**
	 * deletes a request and sends it to the misquote API, if the user confirms deletion
	 *
	 * @param requestId the misquote id to delete
	 **/
	$scope.deleteRequest = function(requestId) {
		// create a modal instance to prompt the user if she/he is sure they want to delete the misquote
		var message = "Do you really want to delete this request?";

		var modalHtml = '<div class="modal-body">' + message + '</div><div class="modal-footer"><button class="btn btn-primary" ng-click="yes()">Yes</button><button class="btn btn-warning" ng-click="no()">No</button></div>';

		var modalInstance = $uibModal.open({
			template: modalHtml,
			controller: ModalInstanceCtrl
		});

		// if the user clicked "yes", delete the misquote
		modalInstance.result.then(function () {
			requestService.destroy(requestId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.deletedRequest = true;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		});
	};

	if($scope.request === null) {
		$scope.getRequest();
	}


});

var ModalInstanceCtrl = function($scope, $uibModalInstance) {
	$scope.yes = function() {
		$uibModalInstance.close();
	};

	$scope.no = function() {
		$uibModalInstance.dismiss('cancel');
	};
};