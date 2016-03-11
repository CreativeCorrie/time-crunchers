app.constant("LOGIN_ENDPOINT", "php/api/login/");
app.service("loginService", function($http, LOGIN_ENDPOINT) {
	function getUrl() {
		return(LOGIN_ENDPOINT);
	}
	this.create = function(login) {
		return($http.post(getUrl(), login));
	};
});

