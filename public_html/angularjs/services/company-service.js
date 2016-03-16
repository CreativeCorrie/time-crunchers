app.constant("COMPANY_ENDPOINT", "php/api/company/");
app.service("CompanyService", function($http, COMPANY_ENDPOINT) {

	function getUrl() {
		return(COMPANY_ENDPOINT);
	}

	function getUrlForId(companyId) {
		return(getUrl() + companyId);
	}

	this.update = function(companyId, company) {
		return($http.put(getUrlForId(companyId, company)));
	};

	this.create = function(company) {
		return($http.post(getUrl(), company));
	};

	this.destroy = function(companyId) {
		return($http.delete(getUrlForId(companyId)));
	};
});