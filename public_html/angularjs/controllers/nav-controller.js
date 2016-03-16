app.controller("NavController", ["$http", "$scope", "$uibModal", function($http, $scope, $uibModal) {
	$scope.breakpoint = null;
	$scope.navCollapsed = null;
	$scope.pages = [];
	$scope.requestData = {};

	$scope.openRequest = function() {
		var requestInstance = $uibModal.open({
			templateUrl: "angularjs/templates/requestModal.php",
			controller: "RequestController",
			resolve: {
				requestData: function() {
					//console.log("The problem cannot be resolved");
					return ($scope.requestData);
				}
			}
		});
		requestInstance.result.then(function(requestData) {
			//console.log(requestData); //TODO: remove
			$scope.requestData = requestData;
			requestService.create(requestData)
				.then(function(reply) {
					if(reply.data.status === 200) {
						//console.log("Requested!"); // TODO: remove
						// NOTE: only the login should use $window; use $location anywhere else
						//$window.location.href = "/"
					} else {
						//console.log("Tacos Findley shall never see the light here");
					}
				});
		});
	};

	$scope.getPages = function() {
		$http.get("navmap.json")
			.then(function(reply) {
				if(reply.status === 200) {
					$scope.pages = reply.data.pages;
				}
			});
	};

	if($scope.pages.length === 0) {
		$scope.getPages();
	}

// collapse the navbar if the screen is changed to a extra small screen
	$scope.$watch("breakpoint", function() {
		$scope.navCollapsed = ($scope.breakpoint === "xs");
	});

}]);