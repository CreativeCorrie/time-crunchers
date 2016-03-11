app.constant("ACTIVATION_ENDPOINT", "php/api/schedule/");
app.service("scheduleService", function($http, ACTIVATION_ENDPOINT) {

	function getUrl() {
		return(ACTIVATION_ENDPOINT);
	}

	function getUrlForId(scheduleId) {
		return(getUrl() + scheduleId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetchScheduleByScheduleId = function(scheduleId) {
		return($http.get(getUrlForId() + scheduleId));
	};

	this.fetchScheduleByScheduleCrewId = function(scheduleCrewId) {
		return($http.get(getUrl() + "?scheduleCrewId=" + scheduleCrewId));
	};

	this.update = function(scheduleId, schedule) {
		return($http.put(getUrlForId(scheduleId, schedule)));
	};

	this.create = function(schedule) {
		return($http.post(getUrl(), schedule));
	};

	this.destroy = function(scheduleId) {
		return($http.delete(getUrlForId(scheduleId)));
	};
});