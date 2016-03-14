app.controller('UserController', ["$scope", "userService", function($scope, userService) {
	$scope.alerts = [];
	$scope.userData = [];

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
	/**
	 * creates a user and sends it to the user API
	 *
	 * @param user the user to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createUser = function(user, validated) {
		if(validated === true) {
			userService.create(user)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newUser = {userId: null, userCompanyId: null, userCrewId: null, userAccessId: null, userPhone: "",userFirstName: "", userLastName: "", userEmail: ""};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	/**
	 * updates a user and sends it to the user API
	 *
	 * @param user the user to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.updateUser= function(user, validated) {
		if(validated === true) {
			userService.update(user.userId, user)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
// really not sure if this belongs
	if($scope.user === null) {
		$scope.getUser();
	}


}]);

