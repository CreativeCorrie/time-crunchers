app.constant("ACCESS_ENDPOINT", "php/api/access/");
app.service("AccessService", function($http, ACCESS_ENDPOINT) {

	function getUrl() {
		return(ACCESS_ENDPOINT);
	}

	function getUrlForId(accessId) {
		return(getUrl() + accessId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetchAccessById = function(accessId) {
		return($http.get(getUrlForId() + accessId));
	};

	this.fetchAccessByName = function(accessName) {
		return($http.get(getUrl() + "?accessName=" + accessName));
	};

	this.fetchAllAccesses = function() {
		return($http.get(getUrl()));
	};

	this.update = function(accessId, access) {
		return($http.put(getUrlForId(accessId, access)));
	};

	this.create = function(access) {
		return($http.post(getUrl(), access));
	};

	this.destroy = function(accessId) {
		return($http.delete(getUrlForId(accessId)));
	};

});