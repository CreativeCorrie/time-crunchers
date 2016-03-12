app.controller("NavController", ["$http", "$scope", function($http, $scope) {
	$scope.breakpoint = null;
	$scope.navCollapsed = null;
	$scope.pages = [];

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