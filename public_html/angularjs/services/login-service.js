app.constant("LOGIN_ENDPOINT", "php/api/login/");
app.service("LoginService", function($http, LOGIN_ENDPOINT) {
	function getUrl() {
		return(LOGIN_ENDPOINT);
	}
	this.login = function(login) {
		return($http.post(getUrl(), login));
	};
});

