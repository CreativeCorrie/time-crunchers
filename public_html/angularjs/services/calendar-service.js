app.constant("SHIFT_ENDPOINT", "php/api/shift/");
app.service("CalendarService", function($http, SHIFT_ENDPOINT) {
	function getUrl() {
		return (SHIFT_ENDPOINT);
	}

	function getUrlForId(shiftId) {
		return (getUrl() + shiftId);
	}

	this.fetchShiftById = function(shiftId) {
		return ($http.get(getUrlForId(shiftId)));
	};

	this.fetchAllShifts = function() {
		return ($http.get(getUrl()));
	};
});