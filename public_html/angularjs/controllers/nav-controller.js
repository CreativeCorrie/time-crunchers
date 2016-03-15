app.controller("NavController", ["$http", "$scope", function($http, $scope) {
	$scope.breakpoint = null;
	$scope.navCollapsed = null;
	$scope.pages = [];

	$scope.openRequest = function() {
		var RequestInstance = $uibModal.open({
			templateUrl: "angularjs/pages/RequestModal.php",
			controller: "RequestModal",
			resolve: {
				RequestData: function(){
					//console.log("The problem cannot be resolved");
					return($scope.requestData);
				}
			}
		});
		requestInstance.result.then(function(requestData) {
			//console.log(loginData);
			$scope.requestData = requestData;
			requestService.request(requestData)
				.then(function(reply) {
					if(reply.data.status === 200) {
						//console.log("yay! teh login!");
						// NOTE: only the login should use $window; use $location anywhere else
						$window.location.href = "aboutView/"
					} else {
						//console.log("Tacos Findley shall never see the light here");
					}
				});
		});
	};
}]);

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