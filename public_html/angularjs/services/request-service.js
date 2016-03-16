app.constant("REQUEST_ENDPOINT", "php/api/request/");
app.service("requestService", function($http, REQUEST_ENDPOINT) {

	function getUrl() {
		return (REQUEST_ENDPOINT);
	}

	function getUrlForId(requestId) {
		return (getUrl() + requestId);
	}

	this.fetchRequestById = function(requestId) {
		return ($http.get(getUrlForId(requestId)));
	};

	this.fetchAllRequests = function() {
		return ($http.get(getUrl()));
	};

	this.update = function(requestId, request) {
		return ($http.put(getUrlForId(requestId, request)));
	};

	this.create = function(request) {
		return ($http.post(getUrl(), request));
	};

	this.destroy = function(requestId) {
		return ($http.delete(getUrlForId(requestId)));
	}
});