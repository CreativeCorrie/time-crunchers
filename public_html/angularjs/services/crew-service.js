app.constant("CREW_ENDPOINT", "php/api/crew/");
app.service("CrewService", function($http, CREW_ENDPOINT) {

	function getUrl() {
		return(CREW_ENDPOINT);
	}

	function getUrlForId(crewId) {
		return(getUrl() + crewId);
		}

	this.fetchCrewById = function(crewId) {
		return($http.get(getUrlForId(crewId)));
	};

	this.fetchCrewByCompanyId = function(crewCompanyId) {
		return($http.get(getUrl() + "?crewCompanyId=" + crewCompanyId));
	};

	this.fetchCrewByLocation = function(crewLocation) {
		return($http.get(getUrl() + "?crewLocation=" + crewLocation));
	};

	this.update = function(crewId, crew) {
		return($http.put(getUrlForId(crewId, crew)));
	};

	this.create = function(crew) {
		return($http.post(getUrl(), crew));
	};

	this.destroy = function(crewId) {
		return($http.delete(getUrlForId(crewId)));
	};
});