app.constant("ACTIVATION_ENDPOINT", "php/api/user/");
app.service("UserService", function($http, ACTIVATION_ENDPOINT) {

	function getUrl() {
		return(ACTIVATION_ENDPOINT);
	}

	function getUrlForId(userId) {
		return(getUrl() + userId);
	}

	this.fetchUserById = function(userId) {
		return($http.get(getUrlForId(userId)));
	};

	this.fetchUserByEmail = function(userEmail) {
		return($http.get(getUrl()+ "?userEmail=" + userEmail));
	};

	this.fetchUserByActivation = function(userActivation) {
		return($http.get(getUrl()+ "?userActivation=" + userActivation));
	};

	this.fetchAllUsers = function() {
		return($http.get(getUrl()));
	};

	this.update = function(userId, user) {
		return($http.put(getUrlForId(userId, user)));
	};

	this.create = function(user) {
		return($http.post(getUrl(), user));
	};

	this.destroy = function(userId) {
		return($http.delete(getUrlForId(userId)));
	}
});