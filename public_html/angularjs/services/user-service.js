app.constant("ACTIVATION_ENDPOINT", "php/api/user/");
app.service("userService", function($http, ACTIVATION_ENDPOINT) {

	function getUrl() {
		return(ACTIVATION_ENDPOINT);
	}

	function getUrlForId(userId) {
		return(getUrl() + userId);
	}

	this.fetchUserById = function(userId) {
		return($http.get(getUrlForId(userId)));
	};

	this.fetchUserByEmail = function(userId) {
		return($http.get(getUrlForId(userId)));
	};

	this.fetchUserByActivation = function(userId) {
		return($http.get(getUrlForId(userId)));
	};


	this.fetchRequestsAll = function() {
		return($http.get(getUrl()));
	};

	this.update = function(userId, user) {
		return($http.put(getUrlForId(usertId, user)));
	};

	this.create = function(user) {
		return($http.post(getUrl(), user));
	};

	this.destroy = function(userId) {
		return($http.delete(getUrlForId(userId)));
	}
});