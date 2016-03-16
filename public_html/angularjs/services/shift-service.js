app.constant("SHIFT_ENDPOINT", "php/api/shift/");
app.service(ShiftService", function($http, SHIFT_ENDPOINT) {

	function getUrl() {
		return(SHIFT_ENDPOINT);
	}

	function getUrlForId(shiftId) {
		return(getUrl() + shiftId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetchShiftById = function(shiftId) {
		return($http.get(getUrlForId() + shiftId));
	};

	this.fetchShiftByUserId = function(shiftUserId) {
		return($http.get(getUrl() + "?shiftUserId=" + shiftUserId));
	};

	this.fetchAllShifts = function(){
		return($http.get(getUrl()));
	};

	this.update = function(shiftId, shift) {
		return($http.put(getUrlForId(shiftId, shift)));
	};

	this.create = function(shift) {
		return($http.post(getUrl(), shift));
	};

	this.destroy = function(shiftId) {
		return($http.delete(getUrlForId(shiftId)));
	};
});