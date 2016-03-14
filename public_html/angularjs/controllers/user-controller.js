app.controller('UserController', function($scope) {
	$scope.alerts = [];
	$scope.userData = [];
	$scope.editedUser = [];

	$scope.getUserById = function() {
		userService.fetchUserById(userId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getUserByEmail = function() {
		userService.fetchUserByEmail(userEmail)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getUserByActivation = function() {
		userService.fetchUserByActivation(userActivation)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAllUsers = function() {
		userService.fetchAllUsers()
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.subscribe("user", "update", function(crew) {
		for(var i=0; i < scope.users.length; i++) {
			if($scope.users[1].userId === crew.users) {
				$scope.users[1] = user;
				break;
			}
		}
	});

	$scope.createUser = function(crew, validated) {
		if(validated === true) {

		}
	}



});