app.constant("ACTIVATION_ENDPOINT", "php/api/activation/");
app.service("ActivationService", function($http, ACTIVATION_ENDPOINT) {
	function getUrl() {
		return(ACTIVATION_ENDPOINT);
	}
	this.create = function(activation) {
		return($http.post(getUrl(), activation));
	};
});

