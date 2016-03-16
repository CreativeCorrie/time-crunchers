app.constant("SCHEDULE_ENDPOINT", "php/api/schedule/");
app.service("ScheduleService", function($http, SCHEDULE_ENDPOINT) {

	function getUrl() {
		return(SCHEDULE_ENDPOINT);
	}

	function getUrlForId(scheduleId) {
		return(getUrl() + scheduleId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetchScheduleById = function(scheduleId) {
		return($http.get(getUrlForId() + scheduleId));
	};

	this.fetchScheduleByCrewId = function(scheduleCrewId) {
		return($http.get(getUrl() + "?scheduleCrewId=" + scheduleCrewId));
	};

	this.fetchAllSchedules = function() {
		return($http.get(getUrl()));
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